<?php
$moduleOptions = get_module_options('otraslevye-reshenija');
?>
<?php if(!empty($moduleOptions['solutions'])):?>
            <section class="solutions-s">
                <div class="solutions-s__container">
                    <h2 class="solutions-s__title title">
                        <?php add_yellow_arrow($moduleOptions['solutions_title']);?>
                    </h2>
                    <div class="solutions-s__subtitle"><?php echo $moduleOptions['solutions_description'];?></div>
                    <div class="solutions-s__body">
                        <div class="solutions-s__slider swiper">
                            <div class="solutions-s__wrapper swiper-wrapper">
                                <?php foreach($moduleOptions['solutions'] as $solution):?>

                                <?php $solutionFields = get_fields($solution->ID);?>

                                <div class="solutions-s__slide swiper-slide">
                                    <a href="<?php echo get_the_permalink($solution->ID) . get_utm_double_uri_custom();?>" class="solutions-s__item item-solutions-s">
                                        <div class="item-solutions-s__name"><?php echo $solutionFields['solution_subtitle'];?></div>
                                        <div class="item-solutions-s__text"><?php echo $solutionFields['solution_description'];?></div>
                                        <div class="item-solutions-s__bottom _icon-arrow-r-d">
                                            <div class="item-solutions-s__type"><?php echo $solution->post_title;?></div>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach;?>
                            </div>
                            <div class="solutions-s__pagination"></div>
                        </div>
                        <div class="solutions-s__section-bottom section-bottom">
                            <?php if($moduleOptions['solutions_more_button_text']):?>
                            <a href="<?php echo get_the_permalink(109) . get_utm_double_uri_custom();?>" class="section-bottom__link _icon-arrow-r-d"><?php echo $moduleOptions['solutions_more_button_text'];?></a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </section>
<?php endif;?>