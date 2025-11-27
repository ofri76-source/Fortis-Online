<?php
/**
 * WAN interfaces section shortcode template.
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
                <label for="fortis_wan1_name"><?php esc_html_e( 'WAN1 interface', 'fortis-toolbox' ); ?></label>
                <select id="fortis_wan1_name" name="fortis_wan1_name">
                    <option value="wan">wan</option>
                    <option value="wan1">wan1</option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_wan1_mode_section"><?php esc_html_e( 'WAN1 mode', 'fortis-toolbox' ); ?></label>
                <select id="fortis_wan1_mode_section" name="fortis_wan1_mode_section">
                    <option value="dhcp">DHCP</option>
                    <option value="static">Static</option>
                    <option value="pppoe">PPPoE</option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_wan1_pppoe_user"><?php esc_html_e( 'PPPoE user (optional)', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_wan1_pppoe_user" name="fortis_wan1_pppoe_user" />
            </div>
        </div>

        <div class="kb-fortis-grid">
            <div class="kb-fortis-field">
                <label for="fortis_wan2_name"><?php esc_html_e( 'WAN2 interface', 'fortis-toolbox' ); ?></label>
                <select id="fortis_wan2_name" name="fortis_wan2_name">
                    <option value="wan2">wan2</option>
                    <option value="a">a</option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_wan2_mode_section"><?php esc_html_e( 'WAN2 mode', 'fortis-toolbox' ); ?></label>
                <select id="fortis_wan2_mode_section" name="fortis_wan2_mode_section">
                    <option value="dhcp">DHCP</option>
                    <option value="static">Static</option>
                    <option value="pppoe">PPPoE</option>
                </select>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_wan2_ip"><?php esc_html_e( 'Static IP (optional)', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_wan2_ip" name="fortis_wan2_ip" placeholder="0.0.0.0/0" />
            </div>
        </div>
    </div>
</div>
