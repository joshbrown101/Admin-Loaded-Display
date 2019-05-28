<?php
/**
 * Admin Loaded Display
 *
 * @package     AdminLoadedDisplay
 * @author      Josh Brown
 * @copyright   2019 Josh Brown
 * @license     GPL-2.0+
 *
 * @admin-loaded-display
 * Plugin Name: Admin Loaded Display
 * Description: Adds a button to the admin bar that displays the loaded scripts
 * and styles that are enqueued for optimization or debugging.
 * Version:     1.0.1
 * Author:      Josh Brown
 * Author URI:  https://github.com/joshbrown101/
 * Text Domain: admin-loaded-display
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

 defined( 'ABSPATH' ) or die( 'wp is not properly loading' );

/**
 * Include our script & style collection file
 * the class ALDCollectScripts that handles gathering the
 * scripts and styles
 */
include 'classes/class-collect-the-registered-scripts.php';

/**
 * Add our styles and script widget to the admin bar - admin display
 */
add_action( 'admin_bar_menu', 'ald_toolbar_menu', 999 );

/**
 * Add our custom node to the admin bar
 */
function ald_toolbar_menu( $wp_admin_bar ) {

$ald_page = site_url('/ald');

	$args = array(
		'id'    => 'ald_page',
		'title' => 'Display Loaded Scripts',
		'href'  => $ald_page,
		'meta'  => array(
      'class' => 'ald-box'
    )
	);
	$wp_admin_bar->add_node( $args );
}

/**
 * Load the enqueued styles and scripts into an object
 * We will utilize wp_print_scripts because it fires so late
 * in order to ensure all the scripts & styles are loaded
 * are captured and accurately reported
 */
function grab_the_code() {
  // call the method that will handle the retreval of the Styles
	// call the method that will handle the retreval of the Scripts
  $collected_styles = ALDCollectScripts::ald_grab_styles();
  $collected_scripts = ALDCollectScripts::ald_grab_scripts();
	$loaded_scripts = '';
	$loaded_scripts .= '<script>';
  $loaded_scripts .= 'var ald_loaded = {}; ';
  $loaded_scripts .= 'ald_loaded.styles = [';
  foreach ($collected_styles as $key => $value) {
    $loaded_scripts .= '"';
    $loaded_scripts .= $value;
    $loaded_scripts .= '",';

  }
  $loaded_scripts .= '];';
  $loaded_scripts .= 'ald_loaded.scripts = [';

  foreach ($collected_scripts as $key => $value) {
    $loaded_scripts .= '"';
    $loaded_scripts .= $value;
    $loaded_scripts .= '",';
  }
  $loaded_scripts .= '];';
  $loaded_scripts .= '</script>';
	echo $loaded_scripts;

}
add_action( 'wp_print_scripts', 'grab_the_code' );

/**
 * Enqueue our styles and our front end script
 * both in admin and front end
 */
function ald_enqueue_scripts() {

  wp_enqueue_script( 'ald_plugin_scripts', plugins_url('js/ald_scripts.js', __FILE__), array('jquery') );
  wp_enqueue_style( 'ald_styles', plugins_url('css/style.css', __FILE__ ) );

}

add_action('admin_enqueue_scripts', 'ald_enqueue_scripts' );
add_action('wp_enqueue_scripts', 'ald_enqueue_scripts' );
