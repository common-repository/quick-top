<?php
/*
* Plugin Name: Quick Top
* Description: A customizable button plugin for quickly scrolling to the top of the page.
* Version: 1.0.0
* Author: Tanvir Hasan
* Author URI: https://profiles.wordpress.org/tanvirh/
* Text Domain: quick-top
* License: GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Include necessary files
require_once plugin_dir_path( __FILE__ ) . 'includes/admin-settings.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/front-end-display.php';

// Enqueue admin styles and scripts
function quick_top_admin_enqueue($hook) {
    if ( $hook !== 'toplevel_page_quick-top-settings' ) {
        return;
    }

    wp_register_style( 'quick-top-admin', plugin_dir_url( __FILE__ ) . 'assets/css/admin.css', array(), '1.0' );
    wp_enqueue_style( 'quick-top-admin' );

    wp_register_script( 'quick-top-admin', plugin_dir_url( __FILE__ ) . 'assets/js/admin.js', array('jquery'), '1.0', true );
    wp_enqueue_script( 'quick-top-admin' );
}
add_action( 'admin_enqueue_scripts', 'quick_top_admin_enqueue' );

// Enqueue front-end styles and scripts
function quick_top_frontend_enqueue() {
    wp_register_style( 'quick-top-frontend', plugin_dir_url( __FILE__ ) . 'assets/css/frontend.css', array(), '1.0' );
    wp_enqueue_style( 'quick-top-frontend' );

    wp_register_script( 'quick-top-frontend', plugin_dir_url( __FILE__ ) . 'assets/js/frontend.js', array('jquery'), '1.0', true );
    wp_enqueue_script( 'quick-top-frontend' );
}
add_action( 'wp_enqueue_scripts', 'quick_top_frontend_enqueue' );

// Enqueue Local Font Awesome
function quick_top_enqueue_font_awesome() {
    wp_register_style( 'quick-top-font-awesome', plugin_dir_url( __FILE__ ) . 'assets/css/fontawesome.min.css', array(), '6.5.2' );
    wp_enqueue_style( 'quick-top-font-awesome' );
}
add_action( 'wp_enqueue_scripts', 'quick_top_enqueue_font_awesome' );
add_action( 'admin_enqueue_scripts', 'quick_top_enqueue_font_awesome' );
?>
