<?php

// Задать вопрос

header('Content-type: text/html; charset=UTF-8');
 
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

if(!empty($_POST)) {

    $success = false;
    $output = 'Во время выполнения скрипта произошли ошибки. Пожалуйста, сообщите администратору сайта об этой проблеме';
  
    // Post values
    $email = get_safe_post($_POST['email']);
            
    
    if(!$email || !is_email($email)) {
        $output = 'Неправильно указан Email';
    }
    
    else{

        $subscription_id = $wpdb->get_var("SELECT id FROM " . $wpdb->prefix . "subscription_emails WHERE email = '" . $email . "'");

        if (!$subscription_id) {
            
            if ($wpdb->insert( $wpdb->prefix . 'subscription_emails', [ 
                'email' => $email,
                
            ] ) ) {
                $success = true;
                $output = get_field('sub_popup_title', 1980); //1980
            }
            else {
                $output = $wpdb->last_error;
            }
        }
        else {
            $output = get_field('sub_popup_title_double', 1980); //1980
        }

    }
   
    echo json_encode(array('success' => $success, 'output' => $output));    
}    

die();
 
?>