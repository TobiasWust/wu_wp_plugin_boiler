<?php
/**
 * @package wu_wp_plugin_boiler
 */
/*
Plugin Name: wu_wp_plugin_boiler
Version: 0.1
Author: Tobias Wust
Author URI: https://www.tobiaswust.de/
Description: Personal Boilerplate for small Wp Plugins
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hey. Please dont call me :)';
	exit;
}

function activate_wu_boiler() {
  // do something on plugin activation?
}

function deactivate_wu_boiler() {
  // do something on plugin deactivation?
}

register_activation_hook( __FILE__, 'activate_wu_boiler' );
register_deactivation_hook( __FILE__, 'deactivate_wu_boiler' );

function wu_load_assets() {
    wp_enqueue_style( 'wu_boiler_style', plugin_dir_url( __FILE__ ) . 'assets/wu_boiler-style.css' );
    wp_enqueue_script( 'wu_boiler_script', plugin_dir_url( __FILE__ ) . 'assets/wu_boiler-script.js' );
}

add_action( 'wp_enqueue_scripts', 'wu_load_assets' );

function wu_wp_shortcode_func() {
  ob_start();
  include ('template/wu_boiler-template.php');
  return ob_get_clean();
}
add_shortcode( 'wu_wp_plugin_boiler', 'wu_wp_shortcode_func' );
