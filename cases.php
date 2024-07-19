<?php
/*
    Template Name: Cases

*/

get_header();
the_post();
$fieldsArr = get_fields();

$services = get_posts(['numberposts' => -1]);

if($services){
    $active_service = (isset($_GET['service']) && $_GET['service']) ? $_GET['service'] : $services[0]->ID;
    $results_per_page = 10;
    $total = count(get_posts([
        'numberposts' => -1,
        'post_type' => 'cases',
        'meta_key'      => 'case_service',
        'meta_value'    => $active_service,
    ]));
    $cases = get_posts([
        'posts_per_page' => $results_per_page,
        'post_type' => 'cases',
        'meta_key'      => 'case_service',
        'meta_value'    => $active_service,
    ]);
}



?>
<style type="text/css">
    .select__content-top{
        display: none;
    }
</style>
            <?php custom_breadcrumbs();?>
            <section class="cases">
                <div class="cases__container">
                    <h1 class="cases__title title"><?php the_title();?></h1>
                    <?php if(!empty($services)):?>
                    <div class="cases__body">
                        <div class="cases__selectcont">
                            <select name="form[]" data-class-modif="cases">
                                <option value="">Выберите категорию груза </option>
                            </select>
                        </div>
                        <div class="cases-tabs">
                            
                            <nav class="cases-tabs__navigation">
                                <?php foreach($services as $service):?>
                                <a href="?service=<?php echo $service->ID . get_utm_double_uri_custom('&');?>" type="button" class="cases-tabs__title<?php if($service->ID == $active_service) echo ' _tab-active';?>"><?php echo $service->post_title;?></a>
                                <?php endforeach;?>

                            </nav>
                            
                            <?php if(!empty($cases)):?>
                            <div class="cases-tabs__content">
                                <div class="cases-tabs__body">
                                    <div class="cases-tabs__column casesBody">
                                        <?php foreach($cases as $case):?>
                                        <?php $caseFields = get_fields($case->ID);?>
                                        <a href="<?php echo get_the_permalink($case->ID) . get_utm_double_uri_custom();?>" class="cases-tabs__item">
                                            <div class="cases-tabs__image-ibg">
                                                <img src="<?php echo $caseFields['case_image']['url'];?>" alt="<?php echo $caseFields['case_image']['alt'];?>">
                                            </div>
                                            <div class="cases-tabs__right">
                                                <div class="cases-tabs__name"><?php echo $case->post_title;?></div>
                                                <div class="cases-tabs__text"><?php echo $caseFields['case_description'];?></div>
                                                <div class="cases-tabs__info">
                                                    <?php if($caseFields['case_route']):?>
                                                    <p><span>Маршрут: </span><?php echo $caseFields['case_route'];?></p>
                                                    <?php endif;?>
                                                    <?php if($caseFields['case_date']):?>
                                                    <p><span>Дата перевозки: </span><?php echo $caseFields['case_date'];?></p>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                        </a>
                                        <?php endforeach;?>
                                    </div>
                                    <?php if($total > $results_per_page):?>
                                    <button type="button" class="cases-tabs__button show-more-button" data-total="<?php echo $total;?>" data-perpage="<?php echo $results_per_page;?>" data-counter="1">Показать ещё</button>
                                    <?php endif;?>
                                    
                                </div>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endif;?>
                </div>
            </section>
            

<?php

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>