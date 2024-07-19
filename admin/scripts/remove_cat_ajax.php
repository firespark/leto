<?php
  
$post = (!empty($_POST)) ? true : false;
if($post) {
  
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    global $wpdb;
  
    $cat_id = $_POST['cat_id'];
    $cargos_ctr = $wpdb->get_var( "SELECT COUNT(*) FROM " . $wpdb->prefix . "cargos WHERE cat_id = $cat_id" );
    if($cargos_ctr != 0) {
        echo 'Категория не пуста! Некоторые грузы принадлежат к этой категории. Задайте им другую категорию';
    }
    else{

        if ($wpdb->delete($wpdb->prefix . 'cargo_cats', [ 'id' => $cat_id ] )){
            echo 1;
        }
        else {
            echo $wpdb->last_error;
        }
    }
      
}