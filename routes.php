<?php
/*
    Template Name: Routes

*/

get_header();
the_post();
$fieldsArr = get_fields();

?>

            <?php custom_breadcrumbs();?>
            
<?php

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>