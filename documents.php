<?php
/*
    Template Name: Documents

*/

get_header();
the_post();
$fieldsArr = get_fields();

?>

            <?php custom_breadcrumbs();?>
            <section class="documents">
                <div class="documents__container">
                    <h1 class="documents__title title-s"><?php the_title();?></h1>
                    <div class="documents__body">
                        <?php if(!empty($fieldsArr['documents_sections'])):?>
                        <?php foreach($fieldsArr['documents_sections'] as $documents_section):?>
                        <div class="documents__block">
                            <div class="documents__name"><?php echo $documents_section['title'];?></div>
                            <?php if(!empty($documents_section['documents'])):?>
                            <?php foreach($documents_section['documents'] as $document):?>
                            <?php $file_check_ext = wp_check_filetype($document['url']);?>
                            <a target="_blank" href="<?php echo $document['url'];?>"
                                class="documents__link"><?php echo $document['title'];?><span> <?php echo $file_check_ext['ext'];?></span>
                            </a>
                            <?php endforeach;?>
                            <?php endif;?>
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