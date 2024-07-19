<?php
/*
    Template Name: Main

*/

get_header();
the_post();
$fieldsArr = get_fields();

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>