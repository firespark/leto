<?php

// Задать вопрос

header('Content-type: text/html; charset=UTF-8');
 
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

$success = false;
$output = 'Что-то пошло не так. Пожалуйста, сообщите администратору сайта об этой проблеме.';

if(!empty($_FILES)) {

  
    $extensions = array("csv"); // file extensions to be checked
   
    $file_extension_check = strtolower(pathinfo($_FILES['uploadFiles']['name'], PATHINFO_EXTENSION));

    
    if($_FILES['uploadFiles']['size'] > 2097152){
        $output = 'Максимальный размер файла - 2 Мб';
    }
    else if (!empty($_FILES) && (!in_array($file_extension_check, $extensions)) ){
        $output = 'Допускаются только форматы .csv';
    }
    
    else{

        $fileName = '';

        if(is_uploaded_file($_FILES['uploadFiles']['tmp_name'])) {

            $sourcePath = $_FILES['uploadFiles']['tmp_name'];
            $targetPath = "../import/1.csv";
            if(move_uploaded_file($sourcePath,$targetPath)) {
                
                $csv_file = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/leto/admin/import/1.csv';

                if (($open = fopen($csv_file, "r")) !== false) {
                    while (($data = fgetcsv($open, 1000, ",")) !== false) {
                        $array[] = implode(', ', $data);
                    }
                 
                    fclose($open);
                }

                foreach ($array as $key => $str) {
                    if($key == 0) continue;
                    //if($key == 10) break;

                    $newArr = explode(';', $str);

                    $title = trim($newArr[0]);
                    $cat = trim($newArr[1]); 
                    $group = trim($newArr[2]); 
                    //$banned = (trim($newArr[3])) ? 1 : 0;
                    $cat_id = 0;
                    $group_id = 0;

                    if(!$cat) continue;

                    $cat_id = $wpdb->get_var("SELECT id FROM " . $wpdb->prefix . "cargo_cats WHERE title = '" . $cat . "'");

                    if(!isset($cat_id)){
                        $wpdb->insert($wpdb->prefix . "cargo_cats", ['title' => $cat]);
                        $cat_id = $wpdb->insert_id;
                    }


                    if($group){

                        $group_id = $wpdb->get_var("SELECT id FROM " . $wpdb->prefix . "cargo_groups WHERE title = '" . $group . "'");

                        if(!isset($group_id)){
                            $insert_data['title'] = $group;
                            $insert_data['cat_id'] = $cat_id;
                            $wpdb->insert($wpdb->prefix . "cargo_groups", ['title' => $group, 'cat_id' => $cat_id]);
                            $group_id = $wpdb->insert_id;
                        }
                        
                    }

                    if($title && $cat_id) {

                        $insert_data = [
                            'title' => $title,
                            'cat_id' => $cat_id,
                            'group_id' => $group_id,
                            //'chs' => $banned,
                        ];

                        $wpdb->insert($wpdb->prefix . "cargos", $insert_data);
                    }

                }

                unlink($csv_file);

                $success = true;
                $output = 'Импорт успешно завершен.';


            }
        }

    }
   
        
}

echo json_encode(array('success' => $success, 'output' => $output));  

die();
 
?>