<?php

//Загрузка новостей

if(!empty($_POST)) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
  
    $results_per_page = get_safe_post($_POST['results_per_page']);
    $counter = get_safe_post($_POST['counter']);
    $start_from = $results_per_page * $counter;

    
    $cases = get_posts([
        'posts_per_page' => $results_per_page,
        'offset' => $start_from,
        'post_type' => 'cases',
        'meta_key'      => 'case_service',
        'meta_value'    => $active_service,
    ]);
    $output = '';

    if(!empty($cases)){
    
        foreach($cases as $case) {
      		$caseFields = get_fields($case->ID);

            $output .= '<a href="' . get_the_permalink($case->ID) . '" class="cases-tabs__item">';
            $output .= '<div class="cases-tabs__image-ibg">';
            $output .= '<img src="' . $caseFields['case_image']['url'] . '" alt="' . $caseFields['case_image']['alt'] . '">';
            $output .= '</div>';
            $output .= '<div class="cases-tabs__right">';
            $output .= '<div class="cases-tabs__name">' . $case->post_title . '</div>';
            $output .= '<div class="cases-tabs__text">' . $caseFields['case_description'] . '</div>';
            $output .= '<div class="cases-tabs__info">';
            if($caseFields['case_route']){
            $output .= '<p><span>Маршрут: </span>' . $caseFields['case_route'] . '</p>';
            }
            if($caseFields['case_date']){
            $output .= '<p><span>Дата перевозки: </span>' . $caseFields['case_date'] . '</p>';
            }
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</a>';
           
        }	
    }
    echo $output;
  
}

  

