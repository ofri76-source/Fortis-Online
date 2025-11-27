<?php
/**
 * Address section shortcode template.
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

        <div class="kb-fortis-table-wrapper">
            <table class="kb-fortis-table">
                <thead>
                    <tr>
                        <th><?php esc_html_e( 'Sel', 'fortis-toolbox' ); ?></th>
                        <th><?php esc_html_e( 'Name', 'fortis-toolbox' ); ?></th>
                        <th><?php esc_html_e( 'Type', 'fortis-toolbox' ); ?></th>
                        <th><?php esc_html_e( 'Value (CIDR / Range / FQDN)', 'fortis-toolbox' ); ?></th>
                        <th><?php esc_html_e( 'Allow routing', 'fortis-toolbox' ); ?></th>
                        <th><?php esc_html_e( 'OK?', 'fortis-toolbox' ); ?></th>
                        <th><?php esc_html_e( 'Actions', 'fortis-toolbox' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" checked aria-label="Select address" /></td>
                        <td><input type="text" value="VIP-2" /></td>
                        <td>
                            <select>
                                <option><?php esc_html_e( 'Subnet', 'fortis-toolbox' ); ?></option>
                                <option>Range</option>
                                <option>FQDN</option>
                            </select>
                        </td>
                        <td><input type="text" value="192.168.10.0/24" placeholder="e.g., 192.168.10.0/24" /></td>
                        <td>
                            <label class="kb-fortis-switch">
                                <input type="checkbox" checked aria-label="Allow routing" />
                                <span class="screen-reader-text"><?php esc_html_e( 'Allow routing for this object', 'fortis-toolbox' ); ?></span>
                            </label>
                        </td>
                        <td>
                            <label class="kb-fortis-switch">
                                <input type="checkbox" checked aria-label="Row OK" />
                                <span class="screen-reader-text"><?php esc_html_e( 'Mark row as OK', 'fortis-toolbox' ); ?></span>
                            </label>
                        </td>
                        <td>
                            <div class="kb-fortis-table-actions">
                                <button type="button" class="kb-fortis-button-secondary" title="Add">+</button>
                                <button type="button" class="kb-fortis-button-secondary" title="Duplicate">
                                    <?php esc_html_e( '⧉', 'fortis-toolbox' ); ?>
                                </button>
                                <button type="button" class="kb-fortis-button-secondary" title="Delete">×</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="kb-fortis-inline kb-fortis-actions">
            <button type="button" class="kb-fortis-button-secondary"><?php esc_html_e( 'Delete', 'fortis-toolbox' ); ?></button>
            <button type="button" class="kb-fortis-button-secondary"><?php esc_html_e( 'Delete All', 'fortis-toolbox' ); ?></button>
            <button type="button" class="kb-fortis-button-secondary"><?php esc_html_e( 'Import', 'fortis-toolbox' ); ?></button>
            <button type="button" class="kb-fortis-button-secondary"><?php esc_html_e( 'Export', 'fortis-toolbox' ); ?></button>
        </div>
    </div>
</div>
