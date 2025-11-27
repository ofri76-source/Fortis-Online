<?php
/**
 * SD-WAN section shortcode template.
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
                <label for="fortis_sdwan_members"><?php esc_html_e( 'Members', 'fortis-toolbox' ); ?></label>
                <input type="text" id="fortis_sdwan_members" name="fortis_sdwan_members" value="wan,wan2" />
                <p class="description"><?php esc_html_e( 'Comma separated interfaces.', 'fortis-toolbox' ); ?></p>
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_sdwan_sla"><?php esc_html_e( 'SLA target (ms)', 'fortis-toolbox' ); ?></label>
                <input type="number" id="fortis_sdwan_sla" name="fortis_sdwan_sla" value="150" />
            </div>
            <div class="kb-fortis-field">
                <label for="fortis_sdwan_strategy"><?php esc_html_e( 'Strategy', 'fortis-toolbox' ); ?></label>
                <select id="fortis_sdwan_strategy" name="fortis_sdwan_strategy">
                    <option value="manual"><?php esc_html_e( 'Manual', 'fortis-toolbox' ); ?></option>
                    <option value="best-quality"><?php esc_html_e( 'Best quality', 'fortis-toolbox' ); ?></option>
                    <option value="priority"><?php esc_html_e( 'Priority', 'fortis-toolbox' ); ?></option>
                </select>
            </div>
        </div>
    </div>
</div>
