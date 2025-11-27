<?php
/**
 * Daily backup section shortcode template.
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
                <label for="fortis_backup_time"><?php esc_html_e( 'Backup time (HH:MM)', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_backup_time" name="fortis_backup_time" value="02:00" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_backup_server"><?php esc_html_e( 'Remote server', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_backup_server" name="fortis_backup_server" placeholder="sftp.example.com" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_backup_user"><?php esc_html_e( 'Username', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_backup_user" name="fortis_backup_user" />
            </div>
        </div>
    </div>
</div>
