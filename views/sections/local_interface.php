<?php
/**
 * Local interface section shortcode template.
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
                <label for="fortis_lan_interface_section"><?php esc_html_e( 'Interface name', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_lan_interface_section" name="fortis_lan_interface_section" value="lan" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_lan_network"><?php esc_html_e( 'Network', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_lan_network" name="fortis_lan_network" value="192.168.1.0/24" />
            </div>
            <div class="kb-fortis-field">
                <label><?php esc_html_e( 'DHCP pool', 'fortis-toolbox' ); ?></label>
                <div class="kb-fortis-inline">
                    <input type="number" name="fortis_lan_pool_start" value="50" min="1" max="254" />
                    <input type="number" name="fortis_lan_pool_end" value="200" min="1" max="254" />
                </div>
            </div>
        </div>
    </div>
</div>
