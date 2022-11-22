<?php
/*
Plugin Name: RST Testimonial
Version: 1.0
Plugin URI: https://rst.com
Author: rst
Author URI: https://rst.com
Description: A Testimonial Plugin for WordPress.
Text Domain: rst-testimonial
Domain Path: /languages/
*/


if ( ! defined( 'ABSPATH' ) ) {
	die( "Can't load this file directly" );
}


add_action('load-textdomain', function () {
    load_plugin_textdomain('rst-testimonial', false, plugin_dir_path(__FILE__) . 'languages');
});


function rst_admin_script_enqueue()
{
	wp_enqueue_script('rst_admin_main_script', plugin_dir_url(__FILE__) . 'admin/js/main.js', array('jquery'), time(), true);
	wp_enqueue_script('rst_admin_shortcode_script', plugin_dir_url(__FILE__) . 'admin/js/rst-testimonial-admin.js', array('jquery'), time(), true);
	wp_enqueue_style('rst_admin_own_style', plugin_dir_url(__FILE__) . 'admin/css/style.css', array(), time(), 'all');
	wp_enqueue_style('rst_admin_shortcode_style', plugin_dir_url(__FILE__) . 'admin/css/rst-shortcode-admin.css', array(), time(), 'all');
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script( 'wp-color-picker');

}

add_action('admin_enqueue_scripts', 'rst_admin_script_enqueue');



require_once(plugin_dir_path(__FILE__) . 'admin/admin-testimonial.php');
require_once( plugin_dir_path( __FILE__ ) . 'admin/admin-shortcode.php');
require_once( plugin_dir_path( __FILE__ ) . 'admin/shortcode-maker.php' );
require_once( plugin_dir_path( __FILE__ ) . 'admin/rst-user-form-options.php' );
require_once( plugin_dir_path( __FILE__ ) . 'admin/doc-sucpport.php' );