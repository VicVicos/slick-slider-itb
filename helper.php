<?php
/**
 * Класс NdlBooking
 */
class ItbSlick
{
	//static $dir = '/wp-content/plugins/ndl-booking/';
	/**
	 * Отображение слайдера
	 * @return html
	 */
	public static function slickitb ($atts)
	{
		$atts = shortcode_atts(array('id' => 0, 'title' => '', 'text' => '', 'link' => '#', 'count' => '1') , $atts, 'slickitb');
		return self::getHtml($atts);
	}
    /**
	 * Обёркти head
	 * @return html
	 */
	public static function slickitbhead ($atts)
	{
		$atts = shortcode_atts(array('class' => 'none') , $atts, 'slickitbhead');
        $class = $atts['class'];
		return '<div class="' . $class . '">';
	}
    /**
	 * Отображение обёртки footer
	 * @return html
	 */
	public static function slickitbfooter ()
	{
		return '</div>';
	}

	/**
	 * Выводим форму
	 * @return str html формы отправки
	 */
	static function getHtml ($atts)
	{
        extract($atts);
		$path = $_SERVER['HTTP_HOST'];
		$html = "";
        $img = self::get_img($id);
        // var_dump($img);
        if ($img == '') {
            return false;
        }
		// Началдо формы
		$html .= '<div class="slide-' . $count .'">
                        <div class="content">
                            <p>' . $title . '</p>
                            <p>' . $text . '</p>
                            <a href="#" class="btn" data-toggle="modal" data-target="#modal">Заказать</a>
                        </div>
                        <img src="' . $img->guid . '" alt="' . $img->meta_value . '" />
                    </div>';
		return $html;
	}
    /**
     * Получение img по её id
     * @method get_img
     * @param  id  $id id изображения
     * @return object  Данные
     */
    static function get_img ($id)
    {
    	global $wpdb;
		$strSelect = "SELECT t1.guid, t1.post_excerpt, t1.post_content, t1.post_title, t2.meta_value
			FROM $wpdb->posts AS t1
			INNER JOIN $wpdb->postmeta AS t2
			WHERE t1.ID = $id
			AND t1.ID = t2.post_id
			AND t2.meta_key = '_wp_attached_file';";
		$path = $wpdb->get_results($strSelect, OBJECT);
		$path = $path['0'];
    	return $path;
    }
}
?>
