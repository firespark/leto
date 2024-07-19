<?php
/*
    Template Name: Services

*/

get_header();
the_post();
$fieldsArr = get_fields();

$services = get_posts(['numberposts' => -1]);

?>

            <?php custom_breadcrumbs();?>
            <section class="categorys">
                <div class="categorys__container">
                    <div class="what__top">
                        <h1 class="what__title title"><?php the_title();?></h1>
                        <div class="what__subtitle"><?php echo $fieldsArr['services_short_description'];?></div>
                    </div>
                    <div class="categorys__body">
                        <?php if(!empty($services)):?>
                        <div data-tabs class="categorys-tabs">
                            <nav data-tabs-titles class="categorys-tabs__navigation">
                                <?php foreach($services as $key => $service):?>
                                <?php 
                                $serviceArr = get_fields($service->ID);
                                $serviceImg = (!empty($serviceArr['service_image_board'])) ? $serviceArr['service_image_board'] : $serviceArr['service_image'];
                                ?>
                                <a href="<?php echo get_the_permalink($service->ID) . get_utm_double_uri_custom();?>" class="categorys-tabs__title<?php if($key == 0) echo ' _tab-active';?>">
                                    <?php if(isset($serviceImg['url'])):?>
                                    <img src="<?php echo $serviceImg['url'];?>" alt="<?php echo $serviceImg['alt'];?>">
                                    <?php endif;?>
                                    <span><?php echo $service->post_title;?></span>
                                </a>
                                <?php endforeach;?>
                            </nav>
                            <div data-tabs-body class="what-tabs__content">
                                <?php foreach($services as $service):?>
                                <?php $service_subcats = get_field('service_subcats', $service->ID);?>
                                <div class="what-tabs__body">
                                    <div class="what-tabs__type"><?php echo $service->post_title;?></div>
                                    <div class="what-tabs__list">
                                        <?php if(!empty($service_subcats)):?>
                                        <?php foreach($service_subcats as $subcat):?>
                                        <span class="what-tabs__name"><?php echo $subcat['subcat'];?></span>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    <?php endif;?>
                    </div>
                </div>
            </section>
            

<?php

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>