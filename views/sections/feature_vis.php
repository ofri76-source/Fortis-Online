<?php
/**
 * Feature visibility section shortcode template.
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

        <div class="kb-fortis-checkbox-group kb-fortis-row-gap">
            <label><input type="checkbox" name="fortis_feature_application" value="1" checked /> <?php esc_html_e( 'Application control', 'fortis-toolbox' ); ?></label>
            <label><input type="checkbox" name="fortis_feature_webfilter" value="1" checked /> <?php esc_html_e( 'Web filtering', 'fortis-toolbox' ); ?></label>
            <label><input type="checkbox" name="fortis_feature_ipsec" value="1" /> <?php esc_html_e( 'IPsec VPN', 'fortis-toolbox' ); ?></label>
            <label><input type="checkbox" name="fortis_feature_wireless" value="1" /> <?php esc_html_e( 'Wireless controller', 'fortis-toolbox' ); ?></label>
        </div>
    </div>
</div>
