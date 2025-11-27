<?php
/**
 * New Forti section shortcode template.
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
                <label for="fortis_new_hostname"><?php esc_html_e( 'Hostname prefix', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_new_hostname" name="fortis_new_hostname" value="FG" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_new_model"><?php esc_html_e( 'Model', 'fortis-toolbox' ); ?></label>
                <select id="fortis_new_model" name="fortis_new_model">
                    <option value="FG-40F">FG-40F</option>
                    <option value="FG-60F">FG-60F</option>
                    <option value="FG-80F">FG-80F</option>
                    <option value="FG-100F">FG-100F</option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_admin_password"><?php esc_html_e( 'Admin password', 'fortis-toolbox' ); ?></label>
                <input type="password" id="fortis_admin_password" name="fortis_admin_password" value="" placeholder="********" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_timezone_new"><?php esc_html_e( 'Timezone', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_timezone_new" name="fortis_timezone_new" value="UTC+2" />
            </div>
        </div>
    </div>
</div>
