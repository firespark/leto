<?php
$header_menu = wp_get_nav_menu_items(2);
?>

                    <div class="header__menu menu">
                        <?php if(!empty($header_menu)):?>
                        <button type="button" class="menu__icon icon-menu" aria-label="Burger menu button"><span></span></button>
                        <nav class="menu__body">
                            <ul class="menu__list">
                                <?php foreach($header_menu as $menu_item):?>
                                <li class="menu__item"><a href="<?php echo $menu_item->url . get_utm_double_uri_custom();?>" class="menu__link"><?php echo $menu_item->title;?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </nav>
                        <?php endif;?>
                    </div>