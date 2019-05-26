<?php
/**
 * Admin Loaded Display
 *
 * @package     AdminLoadedDisplay
 * @author      Josh Brown
 * @copyright   2017 Josh Brown
 * @license     GPL-2.0+
 *
 * @admin-loaded-display
 * Plugin Name: Admin Loaded Display
 * Description: Displays the scripts and styles that are enqueued.
 * Version:     1.0.0
 * Author:      Josh Brown
 * Text Domain: admin-loaded-display
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
include 'classes/class-collect-the-registered-scripts.php';

// add our widget to the admin bar - admin display
add_action( 'admin_bar_menu', 'ald_toolbar_menu', 999 );

function ald_toolbar_menu( $wp_admin_bar ) {


$ald_page = site_url('/ald');

	$args = array(
		'id'    => 'ald_page',
		'title' => 'Loaded Scripts',
		'href'  => $ald_page,
		'meta'  => array(
      'class' => 'ald-box'
    )
	);
	$wp_admin_bar->add_node( $args );
}




function grab_the_code() {
  // include the file that will handle the retreval of the Scripts
  $collected_styles = ALDCollectScripts::ald_grab_styles();
  $collected_scripts = ALDCollectScripts::ald_grab_scripts();
  //error_log( print_r( $collected_styles, true ) );
  //error_log( print_r( $collected_scripts, true ) );
      echo '<script>';
      echo 'var ald_loaded = {}; ';
      echo 'ald_loaded.styles = [';
  foreach ($collected_styles as $key => $value) {
    echo '"';
    echo $value;
    echo '",';

  }
      echo '];';
    echo 'ald_loaded.scripts = [';

  foreach ($collected_scripts as $key => $value) {
    echo '"';
    echo $value;
    echo '",';
  }
  echo '];';
  echo '</script>';

}
add_action( 'wp_print_scripts', 'grab_the_code' );


function ald_enqueue_scripts() {
   wp_register_script( 'ald_plugin_scripts', plugins_url('js/ald_scripts.js', __FILE__), array('jquery') );

  // Pull the data we want to send to the front end
  $translation_array = array(
  	'some_string' => __( 'Some string to translate', 'admin-loaded-display' ),
  	'a_value' => '10'
  );
  wp_localize_script( 'ald_plugin_scripts', 'ald_object', $translation_array );

  // Enqueued script with localized data.
  wp_enqueue_script( 'ald_plugin_scripts');
  wp_enqueue_style( 'ald_styles', plugins_url('css/style.css', __FILE__ ) );

}

add_action('admin_enqueue_scripts', 'ald_enqueue_scripts' );
add_action('wp_enqueue_scripts', 'ald_enqueue_scripts' );
