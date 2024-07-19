<?php

header('Content-type: text/html; charset=UTF-8');
 
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

if(!empty($_POST)) {

    $success = false;
    $output = '';
  
    $id = get_safe_post($_POST['id']);
    $title = get_safe_post($_POST['title']);
    $cat_id = get_safe_post($_POST['cat_id']);
    $group_id = get_safe_post($_POST['group_id']);
        
    
    if(!$title || !$cat_id){
        $output = 'Заполните, пожалуйста, все необходимые поля';
    }
        
    else{
        $cargo = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "cargos WHERE id = $id" );

        if($cargo->id){

            if($cargo->title != $title || $cargo->cat_id != $cat_id || $cargo->group_id != $group_id) {
           
                if($wpdb->update( $wpdb->prefix . 'cargos',
                    [ 'title' => $title, 'cat_id' => $cat_id, 'group_id' => $group_id ],
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