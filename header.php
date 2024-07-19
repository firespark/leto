<?php
global $optionsArr;

$header_menu = wp_get_nav_menu_items(2);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <link rel="icon" href="<?php echo $optionsArr['main_icon']['url'];?>" type="image/x-icon">
    <title><?php is_front_page() ? bloginfo('name') : wp_title(''); ?></title>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no">
    <!-- <style>body{opacity: 0;}</style> -->
    <?php wp_head();?>
    <!-- <meta name="robots" content="noindex, nofollow"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
       m[i].l=1*new Date();
       for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
       k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

       ym(94754820, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
       });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/94754820" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="header__container">
                <div class="header__body">
                    <?php 
                    include __DIR__ . '/inc/header_logo.php';
                    include __DIR__ . '/inc/header_menu.php';
                    include __DIR__ . '/inc/header_phone.php';

                    ?>
                    
                </div>
            </div>
        </header>
        <main class="page">
            <?php include __DIR__ . '/inc/header_to_top.php';?>
