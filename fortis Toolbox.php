<?php
/**
 * Plugin Name: KB - Fortis Toolbox
 * Description: Internal toolbox for generating Fortigate configuration snippets from the WordPress admin.
 * Version: 0.1.0
 * Author: O.K Software
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Fortis_Toolbox_Plugin' ) ) :

class Fortis_Toolbox_Plugin {

    /**
     * Constructor.
     */
    public function __construct() {
        // Admin menu.
        add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );

        // Handle form submit.
        add_action( 'admin_post_fortis_toolbox_generate', array( $this, 'handle_generate_request' ) );

        // Shortcode for frontend pages.
        add_shortcode( 'fortis_toolbox', array( $this, 'render_frontend_shortcode' ) );
    }

    /**
     * Register main admin menu page.
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
     * Render the main plugin page in wp-admin.
     */
    public function render_admin_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        // Get generated config from transient (simple first step, later we can improve UX/storage).
        $generated_config = get_transient( 'fortis_toolbox_last_config' );
        delete_transient( 'fortis_toolbox_last_config' );
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'Fortis Toolbox', 'fortis-toolbox' ); ?></h1>

            <p><?php esc_html_e( 'Basic skeleton – we will expand the form fields and logic step by step.', 'fortis-toolbox' ); ?></p>

            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="fortis_source" value="admin" />
                <?php wp_nonce_field( 'fortis_toolbox_generate', 'fortis_toolbox_nonce' ); ?>
                <input type="hidden" name="action" value="fortis_toolbox_generate" />

                <table class="form-table" role="presentation">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="fortis_client_name"><?php esc_html_e( 'Client Name', 'fortis-toolbox' ); ?></label>
                            </th>
                            <td>
                                <input name="fortis_client_name" id="fortis_client_name" type="text" class="regular-text" required />
                                <p class="description"><?php esc_html_e( 'Internal display name / customer identifier.', 'fortis-toolbox' ); ?></p>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="fortis_model"><?php esc_html_e( 'Fortigate Model', 'fortis-toolbox' ); ?></label>
                            </th>
                            <td>
                                <select name="fortis_model" id="fortis_model" required>
                                    <option value=""><?php esc_html_e( 'Select model…', 'fortis-toolbox' ); ?></option>
                                    <option value="FG-40F">FG-40F</option>
                                    <option value="FG-60F">FG-60F</option>
                                    <option value="FG-80F">FG-80F</option>
                                    <option value="FG-100F">FG-100F</option>
                                    <!-- Later we will generate this list dynamically from a table/array. -->
                                </select>
                                <p class="description"><?php esc_html_e( 'Initial static model list – to be extended from the Fortis toolbox data.', 'fortis-toolbox' ); ?></p>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"><?php esc_html_e( 'WAN Mode', 'fortis-toolbox' ); ?></th>
                            <td>
                                <fieldset>
                                    <label>
                                        <input type="radio" name="fortis_wan_mode" value="dhcp" checked />
                                        <?php esc_html_e( 'DHCP', 'fortis-toolbox' ); ?>
                                    </label><br />
                                    <label>
                                        <input type="radio" name="fortis_wan_mode" value="static" />
                                        <?php esc_html_e( 'Static IP', 'fortis-toolbox' ); ?>
                                    </label><br />
                                    <label>
                                        <input type="radio" name="fortis_wan_mode" value="pppoe" />
                                        <?php esc_html_e( 'PPPoE', 'fortis-toolbox' ); ?>
                                    </label>
                                </fieldset>
                                <p class="description"><?php esc_html_e( 'We will add detailed fields per mode (IP, mask, gateway, VLAN, credentials, etc.) in the next iterations.', 'fortis-toolbox' ); ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php submit_button( __( 'Generate Configuration', 'fortis-toolbox' ) ); ?>
            </form>

            <?php if ( ! empty( $generated_config ) ) : ?>
                <h2><?php esc_html_e( 'Generated Configuration', 'fortis-toolbox' ); ?></h2>
                <textarea
                    readonly
                    rows="15"
                    style="width: 100%; font-family: monospace;">
