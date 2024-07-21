<?php

// Функции можно использовать для веб-сервиса

// Основные настройки
$optionsArr = get_fields('options');


//подключение стилей и js
if(!is_admin()){
	function blog_styles(){
        global $post;
       
        wp_enqueue_style('style_min_css', get_template_directory_uri().'/css/style.min.css', [], 30);
        wp_enqueue_style('custom_css', get_template_directory_uri().'/css/custom.css', [], 47);
        
	}
	add_action('wp_enqueue_scripts','blog_styles');
}

//Подключение меню
add_theme_support('menus');

//Панель администратора
if(!current_user_can('administrator')){
    show_admin_bar(false);
}

// Страница Основные настройки
if(function_exists('acf_add_options_page')){
    acf_add_options_page(array(
        'page_title' => 'Основные настройки',
        'menu_title' => 'Основные настройки',
        'update_button'   => 'Сохранить',
        'menu_slug' => 'main_settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

}

// Получить только цифры из строки
function get_numbers_from_str($str) {
    return preg_replace("/[^0-9]/", '', $str);
}

// Обработка переданного массива $_POST
function get_safe_post($post){
    $safe_post = htmlspecialchars(trim($post));
    return $safe_post;
}


//Навигация сайта
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

    if (empty($pagerange)) {
        $pagerange = 2;
    }

    /**
    * This first part of our function is a fallback
    * for custom pagination inside a regular loop that
    * uses the global $paged and global $wp_query variables.
    * 
    * It's good because we can now override default pagination
    * in our theme, and use this function in default quries
    * and custom queries.
    */

    if (empty($paged)) {
        $paged = 1;
    }
    if ($numpages == '') {
        global $wp_query;
        $numpages = $wp_query->max_num_pages;
        if(!$numpages) {
            $numpages = 1;
        }
    }
    if(is_front_page()){
        $base = '%_%';
        //$format = '?page=%#%';
    }
    else{
        $base = $_SERVER['REDIRECT_URL'] . '%_%';
        //$format = 'page/%#%';
    }
    $format = '?show=%#%';

    /** 
    * We construct the pagination arguments to enter into our paginate_links
    * function. 
    */
    $pagination_args = array(
        'base'            => $base,
        'format'          => $format,
        'total'           => $numpages,
        'current'         => $paged,
        'show_all'        => false,
        'end_size'        => 1,
        'mid_size'        => $pagerange,
        'prev_next'       => True,
        'prev_text'       => __('&laquo;'),
        'next_text'       => __('&raquo;'),
        'type'            => 'plain',
        'add_args'        => false,
        'add_fragment'    => ''
    );

    $paginate_links = paginate_links($pagination_args);

    if ($paginate_links) {
        echo "<nav class='custom-pagination'>";
        //echo "<span class='page-numbers page-num'>Страница " . $paged . " из " . $numpages . "</span> ";
        echo $paginate_links;
        echo "</nav>";
    }

}


// Обрезка текста
function custom_mb_strimwidth($string, $start = 0, $width = 30, $trimmarker = '...') {
    $len = mb_strlen(trim($string));
    $newstring = ( ($len > $width) && ($len != 0) ) ? rtrim(mb_strimwidth($string, $start, $width - mb_strlen($trimmarker))) . $trimmarker : $string;
    return $newstring;
}


function custom_breadcrumbs($args = array()) {

    /* === ОПЦИИ === */
    $text['home'] = 'Главная'; // текст ссылки "Главная"
    $text['category'] = '%s'; // текст для страницы рубрики
    $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
    $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
    $text['author'] = 'Статьи автора %s'; // текст для страницы автора
    $text['404'] = 'Ошибка 404'; // текст для страницы 404
    $text['page'] = 'Страница %s'; // текст 'Страница N'
    $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

    $wrap_before = '<div class="crumbs"><div class="crumbs__container"><div class="crumbs__body">'; // открывающий тег обертки
    $wrap_after = '</div></div></div>'; // закрывающий тег обертки
    $sep = ''; // разделитель между "крошками"
    $before = '<span class="crumbs__link">'; // тег перед текущей "крошкой"
    $after = '</span>'; // тег после текущей "крошки"

    $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
    $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
    $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
    $show_last_sep = 1; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
    
    /* === КОНЕЦ ОПЦИЙ === */

    global $post;
    $home_url = home_url('/');
    $link = '<a href="%1$s" class="crumbs__link">%2$s</a>';
    $parent_id = ( $post ) ? $post->post_parent : '';
    $home_link = sprintf( $link, $home_url, $text['home'], 1 );

    if ( is_home() || is_front_page() ) {

        if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;

    } else {

        $position = 0;

        echo $wrap_before;


        if ( $show_home_link ) {
            $position += 1;
            echo $home_link;
        }

        if(!empty($args)){
            foreach ($args as $arg) {
                echo $sep . sprintf( $link, $arg['url'], $arg['title'], $position );
                echo $sep;

            }
            if ( $show_current ){
                if ( is_page() && ! $parent_id ) {
                    echo $before . get_the_title() . $after;
                } 
                elseif ( is_page() && $parent_id ) {
                    echo $before . get_the_title() . $after;
                } 
                elseif( is_category() ){

                    echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
                }
                elseif( is_search() ){

                    echo $before . sprintf( $text['search'], get_search_query() ) . $after;
                }
        
                elseif ( is_single() && ! is_attachment() ) {
                    if ( get_post_type() != 'post' ) {
                        echo $before . get_the_title() . $after;

                    } 
                    else {
                        echo $before . get_the_title() . $after;
              
                    }
                }
                elseif ( is_year() ) {

                    echo $before . get_the_time('Y') . $after;
                }
                elseif ( is_month() ) {
                    echo $before . get_the_time('F') . $after;
                }
                elseif ( is_day() ) {
                    echo $before . get_the_time('d') . $after;
                }
                elseif ( is_post_type_archive() ) {
                    echo $before . $post_type->label . $after;
                } 
                elseif ( is_attachment() ) {
                    echo $before . get_the_title() . $after;
                } 
        
                elseif ( is_tag() ) {
                    echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                } 
                elseif ( is_author() ) {
                    echo $before . sprintf( $text['author'], $author->display_name ) . $after;
                } 
                elseif ( is_404() ) {
                    echo $before . $text['404'] . $after;
                }
            }
        }
        elseif ( is_single() && ! is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $position += 1;
                $post_type = get_post_type_object( get_post_type() );
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
                if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                elseif ( $show_last_sep ) echo $sep;
            } else {
                $cat = get_the_category(); $catID = $cat[0]->cat_ID;
                $parents = get_ancestors( $catID, 'category' );
                $parents = array_reverse( $parents );
                $parents[] = $catID;
                foreach ( $parents as $cat ) {
                    $position += 1;
                    if ( $position > 1 ) echo $sep;
                    echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                }
                if ( get_query_var( 'cpage' ) ) {
                    $position += 1;
                    echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
                    echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
                } else {
                    if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                    elseif ( $show_last_sep ) echo $sep;
                }
            }

        }
        elseif ( is_page() && ! $parent_id ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_title() . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_page() && $parent_id ) {
            $parents = get_post_ancestors( get_the_ID() );
            foreach ( array_reverse( $parents ) as $pageID ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
            }
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        }
        elseif ( is_category() ) {
            $parents = get_ancestors( get_query_var('cat'), 'category' );
            foreach ( array_reverse( $parents ) as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $cat = get_query_var('cat');
                echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_search() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $show_home_link ) echo $sep;
                echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['search'], get_search_query() ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_year() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_time('Y') . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_month() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_day() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
            $position += 1;
            echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_post_type_archive() ) {
            $post_type = get_post_type_object( get_post_type() );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . $post_type->label . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_attachment() ) {
            $parent = get_post( $parent_id );
            $cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
            $parents = get_ancestors( $catID, 'category' );
            $parents = array_reverse( $parents );
            $parents[] = $catID;
            foreach ( $parents as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            $position += 1;
            echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_tag() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $tagID = get_query_var( 'tag_id' );
                echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_author() ) {
            $author = get_userdata( get_query_var( 'author' ) );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_404() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . $text['404'] . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( has_post_format() && ! is_singular() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            echo get_post_format_string( get_post_format() );
        }

        echo $wrap_after;

    }
} // end of custom_breadcrumbs()

if (!function_exists("mb_str_replace")) 
{
    function mb_str_replace($needle, $replace_text, $haystack) {
        return implode($replace_text, mb_split($needle, $haystack));
    }
}

function get_custom_menu($menu_id){
    $top_menu_obj = wp_get_nav_menu_items($menu_id);

    $menu = array();

    if(!empty($top_menu_obj)){
        foreach ($top_menu_obj as $top_menu) {
            $menu[$top_menu->menu_item_parent][] = array(
                'ID' => $top_menu->ID,
                'title' => $top_menu->title,
                'url' => $top_menu->url,
                'object_id' => $top_menu->object_id,
            );
        }
    }

    return $menu;
}

add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){

    $new = [
        'name'                  => 'Услуги',
        'singular_name'         => 'Услуга',
        'add_new'               => 'Добавить Услугу',
        'add_new_item'          => 'Добавить Услугу',
        'edit_item'             => 'Редактировать Услугу',
        'new_item'              => 'Новая Услуга',
        'view_item'             => 'Просмотреть Услугу',
        'search_items'          => 'Поиск Услуг',
        'not_found'             => 'Услуги не найдены',
        'not_found_in_trash'    => 'Услуги в корзине не найдены.',
        'parent_item_colon'     => '',
        'all_items'             => 'Все Услуги',
        'archives'              => 'Архивы Услуг',
        'insert_into_item'      => 'Вставить в Услугу',
        'uploaded_to_this_item' => 'Загруженные для этой Услуги',
        'featured_image'        => 'Миниатюра Услуги',
        'filter_items_list'     => 'Фильтровать список Услуг',
        'items_list_navigation' => 'Навигация по списку Услуг',
        'items_list'            => 'Услуги',
        'menu_name'             => 'Услуги',
        'name_admin_bar'        => 'Услуга',
    ];

    return (object) array_merge( (array) $labels, $new );
}

// Запись типа Модуль
add_action('init', 'moduleblocks_cpt');
function moduleblocks_cpt() {
    $labels = [
        'name' => 'Модули',
        'singular_name' => 'Модуль',
        'add_new' => 'Добавить',
        'add_new_item' => 'Добавить Модуль',
        'edit_item' => 'Редактировать Модуль',
        'new_item' => 'Новый Модуль',
        'all_items' => 'Все Модули',
        'view_item' => 'Просмотр Модуля',
        'search_items' => 'Поиск Модулей',
        'not_found' => 'Модули не найдены',
        'not_found_in_trash' => 'Корзина пуста',
        'parent_item_colon' => '',
        'menu_name' => 'Модули',
    ];
    $args = [
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'supports' => ['title'],
        'menu_position' => 4,

    ];
    register_post_type('moduleblocks', $args);


}

// Запись типа Решение
add_action('init', 'solutions_cpt');
function solutions_cpt() {
    $labels = [
        'name' => 'Решения',
        'singular_name' => 'Решение',
        'add_new' => 'Добавить',
        'add_new_item' => 'Добавить Решение',
        'edit_item' => 'Редактировать Решение',
        'new_item' => 'Новое Решение',
        'all_items' => 'Все Решения',
        'view_item' => 'Просмотр Решений',
        'search_items' => 'Поиск Решений',
        'not_found' => 'Решения не найдены',
        'not_found_in_trash' => 'Корзина пуста',
        'parent_item_colon' => '',
        'menu_name' => 'Решения',
    ];
    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'supports' => ['title', 'editor'],
        'menu_position' => 4,
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
    ];
    register_post_type('solutions', $args);


}

