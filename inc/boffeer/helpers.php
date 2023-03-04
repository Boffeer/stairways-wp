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
	function get_crb_theme_options()
	{
		return array(
			'email' => carbon_get_theme_option('email'),
			'phone' => carbon_get_theme_option('phone'),
			'phone_href' => 'tel:' . carbon_get_theme_option('phone'),
			'phone_href_2' => 'tel:' . preg_replace('/\D/i', '', carbon_get_theme_option('phone')),
			'viber' => carbon_get_theme_option('viber_url'),
			'whatsapp' => carbon_get_theme_option('whatsapp_url'),	
			'youtube' => carbon_get_theme_option('youtube_url'),
			'vk' => carbon_get_theme_option('vk_url'),
			'privacy' => carbon_get_theme_option('privacy_url'),
			'worktime' => carbon_get_theme_option('worktime'),
			'address_list' => carbon_get_theme_option('address_list'),
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

if (!function_exists('explode_textarea_matrix')) :
	function explode_textarea_matrix($input)
	{
		$shift_enter = explode("\r\n\r\n", $input);
		return $shift_enter;
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

if (!function_exists('boffeer_get_image_url_by_id')) :
		function boffeer_get_image_url_by_id($id) {
			return wp_get_attachment_image_url($id, 'full');
		}
endif;
if (!function_exists('boffer_get_header_meta')) :
	function boffeer_get_header_meta() {
		ob_start(); ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<meta name="format-detection" content="telephone=no" />
		<?php
		$page_id = get_the_ID();
		$title = carbon_get_post_meta($page_id, 'page_title');
		$desc = carbon_get_post_meta($page_id, 'page_description');
		$og_image = carbon_get_post_meta($page_id, 'og_image');
		?>
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?php echo get_site_url(); ?>" />
		<?php if ($title) : ?>
			<title><?php echo $title; ?></title>
			<meta property="og:title" content="<?php echo $title; ?>" />
		<?php endif; ?>
		<?php if ($desc) : ?>
			<meta name="description" content="<?php echo $desc; ?>">
			<meta property="og:description" content="<?php echo $desc; ?>" />
		<?php endif; ?>
		<meta property="og:image" content="<?php echo $og_image; ?>" />
		<?php return ob_get_clean();
	}
endif;


if (!function_exists('get_multilevel_menu')) :
	function get_multilevel_menu($menu_id, $depth = 4) {
		$header_menu_id = $menu_id;
		$header_menu_items =  wp_get_nav_menu_items($header_menu_id, [
			'output_key'  => 'menu_order',
			'depth' => $depth,
		]);

		$top_menu = array();
		$relations = array();
		$has_children = array();
		foreach ($header_menu_items as $key => $item) {
			if (0 == $item->menu_item_parent) {
				$top_menu[] = $item;
			}
			foreach ($header_menu_items as $key_child => $child) {
				if ($item->db_id == $child->menu_item_parent) {
					$relations[$child->menu_item_parent][] = $child->db_id;
				}
			}
		}

		$submenus = array();
		foreach ($header_menu_items as $key => $item) {
			if (!in_array($item, $top_menu)) {
				$submenus[] = $item;
			}
		}

		foreach ($relations as $key => $item) {
			$has_children[] = $key;
		}

		foreach ($header_menu_items as $key => $item) {
			$current_item = $item;
			$header_menu_items[$key] = array(
				'item' => $item,
			);
			if (isset($relations[$item->db_id])) {
				$header_menu_items[$key]['children'] = $relations[$item->db_id];
			}
		}
		return $header_menu_items;
	}
endif;

function get_breadcrumbs()
{
	ob_start();
	$breadcrumbs = '';
	if (function_exists('yoast_breadcrumb')) {
		$breadcrumbs = yoast_breadcrumb('<ul class="breadcrumbs__list">', '</ul>', false);
		$search  = [
			'<span><a href',
			'</a></span>',
			'<span><span>',
			'<span class="breadcrumb_last" aria-current="page"',
			'</span></ul>',
			'<span>',
		];
		$replace = [
			'<li class="breadcrumbs__item"><a href',
			' </a></li>',
			'',
			'<li class="breadcrumbs__item"',
			'</ul>',
			'</span>',
		];
		$breadcrumbs  = str_replace($search, $replace, $breadcrumbs);
	}

	// if (get_the_id()) {
	// 	if (get_post_type(get_the_id()) == 'products') {
	// 		$breadcrumbs  = str_replace('Главная', 'Главная </a></li><li class="breadcrumbs-list__element"><a href="' . get_the_permalink(77) . '">Каталог', $breadcrumbs);
	// 	}
	// }
?>
	<div class="breadcrumbs container">
		<?php echo $breadcrumbs; ?>
	</div>
<?php
	return ob_get_clean();
}
