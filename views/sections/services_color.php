<?php
/**
 * Services color section shortcode template.
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
                <label for="fortis_service_name"><?php esc_html_e( 'Service name', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_service_name" name="fortis_service_name" value="HTTPS" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_service_port"><?php esc_html_e( 'Port', 'fortis-toolbox' ); ?></label>
                <input type="number" id="fortis_service_port" name="fortis_service_port" value="443" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_service_color"><?php esc_html_e( 'Color tag', 'fortis-toolbox' ); ?></label>
                <input type="number" id="fortis_service_color" name="fortis_service_color" value="13" min="1" max="32" />
            </div>
        </div>
    </div>
</div>