// Запись типа Маршрут
add_action('init', 'routes_cpt');
function routes_cpt() {
    $labels = [
        'name' => 'Маршруты',
        'singular_name' => 'Маршрут',
        'add_new' => 'Добавить',
        'add_new_item' => 'Добавить Маршрут',
        'edit_item' => 'Редактировать Маршрут',
        'new_item' => 'Новый Маршрут',
        'all_items' => 'Все Маршруты',
        'view_item' => 'Просмотр Маршрутов',
        'search_items' => 'Поиск Маршрутов',
        'not_found' => 'Маршруты не найдены',
        'not_found_in_trash' => 'Корзина пуста',
        'parent_item_colon' => '',
        'menu_name' => 'Маршруты',
    ];
    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'supports' => ['title', 'editor'],
        'menu_position' => 4,
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
    ];
    register_post_type('routes', $args);


}

// Запись типа Кейс
add_action('init', 'cases_cpt');
function cases_cpt() {
    $labels = [
        'name' => 'Кейсы',
        'singular_name' => 'Кейс',
        'add_new' => 'Добавить',
        'add_new_item' => 'Добавить Кейс',
        'edit_item' => 'Редактировать Кейс',
        'new_item' => 'Новый Кейс',
        'all_items' => 'Все Кейсы',
        'view_item' => 'Просмотр Кейсов',
        'search_items' => 'Поиск Кейсов',
        'not_found' => 'Кейсы не найдены',
        'not_found_in_trash' => 'Корзина пуста',
        'parent_item_colon' => '',
        'menu_name' => 'Кейсы',
    ];
    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'supports' => ['title', 'editor'],
        'menu_position' => 4,
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
    ];
    register_post_type('cases', $args);


}

