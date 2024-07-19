<?php

// Задать вопрос

header('Content-type: text/html; charset=UTF-8');

require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');


if(!empty($_POST)) {

    $output = '';

    $phrase = get_safe_post($_POST['phrase']);
  

    if($phrase){
        
        $data = array(
            'query' => $phrase,
            //'count' => 20,

        );
         
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);

        $ch = curl_init("https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/party");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Token " . $optionsArr['dadata_api_key'],
            "X-Secret: " . $optionsArr['dadata_secret_key'],
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);    
        $res = curl_exec($ch);
        curl_close($ch);    
            
        $responseData = json_decode($res, true);
        

        if(!empty($responseData['suggestions'])){
            $output .= '<div class="select__scroll">';

            foreach($responseData['suggestions'] as $suggestion){
                
                if(!$suggestion['data']['inn']) continue;
                
                $output .= '<button class="select__option" data-value="' . $suggestion['data']['inn'] . '" data-company="' . htmlspecialchars($suggestion['value']) . '" type="button">' . $suggestion['value'] . ' - ' . $suggestion['data']['inn'] . '</button>';
                
                
            }
            $output .= '</div>';
          
        }
    }
    echo $output;
}

die();

?>
