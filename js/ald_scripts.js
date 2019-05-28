/**
 * Add ALD dropdown
 * Create the two dropdowns and buttons for scripts / styles
 * @return false
 */
jQuery( document ).on('click', '.ald-box a.ab-item', function(event){

var is_loaded = jQuery('#ald_loaded');

  if (!is_loaded.length) {

    var ald_admin_box = document.createElement("div");
    ald_admin_box.setAttribute("id", "ald-admin-box");

    var li = document.getElementById("wp-admin-bar-ald_page");
    var ul = document.createElement("ul");
    var ald_style_link = document.createElement("a");

    ald_style_link.setAttribute("id", "ald-enqueued-styles");
    ald_style_link.setAttribute("href", "#");

    var ald_scripts_link = document.createElement("a");
    ald_scripts_link.setAttribute("id", "ald-enqueued-scripts");
    ald_scripts_link.setAttribute("href", "#");

    ul.setAttribute("id", "ald_loaded");
    li.appendChild(ald_admin_box);
    li.appendChild(ul);

    ald_style_link.appendChild(document.createTextNode("Styles"));
    ald_scripts_link.appendChild(document.createTextNode("Scripts"));
    ald_admin_box.appendChild(ald_style_link);
    ald_admin_box.appendChild(ald_scripts_link);

    for (var i = 0, max = ald_loaded.scripts; i < max.length; i++) {
      var loaded_style = document.createElement("li");
      loaded_style.setAttribute("class", "ald_scripts");
      loaded_style.appendChild(document.createTextNode( max[i] ) );
      ul.appendChild(loaded_style);
    }
  } else {

    var admin_box = document.getElementById('ald-admin-box');
    var loaded_scripts = document.getElementById('ald_loaded');
    admin_box.parentNode.removeChild(admin_box);
    loaded_scripts.parentNode.removeChild(loaded_scripts);
  }

  /**
   * Load the dropdown with styles
   */
  jQuery('li#wp-admin-bar-ald_page').on('click', '#ald-enqueued-styles', function(event){

    $ald_loaded = document.getElementById('ald_loaded');
    jQuery($ald_loaded).empty();

    for (var i = 0, max = ald_loaded.styles; i < max.length; i++) {
      var loaded_style = document.createElement("li");
      loaded_style.setAttribute("class", "ald_scripts");
      loaded_style.appendChild(document.createTextNode( max[i] ) );
      $ald_loaded.appendChild(loaded_style);

    }
   });

   /**
    * Load the dropdown with scripts
    */
   jQuery('li#wp-admin-bar-ald_page').on('click', '#ald-enqueued-scripts', function(event){

     $ald_loaded = document.getElementById('ald_loaded');
     jQuery($ald_loaded).empty();

     for (var i = 0, max = ald_loaded.scripts; i < max.length; i++) {
       var loaded_scripts = document.createElement("li");
       loaded_scripts.setAttribute("class", "ald_scripts");
       loaded_scripts.appendChild(document.createTextNode( max[i] ) );
       $ald_loaded.appendChild(loaded_scripts);

     }
    });
    return false;

});

/**
 * Remove ALD dropdown box on when user click outside dropdown
 */
jQuery( document ).on('click', document, function(event){
  if(!jQuery(event.target).closest('#wp-admin-bar-ald_page').length) {
    var ifBox = jQuery("#ald_loaded");
    var alsoBox = jQuery("#ald-admin-box");
    ifBox.remove();
    alsoBox.remove();
  }
});
