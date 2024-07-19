<?php

// Задать вопрос

header('Content-type: text/html; charset=UTF-8');

  require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
  global $wpdb;

if(!empty($_POST)) {

    $output = '';

    // Post values
    $phrase = get_safe_post($_POST['phrase']);
  

    if($phrase){
        $posts_args = array(
            'post_type' => 'cargo',
            'posts_per_page' => 10,
            's' => $phrase,                             
        );

        $cargos = get_posts($posts_args);

        $items = 0;
        $output .= '<div class="select__scroll">';

        if(!empty($cargos)){
            
            $catsArr = [];
            foreach($cargos as $cargo){
                //$output .= '<button class="select__option" data-value="' . $cargo->post_title . '" type="button">' . $cargo->post_title . '</button>';
                $chs = get_field('cargo_banned', $cargo->ID);
                $outClass = 'select__option';
                if($chs) $outClass .= ' chs';
                $cats = wp_get_object_terms( $cargo->ID, 'cargocat' );
                if(!empty($cats)){
                    $items++;
                    
                    if(count($cats) > 1) {
                        foreach($cats as $cat) {
                            if($cat->parent){
                                if(!in_array($cat->name, $catsArr)){
                                    $catsArr[] = $cat->name;
                                    
                                    $output .= '<button class="' . $outClass . '" data-value="' . $cat->name . '" data-chs="' . $chs . '" type="button">' . $cat->name . '</button>';
                                }
                                break;
                            }
                        }
                    }
                    else {
                        if(!in_array($cats[0]->name, $catsArr)){
                            $catsArr[] = $cats[0]->name;
                            $output .= '<button class="' . $outClass . '" data-value="' . $cats[0]->name . '" data-chs="' . $chs . '" type="button">' . $cats[0]->name . '</button>';
                        }
                    }
                    
                }
                
            }

          
        }
        if($items == 0) {
            $output .= '<button class="select__option chs" data-value="" data-chs="1" type="button">--Нет результатов</button>';
        }
        $output .= '</div>';
    }
    echo $output;
}

die();

?>
