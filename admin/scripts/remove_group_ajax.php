<?php
	
$post = (!empty($_POST)) ? true : false;
if($post) {
  
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    global $wpdb;
  
    $group_id = $_POST['group_id'];
    $cargos_ctr = $wpdb->get_var( "SELECT COUNT(*) FROM " . $wpdb->prefix . "cargos WHERE group_id = $group_id" );
    if($cargos_ctr != 0) {
        echo 'Группа не пуста! Некоторые грузы принадлежат к этой группе. Задайте им другую группу';
    }
    else{

        if ($wpdb->delete($wpdb->prefix . 'cargo_groups', [ 'id' => $group_id ] )){
            echo 1;
        }
        else {
            echo $wpdb->last_error;
        }
    }
      
}
