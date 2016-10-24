<?php

/*

Plugin Name: Show me php

Plugin URI: http://show-me-php.com

Description: Un plugin qui affiche les fichiers php utilisés par la page vue

Version: 0.1

Author: Florent Dinet

Author URI: http://votre-site.com

License: GAZOLINE1

*/


// SCRIPT POUR AFFICHER LES FICHIERS TEMPLATES UTILISES

function show_me_php() {

  $mon_tableau=get_included_files();
  $string_to_find="/wp-content/themes";
  $string_to_find2="woocommerce/templates";


  foreach($mon_tableau as $element)
  {
  	$pos = strpos($element,$string_to_find);
  	$pos2 = strpos($element,$string_to_find2);

  	if(($pos === false) && ($pos2 === false)) {

  	} else {
  		echo $element . '<br />';
  	}

  }

}

add_action( 'wp_footer', 'show_me_php', 0 );
