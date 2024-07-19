<?php

header('Content-type: text/html; charset=UTF-8');

require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');


if(!empty($_POST)) {

    $output = '';

    $phrase = get_safe_post($_POST['phrase']);
  

    if($phrase){
        
        
        $cats = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cargo_cats WHERE title LIKE '%" . $phrase . "%' LIMIT 10");
        $groups = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cargo_groups WHERE title LIKE '%" . $phrase . "%' LIMIT 10");

        $cargos = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cargos WHERE title LIKE '%" . $phrase . "%' LIMIT 10");
        

        $items = 0;
        $output .= '<div class="select__scroll">';
        $catsArr = [];
        $groupsArr = [];

        if(!empty($cats)) {
            foreach($cats as $cat){
                $items++;
                

                if(!in_array($cat->id, $catsArr)){
                    $catsArr[] = $cat->id;
                    
                    $outClass = 'select__option';
                        if($cat->chs) $outClass .= ' chs';
                                
                    $output .= '<button class="' . $outClass . '" data-value="' . $cat->title . '" data-chs="' . $cat->chs . '" type="button">' . $cat->title . '</button>';
                        
                }               
                
            }
        }

        if(!empty($groups)){
            
            
            foreach($groups as $group){
                $items++;
                

                if(!in_array($group->cat_id, $catsArr)){
                    $catsArr[] = $group->cat_id;
                    $cat = $wpdb->get_row("SELECT title, chs FROM " . $wpdb->prefix . "cargo_cats WHERE id = $group->cat_id");
                    $outClass = 'select__option';
                        if($cat->chs) $outClass .= ' chs';
                                
                    $output .= '<button class="' . $outClass . '" data-value="' . $cat->title . '" data-chs="' . $cat->chs . '" type="button">' . $cat->title . '</button>';
                        
                }
                
                    
                if(!in_array($group->id, $groupsArr)){
                    $groupsArr[] = $group->id;
                        
                    $outClass = 'select__option';
                    if($group->chs) $outClass .= ' chs';
                                    
                    $output .= '<button class="' . $outClass . '" data-value="' . $group->title . '" data-chs="' . $group->chs . '" type="button">' . $group->title . '</button>';
                        
                }
                    
                    
                
                
                
            }

          
        }

        if(!empty($cargos)){
            
            
            foreach($cargos as $cargo){
                $items++;
                

                if(!in_array($cargo->cat_id, $catsArr)){
                    $catsArr[] = $cargo->cat_id;
                    $cat = $wpdb->get_row("SELECT title, chs FROM " . $wpdb->prefix . "cargo_cats WHERE id = $cargo->cat_id");
                    $outClass = 'select__option';
                        if($cat->chs) $outClass .= ' chs';
                                
                    $output .= '<button class="' . $outClass . '" data-value="' . $cat->title . '" data-chs="' . $cat->chs . '" type="button">' . $cat->title . '</button>';
                        
                }
                if($cargo->group_id){
                    
                    if(!in_array($cargo->group_id, $groupsArr)){
                        $groupsArr[] = $cargo->group_id;
                        $group = $wpdb->get_row("SELECT title, chs FROM " . $wpdb->prefix . "cargo_groups WHERE id = $cargo->group_id");

                        $outClass = 'select__option';
                        if($group->chs) $outClass .= ' chs';
                                    
                        $output .= '<button class="' . $outClass . '" data-value="' . $group->title . '" data-chs="' . $group->chs . '" type="button">' . $group->title . '</button>';
                        
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
