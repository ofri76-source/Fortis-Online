<?php
/**
 * Admin page template for Fortis Toolbox.
 *
 * @var string $generated_config
 */
?>
<div class="wrap">
    <h1><?php esc_html_e( 'Fortis Toolbox', 'fortis-toolbox' ); ?></h1>

    <p><?php esc_html_e( 'Basic skeleton – we will expand the form fields and logic step by step.', 'fortis-toolbox' ); ?></p>

    <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <input type="hidden" name="fortis_source" value="admin" />
        <?php wp_nonce_field( 'fortis_toolbox_generate', 'fortis_toolbox_nonce' ); ?>
        <input type="hidden" name="action" value="fortis_toolbox_generate" />

        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="fortis_client_name"><?php esc_html_e( 'Client Name', 'fortis-toolbox' ); ?></label>
                    </th>
                    <td>
                        <input name="fortis_client_name" id="fortis_client_name" type="text" class="regular-text" required />
                        <p class="description"><?php esc_html_e( 'Internal display name / customer identifier.', 'fortis-toolbox' ); ?></p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="fortis_model"><?php esc_html_e( 'Fortigate Model', 'fortis-toolbox' ); ?></label>
                    </th>
                    <td>
                        <select name="fortis_model" id="fortis_model" required>
                            <option value=""><?php esc_html_e( 'Select model…', 'fortis-toolbox' ); ?></option>
                            <option value="FG-40F">FG-40F</option>
                            <option value="FG-60F">FG-60F</option>
                            <option value="FG-80F">FG-80F</option>
                            <option value="FG-100F">FG-100F</option>
                        </select>
                        <p class="description"><?php esc_html_e( 'Initial static model list – to be extended from the Fortis toolbox data.', 'fortis-toolbox' ); ?></p>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'WAN Mode', 'fortis-toolbox' ); ?></th>
                    <td>
                        <fieldset>
                            <label>
                                <input type="radio" name="fortis_wan_mode" value="dhcp" checked />
                                <?php esc_html_e( 'DHCP', 'fortis-toolbox' ); ?>
                            </label><br />
                            <label>
                                <input type="radio" name="fortis_wan_mode" value="static" />
                                <?php esc_html_e( 'Static IP', 'fortis-toolbox' ); ?>
                            </label><br />
                            <label>
                                <input type="radio" name="fortis_wan_mode" value="pppoe" />
                                <?php esc_html_e( 'PPPoE', 'fortis-toolbox' ); ?>
                            </label>
                        </fieldset>
                        <p class="description"><?php esc_html_e( 'We will add detailed fields per mode (IP, mask, gateway, VLAN, credentials, etc.) in the next iterations.', 'fortis-toolbox' ); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button( __( 'Generate Configuration', 'fortis-toolbox' ) ); ?>
    </form>

    <?php if ( ! empty( $generated_config ) ) : ?>
        <h2><?php esc_html_e( 'Generated Configuration', 'fortis-toolbox' ); ?></h2>
        <textarea
            readonly
            rows="15"
            style="width: 100%; font-family: monospace;">
<?php echo esc_textarea( $generated_config ); ?>
        </textarea>
    <?php endif; ?>
</div>
