<?php
class ALDCollectScripts {

  public static function ald_grab_scripts() {
    error_log( ' running ald_grab_scripts');
    global $wp_scripts;
    $ald_scripts = array();
   foreach( $wp_scripts->queue as $handle ) :
       //error_log($handle);
       array_push($ald_scripts, $handle);
    endforeach;
    //error_log( print_r( $wp_scripts, true ) );
   return $ald_scripts;

 }

  public static function ald_grab_styles() {
    error_log( ' running ald_grab_styles');
     global $wp_styles;
     $ald_styles = array();
    foreach( $wp_styles->queue as $handle ) :
        //error_log($handle);
        array_push($ald_styles, $handle);
     endforeach;
     //error_log( print_r( $wp_styles, true ) );

    return $ald_styles;

  }
}
