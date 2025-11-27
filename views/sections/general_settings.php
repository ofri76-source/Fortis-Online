<?php
/**
 * General settings section shortcode template.
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
                <label for="fortis_hostname_section"><?php esc_html_e( 'Hostname', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_hostname_section" name="fortis_hostname_section" value="FG" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_model_section"><?php esc_html_e( 'Model', 'fortis-toolbox' ); ?></label>
                <select id="fortis_model_section" name="fortis_model_section">
                    <option value="FG-40F">FG-40F</option>
                    <option value="FG-60F">FG-60F</option>
                    <option value="FG-80F">FG-80F</option>
                    <option value="FG-100F">FG-100F</option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_timezone"><?php esc_html_e( 'Timezone', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_timezone" name="fortis_timezone" value="UTC+2" />
            </div>
        </div>
    </div>
</div>
