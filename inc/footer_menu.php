<?php
$footer_menu1 = get_custom_menu(3);
$footer_menu2 = get_custom_menu(4);
$footer_menu3 = get_custom_menu(5);
?>

                    <nav class="top-footer__menu">
                        <div class="top-footer__column">
                            <?php if(!empty($footer_menu1)):?>
                            <?php foreach($footer_menu1[0] as $menu_item):?>
                            <div class="spollers top-footer__block">
                                <div class="spollers__item top-footer__blockcont">
                                    <a href="<?php echo $menu_item['url'] . get_utm_double_uri_custom();?>" class="top-footer__name"><?php echo $menu_item['title'];?></a>
                                    <?php if(isset($footer_menu1[$menu_item['ID']])):?>
                                    <div class="spollers__body top-footer__list">
                                        <ul class="top-footer__listcont">
                                             <?php foreach($footer_menu1[$menu_item['ID']] as $menu_item2):?>
                                            <li>
                                                <a href="<?php echo $menu_item2['url'] . get_utm_double_uri_custom();?>" class="top-footer__link"><?php echo $menu_item2['title'];?></a>
                                            </li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <?php endif;?>
                        </div>
                        <div class="top-footer__column">
                            <?php if(!empty($footer_menu2)):?>
                            <?php foreach($footer_menu2[0] as $menu_item):?>
                            <div class="spollers top-footer__block">
                                <div class="spollers__item top-footer__blockcont">
                                    <a href="<?php echo $menu_item['url'] . get_utm_double_uri_custom();?>" class="top-footer__name"><?php echo $menu_item['title'];?></a>
                                    <?php if(isset($footer_menu2[$menu_item['ID']])):?>
                                    <div class="spollers__body top-footer__list">
                                        <ul class="top-footer__listcont">
                                             <?php foreach($footer_menu2[$menu_item['ID']] as $menu_item2):?>
                                            <li>
                                                <a href="<?php echo $menu_item2['url'] . get_utm_double_uri_custom();?>" class="top-footer__link"><?php echo $menu_item2['title'];?></a>
                                            </li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <?php endif;?>
                        </div>
                        <div class="top-footer__column">
                            <?php if(!empty($footer_menu3)):?>
                            <?php foreach($footer_menu3[0] as $menu_item):?>
                            <div class="spollers top-footer__block">
                                <div class="spollers__item top-footer__blockcont">
                                    <a href="<?php echo $menu_item['url'] . get_utm_double_uri_custom();?>" class="top-footer__name"><?php echo $menu_item['title'];?></a>
                                    <?php if(isset($footer_menu3[$menu_item['ID']])):?>
                                    <div class="spollers__body top-footer__list">
                                        <ul class="top-footer__listcont">
                                             <?php foreach($footer_menu3[$menu_item['ID']] as $menu_item2):?>
                                            <li>
                                                <a href="<?php echo $menu_item2['url'] . get_utm_double_uri_custom();?>" class="top-footer__link"><?php echo $menu_item2['title'];?></a>
                                            </li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    </nav>