<?php
if (!defined('ABSPATH')) {
	exit; // exit if accessed directly
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Default options page
$basic_options_container = Container::make('theme_options', 'theme_header_settings',  'Настройки темы')
	->add_fields(array(
		Field::make('header_scripts', 'crb_header_script', 'Header Script'),
		Field::make( 'association', 'header_categories', __( 'Категории в шапке' ) )
			->set_help_text("Выбрать только категории верхнего уровня")
			->set_types( array(
        array(
          'type' => 'term',
          'taxonomy' => 'categories',
          'parent_id' => 0,
        ),
	    ))
		// Field::make('footer_scripts', 'crb_footer_script', 'Footer Script'),
	));

// Add second options page under 'Basic Options'
Container::make('theme_options', 'theme_options', 'Настройки')
	->set_page_parent($basic_options_container) // reference to a top level container
	->add_tab('Ссылки', array(
		Field::make('text', 'viber_url', 'Viber')
			->set_width(50),
		Field::make('text', 'whatsapp_url', 'Whatsapp')
			->set_width(50),
		Field::make('text', 'vk_url', 'VK')
			->set_width(50),
		Field::make('text', 'youtube_url', 'YouTube')
			->set_width(50),
		Field::make('text', 'email', 'Email')
			->set_width(50),
		Field::make('text', 'phone', 'Телефон')
			->set_width(50),
		Field::make('textarea', 'worktime', 'Рабочее время')
			->set_width(50),
		Field::make('text', 'privacy_url', 'Политика конфиденциальности')
			->set_width(50),
		Field::make('textarea', 'leads_emails', 'Имейлы для заявок')
			->set_width(50),
		Field::make('image', 'default_og_img', 'Стандартная картинка для соцсетей')
			->set_width(50)
			->set_value_type('url'),
	))
	->add_tab('Адреса', array(
		Field::make('complex', 'contacts_cities', 'Города')
			->set_layout('tabbed-horizontal')
			->add_fields( array(
	      Field::make( 'text', 'city', __( 'Город' ) ),
				Field::make('complex', 'locations', 'Локации')
				->add_fields( array(
		      Field::make( 'text', 'title', __( 'Заголовок открытой карточки' ) ),
		      Field::make( 'text', 'address', __( 'Адрес' ) ),
		      Field::make( 'text', 'worktime', __( 'Рабочее время' ) ),
		      Field::make( 'text', 'phone', __( 'Телефон' ) ),
		      Field::make( 'text', 'email', __( 'Email' ) ),
		      Field::make( 'text', 'whatsapp', __( 'Whats App ссылка' ) ),
		      Field::make( 'text', 'viber', __( 'Viber ссылка' ) ),
		      Field::make( 'text', 'messenger_phone', __( 'Телефон мессенджеров' ) ),
				))
    ))
	))
	->add_tab('Базовые настройки страницы товара', array(
    Field::make( 'association', 'order_conditions', __( 'Условия заказа' ))
	    ->set_types(array(
        array(
          'type'      => 'post',
          'post_type' => 'faq',
        )
    )),
    Field::make( 'association', 'base_product_faq', __( 'ЧаВо' ))
	    ->set_types(array(
        array(
          'type'      => 'post',
          'post_type' => 'faq',
        )
    )),
	));
