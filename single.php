<?php

get_header();
the_post();

$fieldsArr = get_fields();
$serviceImg = (!empty($fieldsArr['service_image_board'])) ? $fieldsArr['service_image_board'] : $fieldsArr['service_image'];
?>
	       <?php 
           $breadcrumbs_args = [['url' => get_the_permalink(98), 'title' => get_the_title(98)]];
           custom_breadcrumbs($breadcrumbs_args);
           ?>
            <section class="category">
                <div class="category__container">
                    <h1 class="category__title title-s"><?php the_title();?></h1>
                    <div class="category__body">
                        <div class="category__top">
                            <div class="category__left-ibg">
                                
                                <img src="<?php echo $serviceImg['url'];?>" alt="<?php echo $serviceImg['alt'];?>">
                                
                            </div>
                            <div class="category__right">
                                <div class="category__righttext">
                                    <?php the_content();?>
                                </div>
                                <?php if($fieldsArr['service_button_show']):?>
                                <a href="<?php echo $fieldsArr['service_button_url'] . get_utm_double_uri_custom();?>" class="category__rightbutton calc-button">
                                    <span><?php echo $fieldsArr['service_button_text'];?></span>
                                    <img src="<?php echo get_template_directory_uri();?>/img/arrow-r.png" alt="">
                                </a>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="category__bottom">
                            <div class="what-tabs__body">
                                <?php if(!empty($fieldsArr['service_subcats'])):?>
                                <div class="what-tabs__type"><?php the_title();?></div>
                                <div class="what-tabs__list">
                                    <?php foreach($fieldsArr['service_subcats'] as $subcat):?>
                                    <span class="what-tabs__name"><?php echo $subcat['subcat'];?></span>
                                    <?php endforeach;?>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php 
            include __DIR__ . '/modules/kejsy.php';
            include __DIR__ . '/modules/otraslevye-reshenija.php';
            ?>

<?php

get_footer();

?>