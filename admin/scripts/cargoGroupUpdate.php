<?php

header('Content-type: text/html; charset=UTF-8');
 
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

if(!empty($_POST)) {

    $success = false;
    $output = '';
  
    // Post values
    $id = get_safe_post($_POST['id']);
    $title = get_safe_post($_POST['title']);
    $cat_id = get_safe_post($_POST['cat_id']);
    $chs = (get_safe_post($_POST['chs'])) ? 1 : 0;
    
    
    if(!$title || !$cat_id){
        $output = 'Заполните, пожалуйста, все необходимые поля';
    }
        
    else{
      

        $group = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "cargo_groups WHERE id = $id" );

        if($group->id){

            if($group->title != $title || $group->cat_id != $cat_id || $group->chs != $chs) {
             
                if($wpdb->update( $wpdb->prefix . 'cargo_groups',
                    [ 'title' => $title, 'cat_id' => $cat_id, 'chs' => $chs ],
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