<?php
$moduleOptions = get_module_options('kejsy');
$cases = get_posts([
    'post_type' => 'cases',
    'numberposts' => $moduleOptions['cases_number'],
]);
?>
<?php if(!empty($cases)):?>
            <section class="cases-s">
                <div class="cases-s__container">
                    <div class="cases-s__top">
                        <h2 class="cases-s__title title"><?php add_yellow_arrow($moduleOptions['cases_title']);?></h2>
                        <div class="cases-s__navigation">
                            <button type="button"
                                class="cases-s__swiper-button-prev cases-s__swiper-button swiper-button-prev _icon-arrow-d"
                                aria-label="Slider prev button"></button>
                            <button type="button"
                                class="cases-s__swiper-button-next cases-s__swiper-button swiper-button-next _icon-arrow-d"
                                aria-label="Slider next button"></button>
                        </div>
                    </div>
                    <div class="cases-s__body">
                        <div class="cases-s__slider swiper">
                            <div class="cases-s__wrapper swiper-wrapper">
                                <?php foreach($cases as $case):?>
                                <?php $caseFields = get_fields($case->ID);?>
                                <a href="<?php echo get_the_permalink($case->ID) . get_utm_double_uri_custom();?>" class="cases-s__slide swiper-slide">
                                    <div class="cases-s__image-ibg">
                                        <img src="<?php echo $caseFields['case_image']['url'];?>" alt="<?php echo $caseFields['case_image']['alt'];?>">
                                        <div class="cases-s__obor"><?php echo $caseFields['case_category'];?></div>
                                    </div>
                                    <div class="cases-s__name"><?php echo $case->post_title;?></div>
                                    <div class="cases-s__text"><?php echo $caseFields['case_description'];?></div>
                                    <div class="cases-s__location"><span>Маршрут: </span><?php echo $caseFields['case_route'];?></div>
                                </a>
                                <?php endforeach;?>
                            </div>
                        </div>
                        <div class="cases-s__pagination"></div>
                        <div class="cases-s__section-bottom section-bottom">
                            <?php if($moduleOptions['cases_more_button_text']):?>
                            <a href="<?php echo get_the_permalink(118) . get_utm_double_uri_custom();?>" class="section-bottom__link _icon-arrow-r-d"><?php echo $moduleOptions['cases_more_button_text'];?></a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </section>
<?php endif;?>