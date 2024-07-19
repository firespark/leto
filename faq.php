<?php
/*
    Template Name: Faq

*/

get_header();
the_post();
$fieldsArr = get_fields();
?>

            <?php custom_breadcrumbs();?>
            <section class="questions">
                <div class="questions__container">
                    <h1 class="questions__title title-s"><?php the_title();?></h1>
                    <div class="questions__body">
                        <?php if(!empty($fieldsArr['faq_sections'])):?>
                        <?php foreach($fieldsArr['faq_sections'] as $section):?>
                        <div class="questions__block">
                            <div class="questions__left"><?php echo $section['title'];?></div>
                            <div class="questions__right">
                                <?php if(!empty($section['questions'])):?>
                                <div data-spollers data-one-spoller class="spollers spollers-s">
                                    <?php foreach($section['questions'] as $question):?>
                                    <div data-spollers-item class="spollers__item">
                                        <div data-spollers-title class="spollers__title"><?php echo $question['question'];?></div>
                                        <div class="spollers__body">
                                            <?php echo $question['answer'];?>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>
                </div>
            </section>
            
<?php

get_post_modules($fieldsArr['page_modules']);

get_footer();

?>