//Вывод модулей
function get_post_modules($modules) {

    if(!empty($modules)) {
        foreach($modules as $module) {
            include __DIR__ . '/modules/' . $module->post_name . '.php';
        }
    }
}

function get_post_module_id_by_slug($slug) {
    if ( $post = get_page_by_path( $slug, OBJECT, 'moduleblocks' ) )
    return $post->ID;
    else return 0;
}

function get_module_options($slug) {
    $module_id = get_post_module_id_by_slug($slug);
    if(!$module_id) return null;
    return get_fields($module_id);
}

function add_yellow_arrow($title) {
    $titleArr = explode(' ', $title);
    $titleLast = array_pop($titleArr); 
    $titleFirst = implode(' ', $titleArr);

    $html = '<span>';
    $html .= $titleFirst . ' <br></span>';
    $html .= '<span class="title-decor _icon-arrow-r-d">';
    $html .= $titleLast . '</span>';
    echo $html;
}

function show_route_attrs($tent, $van, $isoterma, $refrigerator) {

    include __DIR__ . '/inc/route-attrs.php';
}

function get_nomenclature_attrs($nomenclature) {
    $body_types = [];
    $load_capacities = [];
    if(!empty($nomenclature)) {
        foreach($nomenclature as $nom) {
            if(!in_array($nom['body_type'], $body_types)){
                $body_types[] = $nom['body_type'];
            }
            if(!in_array($nom['load_capacity'], $load_capacities)){
                $load_capacities[] = $nom['load_capacity'];
            }
        }
    }
    $data = [
        'body_types' => $body_types,
        'load_capacities' => $load_capacities
    ];
    return $data;
}


// отключаем xmlrpc.php
add_filter('xmlrpc_enabled', '__return_false');
remove_action( 'wp_head', 'rsd_link' );


// admin panel