<?php echo esc_textarea( $generated_config ); ?>
                </textarea>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render shortcode on the frontend.
     * Usage: [fortis_toolbox]
     */
    public function render_frontend_shortcode() {
        if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
            return '<p>' . esc_html__( 'You must be logged in as an administrator to use this tool.', 'fortis-toolbox' ) . '</p>';
        }

        $generated_config = get_transient( 'fortis_toolbox_last_config' );

        ob_start();
        ?>
        <style>
            .kb-fortis-wrapper {
                max-width: 1100px;
                margin: 0 auto;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            }
            .kb-fortis-card {
                background: #ffffff;
                border-radius: 12px;
                padding: 24px;
                box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
                margin-bottom: 24px;
                border: 1px solid #e5e7eb;
            }
            .kb-fortis-card h2 {
                margin-top: 0;
                font-size: 1.1rem;
                border-bottom: 1px solid #e5e7eb;
                padding-bottom: 8px;
                margin-bottom: 16px;
            }
            .kb-fortis-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 16px 20px;
            }
            .kb-fortis-field label {
                display: block;
                font-weight: 500;
                font-size: 0.9rem;
                margin-bottom: 4px;
            }
            .kb-fortis-field input[type="text"],
            .kb-fortis-field input[type="number"],
            .kb-fortis-field select {
                width: 100%;
                border-radius: 999px;
                border: 1px solid #d1d5db;
                padding: 8px 12px;
                font-size: 0.9rem;
                box-sizing: border-box;
                background: #f9fafb;
            }
            .kb-fortis-field input:focus,
            .kb-fortis-field select:focus {
                outline: none;
                border-color: #2563eb;
                box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
                background: #ffffff;
            }
            .kb-fortis-checkbox-group {
                display: flex;
                flex-wrap: wrap;
                gap: 10px 18px;
                font-size: 0.9rem;
            }
            .kb-fortis-checkbox-group label {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                cursor: pointer;
            }
            .kb-fortis-switch {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-size: 0.9rem;
            }
            .kb-fortis-switch input {
                transform: scale(1.1);
            }
            .kb-fortis-actions {
                margin-top: 12px;
            }
            .kb-fortis-button-primary {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 8px 18px;
                border-radius: 999px;
                border: none;
                background: linear-gradient(135deg, #2563eb, #1d4ed8);
                color: #ffffff;
                font-weight: 500;
                font-size: 0.9rem;
                cursor: pointer;
                box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
            }
            .kb-fortis-button-primary:hover {
                background: linear-gradient(135deg, #1d4ed8, #1e40af);
            }
            .kb-fortis-cli-card textarea {
                width: 100%;
                box-sizing: border-box;
                border-radius: 12px;
                border: 1px solid #1f2937;
                background: #020617;
                color: #e5e7eb;
                font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
                font-size: 0.85rem;
                padding: 12px 14px;
                resize: none;
                min-height: 140px;
            }
            .kb-fortis-cli-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 8px;
            }
            .kb-fortis-cli-header h2 {
                border: none;
                margin: 0;
                padding: 0;
            }
            .kb-fortis-button-secondary {
                border-radius: 999px;
                border: 1px solid #4b5563;
                padding: 6px 14px;
                font-size: 0.8rem;
                background: #111827;
                color: #e5e7eb;
                cursor: pointer;
            }
            .kb-fortis-button-secondary:hover {
                background: #1f2937;
            }
        </style>

        <div class="kb-fortis-wrapper">
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <?php wp_nonce_field( 'fortis_toolbox_generate', 'fortis_toolbox_nonce' ); ?>
                <input type="hidden" name="action" value="fortis_toolbox_generate" />
                <input type="hidden" name="fortis_source" value="shortcode" />

                <div class="kb-fortis-card">
                    <h2><?php esc_html_e( 'General settings', 'fortis-toolbox' ); ?></h2>
                    <div class="kb-fortis-grid">
                        <div class="kb-fortis-field">
                            <label for="fortis_hostname"><?php esc_html_e( 'Hostname', 'fortis-toolbox' ); ?></label>
                            <input type="text" id="fortis_hostname" name="fortis_hostname" value="FG" />
                        </div>
                        <div class="kb-fortis-field">
                            <label for="fortis_model"><?php esc_html_e( 'Model', 'fortis-toolbox' ); ?></label>
                            <select name="fortis_model" id="fortis_model" required>
                                <option value=""><?php esc_html_e( 'Select model…', 'fortis-toolbox' ); ?></option>
                                <option value="FG-40F">Fortigate 40F</option>
                                <option value="FG-60F">Fortigate 60F</option>
                                <option value="FG-80F">Fortigate 80F</option>
                                <option value="FG-100F">Fortigate 100F</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="kb-fortis-card">
                    <h2><?php esc_html_e( 'LAN', 'fortis-toolbox' ); ?></h2>
                    <div class="kb-fortis-grid">
                        <div class="kb-fortis-field">
                            <label for="fortis_lan_interface"><?php esc_html_e( 'Interface', 'fortis-toolbox' ); ?></label>
                            <select id="fortis_lan_interface" name="fortis_lan_interface">
                                <option value="lan">lan</option>
                            </select>
                        </div>
                        <div class="kb-fortis-field">
                            <label for="fortis_lan_ip"><?php esc_html_e( 'IP', 'fortis-toolbox' ); ?></label>
                            <input type="text" id="fortis_lan_ip" name="fortis_lan_ip" value="192.168.1.99" />
                        </div>
                        <div class="kb-fortis-field">
                            <label for="fortis_lan_subnet"><?php esc_html_e( 'Subnet', 'fortis-toolbox' ); ?></label>
                            <input type="text" id="fortis_lan_subnet" name="fortis_lan_subnet" value="255.255.255.0" />
                        </div>
                        <div class="kb-fortis-field">
                            <label><?php esc_html_e( 'DHCP range', 'fortis-toolbox' ); ?></label>
                            <div style="display:flex; gap:8px;">
                                <input type="number" name="fortis_lan_dhcp_start" value="50" min="1" max="254" style="width:80px;" />
                                <input type="number" name="fortis_lan_dhcp_end" value="200" min="1" max="254" style="width:80px;" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kb-fortis-card">
                    <h2><?php esc_html_e( 'WAN1', 'fortis-toolbox' ); ?></h2>
                    <div class="kb-fortis-grid">
                        <div class="kb-fortis-field">
                            <label class="kb-fortis-switch">
                                <input type="checkbox" name="fortis_wan1_enabled" value="1" checked />
                                <span><?php esc_html_e( 'Enabled', 'fortis-toolbox' ); ?></span>
                            </label>
                        </div>
                        <div class="kb-fortis-field">
                            <label for="fortis_wan1_interface"><?php esc_html_e( 'Interface', 'fortis-toolbox' ); ?></label>
                            <select id="fortis_wan1_interface" name="fortis_wan1_interface">
                                <option value="wan">wan</option>
                                <option value="wan1">wan1</option>
                            </select>
                        </div>
                        <div class="kb-fortis-field">
                            <label for="fortis_wan1_mode"><?php esc_html_e( 'WAN MODE', 'fortis-toolbox' ); ?></label>
                            <select id="fortis_wan1_mode" name="fortis_wan1_mode">
                                <option value="dhcp">DHCP</option>
                                <option value="static">Static</option>
                                <option value="pppoe">PPPoE</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="kb-fortis-card">
                    <h2><?php esc_html_e( 'WAN2', 'fortis-toolbox' ); ?></h2>
                    <div class="kb-fortis-grid">
                        <div class="kb-fortis-field">
                            <label class="kb-fortis-switch">
                                <input type="checkbox" name="fortis_wan2_enabled" value="1" checked />
                                <span><?php esc_html_e( 'Enabled', 'fortis-toolbox' ); ?></span>
                            </label>
                        </div>
                        <div class="kb-fortis-field">
                            <label for="fortis_wan2_interface"><?php esc_html_e( 'Interface', 'fortis-toolbox' ); ?></label>
                            <select id="fortis_wan2_interface" name="fortis_wan2_interface">
                                <option value="wan2">wan2</option>
                                <option value="a">a</option>
                            </select>
                        </div>
                        <div class="kb-fortis-field">
                            <label for="fortis_wan2_mode"><?php esc_html_e( 'WAN MODE', 'fortis-toolbox' ); ?></label>
                            <select id="fortis_wan2_mode" name="fortis_wan2_mode">
                                <option value="dhcp">DHCP</option>
                                <option value="static">Static</option>
                                <option value="pppoe">PPPoE</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="kb-fortis-card">
                    <h2><?php esc_html_e( 'VPN Settings (SSL VPN)', 'fortis-toolbox' ); ?></h2>
                    <div class="kb-fortis-grid">
                        <div class="kb-fortis-field">
                            <label for="fortis_vpn_prefix"><?php esc_html_e( 'VPN prefix', 'fortis-toolbox' ); ?></label>
                            <input type="text" id="fortis_vpn_prefix" name="fortis_vpn_prefix" value="10.212.134" />
                        </div>
                        <div class="kb-fortis-field">
                            <label><?php esc_html_e( 'From / To', 'fortis-toolbox' ); ?></label>
                            <div style="display:flex; gap:8px;">
                                <input type="number" name="fortis_vpn_from" value="100" min="1" max="254" style="width:80px;" />
                                <input type="number" name="fortis_vpn_to" value="120" min="1" max="254" style="width:80px;" />
                            </div>
                        </div>
                        <div class="kb-fortis-field">
                            <label for="fortis_vpn_port"><?php esc_html_e( 'Port', 'fortis-toolbox' ); ?></label>
                            <input type="number" id="fortis_vpn_port" name="fortis_vpn_port" value="10443" />
                        </div>
                        <div class="kb-fortis-field">
                            <label for="fortis_vpn_interfaces"><?php esc_html_e( 'Interfaces (comma separated)', 'fortis-toolbox' ); ?></label>
                            <input type="text" id="fortis_vpn_interfaces" name="fortis_vpn_interfaces" value="wan,a" />
                        </div>
                    </div>
                </div>

                <div class="kb-fortis-card">
                    <h2><?php esc_html_e( 'Network Segmentation', 'fortis-toolbox' ); ?></h2>
                    <div class="kb-fortis-checkbox-group">
                        <label><input type="checkbox" name="fortis_seg_camera" value="1" /> <?php esc_html_e( 'Camera', 'fortis-toolbox' ); ?></label>
                        <label><input type="checkbox" name="fortis_seg_phones" value="1" /> <?php esc_html_e( 'Phones', 'fortis-toolbox' ); ?></label>
                        <label><input type="checkbox" name="fortis_seg_wifi" value="1" /> <?php esc_html_e( 'WIFI', 'fortis-toolbox' ); ?></label>
                    </div>
                </div>

                <div class="kb-fortis-card">
                    <h2><?php esc_html_e( 'LDAP', 'fortis-toolbox' ); ?></h2>
                    <label class="kb-fortis-switch">
                        <input type="checkbox" name="fortis_ldap_enabled" value="1" />
                        <span><?php esc_html_e( 'Enabled', 'fortis-toolbox' ); ?></span>
                    </label>
                </div>

                <div class="kb-fortis-card">
                    <h2><?php esc_html_e( 'CLI block filtering', 'fortis-toolbox' ); ?></h2>
                    <div class="kb-fortis-checkbox-group" style="margin-bottom:10px;">
                        <label><input type="checkbox" name="fortis_cli_enable" value="1" checked /> <?php esc_html_e( 'Enable block filtering', 'fortis-toolbox' ); ?></label>
                        <label><input type="checkbox" name="fortis_cli_exist" value="1" /> <?php esc_html_e( 'exist fortigate', 'fortis-toolbox' ); ?></label>
                    </div>
                    <div style="margin-bottom:10px;">
                        <button type="button" class="kb-fortis-button-secondary" onclick="kbFortisCheckAll(true)"><?php esc_html_e( 'All', 'fortis-toolbox' ); ?></button>
                        <button type="button" class="kb-fortis-button-secondary" onclick="kbFortisCheckAll(false)" style="margin-left:6px;">
                            <?php esc_html_e( 'Clear', 'fortis-toolbox' ); ?>
                        </button>
                    </div>
                    <div class="kb-fortis-checkbox-group" id="kb-fortis-cli-blocks">
                        <?php
                        $blocks = array(
                            'general_settings' => 'General Settings',
                            'local_interface'  => 'Local interface',
                            'wan_interfaces'   => 'Wan Interfaces',
                            'sd_wan'           => 'sd-wan',
                            'address'          => 'Address',
                            'address_group'    => 'Address Group',
                            'logs'             => 'Logs',
                            'feature_vis'      => 'Feature Visibility',
                            'admin'            => 'admin',
                            'daily_backup'     => 'Daily Backup',
                            'vpn_settings'     => 'VPN Settings',
                            'firewall_policy'  => 'Firewall policy',
                            'services_color'   => 'Services Color',
                            'ldap'             => 'LDAP',
                        );
                        foreach ( $blocks as $key => $label ) :
                            ?>
                            <label>
                                <input type="checkbox" name="fortis_cli_blocks[]" value="<?php echo esc_attr( $key ); ?>" checked />
                                <?php echo esc_html( $label ); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="kb-fortis-actions">
                    <button type="submit" class="kb-fortis-button-primary"><?php esc_html_e( 'Generate configuration', 'fortis-toolbox' ); ?></button>
                </div>
            </form>

            <div class="kb-fortis-card kb-fortis-cli-card" style="margin-top:24px;">
                <div class="kb-fortis-cli-header">
                    <h2><?php esc_html_e( 'CLI output', 'fortis-toolbox' ); ?></h2>
                    <button type="button" class="kb-fortis-button-secondary" onclick="kbFortisCopyCLI()">
                        <?php esc_html_e( 'Copy to clipboard', 'fortis-toolbox' ); ?>
                    </button>
                </div>
                <textarea class="kb-fortis-cli" readonly oninput="kbFortisAutoResize(this)"><?php echo esc_textarea( $generated_config ); ?></textarea>
            </div>
        </div>

        <script>
            function kbFortisAutoResize(el) {
                if (!el) return;
                el.style.height = 'auto';
                el.style.height = (el.scrollHeight + 10) + 'px';
            }
            document.addEventListener('DOMContentLoaded', function () {
                var cli = document.querySelector('.kb-fortis-cli');
                if (cli) {
                    kbFortisAutoResize(cli);
                }
            });
            function kbFortisCopyCLI() {
                var cli = document.querySelector('.kb-fortis-cli');
                if (!cli) return;
                cli.focus();
                cli.select();
                try {
                    document.execCommand('copy');
                } catch (e) {}
            }
            function kbFortisCheckAll(state) {
                var container = document.getElementById('kb-fortis-cli-blocks');
                if (!container) return;
                var boxes = container.querySelectorAll('input[type="checkbox"]');
                boxes.forEach(function (cb) { cb.checked = state; });
            }
        </script>
        <?php

        return ob_get_clean();
    }

    /**
     * Handle form submission and generate a very basic config skeleton.
     * Later we will port the real Python logic here.
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
            if ( 'shortcode' === $source && wp_get_referer() ) {
                wp_safe_redirect( wp_get_referer() );
            } else {
                wp_safe_redirect( add_query_arg( array( 'page' => 'fortis-toolbox', 'fortis_error' => 'missing_fields' ), admin_url( 'admin.php' ) ) );
            }
            exit;
        }
            exit;
        }

        // Very basic placeholder config – we will replace this with real logic from your Python tool.
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

        // Store in transient so we can show it after redirect (simple first step).
        set_transient( 'fortis_toolbox_last_config', $generated_config, MINUTE_IN_SECONDS * 10 );

        wp_safe_redirect( add_query_arg( array( 'page' => 'fortis-toolbox' ), admin_url( 'admin.php' ) ) );
        exit;
    }
}

endif; // class_exists

// Bootstrap the plugin.
function fortis_toolbox_bootstrap() {
    new Fortis_Toolbox_Plugin();
}
add_action( 'plugins_loaded', 'fortis_toolbox_bootstrap' );
