<?php
$moduleOptions = get_module_options('banner');

?>

            <section class="first">
                <div class="first__container">
                    <div class="first__body">
                        <h1 class="first__title">
                            <span class="first__title-anim"><?php echo $moduleOptions['banner_title'];?></span>
                            <span class="first__title-anim first__title-2"><?php echo $moduleOptions['banner_subtitle'];?></span>
                            <span class="first__title-3"><?php echo $moduleOptions['banner_title'];?> <?php echo $moduleOptions['banner_subtitle'];?></span>
                        </h1>
                        <?php if($moduleOptions['banner_button']):?>
                        <a href="<?php echo $moduleOptions['banner_button_link'] . get_utm_double_uri_custom();?>" class="calc-button">
                            <span><?php echo $moduleOptions['banner_button_text'];?></span>
                            <img src="<?php echo get_template_directory_uri();?>/img/arrow-r.png" alt="">
                        </a>
                        <?php endif;?>
                    </div>
                </div>
            </section>