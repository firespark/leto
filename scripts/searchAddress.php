<?php

// Задать вопрос

header('Content-type: text/html; charset=UTF-8');

require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');


$exclude_settlement_types = ['тер', 'зона', 'снт', 'тер. ДПК', 'кв-л'];


if(!empty($_POST)) {

    $output = '';

    $phrase = mb_strtolower(get_safe_post($_POST['phrase']));
  

    if($phrase){

        //$localCities = get_field('calc_cities', 41);

        $responseData = search_dadata_address($phrase);
        

        //if(!empty($localCities) || !empty($responseData['suggestions'])){
        if(!empty($responseData['suggestions'])){
            $output .= '<div class="select__scroll">';

            /*foreach($localCities as $city) {
                if (strpos(mb_strtolower($city['city']), $phrase) !== false){
                    $output .= '<button class="select__option" 
                        data-value="' . $city['city'] . '" 
                        data-city="' . $city['city'] . '" 
                        data-fias="0" 
                        data-fiasId="" 
                        data-fiasRegion="" 
                        data-lat="" 
                        data-long="" 
                    type="button">' . $city['city'] . '</button>';
                }
            }*/

            foreach($responseData['suggestions'] as $suggestion){

                if (in_array($suggestion['data']['settlement_type'], $exclude_settlement_types)) continue;
                
                /*
                if($suggestion['data']['city'] == 'Москва' || $suggestion['data']['city'] == 'Санкт-Петербург'){
                    $city = $suggestion['data']['city'] . ' (' . $suggestion['data']['region_type_full'] . ' ' . $suggestion['data']['region'] . ')';
                }
                else {
                    $city = $suggestion['data']['city'] . ' (' . $suggestion['data']['region'] . ' ' . $suggestion['data']['region_type_full'] . ')';
                }
                */

                $city   = '';
                $region = '';
                if ($suggestion['data']['street'] == null && $suggestion['data']['geo_lat'] != null) {
                    if ($suggestion['data']['settlement'] == null || $suggestion['data']['settlement'] == "") {
                        if ($suggestion['data']['city'] != null) {
                            $city   = $suggestion['data']['city'];
                        } else {
                            $city = $suggestion['data']['area_with_type'];
                        }
                    } else {
                        $city   = $suggestion['data']['settlement'];
                    }

                    if ($suggestion['data']['region'] == "Москва" || $suggestion['data']['region'] == "Санкт-Петербург") {
                        $region     = $suggestion['data']['region_type_full'] . " " . $suggestion['data']['region'];
                    } else {
                        $region     = $suggestion['data']['region'] . " " . $suggestion['data']['region_type_full'];
                        if ( $suggestion['data']['city'] != null && $city != $suggestion['data']['city']) {
                            $region     = trim($suggestion['data']['region'] . " " . $suggestion['data']['region_type_full'] . ", " . $suggestion['data']['city']);
                        } else {
                            $region     = trim($suggestion['data']['region'] . " " . $suggestion['data']['region_type_full'] . " " . $suggestion['data']['area'] . " " . $suggestion['data']['area_type_full']);
                        }
                    }
                    $city = $city . ' (' . $region . ')';
                }

                if ($city) {
                    $fias = $suggestion['data']['settlement_fias_id'] ?? $suggestion['data']['city_fias_id'];
                
                    $output .= '<button class="select__option" 
                        data-value="' . $suggestion['value'] . '" 
                        data-city="' . $city . '" 
                        data-fias="' . $fias . '" 
                        data-fiasid="' . $suggestion['data']['fias_id'] . '" 
                        data-fiasregion="' . $suggestion['data']['region_fias_id'] . '" 
                        data-lat="' . $suggestion['data']['geo_lat'] . '" 
                        data-long="' . $suggestion['data']['geo_lon'] . '" 
                    type="button">' . $suggestion['value'] . '</button>';
                }


                
                
                
            }
            $output .= '</div>';
          
        }
    }
    echo $output;
}

die();

?>
