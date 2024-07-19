<?php
$moduleOptions = get_module_options('marshruty-i-tarify');
$routes = get_posts([
    'post_type' => 'routes',
    'numberposts' => -1
]);

$field1 = get_field_object('field_64b59acec970b');
$field2 = get_field_object('field_64b59c94a113c');
$field3 = get_field_object('field_64b59ca3a1152');
$field4 = get_field_object('field_64b59f6aaa68d');
$field5 = get_field_object('field_64b59f9e16e20');
?>
            <section class="routes-s index-routes-s">
                <div class="routes-s__container">
                    <h2 class="routes-s__title title">
                        <?php add_yellow_arrow($moduleOptions['routes_title']);?>
                        
                    </h2>
                    <?php if(!empty($routes)):?>
                    <div class="routes-s__body">
                        <div class="routes-s__top">
                            <div class="routes-s__list">
                                <div class="routes-s__row">
                                    <div class="routes-s__city" id="routeCityTitle"><?php echo $moduleOptions['routes_table_city'];?></div>
                                    <div class="routes-s__price"><?php echo $field1['label'];?></div>
                                    <div class="routes-s__price"><?php echo $field2['label'];?></div>
                                    <div class="routes-s__price"><?php echo $field3['label'];?></div>
                                    <div class="routes-s__price"><?php echo $field4['label'];?></div>
                                    <div class="routes-s__price"><?php echo $field5['label'];?></div>
                                </div>
                            </div>
                        </div>
                        <div class="routes-s__selectcont">
                            <select name="form[]" data-class-modif="routes-s">
                                <option value="">Выберите категорию груза </option>
                            </select>
                        </div>
                        <div class="routes-s__slider routes-s__slider-s swiper">
                            <nav data-tabs-titles="00" class="routes-s-tabs__navigation">
                            </nav>
                            <div data-tabs-body class="routes-s__wrapper swiper-wrapper routes-s__bottom">
                                <?php foreach($routes as $route):?>
                                <?php 
                                $routeArr = get_fields($route->ID);
                                $routeUrl = get_the_permalink($route->ID);
                                ?>
                                <div class="routes-s__slide swiper-slide routes-s__list">
                                    <a href="<?php echo $routeUrl . get_utm_double_uri_custom();?>" class="routes-s__row">
                                        <div class="routes-s__city"><?php echo $routeArr['route_city_to'];?></div>
                                        <div class="routes-s__price"><span class="routes-s__price-first">1,5 тонн</span><?php echo $routeArr['route_tonn_1_5']['price'];?>
                                        </div>
                                        <div class="routes-s__price"><span class="routes-s__price-first">3 тонн</span><?php echo $routeArr['route_tonn_3']['price'];?>
                                        </div>
                                        <div class="routes-s__price"><span class="routes-s__price-first">5 тонн</span><?php echo $routeArr['route_tonn_5']['price'];?>
                                        </div>
                                        <div class="routes-s__price"><span class="routes-s__price-first">10 тонн</span><?php echo $routeArr['route_tonn_10']['price'];?>
                                        </div>
                                        <div class="routes-s__price"><span class="routes-s__price-first">20 тонн</span><?php echo $routeArr['route_tonn_20']['price'];?>
                                        </div>
                                    </a>
                                    <a href="<?php echo $routeUrl . get_utm_double_uri_custom();?>" class="routes-s__link">Подробнее</a>
                                </div>
                                <?php endforeach;?>
                            </div>
                            <div class="routes-s__slider-scrollbar"></div>
                        </div>
                        <div class="routes-s__info"><?php echo $moduleOptions['routes_extra_text'];?></div>
                    </div>
                    <?php endif;?>
                </div>
            </section>