function pagination_cargos($page, $paged, $get_par, $total_pages){
    $pagination = '<span>Страницы: </span>';
    if ($paged != 1){$pagination .= '<a href="/wp-admin/admin.php?page=' . $page . $get_par . '" title="Первая страница">&lt;&lt;&lt;</a>';}
    for ($i = 1; $i <= $total_pages; $i++){
        if($i == $paged || (!$paged && $i == 1)) $pagination .= '<span>' . $i . '</span>';
        else {
            $pagination .= '<a href="';
            if($i == 1) $pagination .= '/wp-admin/admin.php?page=' . $page . $get_par; 
            else $pagination .= '/wp-admin/admin.php?page=' . $page . '&paged=' .$i . $get_par;
            $pagination .= '">' . $i . '</a>';
        }
    }

    if($paged != $total_pages){
        $pagination .= '<a href="/wp-admin/admin.php?page=' . $page . '&paged=' . $total_pages . $get_par . '" title="Последняя страница">&gt;&gt;&gt;</a>';
    }
    return $pagination;
}

function cargos_display(){
    global $wpdb;

  
    $results_per_page = 100;

    if($_GET['cat']){
        $cat_id = $_GET['cat'];
        $cat_selected = $cat_id;
        $total_pages = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "cargos WHERE cat_id = $cat_id");
    
        $total_pages = ceil($total_pages/$results_per_page);
        $get_par = '';
        if($total_pages > 1){

            if ($_GET["paged"]) $paged  = $_GET["paged"];
            else $paged=1; 
            $start_from = ($paged-1) * $results_per_page;
            $cargos = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cargos WHERE cat_id = $cat_id ORDER BY title ASC LIMIT $start_from,$results_per_page");
            $navi = pagination_cargos('cargos_view', $paged, $get_par, $total_pages);
        }
        else {
            $cargos = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cargos WHERE cat_id = $cat_id ORDER BY title ASC");
            $navi = '';
        }
    }

    elseif($_GET['group']){
        $group_id = $_GET['group'];
        $total_pages = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "cargos WHERE group_id = $group_id");
    
        $total_pages = ceil($total_pages/$results_per_page);
        $get_par = '';
        if($total_pages > 1){

            if ($_GET["paged"]) $paged  = $_GET["paged"];
            else $paged=1; 
            $start_from = ($paged-1) * $results_per_page;
            $cargos = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cargos WHERE group_id = $group_id ORDER BY title ASC LIMIT $start_from,$results_per_page");
            $navi = pagination_cargos('cargos_view', $paged, $get_par, $total_pages);
        }
        else {
            $cargos = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cargos WHERE group_id = $group_id ORDER BY title ASC");
            $navi = '';
        }
        $cat_selected = $wpdb->get_var( "SELECT cat_id FROM " . $wpdb->prefix . "cargo_groups WHERE id = " . $group_id );
    }
    elseif($_GET['search']){
        $search = $_GET['search'];
        $cat_selected = 0;
        $total_pages = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "cargos WHERE title LIKE '%" . $search . "%'");
    
        $total_pages = ceil($total_pages/$results_per_page);
        $get_par = '';
        if($total_pages > 1){

            if ($_GET["paged"]) $paged  = $_GET["paged"];
            else $paged=1; 
            $start_from = ($paged-1) * $results_per_page;
            $cargos = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cargos WHERE title LIKE '%" . $search . "%' ORDER BY title ASC LIMIT $start_from,$results_per_page");
            $navi = pagination_cargos('cargos_view', $paged, $get_par, $total_pages);
        }
        else {
            $cargos = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cargos WHERE title LIKE '%" . $search . "%' ORDER BY title ASC");
            $navi = '';
        }
    }
    else {

        $cat_selected = 0;
        $total_pages = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "cargos");
        
        $total_pages = ceil($total_pages/$results_per_page);
        $get_par = '';
        if($total_pages > 1){

            if ($_GET["paged"]) $paged  = $_GET["paged"];
            else $paged=1; 
            $start_from = ($paged-1) * $results_per_page;
            $cargos = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cargos ORDER BY title ASC LIMIT $start_from,$results_per_page");
            $navi = pagination_cargos('cargos_view', $paged, $get_par, $total_pages);
        }
        else {
            $cargos = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cargos ORDER BY title ASC");
            $navi = '';
        }
    }

    $cats = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_cats ORDER BY title ASC" );

    if($_GET['cat']){

        $groups = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_groups WHERE cat_id = " . $_GET['cat'] . " ORDER BY title ASC" );
    }
    else {
        $groups = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_groups ORDER BY title ASC" );
    }

    $data = [];
    

    if(!empty($cargos)) {
        foreach($cargos as $cargo) {
            
            foreach($cats as $cat) {
                if($cat->id == $cargo->cat_id) {
                    $cat_title = $cat->title;
                    break;
                }
            }

            $group_title = '';
            if($cargo->group_id) {
                foreach($groups as $group) {
                    if($group->id == $cargo->group_id) {
                        $group_title = $group->title;
                        break;
                    }
                }
            }

            $data[] = [
                'id' => $cargo->id,
                'title' => $cargo->title,
                'cat_title' => $cat_title,
                'group_title' => $group_title,
            ];

        }
    }

 
    include 'admin/cargos_file.php';
}

//Страница Грузы в админ панели

add_action('admin_menu', 'cargos_view');
function cargos_view(){
    $page_title = 'Грузы';
    $menu_title = 'Грузы';
    $capability = 'edit_posts';
    $menu_slug = 'cargos_view';
    $function = 'cargos_display';
    $icon_url = '';
    $position = 22;

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
}

function cargo_show_single(){
    global $wpdb;
    $cargo_id = $_GET['id'];
  
    $cargo = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "cargos WHERE id = $cargo_id" );

    $cats = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_cats ORDER BY title ASC" );

    $groups = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_groups ORDER BY title ASC" );
  
    include 'admin/singlecargo_file.php';
}

