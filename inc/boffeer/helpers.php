<?php

if (!function_exists('get_home_link')) {
	function get_home_link()
	{
		if (is_front_page()) {
			return '#';
		} else {
			return home_url();
		}
	}
}

if (!function_exists('get_vd')) {
	function get_vd($vd)
	{
		echo '<pre>';
		var_dump($vd);
		echo '</pre>';
	}
}

if (!function_exists('get_crb_contacts')) {
	function get_crb_contacts()
	{
		return array(
			'email' => carbon_get_theme_option('email'),
			'phone' => carbon_get_theme_option('phone'),
			'phone_href' => 'tel:' . preg_replace('/\D/i', '', carbon_get_theme_option('phone')),
			'telegram' => carbon_get_theme_option('telegram_url'),
			'vk' => carbon_get_theme_option('vk_url'),
			'whatsapp' => carbon_get_theme_option('whatsapp_url'),	
			'yandex' => carbon_get_theme_option('y_services_url'),
			'avito' => carbon_get_theme_option('avito_url'),
			'privacy' => carbon_get_theme_option('privacy_url'),
			'designer_url' => carbon_get_theme_option('designer_url'),
			'worktime' => carbon_get_theme_option('worktime'),
			'og_default' => carbon_get_theme_option('default_og_img'),
		);
	}
}

if (!function_exists('get_alt_title')) {
	function get_alt_title()
	{
		return $_SERVER['SERVER_NAME'];
	}
}

if (!function_exists('boffeer_explode_textarea')) :
	/**
	 * Transform textarea saved as string to array where every new line is a item of the array
	 */
	function boffeer_explode_textarea($input)
	{
		return explode("\n", str_replace("\r", "", $input));
	}
endif;

if (!function_exists('explode_tinymc')) :
	function explode_tinymc($input)
	{
		$shift_enter = explode("\r\n\r\n", $input);
		return array_map('nl2br', $shift_enter);
	}
endif;

if (!function_exists('the_truncated_post')) {
	function the_truncated_post($symbol_amount = 100)
	{
		$filtered = strip_tags(preg_replace('@<style[^>]*?>.*?</style>@si', '', preg_replace('@<script[^>]*?>.*?</script>@si', '', apply_filters('the_content', get_the_content()))));
		return substr($filtered, 0, strrpos(substr($filtered, 0, $symbol_amount), ' ')) . '...';
	}
}

if (!function_exists('get_yt_id')) :
	function get_yt_id($url)
	{
		$url = parse_url($url, PHP_URL_QUERY);
		parse_str($url, $query_params);
		return $query_params['v'];
	}
endif;

if (!function_exists('get_youtube_id')) :
function get_youtube_id($url)
	{
		preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);

		echo $matches[1];
}
endif;

if (!function_exists('multi_format_thumbnail')) :
function multi_format_thumbnail($thumbnail_url, $post, $size)
{

		if (false == $thumbnail_url) {
			$thumbnail_url = get_field('default_product_img', 'options');
		}
		return $thumbnail_url;
}
endif;

if (!function_exists('nbsp_callback')) :
	function nbsp_callback($matches)
	{
		$newText = substr($matches[0], -1) == " " ? substr($matches[0], 0, -1) . "&nbsp;" : $matches[0];
		return $newText;
	}
endif;


if (!function_exists('get_nbsp_text')) :
	function nbsp_text($text)
	{
		$regexp = '/(?:^|[^а-яёА-ЯЁ0-9_])(за|из|в|без|а|до|к|я|на|но|по|о|от|что|перед|при|через|с|у|над|об|под|про|для|и|или|со)(?:^|[^а-яёА-ЯЁ0-9_])/u';

		$text = preg_replace_callback(
			$regexp,
			[$this, "nbsp_callback"],
			$text
		);

		return $text;
	}
endif;


if (!function_exists('get_search_hints')) :
function get_search_hints()
{
		if ($_GET['s'] == '') {
			return;
		}

		$max_hints_count = 8;

		$args = array(
			's' => wp_slash($_GET['s']),
			'post_type' => 'product',
			'posts_per_page' => $max_hints_count,
		);
		$hints = get_posts($args);
		// echo json_encode($hints);

		ob_start(); ?>
		<?php if (count($hints) > 0) : ?>
			<?php foreach ($hints as $hint) : ?>
				<a href="<?php the_permalink($hint->ID); ?>" class="search-form__item"><?php echo get_the_title($hint->ID); ?></a>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="search-form__item">Ничего не найдено</div>
		<?php endif; ?>
<?php echo ob_get_clean();
		wp_die();
}
endif;
