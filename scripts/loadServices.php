<?php

if(!empty($_POST)) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    global $wpdb;
  
    $results_per_page = get_option('posts_per_page');
    $counter = get_safe_post($_POST['counter']);
    $start_from = $results_per_page * $counter;

    
    $args = [
        'posts_per_page' => $results_per_page,
        'offset' => $start_from,
        'post_type' => 'services',
    ];

    $services = get_posts($args);
    $output = '';

    if(!empty($services)){
    
        foreach($services as $service) {
      		$serviceArr = get_fields($service->ID);

            $output .= '<div class="col-md-4 d-flex align-items-stretch">';
            $output .= '<div class="services p-4 d-flex align-items-start">';
            $output .= '<div class="text ps-4">';
            $output .= '<div class="image-container">';
            if($serviceArr['service_img']){
            $output .= '<img src="' . $serviceArr['service_img']['url'] . '" alt="' . $serviceArr['service_img']['alt'] . '" class="image">';
            }
            $output .= '</div>';
            if($serviceArr['service_price']){
            $output .= '<p class="meta"><span>' . $serviceArr['service_price'] . '</span></p>';
            }
            $output .= '<div class="h2">' . $service->post_title . '</div>';
            $output .= '<p>' . $serviceArr['service_description'] . '</p>';
            if($serviceArr['service_show_button']){
            $output .= '<a type="button" class="btn btn-primary px-4 py-3 addMessage" data-toggle="modal" data-target="#order-modal" data-message="Заказ услуги: ' . $service->post_title . '">' . $serviceArr['service_button_text'] . '</a>';
            }
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
           
        }	
    }
    echo $output;
  
}

  

