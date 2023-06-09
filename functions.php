<?php
/**
 * stairways functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package stairways
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function stairways_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on stairways, use a find and replace
		* to change 'stairways' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'stairways', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'clients' => esc_html__( 'Клиентам — clients', 'stairways' ),
			'about' => esc_html__( 'О нас — about', 'stairways' ),
			'footer_clients' => esc_html__( 'Клиентам в подвале — footer_clients', 'stairways' ),
			'products' => esc_html__( 'Лестницы — products', 'stairways' ),
			'footer_company' => esc_html__( 'О нас в подвале — footer_company', 'stairways' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'stairways_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function stairways_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'stairways_content_width', 640 );
}
add_action( 'after_setup_theme', 'stairways_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function stairways_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'stairways' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'stairways' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
// add_action( 'widgets_init', 'stairways_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function stairways_scripts() {
	wp_enqueue_style( 'stairways-style', THEME_STATIC . "/css/style.css", array(), _S_VERSION );
	wp_enqueue_script( 'stairways-scripts', THEME_STATIC . '/js/index.js', array(), _S_VERSION, true );

	$contacts_cities = carbon_get_theme_option('contacts_cities');
	$phones = array();
	foreach ($contacts_cities as $city) {

		$tel = THEME_OPTIONS['phone'];

		if (isset($city['locations'][0])) {
			$tel = $city['locations'][0]['phone'];
		}

		$phones[$city['city']] = array(
			'href' => get_phone_href($tel),
			'text' => $tel,
		);
	}

  $data = [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'phones' => $phones,
	];
	wp_add_inline_script( 'stairways-scripts', 'const stairways = ' . wp_json_encode( $data ), 'before' );
}
add_action( 'wp_enqueue_scripts', 'stairways_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/** * Customizer additions. */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/**
 * Boffeer Functions
 */
require get_template_directory() . '/inc/boffeer/functions.php';

/**
 * Stairs Functions
 */
require get_template_directory() . '/inc/stairs-functions.php';
require get_template_directory() . '/inc/categories-functions.php';
require get_template_directory() . '/inc/cases-functions.php';
require get_template_directory() . '/inc/videos-functions.php';
require get_template_directory() . '/inc/stairs-shortcodes.php';