add_action('admin_menu', 'cargo_show');
function cargo_show(){
    $page_title = 'Просмотр';
    $menu_title = '';
    $capability = 'edit_posts';
    $menu_slug = 'cargo_show';
    $function = 'cargo_show_single';
  

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);
    remove_menu_page('cargo_show');
}

function cargo_show_add(){

    global $wpdb;

    $cats = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_cats ORDER BY title ASC" );

    $groups = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_groups ORDER BY title ASC" );

  
    include 'admin/cargo_add.php';
}

add_action('admin_menu', 'cargo_add');
function cargo_add(){
    $page_title = 'Добавить груз';
    $menu_title = '';
    $capability = 'edit_posts';
    $menu_slug = 'cargo_add';
    $function = 'cargo_show_add';
  

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);
    remove_menu_page('cargo_add');
}



//Категории
function cargo_cats_display(){
    global $wpdb;

    if($_GET['search']){
        $cats = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_cats WHERE title LIKE '%" . $_GET['search'] . "%' ORDER BY title ASC" );
    }
    else{

        $cats = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_cats ORDER BY title ASC" );
    }
 
    include 'admin/cargo_cats_file.php';
}

add_action('admin_menu', 'cargo_cats_view');

function cargo_cats_view(){
    $page_title = 'Категории грузов';
    $menu_title = 'Категории грузов';
    $capability = 'edit_posts';
    $menu_slug = 'cargo_cats_view';
    $function = 'cargo_cats_display';
    $icon_url = '';
    $position = 22;

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
}

function cargo_cat_show_single(){
    global $wpdb;
    $cat_id = $_GET['id'];

    $cat = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "cargo_cats WHERE id = $cat_id" );

    include 'admin/singlecargo_cat_file.php';
}

add_action('admin_menu', 'cargo_cat_show');
function cargo_cat_show(){
    $page_title = 'Просмотр';
    $menu_title = '';
    $capability = 'edit_posts';
    $menu_slug = 'cargo_cat_show';
    $function = 'cargo_cat_show_single';
  

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);
    remove_menu_page('cargo_cat_show');
}

function cargo_show_cat_add(){

  
    include 'admin/cargo_cat_add.php';
}

add_action('admin_menu', 'cargo_cat_add');
function cargo_cat_add(){
    $page_title = 'Добавить категорию груза';
    $menu_title = '';
    $capability = 'edit_posts';
    $menu_slug = 'cargo_cat_add';
    $function = 'cargo_show_cat_add';
  

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);
    remove_menu_page('cargo_cat_add');
}


//Группы
function cargo_groups_display(){
    global $wpdb;

    if($_GET['cat']){
        $cat_id = $_GET['cat'];
        $groups = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_groups WHERE cat_id = " . $cat_id . " ORDER BY title ASC" );
    }

    elseif($_GET['search']){
        $groups = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_groups WHERE title LIKE '%" . $_GET['search'] . "%' ORDER BY title ASC" );
    }
    else{

        $groups = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_groups ORDER BY title ASC" );
    }

    $cats = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_cats ORDER BY title ASC" );

    
    $data = [];

    if(!empty($groups)) {
        foreach($groups as $group) {
            foreach($cats as $cat) {
                if($group->cat_id == $cat->id) {
                    $cat_title = $cat->title;
                    break;
                }
            }


            $data[] = [
                'id' => $group->id,
                'title' => $group->title,
                'cat_title' => $cat_title,
                'chs' => $group->chs,
            ];

        }
    }
 
    include 'admin/cargo_groups_file.php';
}

add_action('admin_menu', 'cargo_groups_view');

function cargo_groups_view(){
    $page_title = 'Группы грузов';
    $menu_title = 'Группы грузов';
    $capability = 'edit_posts';
    $menu_slug = 'cargo_groups_view';
    $function = 'cargo_groups_display';
    $icon_url = '';
    $position = 22;

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
}

function cargo_group_show_single(){
    global $wpdb;
    $group_id = $_GET['id'];

    $group = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "cargo_groups WHERE id = $group_id" );

    $cats = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_cats ORDER BY title ASC" );

    include 'admin/singlecargo_group_file.php';
}

add_action('admin_menu', 'cargo_group_show');
function cargo_group_show(){
    $page_title = 'Просмотр';
    $menu_title = '';
    $capability = 'edit_posts';
    $menu_slug = 'cargo_group_show';
    $function = 'cargo_group_show_single';
  

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);
    remove_menu_page('cargo_group_show');
}

function cargo_show_group_add(){

    global $wpdb;

    $cats = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "cargo_cats ORDER BY title ASC" );

    include 'admin/cargo_group_add.php';
}

add_action('admin_menu', 'cargo_group_add');
function cargo_group_add(){
    $page_title = 'Добавить группу груза';
    $menu_title = '';
    $capability = 'edit_posts';
    $menu_slug = 'cargo_group_add';
    $function = 'cargo_show_group_add';
  

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);
    remove_menu_page('cargo_group_add');
}

//Импорт грузов
function cargo_import_display(){
    
 
    include 'admin/cargo_import.php';
}

add_action('admin_menu', 'cargo_import_view');

