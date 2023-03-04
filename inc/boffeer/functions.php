<?php

if (!function_exists('upload_allow_types')) :
	function upload_allow_types($mimes)
	{
			// разрешаем новые типы
			$mimes['svg']  = 'image/svg';
			$mimes['svg']  = 'image/svg+xml';
			$mimes['txt']  = 'text/plain';
			$mimes['pdf']  = 'application/pdf';
			$mimes['doc']  = 'application/msword';
			$mimes['docx']  = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';

			return $mimes;
	}
endif;


if (!function_exists('fix_svg_mime_type')) :
	function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
	{
		// WP 5.1 +
		if (version_compare($GLOBALS['wp_version'], '5.1.0', '>='))
			$dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
		else
			$dosvg = ('.svg' === strtolower(substr($filename, -4)));

		// mime тип был обнулен, поправим его
		// а также проверим право пользователя
		if ($dosvg) {

			// разрешим
			if (current_user_can('manage_options')) {

				$data['ext']  = 'svg';
				$data['type'] = 'image/svg+xml';
			}
			// запретим
			else {
				$data['ext'] = $type_and_ext['type'] = false;
			}
		}

		return $data;
	}
endif;


if (!function_exists('wpexplorer_remove_menus')) :
	function wpexplorer_remove_menus()
	{
		remove_menu_page('edit.php');
	}
endif;


define('THEME_URL', get_stylesheet_directory_uri());
define('THEME_STATIC', THEME_URL . '/static-bundle/dist');
define('FORM_URLS', array( 'mail' => get_stylesheet_directory_uri() . "/inc/mail.php"));


require_once get_template_directory() . "/inc/boffeer/helpers.php";
require_once get_template_directory() . '/inc/boffeer/helpers/text-helpers.php';

require_once get_template_directory() . "/inc/boffeer/stairways-post-types.php";

/**
 * Carbon Fields
 */
add_action('carbon_fields_register_fields', 'ast_register_custom_fields');
function ast_register_custom_fields()
{
	require get_template_directory() . '/inc/boffeer/custom-fields-options/metabox.php';
	require get_template_directory() . '/inc/boffeer/custom-fields-options/theme-options.php';
	define('THEME_OPTIONS', get_crb_theme_options());
}



add_action( 'wp_ajax_get_service', 'get_service' );
add_action( 'wp_ajax_nopriv_get_service', 'get_service' );
function get_service() {
	// $current_post = get_post($_POST['id']);
	$id = $_POST['id'];

	$gallery = array();
	foreach (carbon_get_post_meta($id, "service_gallery") as $key => $img) {
		$gallery[] = wp_get_attachment_url($img);
	}

	$bullets = array();
	foreach (boffeer_explode_textarea(carbon_get_post_meta($id, "service_desc")) as $key => $bullet) {
		$bullets[] = esc_html($bullet);
	}

	$service = array(
		"name" => carbon_get_post_meta($id, "service_name"),
		"badge" => "",
		"thumb" => false,
		"gallery" => $gallery,
		"bullets" => $bullets,
	);
	echo json_encode($service);
	die;
}

add_filter( 'wp_enqueue_scripts', 'change_default_jquery', PHP_INT_MAX );

function change_default_jquery( ){
    wp_dequeue_script( 'jquery');
    wp_deregister_script( 'jquery');   
}
