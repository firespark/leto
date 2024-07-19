<?php
$moduleOptions = get_module_options('vakansii');
?>
<?php if(!empty($moduleOptions['vacancies'])):?>
            <section class="vacancies">
                <div class="vacancies__container">
                    <h2 class="vacancies__title title">
                        <?php add_yellow_arrow($moduleOptions['vacancies_title']);?>
                    </h2>
                    <div class="vacancies__body">
                        <div data-spollers data-one-spoller class="spollers spollers-s">

                            <?php foreach($moduleOptions['vacancies'] as $vacancy):?>
                            <div data-spollers-item class="spollers__item">
                                <div data-spollers-title class="spollers__title"><?php echo $vacancy['title'];?></div>
                                <div class="spollers__body">
                                    <?php echo $vacancy['description'];?>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </section>
<?php endif;?>