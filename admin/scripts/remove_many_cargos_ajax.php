<?php
	
$post = (!empty($_POST)) ? true : false;
if($post) {
  
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
  
    $ids = $_POST['ids'];

    if($ids) {
        $ids = implode( ',', array_map( 'absint', $ids ) );

        if ($wpdb->query( "DELETE FROM " . $wpdb->prefix . "cargos WHERE ID IN($ids)" )){
            echo 1;
        }
        else {
            echo $wpdb->last_error;
        }
    }
    else {
        echo 1;
    }

    
      
}
