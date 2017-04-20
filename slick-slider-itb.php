<?php
/*
Plugin Name: Slick Slider itb
Description: Slick Slider for site
Plugin URI: http://vocis.ru
Author: Vicos
Author URI: http://vocis.ru
Version: 1.1
License: GPL2
*/

// Активация и деактивация плагина
include_once dirname( __FILE__ ) . '/ItbSlickAction.php';
include_once dirname( __FILE__ ) . '/helper.php';

register_activation_hook(__FILE__, array( 'ItbSlickAction', 'itbSlickActivate' ));
register_deactivation_hook(__FILE__, array('ItbSlickAction', 'itbSlickDeactivate'));

// Регистрируем фильтр и цепляем к ней функцию
//add_filter('the_content',  array('NdlBooking', 'getFormFilter'));

// Регистрируем shortcode
add_shortcode('slickitb', array('ItbSlick', 'slickitb'));
add_shortcode('slickitbhead', array('ItbSlick', 'slickitbhead'));
add_shortcode('slickitbfooter', array('ItbSlick', 'slickitbfooter'));

/*
 * Изменение вывода галереи через шоткод
 * Смотреть функцию gallery_shortcode в http://wp-kama.ru/filecode/wp-includes/media.php
 * $output = apply_filters( 'post_gallery', '', $attr );
 */
add_filter('post_gallery', 'my_gallery_output', 10, 2);
function my_gallery_output( $output, $attr ){
    $ids_arr = explode(',', $attr['ids']);
    $ids_arr = array_map('trim', $ids_arr );

    $pictures = get_posts( array(
        'posts_per_page' => -1,
        'post__in'       => $ids_arr,
        'post_type'      => 'attachment',
        'orderby'        => 'post__in',
    ) );
    if( ! $pictures ) return 'Запрос вернул пустой результат.';

    // Вывод
    $out = '<div class="wrp-gallery"><h2>' . $attr['name'] . '</h2><div class="gallery">';

    // Выводим каждую картинку из галереи
    foreach( $pictures as $pic ){
        $src = $pic->guid;
        $t = esc_attr( $pic->post_title );
        $title = ( $t && false === strpos($src, $t)  ) ? $t : '';

        $caption = ( $pic->post_excerpt != '' ? $pic->post_excerpt : $title );
        $out .= '<div><a href="'. $src .'" data-fancybox="gallery"><img src="'. kama_thumb_src('w=225&h=150&src='. $src ) .'" alt="'. $title .'" /></a></div>';
    }

    $out .= '</div></div>';
    return $out;
}
?>
