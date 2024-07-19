<?php
/*
    Template Name: Insurance

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
                                <?php if(!empty($fieldsArr['insurance_img'])):?>
                                <img src="<?php echo $fieldsArr['insurance_img']['url'];?>" alt="<?php echo $fieldsArr['insurance_img']['alt'];?>">
                                <?php endif;?>
                            </div>
                            <div class="category__right">
                                <div class="category__righttext">
                                    <?php the_content();?>
                                </div>
                                <?php if($fieldsArr['insurance_button_show']):?>
                                <a href="<?php echo $fieldsArr['insurance_button_url'] . get_utm_double_uri_custom();?>" class="category__rightbutton calc-button">
                                    <span><?php echo $fieldsArr['insurance_button_text'];?></span>
                                    <img src="<?php echo get_template_directory_uri();?>/img/arrow-r.png" alt="">
                                </a>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="insurance-bottom">
                            <div class="insurance-bottom__body">
                                <div class="insurance-bottom__info">
                                    <?php echo $fieldsArr['insurance_description'];?>
                                </div>
                                <?php if(!empty($fieldsArr['insurances'])):?>
                                <div class="insurance-bottom__content">
                                    <div class="insurance-bottom__top">
                                        <div class="insurance-bottom__column">Стоимость груза</div>
                                        <div class="insurance-bottom__column">Страховая ставка</div>
                                        <div class="insurance-bottom__column">Стоимость страховки</div>
                                        <div class="insurance-bottom__column">Примечание</div>
                                    </div>
                                    <?php foreach($fieldsArr['insurances'] as $cell):?>
                                    <div class="insurance-bottom__row">
                                        <div class="insurance-bottom__column"><?php echo $cell['cost'];?><span>Стоимость груза</span></div>
                                        <div class="insurance-bottom__column"><?php echo $cell['coef'];?><span>Страховая ставка</span></div>
                                        <div class="insurance-bottom__column"><?php echo $cell['price'];?><span>Стоимость страховки</span></div>
                                        <div class="insurance-bottom__column"><sup>*</sup><span><?php echo $cell['extra'];?></span></div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
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