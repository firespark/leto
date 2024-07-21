<?php

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
    $route_begin_fiasId = get_safe_post($_POST['route_begin_fiasId']);
    $route_begin_fiasRegion = get_safe_post($_POST['route_begin_fiasRegion']);
    $route_begin_lat = get_safe_post($_POST['route_begin_lat']);
    $route_begin_long = get_safe_post($_POST['route_begin_long']);
    $route_end_fias = get_safe_post($_POST['route_end_fias']);
    $route_end_fiasId = get_safe_post($_POST['route_end_fiasId']);
    $route_end_fiasRegion = get_safe_post($_POST['route_end_fiasRegion']);
    $route_end_lat= get_safe_post($_POST['route_end_lat']);
    $route_end_long = get_safe_post($_POST['route_end_long']);

    $utm_source = get_safe_post($_POST['utm_source']);
    $utm_medium = get_safe_post($_POST['utm_medium']);
    $utm_campaign = get_safe_post($_POST['utm_campaign']);
    $utm_term = get_safe_post($_POST['utm_term']);
    $utm_content = get_safe_post($_POST['utm_content']);
    $utm_referrer = get_safe_post($_POST['utm_referrer']);
    $utm_user_ip = get_safe_post($_POST['utm_user_ip']);

    
    
    if($load_capacity && $body_type && $route_begin && $route_end){

        $calc_price = NULL;

        if($route_begin_fiasId && $route_end_fiasId) {
            $calc_price = $wpdb->get_var("SELECT price FROM " . $wpdb->prefix . "calc_prices WHERE active = 1 AND deleted = 0 AND load_capacity = '" . $load_capacity . "' AND body_type = '" . $body_type . "' AND fias1 = '" . $route_begin_fiasId . "' AND fias2 = '" . $route_end_fiasId . "'");
            
        }


        if($calc_price) {
            $success = true;
            $output = $calc_price;
        }
        else {


            $product_code = get_product_code($body_type, $load_capacity);

            if($product_code) {
                //$p1 = get_calc_price_route_p(1, $route_begin, $route_end, $route_begin_fias, $route_end_fias);
                //$p2 = get_calc_price_route_p(2, $route_begin, $route_end, $route_begin_fias, $route_end_fias);
                $by_code = get_by_code($route_begin_fias, $route_end_fias);

                $data = [
                    'p1' => $route_begin,
                    'p2' => $route_end,
                    'by_code' => $by_code,
                    'n_code' => $product_code,
                    'fias_id1' => $route_begin_fiasId,
                    'fias_id2' => $route_end_fiasId,
                    'region_fias_id1' => $route_begin_fiasRegion,
                    'region_fias_id2' => $route_end_fiasRegion,
                    'geo_lat1' => $route_begin_lat,
                    'geo_lat2' => $route_end_lat,
                    'geo_lon1' => $route_begin_long,
                    'geo_lon2' => $route_end_long,                  

                ];

                $url = $optionsArr['1c_api_link'] . '/customer_rate';
                 
                $curl = curl_init($url);

                curl_setopt($curl, CURLOPT_POST, true);

                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

                $response = curl_exec($curl);

                curl_close($curl);    
                    
                $responseData = json_decode($response, true);  
                   
                if($responseData['success']) {
                    if($route_begin_fiasId && $route_end_fiasId) {
                        $wpdb->insert( $wpdb->prefix . 'calc_prices', [ 
                            'load_capacity' => $load_capacity,
                            'body_type' => $body_type,
                            'point1' => $route_begin,
                            'point2' => $route_end,
                            'fias1' => $route_begin_fiasId,
                            'fias2' => $route_end_fiasId,
                            'price' => $responseData['customer_rate'],
                            
                            'utm_source' => $utm_source,
                            'utm_medium' => $utm_medium,
                            'utm_campaign' => $utm_campaign,
                            'utm_term' => $utm_term,
                            'utm_content' => $utm_content,
                            'utm_referrer' => $utm_referrer,
                            'utm_user_ip' => $utm_user_ip, 
                        ] );
                    }

                    $success = true;
                    $output = $responseData['customer_rate'];
                }
                else {
                    if($responseData['message']) {
                        $output = $responseData['message'];
                    }
                }
            }
        }
    }
   
    echo json_encode(array('success' => $success, 'output' => $output));    
}    

die();
 
?>