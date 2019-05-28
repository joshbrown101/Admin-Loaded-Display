<?php

defined( 'ABSPATH' ) or die( 'wp is not properly loading' );


/**
 * ALDCollectScripts handles the data fetching for the plugin.
 */
class ALDCollectScripts {

  /**
   *  Collect the scripts that are running and store them in an array and return
   *  @return [array]
   */
  public static function ald_grab_scripts() {
    global $wp_scripts;
    $ald_scripts = array();
   foreach( $wp_scripts->queue as $handle ) :
       array_push($ald_scripts, $handle);
    endforeach;
   return $ald_scripts;

 }

 /**
  *  Collect the styles that are running and store them in an array and return
  *  @return [array]
  */
  public static function ald_grab_styles() {
     global $wp_styles;
     $ald_styles = array();
    foreach( $wp_styles->queue as $handle ) :
        array_push($ald_styles, $handle);
     endforeach;

    return $ald_styles;

  }
}
