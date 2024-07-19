<?php
	
$post = (!empty($_POST)) ? true : false;
if($post) {
  
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    global $wpdb;
  
    $cargo_id = $_POST['cargo_id'];

    if ($wpdb->delete($wpdb->prefix . 'cargos', [ 'id' => $cargo_id ] )){
        echo 1;
    }
      
}
