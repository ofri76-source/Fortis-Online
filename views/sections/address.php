<?php
/**
 * Address section shortcode template.
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
                <label for="fortis_address_name"><?php esc_html_e( 'Address name', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_address_name" name="fortis_address_name" value="HQ_LAN" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_address_subnet"><?php esc_html_e( 'Subnet', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_address_subnet" name="fortis_address_subnet" value="192.168.1.0/24" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_address_type"><?php esc_html_e( 'Type', 'fortis-toolbox' ); ?></label>
                <select id="fortis_address_type" name="fortis_address_type">
                    <option value="subnet"><?php esc_html_e( 'Subnet', 'fortis-toolbox' ); ?></option>
                    <option value="fqdn">FQDN</option>
                    <option value="ip-range"><?php esc_html_e( 'IP range', 'fortis-toolbox' ); ?></option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_address_desc"><?php esc_html_e( 'Description', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_address_desc" name="fortis_address_desc" value="Main office LAN" />
            </div>
        </div>
    </div>
</div>
