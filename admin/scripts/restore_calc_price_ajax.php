<?php
	
$post = (!empty($_POST)) ? true : false;
if($post) {
  
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    global $wpdb;
  
    $calc_price_id = $_POST['calc_price_id'];

    if ($wpdb->update( $wpdb->prefix . 'calc_prices', [ 'deleted' => 0 ], [ 'id' => $calc_price_id ] )) {
        echo 1;
    }
    else {
        echo $wpdb->last_error;
    }
      
}
