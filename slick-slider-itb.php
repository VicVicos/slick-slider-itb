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
?>
