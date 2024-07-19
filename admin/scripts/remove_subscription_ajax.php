<?php
	
$post = (!empty($_POST)) ? true : false;
if($post) {
  
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    global $wpdb;
  
    $subscription_id = $_POST['subscription_id'];

    if ($wpdb->delete($wpdb->prefix . 'subscription_emails', [ 'id' => $subscription_id ] )){
        echo 1;
    }
      
}
