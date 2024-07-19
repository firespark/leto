<?php

get_header();
the_post();

$fieldsArr = get_fields();
?>
	        <?php 
            $breadcrumbs_args = [['url' => get_the_permalink(118), 'title' => get_the_title(118)]];
            custom_breadcrumbs($breadcrumbs_args);
            ?>
            <section class="case">
                <div class="case__container">
                    <h1 class="case__title title-s"><?php the_title();?></h1>
                    <div class="case__body">
                        <div class="case-top">
                            <div class="case-top__left">
                                <div class="case-top__slider swiper">
                                    <div class="case-top__wrapper swiper-wrapper">
                                        <?php if(!empty($fieldsArr['case_image'])):?>
                                        <div class="case-top__slide-ibg swiper-slide">
                                            <img src="<?php echo $fieldsArr['case_image']['url'];?>" alt="<?php echo $fieldsArr['case_image']['alt'];?>">
                                        </div>
                                        <?php endif;?>
                                        <?php if(!empty($fieldsArr['case_extra_images'])):?>
                                        <?php foreach($fieldsArr['case_extra_images'] as $extra_image):?>
                                        <div class="case-top__slide-ibg swiper-slide">
                                            <img src="<?php echo $extra_image['url'];?>" alt="<?php echo $extra_image['alt'];?>">
                                        </div>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                        
                                    </div>
                                    <?php if(!empty($fieldsArr['case_extra_images'])):?>
                                    <div class="case-top__navigation">
                                        <button type="button"
                                            class="case-top__swiper-button-prev cases-s__swiper-button swiper-button-prev _icon-arrow-d"
                                            aria-label="Slider prev button"></button>
                                        <button type="button"
                                            class="case-top__swiper-button-next cases-s__swiper-button swiper-button-next _icon-arrow-d"
                                            aria-label="Slider next button"></button>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="case-top__right">
                                <div class="case-top__top">
                                    <?php if($fieldsArr['case_what']):?>
                                    <div class="case-top__block">
                                        <div class="case-top__name _icon-drob-1">Что перевозили?</div>
                                        <div class="case-top__text"><?php echo $fieldsArr['case_what'];?></div>
                                    </div>
                                    <?php endif;?>
                                    <?php if($fieldsArr['case_transport']):?>
                                    <div class="case-top__block">
                                        <div class="case-top__name _icon-drob-2">На чём перевозили?</div>
                                        <div class="case-top__text"><?php echo $fieldsArr['case_transport'];?></div>
                                    </div>
                                    <?php endif;?>
                                    <?php if($fieldsArr['case_what']):?>
                                    <div class="case-top__block">
                                        <div class="case-top__name _icon-drob-3">Маршрут</div>
                                        <div class="case-top__text"><?php echo $fieldsArr['case_route'];?></div>
                                    </div>
                                    <?php endif;?>
                                    <?php if($fieldsArr['case_route']):?>
                                    <div class="case-top__block">
                                        <div class="case-top__name _icon-drob-4">Дата перевозки</div>
                                        <div class="case-top__text"><?php echo $fieldsArr['case_date'];?></div>
                                    </div>
                                    <?php endif;?>
                                </div>
                                
                                <?php if($fieldsArr['case_button_show']):?>
                                <a href="<?php echo $fieldsArr['case_button_url'] . get_utm_double_uri_custom();?>" class="case-top__button calc-button">
                                    <span><?php echo $fieldsArr['case_button_text'];?></span>
                                    <img src="<?php echo get_template_directory_uri();?>/img/arrow-r.png" alt="">
                                </a>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="case-bottom">
                            <div class="case-bottom__numbers">
                                <?php if($fieldsArr['case_time']):?>
                                <div class="case-bottom__number">
                                    <div class="case-bottom__numbercount"><?php echo $fieldsArr['case_time'];?></div>
                                    <div class="case-bottom__numbertext">Время в пути</div>
                                </div>
                                <?php endif;?>
                                <?php if($fieldsArr['case_distance']):?>
                                <div class="case-bottom__number">
                                    <div class="case-bottom__numbercount"><?php echo $fieldsArr['case_distance'];?></div>
                                    <div class="case-bottom__numbertext">Расстояние</div>
                                </div>
                                <?php endif;?>
                                <?php if($fieldsArr['case_weight']):?>
                                <div class="case-bottom__number">
                                    <div class="case-bottom__numbercount"><?php echo $fieldsArr['case_weight'];?></div>
                                    <div class="case-bottom__numbertext">Вес груза</div>
                                </div>
                                <?php endif;?>
                            </div>
                            <div class="case-bottom__info">
                                <div class="case-bottom__title title-s"><?php echo $fieldsArr['case_content_title'];?></div>
                                <div class="case-bottom__content page_content">
                                    <?php the_content();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php 
            include __DIR__ . '/modules/otraslevye-reshenija.php';
            ?>

<?php

get_footer();

?>