<?php
	

  
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    global $wpdb;
  

    /*if ($wpdb->query("DELETE FROM " . $wpdb->prefix. "calc_prices")){
        echo 1;
    }*/
    
    if ($wpdb->update( $wpdb->prefix . 'calc_prices', [ 'deleted' => 1 ], [ 'id' >= 0 ] )) {
        echo 1;
    }
    else {
        echo $wpdb->last_error;
    }
      

