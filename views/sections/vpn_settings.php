<?php
/**
 * VPN settings section shortcode template.
 *
 * @var array  $section_links
 * @var string $current_slug
 * @var array  $current_config
 */
?>
<div class="kb-fortis-wrapper">
    <?php require FORTIS_TOOLBOX_PATH . 'views/partials/section-nav.php'; ?>

    <div class="kb-fortis-card">
        <h2><?php echo esc_html( $current_config['title'] ); ?></h2>
        <p><?php echo esc_html( $current_config['description'] ); ?></p>

        <div class="kb-fortis-grid">
            <div class="kb-fortis-field">
                <label for="fortis_ssl_prefix"><?php esc_html_e( 'SSL VPN prefix', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_ssl_prefix" name="fortis_ssl_prefix" value="10.212.134" />
            </div>
            <div class="kb-fortis-field">
                <label><?php esc_html_e( 'Range', 'fortis-toolbox' ); ?></label>
                <div class="kb-fortis-inline">
                    <input type="number" name="fortis_ssl_range_from" value="100" min="1" max="254" />
                    <input type="number" name="fortis_ssl_range_to" value="120" min="1" max="254" />
                </div>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_ssl_port"><?php esc_html_e( 'Portal port', 'fortis-toolbox' ); ?></label>
                <input type="number" id="fortis_ssl_port" name="fortis_ssl_port" value="10443" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_ssl_interfaces"><?php esc_html_e( 'Interfaces (comma separated)', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_ssl_interfaces" name="fortis_ssl_interfaces" value="wan,a" />
            </div>
        </div>
    </div>
</div>
