<?php

header('Content-type: text/html; charset=UTF-8');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
require_once(ABSPATH . 'wp-admin/includes/taxonomy.php');

$csv_file = $_SERVER['DOCUMENT_ROOT'] . '/csv/3.csv';

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
	$banned = (trim($newArr[3])) ? 1 : 0;
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

	$insert_data = [
		'title' => $title,
		'cat_id' => $cat_id,
		'group_id' => $group_id,
		'chs' => $banned,
	];

	$wpdb->insert($wpdb->prefix . "cargos", $insert_data);

}

