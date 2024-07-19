<?php
/*
    Template Name: About

*/

get_header();
the_post();
$fieldsArr = get_fields();

?>

            <?php custom_breadcrumbs();?>
            <section class="about">
                <div class="about__container">
                    <h1 class="about__title title-s"><?php the_title();?></h1>
                    <div class="about__body">
                        <div class="about-top">
                            <div class="about-top__left-ibg">
                                <img src="<?php echo get_template_directory_uri();?>/img/logo-s.svg" alt="">
                            </div>
                            <div class="about-top__right">
                                <?php the_content();?>
                            </div>
                        </div>
                        <div class="about-bottom">
                            <div class="about-bottom__left"><?php echo $fieldsArr['about_economics_title'];?></div>
                            <div class="about-bottom__right">
                                <?php if(!empty($fieldsArr['about_economics'])):?>
                                <?php foreach($fieldsArr['about_economics'] as $item):?>
                                <div class="about-bottom__row"><a href="<?php echo $item['url'] . get_utm_double_uri_custom();?>"><?php echo $item['item'];?></a>
                                </div>
                                <?php endforeach;?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="about-1">
                <div class="about-1__container">
                    <h2 class="about-1__title title">
                        <?php add_yellow_arrow($fieldsArr['about_routes_title']);?>
                        <!--<span>Что мы чаще <br></span>
                        <span class="title-decor _icon-arrow-r-d">
                            перевозим</span>-->
                    </h2>
                    <div class="about-1__body">
                        <div class="about-1__image-ibg">
                            <?php if($fieldsArr['aboute_routes_image1']):?>
                            <img class="about-1__image-b" src="<?php echo $fieldsArr['aboute_routes_image1']['url'];?>" alt="<?php echo $fieldsArr['aboute_routes_image1']['alt'];?>">
                            <?php endif;?>
                            <?php if($fieldsArr['aboute_routes_image1_mobile']):?>
                            <img class="about-1__image-s" src="<?php echo $fieldsArr['aboute_routes_image1_mobile']['url'];?>" alt="<?php echo $fieldsArr['aboute_routes_image1_mobile']['alt'];?>">
                            <?php endif;?>
                        </div>
                        <div class="about-1__text">
                            <?php echo $fieldsArr['about_routes_text'];?>
                        </div>
                        <div class="about-2__image-ibg">
                            <?php if($fieldsArr['about_routes_image2']):?>
                            <img src="<?php echo $fieldsArr['about_routes_image2']['url'];?>" alt="<?php echo $fieldsArr['about_routes_image2']['alt'];?>">
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </section>
            <section class="about-3">
                <div class="about-3__container">
                    <h2 class="about-3__title title">
                        <?php add_yellow_arrow($fieldsArr['about_transport_title']);?>
                    </h2>
                    <div class="about-3__body">
                        <div class="about-3__image-ibg">
                            <?php if($fieldsArr['about_transport_image']):?>
                            <img class="about-3__image-b" src="<?php echo $fieldsArr['about_transport_image']['url'];?>" alt="<?php echo $fieldsArr['about_transport_image']['alt'];?>">
                            <?php endif;?>
                            <?php if($fieldsArr['about_transport_image_mobile']):?>
                            <img class="about-3__image-s" src="<?php echo $fieldsArr['about_transport_image_mobile']['url'];?>" alt="<?php echo $fieldsArr['about_transport_image_mobile']['alt'];?>">
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </section>

<?php

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>