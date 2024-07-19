<?php
/*
    Template Name: Services Page

*/

get_header();
the_post();
$fieldsArr = get_fields();

?>

            <?php custom_breadcrumbs();?>
            <section class="solutions">
                <div class="solutions__container">
                    <h1 class="solutions__title title"><?php the_title();?></h1>
                    <div class="solutions__body solutions__body-reverce">
                        <div class="solutions__item">
                            <a href="<?php echo get_the_permalink(104) . get_utm_double_uri_custom();?>" class="solutions-s__item item-solutions-s">
                                <div class="item-solutions-s__name mw-200"><?php echo get_the_title(104);?></div>
                                <div class="item-solutions-s__bottom _icon-arrow-r-d">
                                </div>
                            </a>
                        </div>
                        <div class="solutions__item">
                            <a href="<?php echo get_the_permalink(107) . get_utm_double_uri_custom();?>" class="solutions-s__item item-solutions-s">
                                <div class="item-solutions-s__name mw-150"><?php echo get_the_title(107);?></div>
                                <div class="item-solutions-s__bottom _icon-arrow-r-d">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            

<?php

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>