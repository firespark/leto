<?php

get_header();
the_post();

$fieldsArr = get_fields();

?>
	        <?php 
            $breadcrumbs_args = [['url' => get_the_permalink(109), 'title' => get_the_title(109)]];
            custom_breadcrumbs($breadcrumbs_args);
            ?>
            <section class="category solution">
                <div class="category__container">
                    <h1 class="category__title title-s"><?php the_title();?></h1>
                    <div class="category__body">
                        <div class="category__top">
                            <div class="solution__left">
                                <?php echo $fieldsArr['solution_subtitle'];?>
                            </div>
                            <div class="category__right">
                                <div class="category__righttext page_content">
                                    <?php the_content();?>
                                </div>
                                <?php if($fieldsArr['solution_button_show']):?>
                                <a href="<?php echo $fieldsArr['solution_button_url'] . get_utm_double_uri_custom();?>" class="category__rightbutton calc-button">
                                    <span><?php echo $fieldsArr['solution_button_text'];?></span>
                                    <img src="<?php echo get_template_directory_uri();?>/img/arrow-r.png" alt="">
                                </a>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="category__bottom">
                            <div class="what-tabs__body">
                                <?php if(!empty($fieldsArr['solutions_cargos'])):?>
                                <div class="what-tabs__type">Виды груза:</div>
                                <div class="what-tabs__list">
                                    <?php foreach($fieldsArr['solutions_cargos'] as $cargo):?>
                                    <span class="what-tabs__name"><?php echo $cargo['cargo'];?></span>
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
            ?>

<?php

get_footer();

?>