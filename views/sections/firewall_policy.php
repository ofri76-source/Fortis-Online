<?php
/**
 * Firewall policy section shortcode template.
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
                <label for="fortis_policy_name"><?php esc_html_e( 'Policy name', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_policy_name" name="fortis_policy_name" value="LAN_to_WAN" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_policy_src"><?php esc_html_e( 'Source', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_policy_src" name="fortis_policy_src" value="lan" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_policy_dst"><?php esc_html_e( 'Destination', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_policy_dst" name="fortis_policy_dst" value="all" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_policy_services"><?php esc_html_e( 'Services', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_policy_services" name="fortis_policy_services" value="ALL" />
            </div>
        </div>
    </div>
</div>