function cargo_import_view(){
    $page_title = 'Импорт грузов';
    $menu_title = 'Импорт грузов';
    $capability = 'edit_posts';
    $menu_slug = 'cargo_import_view';
    $function = 'cargo_import_display';
    $icon_url = '';
    $position = 22;

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
}


function get_query_calc_arr() {
    $query_arr = [];

    if( isset($_GET['load_capacity']) && $_GET['load_capacity'] ) {
        $query_arr[] = "load_capacity = '" . $_GET['load_capacity'] . "'";
    }

    if( isset($_GET['body_type']) && $_GET['body_type'] ) {
        $query_arr[] = "body_type = '" . $_GET['body_type'] . "'";
    }

    if( isset($_GET['start_date']) && $_GET['start_date'] ) {
        $query_arr[] = "create_date >= '" . $_GET['start_date'] . "'";
    } 
    
    if( isset($_GET['end_date']) && $_GET['end_date'] ) {
        $query_arr[] = "create_date <= '" . $_GET['end_date'] . "'";
    }

    if( isset($_GET['utm_source']) && $_GET['utm_source'] ) {
        $query_arr[] = "utm_source = '" . $_GET['utm_source'] . "'";
    }

    if( isset($_GET['utm_medium']) && $_GET['utm_medium'] ) {
        $query_arr[] = "utm_medium = '" . $_GET['utm_medium'] . "'";
    }

    if( isset($_GET['utm_campaign']) && $_GET['utm_campaign'] ) {
        $query_arr[] = "utm_campaign = '" . $_GET['utm_campaign'] . "'";
    }

    return $query_arr;
}

function calc_prices_processing($active = null, $deleted = 0) {
    global $wpdb;

  
    $results_per_page = 10;

    
    $query_arr = get_query_calc_arr();    


    if(!empty($query_arr)){

        $get_par = '&' . implode('&', $query_arr);

        $query_arr[] = "deleted = $deleted";

        if($active === 1 || $active === 0) {
            $query_arr[] = "active = $active";
        }
        
        $query_str = implode(' AND ', $query_arr);

        $total_pages = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "calc_prices WHERE " . $query_str . " ORDER BY id DESC");
    
        $total_pages = ceil($total_pages/$results_per_page);
        
        if($total_pages > 1){

            if ($_GET["paged"]) $paged  = $_GET["paged"];
            else $paged=1; 
            $start_from = ($paged-1) * $results_per_page;
            $calc_prices = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "calc_prices WHERE " . $query_str . " ORDER BY id DESC LIMIT $start_from,$results_per_page");
            $navi = pagination_cargos('calc_prices_view', $paged, $get_par, $total_pages);
        }
        else {
            $calc_prices = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "calc_prices WHERE " . $query_str . " ORDER BY id DESC");
            $navi = '';
        }
    }

    
    elseif(isset($_GET['search']) && $_GET['search']){
        $search = $_GET['search'];

        $search_sql = "deleted = $deleted AND
            (point1 LIKE '%" . $search . "%' OR 
            point2 LIKE '%" . $search . "%' OR 
            fias1 LIKE '%" . $search . "%' OR 
            fias2 LIKE '%" . $search . "%')";
        
        if($active === 1 || $active === 0) {
            $search_sql .= " AND active = $active";
        }

        $total_pages = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "calc_prices WHERE " . $search_sql . " ORDER BY id DESC");
    
        $total_pages = ceil($total_pages/$results_per_page);
        $get_par = '&search=' . $_GET['search'];
        if($total_pages > 1){

            if ($_GET["paged"]) $paged  = $_GET["paged"];
            else $paged=1; 
            $start_from = ($paged-1) * $results_per_page;
            $calc_prices = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "calc_prices WHERE " . $search_sql .
            " ORDER BY id DESC LIMIT $start_from, $results_per_page");
            $navi = pagination_cargos('calc_prices_view', $paged, $get_par, $total_pages);
        }
        else {
            $calc_prices = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "calc_prices WHERE " . $search_sql . " ORDER BY id DESC");
            $navi = '';
        }
    }
    
    else {

        $sql_str = "deleted = $deleted";

        if($active === 1 || $active === 0) {
            $sql_str .= " AND active = $active";
        }

        $total_pages = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "calc_prices WHERE $sql_str ORDER BY id DESC");
        
        $total_pages = ceil($total_pages/$results_per_page);
        $get_par = '';
        if($total_pages > 1){

            if (isset($_GET["paged"]) && $_GET["paged"]) $paged  = $_GET["paged"];
            else $paged=1; 
            $start_from = ($paged-1) * $results_per_page;
            $calc_prices = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "calc_prices WHERE $sql_str ORDER BY id DESC LIMIT $start_from,$results_per_page");
            $navi = pagination_cargos('calc_prices_view', $paged, $get_par, $total_pages);
        }
        else {
            $calc_prices = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "calc_prices WHERE $sql_str ORDER BY id DESC");
            $navi = '';
        }
    }

    $load_capacities = $wpdb->get_results("SELECT DISTINCT load_capacity FROM " . $wpdb->prefix . "calc_prices");
    $body_types = $wpdb->get_results("SELECT DISTINCT body_type FROM " . $wpdb->prefix . "calc_prices");
    $utm_sources = $wpdb->get_results("SELECT DISTINCT utm_source FROM " . $wpdb->prefix . "calc_prices");
    $utm_mediums = $wpdb->get_results("SELECT DISTINCT utm_medium FROM " . $wpdb->prefix . "calc_prices");
    $utm_campaigns = $wpdb->get_results("SELECT DISTINCT utm_campaign FROM " . $wpdb->prefix . "calc_prices");

    return [
        'calc_prices' => $calc_prices,
        'navi' => $navi,
        'load_capacities' => $load_capacities,
        'body_types' => $body_types,
        'utm_sources' => $utm_sources,
        'utm_mediums' => $utm_mediums,
        'utm_campaigns' => $utm_campaigns,
    ];

}

