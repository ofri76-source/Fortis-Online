<?php
/**
 * Shortcode template for Fortis Toolbox.
 *
 * @var string $generated_config
 * @var array  $cli_blocks
 */
?>
<div class="kb-fortis-wrapper">
    <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <?php wp_nonce_field( 'fortis_toolbox_generate', 'fortis_toolbox_nonce' ); ?>
        <input type="hidden" name="action" value="fortis_toolbox_generate" />
        <input type="hidden" name="fortis_source" value="shortcode" />

        <div class="kb-fortis-card">
            <h2><?php esc_html_e( 'General settings', 'fortis-toolbox' ); ?></h2>
            <div class="kb-fortis-grid">
                <div class="kb-fortis-field">
                    <label for="fortis_hostname"><?php esc_html_e( 'Hostname', 'fortis-toolbox' ); ?></label>
                    <input type="text" id="fortis_hostname" name="fortis_hostname" value="FG" />
                </div>
                <div class="kb-fortis-field">
                    <label for="fortis_model"><?php esc_html_e( 'Model', 'fortis-toolbox' ); ?></label>
                    <select name="fortis_model" id="fortis_model" required>
                        <option value=""><?php esc_html_e( 'Select model…', 'fortis-toolbox' ); ?></option>
                        <option value="FG-40F">Fortigate 40F</option>
                        <option value="FG-60F">Fortigate 60F</option>
                        <option value="FG-80F">Fortigate 80F</option>
                        <option value="FG-100F">Fortigate 100F</option>
                    </select>
                </div>
                <div class="kb-fortis-field">
                    <label for="fortis_tenant_domain"><?php esc_html_e( 'Tenant Domain', 'fortis-toolbox' ); ?></label>
                    <input type="text" id="fortis_tenant_domain" name="fortis_tenant_domain" value="" />
                </div>
                <div class="kb-fortis-field">
                    <label for="fortis_client_id"><?php esc_html_e( 'Client ID', 'fortis-toolbox' ); ?></label>
                    <input type="text" id="fortis_client_id" name="fortis_client_id" value="" />
                </div>
            </div>

            <div id="additional-tenants" data-tenant-signature="fortis-shortcode-tenants-ui-v1"></div>

            <div class="form-group">
                <button type="button" id="add-tenant-row" class="m365-btn m365-btn-small">
                    הוסף טננט נוסף
                </button>
            </div>

            <input type="hidden"
                   id="customer-tenants-json"
                   name="tenants"
                   value="[]">
            <!-- Fortis tenants UI signature: views/shortcode.php -->
        </div>

        <div class="kb-fortis-card">
            <h2><?php esc_html_e( 'LAN', 'fortis-toolbox' ); ?></h2>
            <div class="kb-fortis-grid">
                <div class="kb-fortis-field">
                    <label for="fortis_lan_interface"><?php esc_html_e( 'Interface', 'fortis-toolbox' ); ?></label>
                    <select id="fortis_lan_interface" name="fortis_lan_interface">
                        <option value="lan">lan</option>
                    </select>
                </div>
                <div class="kb-fortis-field">
                    <label for="fortis_lan_ip"><?php esc_html_e( 'IP', 'fortis-toolbox' ); ?></label>
                    <input type="text" id="fortis_lan_ip" name="fortis_lan_ip" value="192.168.1.99" />
                </div>
                <div class="kb-fortis-field">
                    <label for="fortis_lan_subnet"><?php esc_html_e( 'Subnet', 'fortis-toolbox' ); ?></label>
                    <input type="text" id="fortis_lan_subnet" name="fortis_lan_subnet" value="255.255.255.0" />
                </div>
                <div class="kb-fortis-field">
                    <label><?php esc_html_e( 'DHCP range', 'fortis-toolbox' ); ?></label>
                    <div class="kb-fortis-inline">
                        <input type="number" name="fortis_lan_dhcp_start" value="50" min="1" max="254" />
                        <input type="number" name="fortis_lan_dhcp_end" value="200" min="1" max="254" />
                    </div>
                </div>
            </div>
        </div>

        <div class="kb-fortis-card">
            <h2><?php esc_html_e( 'WAN1', 'fortis-toolbox' ); ?></h2>
            <div class="kb-fortis-grid">
                <div class="kb-fortis-field">
                    <label class="kb-fortis-switch">
                        <input type="checkbox" name="fortis_wan1_enabled" value="1" checked />
                        <span><?php esc_html_e( 'Enabled', 'fortis-toolbox' ); ?></span>
                    </label>
                </div>
                <div class="kb-fortis-field">
                    <label for="fortis_wan1_interface"><?php esc_html_e( 'Interface', 'fortis-toolbox' ); ?></label>
                    <select id="fortis_wan1_interface" name="fortis_wan1_interface">
                        <option value="wan">wan</option>
                        <option value="wan1">wan1</option>
                    </select>
                </div>
                <div class="kb-fortis-field">
                    <label for="fortis_wan1_mode"><?php esc_html_e( 'WAN MODE', 'fortis-toolbox' ); ?></label>
                    <select id="fortis_wan1_mode" name="fortis_wan1_mode">
                        <option value="dhcp">DHCP</option>
                        <option value="static">Static</option>
                        <option value="pppoe">PPPoE</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="kb-fortis-card">
            <h2><?php esc_html_e( 'WAN2', 'fortis-toolbox' ); ?></h2>
            <div class="kb-fortis-grid">
                <div class="kb-fortis-field">
                    <label class="kb-fortis-switch">
                        <input type="checkbox" name="fortis_wan2_enabled" value="1" checked />
                        <span><?php esc_html_e( 'Enabled', 'fortis-toolbox' ); ?></span>
                    </label>
                </div>
                <div class="kb-fortis-field">
                    <label for="fortis_wan2_interface"><?php esc_html_e( 'Interface', 'fortis-toolbox' ); ?></label>
                    <select id="fortis_wan2_interface" name="fortis_wan2_interface">
                        <option value="wan2">wan2</option>
                        <option value="a">a</option>
                    </select>
                </div>
                <div class="kb-fortis-field">
                    <label for="fortis_wan2_mode"><?php esc_html_e( 'WAN MODE', 'fortis-toolbox' ); ?></label>
                    <select id="fortis_wan2_mode" name="fortis_wan2_mode">
                        <option value="dhcp">DHCP</option>
                        <option value="static">Static</option>
                        <option value="pppoe">PPPoE</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="kb-fortis-card">
            <h2><?php esc_html_e( 'VPN Settings (SSL VPN)', 'fortis-toolbox' ); ?></h2>
            <div class="kb-fortis-grid">
                <div class="kb-fortis-field">
                    <label for="fortis_vpn_prefix"><?php esc_html_e( 'VPN prefix', 'fortis-toolbox' ); ?></label>
                    <input type="text" id="fortis_vpn_prefix" name="fortis_vpn_prefix" value="10.212.134" />
                </div>
                <div class="kb-fortis-field">
                    <label><?php esc_html_e( 'From / To', 'fortis-toolbox' ); ?></label>
                    <div class="kb-fortis-inline">
                        <input type="number" name="fortis_vpn_from" value="100" min="1" max="254" />
                        <input type="number" name="fortis_vpn_to" value="120" min="1" max="254" />
                    </div>
                </div>
                <div class="kb-fortis-field">
                    <label for="fortis_vpn_port"><?php esc_html_e( 'Port', 'fortis-toolbox' ); ?></label>
                    <input type="number" id="fortis_vpn_port" name="fortis_vpn_port" value="10443" />
                </div>
                <div class="kb-fortis-field">
                    <label for="fortis_vpn_interfaces"><?php esc_html_e( 'Interfaces (comma separated)', 'fortis-toolbox' ); ?></label>
                    <input type="text" id="fortis_vpn_interfaces" name="fortis_vpn_interfaces" value="wan,a" />
                </div>
            </div>
        </div>

        <div class="kb-fortis-card">
            <h2><?php esc_html_e( 'Network Segmentation', 'fortis-toolbox' ); ?></h2>
            <div class="kb-fortis-checkbox-group">
                <label><input type="checkbox" name="fortis_seg_camera" value="1" /> <?php esc_html_e( 'Camera', 'fortis-toolbox' ); ?></label>
                <label><input type="checkbox" name="fortis_seg_phones" value="1" /> <?php esc_html_e( 'Phones', 'fortis-toolbox' ); ?></label>
                <label><input type="checkbox" name="fortis_seg_wifi" value="1" /> <?php esc_html_e( 'WIFI', 'fortis-toolbox' ); ?></label>
            </div>
        </div>

        <div class="kb-fortis-card">
            <h2><?php esc_html_e( 'LDAP', 'fortis-toolbox' ); ?></h2>
            <label class="kb-fortis-switch">
                <input type="checkbox" name="fortis_ldap_enabled" value="1" />
                <span><?php esc_html_e( 'Enabled', 'fortis-toolbox' ); ?></span>
            </label>
        </div>

        <div class="kb-fortis-card">
            <h2><?php esc_html_e( 'CLI block filtering', 'fortis-toolbox' ); ?></h2>
            <div class="kb-fortis-checkbox-group kb-fortis-row-gap">
                <label><input type="checkbox" name="fortis_cli_enable" value="1" checked /> <?php esc_html_e( 'Enable block filtering', 'fortis-toolbox' ); ?></label>
                <label><input type="checkbox" name="fortis_cli_exist" value="1" /> <?php esc_html_e( 'exist fortigate', 'fortis-toolbox' ); ?></label>
            </div>
            <div class="kb-fortis-inline">
                <button type="button" class="kb-fortis-button-secondary" data-kb-fortis-check="all"><?php esc_html_e( 'All', 'fortis-toolbox' ); ?></button>
                <button type="button" class="kb-fortis-button-secondary" data-kb-fortis-check="clear"><?php esc_html_e( 'Clear', 'fortis-toolbox' ); ?></button>
            </div>
            <div class="kb-fortis-checkbox-group" id="kb-fortis-cli-blocks">
                <?php foreach ( $cli_blocks as $key => $label ) : ?>
                    <label>
                        <input type="checkbox" name="fortis_cli_blocks[]" value="<?php echo esc_attr( $key ); ?>" checked />
                        <?php echo esc_html( $label ); ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="kb-fortis-actions">
            <button type="submit" class="kb-fortis-button-primary"><?php esc_html_e( 'Generate configuration', 'fortis-toolbox' ); ?></button>
        </div>
    </form>

    <div class="kb-fortis-card kb-fortis-cli-card">
        <div class="kb-fortis-cli-header">
            <h2><?php esc_html_e( 'CLI output', 'fortis-toolbox' ); ?></h2>
            <button type="button" class="kb-fortis-button-secondary" data-kb-fortis-copy>
                <?php esc_html_e( 'Copy to clipboard', 'fortis-toolbox' ); ?>
            </button>
        </div>
        <textarea class="kb-fortis-cli" readonly><?php echo esc_textarea( $generated_config ); ?></textarea>
    </div>
</div>
