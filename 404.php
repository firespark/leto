<?php

get_header();
the_post();

?>
	    <div class="page error-page">
            <div class="error">
                <div class="error__container">
                    <div class="error__body">
                        <div class="error__image-ibg">
                            <img src="<?php echo get_template_directory_uri();?>/img/error.svg" alt="">
                        </div>
                        <div class="error__text">
                            <p>Ой, страница не найдена.</p>
                            <p>Начнем всё сначала?</p>
                        </div>
                        <a href="/" class="error__button calc-button">
                            <span>Поехали</span>
                            <img src="<?php echo get_template_directory_uri();?>/img/arrow-r.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

<?php

get_footer();

?>