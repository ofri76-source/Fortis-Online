<?php
/**
 * Core plugin logic for KB - Fortis Toolbox.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main plugin class.
 */
class Fortis_Toolbox_Plugin {
    /**
     * Singleton instance.
     *
     * @var Fortis_Toolbox_Plugin|null
     */
    private static $instance = null;

    /**
     * Section definitions used to build per-topic shortcode pages.
     *
     * @var array
     */
    private $sections = array(
        'new_forti'   => array(
            'title'       => 'New Forti',
            'description' => 'Baseline device identity and onboarding details.',
        ),
        'virtual_ip'  => array(
            'title'       => 'Virtual IP',
            'description' => 'External VIP definitions and mapped addresses.',
        ),
        'address'     => array(
            'title'       => 'Address',
            'description' => 'Address objects, CIDR ranges, and labels.',
        ),
        'security'    => array(
            'title'       => 'Security',
            'description' => 'Firewall posture, profiles, and access safeguards.',
        ),
        'alerts'      => array(
            'title'       => 'Alerts',
            'description' => 'Notification channels, recipients, and thresholds.',
        ),
        'import'      => array(
            'title'       => 'Import',
            'description' => 'Upload or paste existing configuration snippets.',
        ),
        'settings'    => array(
            'title'       => 'Settings',
            'description' => 'Global toolbox preferences and defaults.',
        ),
    );

