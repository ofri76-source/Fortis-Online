<?php
/**
 * Address group section shortcode template.
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
                <label for="fortis_address_group_name"><?php esc_html_e( 'Group name', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_address_group_name" name="fortis_address_group_name" value="Offices" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_address_group_members"><?php esc_html_e( 'Members (comma separated)', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_address_group_members" name="fortis_address_group_members" value="Office_LAN,Warehouse" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_address_group_color"><?php esc_html_e( 'Color tag', 'fortis-toolbox' ); ?></label>
                <input type="number" id="fortis_address_group_color" name="fortis_address_group_color" value="2" min="1" max="32" />
            </div>
        </div>
    </div>
</div>
