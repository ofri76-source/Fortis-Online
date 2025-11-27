<?php
/**
 * LDAP section shortcode template.
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
                <label for="fortis_ldap_server"><?php esc_html_e( 'Server', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_ldap_server" name="fortis_ldap_server" placeholder="ldap.example.com" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_ldap_base"><?php esc_html_e( 'Base DN', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_ldap_base" name="fortis_ldap_base" value="dc=example,dc=com" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_ldap_bind"><?php esc_html_e( 'Bind user', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_ldap_bind" name="fortis_ldap_bind" value="cn=admin,dc=example,dc=com" />
            </div>
        </div>
    </div>
</div>
