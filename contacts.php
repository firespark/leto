<?php
/*
    Template Name: Contacts

*/

get_header();
the_post();
$fieldsArr = get_fields();
?>

            <?php custom_breadcrumbs();?>
            <div class="contacts">
                <div class="map__body">
                    <div class="map__cont" id="map">
                        <script
                            src="https://api-maps.yandex.ru/2.1/?apikey=2f6f4515-c5de-4c26-846a-10bdf30fe3b6&lang=ru_RU&_v=20230515095652"
                            type="text/javascript"></script>
                    </div>
                </div>
                <div class="contacts__container">
                    <div class="contacts__body">
                        <div class="contacts__top">
                            <div class="contacts__block _icon-phone">
                                <a href="tel:+<?php echo get_numbers_from_str($optionsArr['main_phone']);?>" class="contacts__blocktop"><?php echo $optionsArr['main_phone'];?></a>
                                <div class="contacts__blockbottom">Телефон</div>
                            </div>
                            <div class="contacts__block _icon-mail">
                                <a href="mailto:<?php echo $optionsArr['main_email'];?>" class="contacts__blocktop"><?php echo $optionsArr['main_email'];?></a>
                                <div class="contacts__blockbottom">Email</div>
                            </div>
                            <div class="contacts__block _icon-location">
                                <?php if($optionsArr['main_address']):?>
                                <div class="contacts__blocktop">
                                    <?php echo $optionsArr['main_address'];?>
                                </div>
                                <?php endif;?>
                                <?php if($optionsArr['main_timetable']):?>
                                <div class="contacts__blockbottom">
                                    <?php echo $optionsArr['main_timetable'];?>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="contacts__socs">
                            <?php if($optionsArr['main_vk']):?>
                            <a href="<?php echo $optionsArr['main_vk'];?>" class="contacts__soc _icon-vk" aria-label="VK Link" target="_blank"></a>
                            <?php endif;?>
                            <?php if($optionsArr['main_tg']):?>
                            <a href="<?php echo $optionsArr['main_tg'];?>" class="contacts__soc _icon-telegram" aria-label="VK Telegram" target="_blank"></a>
                            <?php endif;?>
                        </div>
                        <?php if($fieldsArr['contacts_button_show']):?>
                                <a href="<?php echo $fieldsArr['contacts_button_url'] . get_utm_double_uri_custom();?>" class="category__rightbutton calc-button">
                                    <span><?php echo $fieldsArr['contacts_button_text'];?></span>
                                    <img src="<?php echo get_template_directory_uri();?>/img/arrow-r.png" alt="">
                                </a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <section class="details">
                <div class="details__container">
                    <h1 class="details__title title"><?php add_yellow_arrow($fieldsArr['contacts_requisits_title']);?></h1>
                    <div class="details__body">
                        <div class="details__left">
                            <?php if($fieldsArr['contacts_file1']):?>
                            <?php $file_check_ext1 = wp_check_filetype($fieldsArr['contacts_file1']['url']);?>
                            <div class="details__itemcont">
                                <a target="_blank" class="details__item"
                                    href="<?php echo $fieldsArr['contacts_file1']['url'];?>">
                                    <span class="bottom-footer__linkdecor"><?php echo $file_check_ext1['ext'];?></span>
                                    <span class="details__itemright">
                                        <span class="details__itemname"><?php echo $fieldsArr['contacts_file1']['title'];?></span>
                                        <span class="details__itemtype"><?php echo $file_check_ext1['ext'];?></span>
                                    </span>
                                </a>
                            </div>
                            <?php endif;?>
                            <?php if($fieldsArr['contacts_file2']):?>
                            <?php $file_check_ext2 = wp_check_filetype($fieldsArr['contacts_file2']['url']);?>
                            <div class="details__itemcont">
                                <a target="_blank" class="details__item"
                                    href="<?php echo $fieldsArr['contacts_file2']['url'];?>">
                                    <span class="bottom-footer__linkdecor"><?php echo $file_check_ext2['ext'];?></span>
                                    <span class="details__itemright">
                                        <span class="details__itemname"><?php echo $fieldsArr['contacts_file2']['title'];?></span>
                                        <span class="details__itemtype"><?php echo $file_check_ext2['ext'];?></span>
                                    </span>
                                </a>
                            </div>
                            <?php endif;?>
                        </div>
                        <div class="details__right">
                            <div class="details__section-bottom section-bottom">
                                <a href="<?php echo get_the_permalink(115) . get_utm_double_uri_custom();?>" class="section-bottom__link _icon-arrow-r-d">Все документы</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
<?php

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>