<?php
/**
 * Plugin Name: KB - Fortis Toolbox
 * Description: Internal toolbox for generating Fortigate configuration snippets from the WordPress admin.
 * Version: 0.1.0
 * Author: O.K Software
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( 'FORTIS_TOOLBOX_PATH' ) ) {
    define( 'FORTIS_TOOLBOX_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'FORTIS_TOOLBOX_URL' ) ) {
    define( 'FORTIS_TOOLBOX_URL', plugin_dir_url( __FILE__ ) );
}

require_once FORTIS_TOOLBOX_PATH . 'includes/class-fortis-toolbox.php';

add_action( 'plugins_loaded', array( 'Fortis_Toolbox_Plugin', 'bootstrap' ) );
