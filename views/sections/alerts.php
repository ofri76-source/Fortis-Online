<?php
/**
 * Alerts section shortcode template.
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
                <label for="fortis_alert_email"><?php esc_html_e( 'Alert email', 'fortis-toolbox' ); ?></label>
                <input type="email" id="fortis_alert_email" name="fortis_alert_email" value="noc@example.com" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_alert_phone"><?php esc_html_e( 'SMS/Phone', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_alert_phone" name="fortis_alert_phone" value="+1-555-0100" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_alert_log"><?php esc_html_e( 'Syslog server', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_alert_log" name="fortis_alert_log" value="198.51.100.5" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_alert_threshold"><?php esc_html_e( 'Alert threshold', 'fortis-toolbox' ); ?></label>
                <select id="fortis_alert_threshold" name="fortis_alert_threshold">
                    <option value="info"><?php esc_html_e( 'Info', 'fortis-toolbox' ); ?></option>
                    <option value="warning">Warning</option>
                    <option value="critical">Critical</option>
                </select>
            </div>
        </div>
    </div>
</div>
