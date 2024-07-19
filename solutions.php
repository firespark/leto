<?php
/*
    Template Name: Solutions

*/

get_header();
the_post();
$fieldsArr = get_fields();

$solutions = get_posts([
    'post_type' => 'solutions',
    'numberposts' => -1
]);

?>

            <?php custom_breadcrumbs();?>
            <section class="solutions">
                <div class="solutions__container">
                    <h1 class="solutions__title title"><?php the_title();?></h1>
                    <div class="solutions__body">
                        <?php if(!empty($solutions)):?>
                        <?php foreach($solutions as $solution):?>
                        <?php $solutionFields = get_fields($solution->ID);?>
                        <div class="solutions__item">
                            <a href="<?php echo get_the_permalink($solution->ID) . get_utm_double_uri_custom();?>" class="solutions-s__item item-solutions-s">
                                <div class="item-solutions-s__name"><?php echo $solutionFields['solution_subtitle'];?></div>
                                <div class="item-solutions-s__text"><?php echo $solutionFields['solution_description'];?></div>
                                <div class="item-solutions-s__bottom _icon-arrow-r-d">
                                    <div class="item-solutions-s__type"><?php echo $solution->post_title;?></div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach;?>
                        <?php endif;?>
                        <div class="solutions__item solutions-s__item item-solutions-s">
                            <div class="solutions__item-ibg">
                                <?php if(!empty($fieldsArr['solutions_image'])):?>
                                <img src="<?php echo $fieldsArr['solutions_image']['url'];?>" alt="<?php echo $fieldsArr['solutions_image']['alt'];?>">
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
<?php

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>