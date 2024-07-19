<?php

header('Content-type: text/html; charset=UTF-8');
 
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

if(!empty($_POST)) {

    $success = false;
    $output = '';
  
    $id = get_safe_post($_POST['id']);
    $title = get_safe_post($_POST['title']);
    $chs = (get_safe_post($_POST['chs'])) ? 1 : 0;
    
    
    if(!$title){
        $output = 'Заполните, пожалуйста, все необходимые поля';
    }
        
    else{
     
        $cat = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "cargo_cats WHERE id = $id" );

        if($cat->id){

            if($cat->title != $title || $cat->chs != $chs) {
             
                if($wpdb->update( $wpdb->prefix . 'cargo_cats',
                    [ 'title' => $title, 'chs' => $chs ],
                    [ 'id' => $id ]
                )) {
                    $success = true;
                    $output = 'Изменения сохранены';
                }
                else {
                    $output = 'Что-то пошло не так. Пожалуйста, сообщите администратору сайта об этой проблеме.';
                }
            }
            else {
                $success = true;
                $output = 'Изменения сохранены';
            }
        
        }
    }
   
    echo json_encode(array('success' => $success, 'output' => $output));    
}    

die();
 
?>