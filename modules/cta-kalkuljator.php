<?php
$moduleOptions = get_module_options('cta-kalkuljator');

?>

            <div class="routes">
                <div class="routes__container">
                    <div class="routes__body">
                        <div class="routes__left"><?php echo $moduleOptions['cta_calc_title'];?></div>
                        <div class="routes__right">
                            <?php if($moduleOptions['cta_calc_button_show']):?>
                            <a href="<?php echo $moduleOptions['cta_calc_button_url'] . get_utm_double_uri_custom();?>" class="routes__button calc-button">
                                <span><?php echo $moduleOptions['cta_calc_button_text'];?></span>
                                <img src="<?php echo get_template_directory_uri();?>/img/arrow-r.png" alt="">
                            </a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>