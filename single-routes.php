<?php

get_header();
the_post();

$fieldsArr = get_fields();

?>
	        <?php 
            $breadcrumbs_args = [['url' => get_the_permalink(100), 'title' => get_the_title(100)]];
            custom_breadcrumbs($breadcrumbs_args);
            ?>
            <section class="route">
                <div class="route__container">
                    <h1 class="route__title title-s"><?php the_title();?></h1>
                    <div class="route__body">
                        <div class="route-top">
                            <div class="route-top__left">
                                <?php if($fieldsArr['route_duration']):?>
                                <div class="route-top__block _icon-drob-1">
                                    <div class="route-top__blockname">Время в пути</div>
                                    <div class="route-top__blocktext"><?php echo $fieldsArr['route_duration'];?></div>
                                </div>
                                <?php endif;?>
                                <?php if($fieldsArr['route_distance']):?>
                                <div class="route-top__block">
                                    <div class="route-top__blockimage"></div>
                                    <div class="route-top__blockname">Расстояние</div>
                                    <div class="route-top__blocktext"><?php echo $fieldsArr['route_distance'];?></div>
                                </div>
                                <?php endif;?>
                            </div>
                            <div class="route-top__right">
                                <div class="route-top__text page_content">
                                    <?php the_content();?>
                                </div>
                                <?php if($fieldsArr['route_button_show']):?>
                                <a href="<?php echo $fieldsArr['route_button_url'] . get_utm_double_uri_custom();?>" class="route-top__button calc-button">
                                    <span><?php echo $fieldsArr['route_button_text'];?></span>
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
            include __DIR__ . '/modules/kejsy.php';
            ?>

<?php

get_footer();

?>