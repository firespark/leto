<?php
	

  
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    global $wpdb;
  

    /*if ($wpdb->query("DELETE FROM " . $wpdb->prefix. "calc_prices")){
        echo 1;
    }*/
    
    if ($wpdb->query("UPDATE " . $wpdb->prefix. "calc_prices SET deleted = 1 WHERE 1")){
        echo 1;
    }
    else {
        echo $wpdb->last_error;
    }
      

