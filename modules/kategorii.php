<?php
$moduleOptions = get_module_options('kategorii');
$services = get_posts(['numberposts' => -1]);
?>

            <section class="what">
                <div class="what__container">
                    <div class="what__top">
                        <h2 class="what__title title"><?php echo $moduleOptions['cats_title'];?></h2>
                        <div class="what__subtitle"><?php echo $moduleOptions['cats_subtitle'];?></div>
                    </div>
                    <?php if(!empty($services)):?>
                    <div data-tabs class="what-tabs">
                        <nav data-tabs-titles class="what-tabs__navigation">
                            <?php foreach($services as $key => $service):?>
                            <a href="<?php echo get_the_permalink($service->ID) . get_utm_double_uri_custom();?>" class="what-tabs__title<?php if($key == 0) echo ' _tab-active';?>"><?php echo $service->post_title;?></a>
                            <?php endforeach;?>

                        </nav>
                        <div data-tabs-body class="what-tabs__content">
                            <?php foreach($services as $service):?>
                            <?php $serviceArr = get_fields($service->ID);?>
                            <div class="what-tabs__body">
                                <div class="what-tabs__image-ibg">
                                    <?php if(isset($serviceArr['service_image']['url'])):?>
                                    <img src="<?php echo $serviceArr['service_image']['url'];?>" alt="<?php echo $serviceArr['service_image']['alt'];?>">
                                    <?php endif;?>
                                </div>
                                <div class="what-tabs__type"><?php echo $service->post_title;?></div>
                                <div class="what-tabs__list">
                                    <?php if(!empty($serviceArr['service_subcats'])):?>
                                    <?php foreach($serviceArr['service_subcats'] as $subcat):?>
                                    <span class="what-tabs__name"><?php echo $subcat['subcat'];?></span>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </div>
                            </div>
                            <?php endforeach;?>

                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </section>