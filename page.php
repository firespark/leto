<?php

get_header();
the_post();

$fieldsArr = get_fields();

?>
	<?php custom_breadcrumbs();?>
    <section class="routes-s">
        <div class="routes-s__container">
            
            <div class="routes-s__body page_content">
                <h1><?php the_title();?></h1>
                <?php the_content();?>
            </div>
        </div>
    </section>

<?php

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>