function calc_prices_display(){
    
    $arr = calc_prices_processing();

    $title = 'Цены калькулятора';
    $calc_prices = $arr['calc_prices'];
    $navi = $arr['navi'];
    $load_capacities = $arr['load_capacities'];
    $body_types = $arr['body_types'];
    $utm_sources = $arr['utm_sources'];
    $utm_mediums = $arr['utm_mediums'];
    $utm_campaigns = $arr['utm_campaigns'];
 
    include 'admin/calc_prices_file.php';
}

function calc_prices_cart(){
    
    $arr = calc_prices_processing(null, 1);

    $title = 'Корзина';
    $calc_prices = $arr['calc_prices'];
    $navi = $arr['navi'];
    $load_capacities = $arr['load_capacities'];
    $body_types = $arr['body_types'];
    $utm_sources = $arr['utm_sources'];
    $utm_mediums = $arr['utm_mediums'];
    $utm_campaigns = $arr['utm_campaigns'];
 
    include 'admin/calc_prices_file.php';
}

function calc_prices_active(){
    
    $arr = calc_prices_processing(1);

    $title = 'Цены калькулятора - Активные';
    $calc_prices = $arr['calc_prices'];
    $navi = $arr['navi'];
    $load_capacities = $arr['load_capacities'];
    $body_types = $arr['body_types'];
    $utm_sources = $arr['utm_sources'];
    $utm_mediums = $arr['utm_mediums'];
    $utm_campaigns = $arr['utm_campaigns'];
 
    include 'admin/calc_prices_file.php';
}

function calc_prices_inactive(){
    
    $arr = calc_prices_processing(0);

    $title = 'Цены калькулятора - Неактивные';
    $calc_prices = $arr['calc_prices'];
    $navi = $arr['navi'];
    $load_capacities = $arr['load_capacities'];
    $body_types = $arr['body_types'];
    $utm_sources = $arr['utm_sources'];
    $utm_mediums = $arr['utm_mediums'];
    $utm_campaigns = $arr['utm_campaigns'];
 
    include 'admin/calc_prices_file.php';
}

//Страница Записи калькулятора в админ панели

add_action('admin_menu', 'calc_prices_view');

function calc_prices_view(){
    $page_title = 'Записи калькулятора';
    $menu_title = 'Записи калькулятора';
    $capability = 'edit_posts';
    $menu_slug = 'calc_prices_view';
    $function = 'calc_prices_display';
    $icon_url = '';
    $position = 23;

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);

    add_submenu_page( 
        'calc_prices_view', 
        'Активные', 
        'Активные', 
        'edit_posts', 
        'calc_prices_active', 
        'calc_prices_active', 
        1 
    );

    add_submenu_page( 
        'calc_prices_view', 
        'Неактивные', 
        'Неактивные', 
        'edit_posts', 
        'calc_prices_inactive', 
        'calc_prices_inactive', 
        2 
    );
    
    add_submenu_page( 
        'calc_prices_view', 
        'Корзина', 
        'Корзина', 
        'edit_posts', 
        'calc_prices_cart', 
        'calc_prices_cart', 
        3 
    );

}



// Подписки
function subscriptions_display(){
    global $wpdb;

  
    $results_per_page = 100;

    if($_GET['search']){
        $search = $_GET['search'];
        $total_pages = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "subscription_emails WHERE 
            email LIKE '%" . $search . "%'");
    
        $total_pages = ceil($total_pages/$results_per_page);
        $get_par = '';
        if($total_pages > 1){

            if ($_GET["paged"]) $paged  = $_GET["paged"];
            else $paged=1; 
            $start_from = ($paged-1) * $results_per_page;
            $subscriptions = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "subscription_emails WHERE email LIKE '%" . $search . "%'
            LIMIT $start_from, $results_per_page");
            $navi = pagination_cargos('subscriptions_view', $paged, $get_par, $total_pages);
        }
        else {
            $subscriptions = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "subscription_emails WHERE 
                email LIKE '%" . $search . "%'");
            $navi = '';
        }
    }
    
    else {

        $total_pages = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "subscription_emails");
        
        $total_pages = ceil($total_pages/$results_per_page);
        $get_par = '';
        if($total_pages > 1){

            if ($_GET["paged"]) $paged  = $_GET["paged"];
            else $paged=1; 
            $start_from = ($paged-1) * $results_per_page;
            $subscriptions = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "subscription_emails LIMIT $start_from,$results_per_page");
            $navi = pagination_cargos('subscriptions_view', $paged, $get_par, $total_pages);
        }
        else {
            $subscriptions = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "subscription_emails");
            $navi = '';
        }
    }

 
    include 'admin/subscriptions_file.php';
}

