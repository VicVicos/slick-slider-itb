<?php
/*
Plugin Name: Slick Slider itb
Description: Slick Slider for site
Plugin URI: http://vocis.ru
Author: Vicos
Author URI: http://vocis.ru
Version: 1.0
License: GPL2
*/

// Активация и деактивация плагина
include_once dirname( __FILE__ ) . '/ItbSlickAction.php';
include_once dirname( __FILE__ ) . '/helper.php';

register_activation_hook(__FILE__, array( 'ItbSlickAction', 'itbSlickActivate' ));
register_deactivation_hook(__FILE__, array('ItbSlickAction', 'itbSlickDeactivate'));

// Регистрируем фильтр и цепляем к ней функцию
//add_filter('the_content',  array('NdlBooking', 'getFormFilter'));

//do_action('get_post_data_vbv', $data);

// Регистрируем shortcode
add_shortcode('slickitb', array('ItbSlick', 'slickitb'));
add_shortcode('slickitbhead', array('ItbSlick', 'slickitbhead'));
add_shortcode('slickitbfooter', array('ItbSlick', 'slickitbfooter'));
// add_shortcode('booking_quick', array('NdlBooking', 'booking_quick'));
// add_shortcode('booking_contact', array('NdlBooking', 'booking_contact'));

?>
