<?php
/**
 * Settings section shortcode template.
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
                <label class="kb-fortis-switch">
                    <input type="checkbox" name="fortis_settings_ltr" value="1" checked />
                    <span><?php esc_html_e( 'Force LTR layout', 'fortis-toolbox' ); ?></span>
                </label>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_settings_theme"><?php esc_html_e( 'Theme', 'fortis-toolbox' ); ?></label>
                <select id="fortis_settings_theme" name="fortis_settings_theme">
                    <option value="light"><?php esc_html_e( 'Light', 'fortis-toolbox' ); ?></option>
                    <option value="dark">Dark</option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_settings_language"><?php esc_html_e( 'Language', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_settings_language" name="fortis_settings_language" value="English" />
            </div>
            <div class="kb-fortis-field">
                <label class="kb-fortis-switch">
                    <input type="checkbox" name="fortis_settings_autosave" value="1" />
                    <span><?php esc_html_e( 'Autosave drafts', 'fortis-toolbox' ); ?></span>
                </label>
            </div>
        </div>
    </div>
</div>
