<?php

// Задать вопрос

header('Content-type: text/html; charset=UTF-8');
 
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

if(!empty($_POST)) {

    $success = false;
    $output = 'Во время выполнения скрипта произошли ошибки. Пожалуйста, сообщите администратору сайта об этой проблеме';
  
    // Post values
    $load_capacity = get_safe_post($_POST['load_capacity']);
    $body_type = get_safe_post($_POST['body_type']);

    $route_begin = get_safe_post($_POST['route_begin']);
    $route_end = get_safe_post($_POST['route_end']);
    $route_begin_fias = get_safe_post($_POST['route_begin_fias']);
    $route_end_fias = get_safe_post($_POST['route_end_fias']);

    $date = get_safe_post($_POST['date']);
    $cargo_title = get_safe_post($_POST['cargo_title']);
    $cargo_weight = get_safe_post($_POST['cargo_weight']);
    $cargo_size = get_safe_post($_POST['cargo_size']);
    //$payment = get_safe_post($_POST['payment']);
    $package = get_safe_post($_POST['package']);
    $p_qty = get_safe_post($_POST['comment']);
    $is_temp_regime = get_safe_post($_POST['is_temp_regime']);
    //$c_min = get_safe_post($_POST['c_min']);
    //$c_max = get_safe_post($_POST['c_max']);
    $fio = get_safe_post($_POST['fio']);
    $phone = get_safe_post($_POST['phone']);
    $company = get_safe_post($_POST['company']);
    $inn = get_safe_post($_POST['inn']);
    $person_comment = get_safe_post($_POST['person_comment']);
    $email = get_safe_post($_POST['email']);
    $rate = get_safe_post($_POST['cargo_rate']);
    $agree = get_safe_post($_POST['agree']);

    $utm_source = get_safe_post($_POST['utm_source']);
    $utm_medium = get_safe_post($_POST['utm_medium']);
    $utm_campaign = get_safe_post($_POST['utm_campaign']);
    $utm_term = get_safe_post($_POST['utm_term']);
    $utm_content = get_safe_post($_POST['utm_content']);
    $utm_referrer = get_safe_post($_POST['utm_referrer']);
    $utm_user_ip = get_safe_post($_POST['utm_user_ip']);
        
    
    if(!$load_capacity || !$body_type || !$route_begin || !$route_end || !$date || !$fio || !$phone || !$cargo_title){
        $output = 'Заполните, пожалуйста, все необходимые поля';
    }
    else if($email && !is_email($email)) {
        $output = 'Неправильно указан Email';
    }
    else if(!is_phone_custom($phone)) {
        $output = 'Неправильно указан Телефон';
    }
    /*else if($is_temp_regime && ( (!$c_min && $c_min != 0) || (!$c_max && $c_max != 0) )) {
        $output = 'Не указаны минимальная и максимальная температуры';
    }*/
    else if(!$agree) {
        $output = 'Вы не согласились с условиями политики конфиденциальности';
    }
    
    else{

        $product_code = get_product_code($body_type, $load_capacity);

        if($product_code) {
            $p1 = get_calc_price_route_p(1, $route_begin, $route_end, $route_begin_fias, $route_end_fias);
            $p2 = get_calc_price_route_p(2, $route_begin, $route_end, $route_begin_fias, $route_end_fias);
            $by_code = get_by_code($route_begin_fias, $route_end_fias);

            $data = [
                'p1' => $p1,
                'p2' => $p2,
                'by_code' => $by_code,
                'n_code' => $product_code,
                'cargo' => $cargo_title, 
                'date' => date("Ymd", strtotime($date)), 
                'lead_name' => mb_strimwidth($fio, 0, 150), 
                'lead_phone' => $phone,
                'lead_email' => $email,
                'lead_company' => $company, 
                'weight' => $cargo_weight, 
                'volume' => $cargo_size, 
                'is_temp' => ($is_temp_regime) ? 1 : NULL,
                //'min_temp' => $c_min, 
                //'max_temp' => $c_max,
                'p_name' => $package,
                'p_qty' => $p_qty,
                'lead_inn' => $inn,
                'rate' => $rate,

                'utm_source' => $utm_source,
                'utm_medium' => $utm_medium,
                'utm_campaign' => $utm_campaign,
                'utm_term' => $utm_term,
                'utm_content' => $utm_content,
                'utm_referrer' => $utm_referrer,
                'utm_user_ip' => $utm_user_ip,   

            ];

            $url = $optionsArr['1c_api_link'] . '/create_pvp';
             
            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_POST, true);

            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

            $response = curl_exec($curl);

            curl_close($curl);    
                
            $responseData = json_decode($response, true);

               
            if($responseData['success']) {
                $from = get_option('from');
                $to = get_option('admin_email');
                $headers = "Content-Type: text/html; charset=UTF-8";
                $subject = 'Расчет калькулятора на сайте ' . get_bloginfo('name');  
                
                $msg = "<p>Цена: " . number_format($rate, 0, ',', ' ') . " руб.</p>";
                $msg .= "<p>Грузоподъемность: " . $load_capacity . "</p>";
                $msg .= "<p>Тип кузова: " . $body_type . "</p>";
                $msg .= "<p>Город погрузки: " . $route_begin . "</p>";
                $msg .= "<p>Город разгрузки: " . $route_end . "</p>";
                $msg .= "<p>Дата доставки: " . $date . "</p>";
                $msg .= "<p>Груз: " . $cargo_title . "</p>";
                $msg .= "<p>Вес: " . $cargo_weight . "</p>";
                $msg .= "<p>Объем: " . $cargo_size . "</p>";
                //$msg .= "<p>Тип оплаты: " . $payment . "</p>";
                $msg .= "<p>Упаковка: " . $package . "</p>";
                $msg .= "<p>Количество мест: " . $p_qty . "</p>";
                if($is_temp_regime){
                    $msg .= "<p>Нужен температурный режим</p>";
                    //$msg .= "<p>Мин. температура: " . $c_min . "</p>";
                    //$msg .= "<p>Макс. температура: " . $c_max . "</p>";
                }
                $msg .= "<p>ФИО: " . $fio . "</p>";
                $msg .= "<p>Телефон: " . $phone . "</p>";
                $msg .= "<p>Email: " . $email . "</p>";
                $msg .= "<p>Название компании: " . $company . "</p>";
                $msg .= "<p>ИНН: " . $inn . "</p>";
                $msg .= "<p>Комментарий: " . $person_comment . "</p>";
                
              
                wp_mail( $to, $subject, $msg, $headers ); 

                $success = true;
                $output = get_field('calc_success_message', 41);
            }
            else {
                //$output = $response;
                if($responseData['message']) {
                    $output = $responseData['message'];
                }
            }

        }
    }
   
    echo json_encode(array('success' => $success, 'output' => $output));    
}    

die();
 
?>