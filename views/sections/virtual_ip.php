<?php
/**
 * Virtual IP section shortcode template.
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
                <label for="fortis_vip_name"><?php esc_html_e( 'VIP name', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_vip_name" name="fortis_vip_name" value="vip_frontend" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_vip_interface"><?php esc_html_e( 'External interface', 'fortis-toolbox' ); ?></label>
                <select id="fortis_vip_interface" name="fortis_vip_interface">
                    <option value="wan">wan</option>
                    <option value="wan2">wan2</option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_vip_external"><?php esc_html_e( 'External IP', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_vip_external" name="fortis_vip_external" value="203.0.113.10" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_vip_mapped"><?php esc_html_e( 'Mapped IP', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_vip_mapped" name="fortis_vip_mapped" value="192.168.1.10" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_vip_port_forward"><?php esc_html_e( 'Port forwarding', 'fortis-toolbox' ); ?></label>
                <select id="fortis_vip_port_forward" name="fortis_vip_port_forward">
                    <option value="disable"><?php esc_html_e( 'Disabled', 'fortis-toolbox' ); ?></option>
                    <option value="http">HTTP (80)</option>
                    <option value="https">HTTPS (443)</option>
                    <option value="custom"><?php esc_html_e( 'Custom', 'fortis-toolbox' ); ?></option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_vip_internal_port"><?php esc_html_e( 'Mapped port (when custom)', 'fortis-toolbox' ); ?></label>
                <input type="number" id="fortis_vip_internal_port" name="fortis_vip_internal_port" value="8443" />
            </div>
        </div>
    </div>
</div>
