<?php

header('Content-type: text/html; charset=UTF-8');
 
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

if(!empty($_POST)) {

    $success = false;
    $output = '';
  

    $title = get_safe_post($_POST['title']);
    $cat_id = get_safe_post($_POST['cat_id']);
    $chs = (get_safe_post($_POST['chs'])) ? 1 : 0;
    
    
    if(!$title){
        $output = 'Заполните, пожалуйста, все необходимые поля';
    }
        
    else{
      

        if($wpdb->insert( $wpdb->prefix . 'cargo_groups',
            [ 'title' => $title, 'cat_id' => $cat_id, 'chs' => $chs ]
        )) {
            $success = true;
            $output = 'Изменения сохранены';
        }
        else {
            $output = 'Что-то пошло не так. Пожалуйста, сообщите администратору сайта об этой проблеме.';
        }
      
    }
   
    echo json_encode(array('success' => $success, 'output' => $output));    
}    

die();
 
?>