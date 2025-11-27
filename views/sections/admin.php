<?php
/**
 * Admin section shortcode template.
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
                <label for="fortis_admin_user"><?php esc_html_e( 'Admin user', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_admin_user" name="fortis_admin_user" value="admin" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_admin_email"><?php esc_html_e( 'Email', 'fortis-toolbox' ); ?></label>
                <input type="email" id="fortis_admin_email" name="fortis_admin_email" value="admin@example.com" />
            </div>
            <div class="kb-fortis-field">
                <label class="kb-fortis-switch">
                    <input type="checkbox" name="fortis_admin_mfa" value="1" checked />
                    <span><?php esc_html_e( 'Enable MFA', 'fortis-toolbox' ); ?></span>
                </label>
            </div>
        </div>
    </div>
</div>
