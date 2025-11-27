<?php
/**
 * Logs section shortcode template.
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
                <label for="fortis_log_destination"><?php esc_html_e( 'Destination', 'fortis-toolbox' ); ?></label>
                <select id="fortis_log_destination" name="fortis_log_destination">
                    <option value="memory"><?php esc_html_e( 'Local memory', 'fortis-toolbox' ); ?></option>
                    <option value="forticloud"><?php esc_html_e( 'FortiCloud', 'fortis-toolbox' ); ?></option>
                    <option value="syslog"><?php esc_html_e( 'Syslog server', 'fortis-toolbox' ); ?></option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_syslog_server"><?php esc_html_e( 'Syslog server (if used)', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_syslog_server" name="fortis_syslog_server" placeholder="10.0.0.10" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_log_retention"><?php esc_html_e( 'Retention (days)', 'fortis-toolbox' ); ?></label>
                <input type="number" id="fortis_log_retention" name="fortis_log_retention" value="30" />
            </div>
        </div>
    </div>
</div>
