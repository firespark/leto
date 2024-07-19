<?php
/*
    Template Name: Transportation

*/

get_header();
the_post();
$fieldsArr = get_fields();

?>

            <?php custom_breadcrumbs();?>
            <section class="category transp">
                <div class="category__container">
                    <h1 class="category__title title-s"><?php the_title();?></h1>
                    <div class="category__body">
                        <div class="category__top">
                            <div class="category__left-ibg">
                                <?php if(!empty($fieldsArr['transp_img'])):?>
                                <img src="<?php echo $fieldsArr['transp_img']['url'];?>" alt="<?php echo $fieldsArr['transp_img']['alt'];?>">
                                <?php endif;?>
                            </div>
                            <div class="category__right">
                                <div class="category__righttext">
                                    <?php the_content();?>
                                </div>
                                <?php if($fieldsArr['transp_button_show']):?>
                                <a href="<?php echo $fieldsArr['transp_button_url'] . get_utm_double_uri_custom();?>" class="category__rightbutton calc-button">
                                    <span><?php echo $fieldsArr['transp_button_text'];?></span>
                                    <img src="<?php echo get_template_directory_uri();?>/img/arrow-r.png" alt="">
                                </a>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="route-bottom">
                            <div data-tabs class="route-bottom">
                                <nav data-tabs-titles class="route-bottom__navigation">
                                    <button type="button" class="route-bottom__title _tab-active">1,5 т</button>
                                    <button type="button" class="route-bottom__title">3 т</button>
                                    <button type="button" class="route-bottom__title">5 т</button>
                                    <button type="button" class="route-bottom__title">10 т</button>
                                    <button type="button" class="route-bottom__title">20 т</button>
                                </nav>
                                <div data-tabs-body class="route-bottom__content">
                                    <?php 
                                    show_route_attrs(
                                        $fieldsArr['route_tonn_1_5']['tent'],
                                        $fieldsArr['route_tonn_1_5']['van'],
                                        $fieldsArr['route_tonn_1_5']['isoterma'],
                                        $fieldsArr['route_tonn_1_5']['refrigerator'],
                                    );
                                    show_route_attrs(
                                        $fieldsArr['route_tonn_3']['tent'],
                                        $fieldsArr['route_tonn_3']['van'],
                                        $fieldsArr['route_tonn_3']['isoterma'],
                                        $fieldsArr['route_tonn_3']['refrigerator'],
                                    );
                                    show_route_attrs(
                                        $fieldsArr['route_tonn_5']['tent'],
                                        $fieldsArr['route_tonn_5']['van'],
                                        $fieldsArr['route_tonn_5']['isoterma'],
                                        $fieldsArr['route_tonn_5']['refrigerator'],
                                    );
                                    show_route_attrs(
                                        $fieldsArr['route_tonn_10']['tent'],
                                        $fieldsArr['route_tonn_10']['van'],
                                        $fieldsArr['route_tonn_10']['isoterma'],
                                        $fieldsArr['route_tonn_10']['refrigerator'],
                                    );
                                    show_route_attrs(
                                        $fieldsArr['route_tonn_20']['tent'],
                                        $fieldsArr['route_tonn_20']['van'],
                                        $fieldsArr['route_tonn_20']['isoterma'],
                                        $fieldsArr['route_tonn_20']['refrigerator'],
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
<?php

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>