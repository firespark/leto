<?php

header('Content-type: text/html; charset=UTF-8');
 
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

if(!empty($_POST)) {

    $success = false;
    $output = '';
  
    // Post values
    $name = get_safe_post($_POST['name']);
    $contact = get_safe_post($_POST['contact']);
    $message = get_safe_post($_POST['message']);
    $agree = get_safe_post($_POST['agree']);
        
    
    if(!$name || !$contact){
        $output = 'Заполните, пожалуйста, все необходимые поля';
    }
    else if(!$agree) {
        $output = 'Вы не согласились с условиями политики конфиденциальности';
    }
    
    else{

        $from = get_option('from');
        $to = get_option('admin_email');
        $headers = "Content-Type: text/html; charset=UTF-8";
        $subject = 'Сообщение с сайта ' . get_bloginfo('name');  
      
        $msg = "<p>Имя: " . $name . "</p>";
        $msg .= "<p>Контакт: " . $contact . "</p>";
        $msg .= "<p>Сообщение: " . $message . "</p>";
      
        $send_admin =  wp_mail( $to, $subject, $msg, $headers );  
           
        if($send_admin) {
            $success = true;
            $output = 'Спасибо! Ваше сообщение доставлено. Мы свяжемся с Вами в ближайшее время.';
        }
        else {
            $output = 'Что-то пошло не так. Пожалуйста, сообщите администратору сайта об этой проблеме.';
        }
    }
   
    echo json_encode(array('success' => $success, 'output' => $output));    
}    

die();
 
?>