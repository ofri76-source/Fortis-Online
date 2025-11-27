<?php
/**
 * Security section shortcode template.
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
                    <input type="checkbox" name="fortis_security_ips" value="1" checked />
                    <span><?php esc_html_e( 'Enable IPS profile', 'fortis-toolbox' ); ?></span>
                </label>
            </div>
            <div class="kb-fortis-field">
                <label class="kb-fortis-switch">
                    <input type="checkbox" name="fortis_security_antivirus" value="1" checked />
                    <span><?php esc_html_e( 'Enable Antivirus', 'fortis-toolbox' ); ?></span>
                </label>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_security_policy"><?php esc_html_e( 'Default policy action', 'fortis-toolbox' ); ?></label>
                <select id="fortis_security_policy" name="fortis_security_policy">
                    <option value="deny"><?php esc_html_e( 'Deny', 'fortis-toolbox' ); ?></option>
                    <option value="allow">Allow</option>
                    <option value="monitor"><?php esc_html_e( 'Monitor', 'fortis-toolbox' ); ?></option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_security_admins"><?php esc_html_e( 'Trusted admin addresses (CIDR)', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_security_admins" name="fortis_security_admins" value="192.0.2.0/24" />
            </div>
        </div>
    </div>
</div>
