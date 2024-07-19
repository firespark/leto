<?php
global $optionsArr;
wp_footer();
?>

</main>
        <footer class="footer">
            <div class="footer__container">
                <div class="top-footer">
                    <?php 
                    include __DIR__ . '/inc/footer_logo.php';
                    include __DIR__ . '/inc/footer_menu.php';
                    ?>
                    
                </div>
                <div class="bottom-footer">
                    <?php 
                    include __DIR__ . '/inc/footer_left.php';
                    include __DIR__ . '/inc/footer_right.php';
                    ?>
                    
                </div>
            </div>
        </footer>
    </div>
    <?php 
    include __DIR__ . '/inc/footer_body_style.php';
    include __DIR__ . '/inc/footer_preloader.php';
    ?>
    <script src="<?php echo get_template_directory_uri();?>/js/jquery-3.7.0.min.js"></script>
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/jquery.maskedinput.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/app.js?v=24"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/custom.js?v=<?php echo rand(100,100000000);?>"></script>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NPYE4E23YQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-NPYE4E23YQ');
</script>

</body>

</html>