//Страница Подписки в админ панели

add_action('admin_menu', 'subscriptions_view');
function subscriptions_view(){
    $page_title = 'Подписки';
    $menu_title = 'Подписки';
    $capability = 'edit_posts';
    $menu_slug = 'subscriptions_view';
    $function = 'subscriptions_display';
    $icon_url = '';
    $position = 23;

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
}



function search_dadata_address($phrase) {
    global $optionsArr;

        $data = [
            'query' => $phrase,
            'from_bound' => ['value' => 'city' ],
            'to_bound' => ['value' => 'settlement' ],
            'locations' => [
                ['country_iso_code' => 'RU'],
                ['country_iso_code' => 'BY'],
                ['country_iso_code' => 'KZ'],
            ]
        ];
         
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);

        $ch = curl_init("https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Token " . $optionsArr['dadata_api_key'],
            "X-Secret: " . $optionsArr['dadata_secret_key'],
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);    
        $res = curl_exec($ch);
        curl_close($ch);    
            
        $responseData = json_decode($res, true);

        return $responseData;

}

function get_product_code($body_type, $load_capacity) {
    $product_code = NULL;
    $nomenclatures = get_field('calc_nomenclature', 41);
    if(!empty($nomenclatures)) {

        foreach ($nomenclatures as $nomenclature) {
            if($nomenclature['body_type'] == $body_type && $nomenclature['load_capacity'] == $load_capacity) {
                $product_code = $nomenclature['code'];
                break;
            }
        }
    }
    return $product_code;
}

function get_calc_price_route_p($p, $route_begin, $route_end, $route_begin_fias, $route_end_fias) {
    if($route_begin_fias && $route_end_fias) {
        
        return ($p == 1) ? $route_begin_fias : $route_end_fias;
        
    }
    elseif($route_begin_fias && !$route_end_fias) {
        
        return ($p == 1) ? $route_begin_fias : $route_end;
        
    }
    elseif(!$route_begin_fias && $route_end_fias) {
        
        return ($p == 1) ? $route_begin : $route_end_fias;
        
    }
    else {
        
        return ($p == 1) ? $route_begin_fias : $route_end_fias;
        
    }

    
}

function get_by_code($route_begin_fias, $route_end_fias) {
    if($route_begin_fias && $route_end_fias) {
        
        return 1;

    }
    elseif($route_begin_fias && !$route_end_fias) {
        
        return 'f';
        
    }
    elseif(!$route_begin_fias && $route_end_fias) {
        
        return 's';
        
    }
    else {
        
        return 0;
        
    }

}

function get_server_user_ip($server) {
    if (!empty($server['HTTP_CLIENT_IP'])) {
        return $server['HTTP_CLIENT_IP'];
    } 
    if (!empty($server['HTTP_X_FORWARDED_FOR'])) {
        return $server['HTTP_X_FORWARDED_FOR'];
    } 
    return $server['REMOTE_ADDR'];
    
}


add_filter( 'upload_mimes', 'upload_allow_types' );
function upload_allow_types( $mimes ) {
    $mimes['ico']  = 'image/vnd.microsoft.icon';
    return $mimes;
}

inactive_calc_prices($optionsArr['main_calc_price_days']);

function inactive_calc_prices($main_calc_price_days) {
    global $wpdb;
  
    $inactive_date = date('Y-m-d', strtotime("-" . $main_calc_price_days . " DAYS"));

    $wpdb->query("UPDATE " . $wpdb->prefix. "calc_prices SET active = 0 WHERE create_date < '" . $inactive_date . "'");
    $wpdb->query("UPDATE " . $wpdb->prefix. "calc_prices SET active = 1 WHERE create_date >= '" . $inactive_date . "'");
}

function is_phone_custom($phone) {
    $phone = preg_replace('/[^0-9]/', "", $phone);

    if (strlen($phone) != 11) {
        return false;
    }

    if ($phone[0] != 8 && $phone[0] != 7) {
        return false;
    }

    if ($phone[1] != 9 ) {
        return false;
    }

    return true;
}

function is_page_utm_double_custom() {
    global $optionsArr;
    global $_GET;

    if ($optionsArr['main_phone_double'] && ($_GET['utm_source'] || $_GET['utm_medium'] || $_GET['utm_campaign'])) {
        return true;
    }

    return false;
}

function get_utm_double_uri_custom($sign = '?') {
    global $_GET;
    $strArr = [];

    if(isset($_GET['utm_source']) && $_GET['utm_source']) {
        $strArr['utm_source'] = $_GET['utm_source'];
    }
    if(isset($_GET['utm_medium']) && $_GET['utm_medium']) {
        $strArr['utm_medium'] = $_GET['utm_medium'];
    }
    if(isset($_GET['utm_campaign']) && $_GET['utm_campaign']) {
        $strArr['utm_campaign'] = $_GET['utm_campaign'];
    }
    if(isset($_GET['utm_term']) && $_GET['utm_term']) {
        $strArr['utm_term'] = $_GET['utm_term'];
    }
    if(isset($_GET['utm_content']) && $_GET['utm_content']) {
        $strArr['utm_content'] = $_GET['utm_content'];
    }

    if (!empty($strArr)) {
        return $sign . http_build_query($strArr);
    }
 
    return;
}


add_filter( 'upload_mimes', 'svg_upload_allow' );

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}