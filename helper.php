<?php
/**
 * Класс NdlBooking
 */
class ItbSlick
{
	/**
	 * Отображение слайдера
	 * @return html
	 */
	public static function slickitb ($atts, $content)
	{
		$atts = shortcode_atts(
		    array(
		        'id' => 0,
                'title' => '',
                'text' => '',
                'link' => '#',
                'count' => '1'
            ),
                $atts,
                'slickitb'
        );
		return self::getHtml($atts, $content);
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
	static function getHtml ($atts, $content)
	{
	    $title = '';
	    $link = '';
	    $id = 0;
        extract($atts);
        $img = self::get_img($id);

        if ($img == '') {
            return false;
        }

        $patternValue = [
            0 => '%guid%',
            1 => '%meta_value%',
            2 => '%title%',
            3 => '%content%',
            4 => '%link%'
        ];
        $values = [
            0 => $img->guid,
            1 => $img->meta_value,
            2 => $title,
            3 => $content,
            4 => $link
        ];
		$preHtml = '<div>
                        <img src="%guid%" alt="%meta_value%" />
                        <div class="slide-content">
                            <p class="title">%title%</p>
                            <div>%content%</div>
                            <a href="%link%" class="btn btn-b-orange">Подробнее</a>
                        </div>
                    </div>';
        $html = str_replace($patternValue , $values, $preHtml);
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
