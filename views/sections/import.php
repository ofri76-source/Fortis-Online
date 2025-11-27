<?php
/**
 * Import section shortcode template.
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
                <label for="fortis_import_file"><?php esc_html_e( 'Upload configuration file', 'fortis-toolbox' ); ?></label>
                <input type="file" id="fortis_import_file" name="fortis_import_file" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_import_text"><?php esc_html_e( 'Or paste configuration', 'fortis-toolbox' ); ?></label>
                <textarea id="fortis_import_text" name="fortis_import_text" rows="5" placeholder="config system ..."></textarea>
            </div>
            <div class="kb-fortis-field">
                <label class="kb-fortis-switch">
                    <input type="checkbox" name="fortis_import_validate" value="1" checked />
                    <span><?php esc_html_e( 'Validate before applying', 'fortis-toolbox' ); ?></span>
                </label>
            </div>
        </div>
    </div>
</div>
