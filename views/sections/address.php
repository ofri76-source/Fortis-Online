<?php
/**
 * Address objects section shortcode template.
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
                <input type="text" id="fortis_address_name" name="fortis_address_name" value="Office_LAN" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_address_subnet"><?php esc_html_e( 'Subnet / host', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_address_subnet" name="fortis_address_subnet" value="10.0.0.0/24" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_address_interface"><?php esc_html_e( 'Interface (optional)', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_address_interface" name="fortis_address_interface" placeholder="any" />
            </div>
        </div>
    </div>
</div>
