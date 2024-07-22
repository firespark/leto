<?php
	

  
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    global $wpdb;
  

    if ($wpdb->query("DELETE FROM " . $wpdb->prefix. "calc_prices WHERE deleted = 1")){
        echo 1;
    }
    
    else {
        echo $wpdb->last_error;
    }
      

