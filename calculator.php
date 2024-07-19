<?php
/*
    Template Name: Calculator

*/

get_header();
the_post();
$fieldsArr = get_fields();

$nomenclature_attrs = get_nomenclature_attrs($fieldsArr['calc_nomenclature']);

$datetime = new DateTime('tomorrow');

//$responseData = search_dadata_address('луг');
//print_r($responseData);

?>

            <?php custom_breadcrumbs();?>
            <section class="calc<?php if (is_page_utm_double_custom()) echo ' calc__double';?>">
                <div class="calc__container">
                    <form id="calcForm" class="calc__body">
                        <?php include __DIR__ . '/inc/calc-hidden.php';?>
                        
                        <div class="calc__left">
                            <h1 class="calc__title title-s"><?php echo ($fieldsArr['post_h1']) ? $fieldsArr['post_h1'] : $post->post_title;?></h1>
                            <div class="calc__subtitle"><i><?php echo $fieldsArr['calc_fields_description'];?></i></div>
                            <div class="calc__left-1">
                                
                                <?php
                                include __DIR__ . '/inc/calc-ts.php';
                                include __DIR__ . '/inc/calc-route.php';
                                include __DIR__ . '/inc/calc-date.php';
                                include __DIR__ . '/inc/calc-cargo.php';
                                include __DIR__ . '/inc/calc-payment.php';
                                include __DIR__ . '/inc/calc-extra-info.php';
                                include __DIR__ . '/inc/calc-temperature.php';
                                ?>
                                
                            </div>
                            <div hidden class="calc__left-2">
                                <?php include __DIR__ . '/inc/calc-client-info.php';?>
                            </div>
                            <button type="button" class="calc__button calc__button-1">Продолжить</button>
                            <button type="submit" id="sendCalcButton" class="calc__button calc__button-2 _hidden">Оформить заказ</button>
                            <div class="modalContentSuccess"></div>
                            <div class="errormessage"></div>

                        </div>
                        <div data-da=".calc__left-1, 768, 2" class="calc__right calc-right">
                            <?php include __DIR__ . '/inc/calc-show-cost.php';?>
                        </div>
                    </form>
                    
                </div>
            </section>
<?php

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>
<?php include __DIR__ . '/inc/calc-popup.php';?>