    /**
     * Bootstrap the plugin singleton.
     */
    public static function bootstrap() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Register hooks.
     */
    private function __construct() {
        add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
        add_action( 'admin_post_fortis_toolbox_generate', array( $this, 'handle_generate_request' ) );
        add_shortcode( 'fortis_toolbox', array( $this, 'render_frontend_shortcode' ) );
        foreach ( array_keys( $this->sections ) as $section_slug ) {
            add_shortcode( 'fortis_toolbox_' . $section_slug, array( $this, 'render_section_shortcode' ) );
        }
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'maybe_enqueue_frontend_assets' ) );
    }

    /**
     * Add the admin menu entry.
     */
    public function register_admin_menu() {
        add_menu_page(
            __( 'Fortis Toolbox', 'fortis-toolbox' ),
            __( 'Fortis Toolbox', 'fortis-toolbox' ),
            'manage_options',
            'fortis-toolbox',
            array( $this, 'render_admin_page' ),
            'dashicons-admin-tools',
            85
        );
    }

    /**
     * Enqueue styles and scripts shared between admin and shortcode.
     */
    public function enqueue_assets() {
        wp_enqueue_style(
            'fortis-toolbox-styles',
            FORTIS_TOOLBOX_URL . 'assets/css/fortis-toolbox.css',
            array(),
            '0.1.0'
        );

        wp_enqueue_script(
            'fortis-toolbox-scripts',
            FORTIS_TOOLBOX_URL . 'assets/js/fortis-toolbox.js',
            array(),
            '0.1.0',
            true
        );
    }

    /**
     * Enqueue assets only on the plugin admin page.
     *
     * @param string $hook Current admin page hook.
     */
    public function enqueue_admin_assets( $hook ) {
        if ( 'toplevel_page_fortis-toolbox' !== $hook ) {
            return;
        }

        $this->enqueue_assets();
    }

    /**
     * Enqueue assets on the frontend when the shortcode is present.
     */
    public function maybe_enqueue_frontend_assets() {
        if ( is_admin() ) {
            return;
        }

        $post = get_post();
        if ( ! $post || ! has_shortcode( $post->post_content, 'fortis_toolbox' ) ) {
            return;
        }

        $this->enqueue_assets();
    }

    /**
     * Render admin page.
     */
    public function render_admin_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $generated_config = $this->consume_generated_config();

        require FORTIS_TOOLBOX_PATH . 'views/admin-page.php';
    }

    /**
     * Render the shortcode output.
     */
    public function render_frontend_shortcode() {
        if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
            return '<p>' . esc_html__( 'You must be logged in as an administrator to use this tool.', 'fortis-toolbox' ) . '</p>';
        }

        $this->enqueue_assets();

        $generated_config = $this->consume_generated_config();
        $cli_blocks       = $this->get_cli_blocks();

        ob_start();
        require FORTIS_TOOLBOX_PATH . 'views/shortcode.php';
        return ob_get_clean();
    }

    /**
     * Render a section-specific shortcode view.
     *
     * @param array       $atts    Shortcode attributes.
     * @param string|null $content Content (unused).
     * @param string      $tag     Shortcode tag name.
     *
     * @return string
     */
    public function render_section_shortcode( $atts, $content = null, $tag = '' ) {
        $slug      = str_replace( 'fortis_toolbox_', '', (string) $tag );
        $sections  = $this->get_sections();
        $template  = FORTIS_TOOLBOX_PATH . 'views/sections/' . $slug . '.php';

        if ( ! isset( $sections[ $slug ] ) || ! file_exists( $template ) ) {
            return '';
        }

        $this->enqueue_assets();

        $section_links  = $this->get_section_links();
        $current_slug   = $slug;
        $current_config = $sections[ $slug ];

        ob_start();
        require $template;
        return ob_get_clean();
    }

    /**
     * Handle form submission and generate a very basic config skeleton.
     */
    public function handle_generate_request() {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( __( 'You are not allowed to do this.', 'fortis-toolbox' ) );
        }

        check_admin_referer( 'fortis_toolbox_generate', 'fortis_toolbox_nonce' );

        $client_name = isset( $_POST['fortis_client_name'] ) ? sanitize_text_field( wp_unslash( $_POST['fortis_client_name'] ) ) : '';
        $model       = isset( $_POST['fortis_model'] ) ? sanitize_text_field( wp_unslash( $_POST['fortis_model'] ) ) : '';
        $wan_mode    = isset( $_POST['fortis_wan_mode'] ) ? sanitize_text_field( wp_unslash( $_POST['fortis_wan_mode'] ) ) : 'dhcp';
        $source      = isset( $_POST['fortis_source'] ) ? sanitize_text_field( wp_unslash( $_POST['fortis_source'] ) ) : 'admin';

        if ( empty( $client_name ) || empty( $model ) ) {
            $redirect = ( 'shortcode' === $source && wp_get_referer() )
                ? wp_get_referer()
                : add_query_arg( array( 'page' => 'fortis-toolbox', 'fortis_error' => 'missing_fields' ), admin_url( 'admin.php' ) );

            wp_safe_redirect( $redirect );
            exit;
        }

        $config_lines   = array();
        $config_lines[] = sprintf( '# Fortis Toolbox generated config for client: %s', $client_name );
        $config_lines[] = sprintf( '# Model: %s', $model );
        $config_lines[] = sprintf( '# WAN mode: %s', strtoupper( $wan_mode ) );
        $config_lines[] = '';
        $config_lines[] = 'config system global';
        $config_lines[] = sprintf( '    set hostname "%s-%s"', $client_name, $model );
        $config_lines[] = 'end';
        $config_lines[] = '';
        $config_lines[] = '# TODO: add real interface, policy and object configuration here.';

        $generated_config = implode( "\n", $config_lines );
        set_transient( 'fortis_toolbox_last_config', $generated_config, MINUTE_IN_SECONDS * 10 );

        $redirect = ( 'shortcode' === $source && wp_get_referer() )
            ? wp_get_referer()
            : add_query_arg( array( 'page' => 'fortis-toolbox' ), admin_url( 'admin.php' ) );

        wp_safe_redirect( $redirect );
        exit;
    }

    /**
     * Retrieve generated config from transient and clean it after use.
     *
     * @return string
     */
    private function consume_generated_config() {
        $generated_config = get_transient( 'fortis_toolbox_last_config' );
        delete_transient( 'fortis_toolbox_last_config' );

        return (string) $generated_config;
    }

    /**
     * Return the list of CLI blocks for filtering.
     *
     * @return array
     */
    public function get_cli_blocks() {
        return array(
            'new_forti'  => 'New Forti',
            'virtual_ip' => 'Virtual IP',
            'address'    => 'Address',
            'security'   => 'Security',
            'alerts'     => 'Alerts',
            'import'     => 'Import',
            'settings'   => 'Settings',
        );
    }

    /**
     * Return the list of section definitions.
     *
     * @return array
     */
    public function get_sections() {
        return $this->sections;
    }

    /**
     * Build nav links for the section pages.
     *
     * @return array
     */
    public function get_section_links() {
        $links = array();

        $default_urls = array(
            'new_forti'  => 'https://kb.macompo.co.il/?page_id=14249',
            'virtual_ip' => 'https://kb.macompo.co.il/?page_id=14254',
            'address'    => 'https://kb.macompo.co.il/?page_id=14255',
            'security'   => 'https://kb.macompo.co.il/?page_id=14256',
            'alerts'     => 'https://kb.macompo.co.il/?page_id=14264',
            'import'     => 'https://kb.macompo.co.il/?page_id=14252',
            'settings'   => 'https://kb.macompo.co.il/?page_id=14257',
        );

        foreach ( $this->sections as $slug => $section ) {
            $links[ $slug ] = array(
                'slug'  => $slug,
                'title' => $section['title'],
                'url'   => apply_filters(
                    'fortis_toolbox_section_url',
                    isset( $default_urls[ $slug ] ) ? $default_urls[ $slug ] : '#',
                    $slug,
                    $section
                ),
            );
        }

        /**
         * Filter the nav links used on section pages.
         *
         * @param array $links Array of section links.
         */
        return apply_filters( 'fortis_toolbox_section_links', $links );
    }
}
