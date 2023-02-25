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
Container::make('theme_options', 'theme_options', 'Контакты')
	->set_page_parent($basic_options_container) // reference to a top level container
	->add_tab('Contacts', array(
		Field::make('text', 'whatsapp_url', 'Whatsapp')
			->set_width(50),
		Field::make('text', 'telegram_url', 'Telegram')
			->set_width(50),
		Field::make('text', 'vk_url', 'VK')
			->set_width(50),
		Field::make('text', 'y_services_url', 'Яндекс.услуги')
			->set_width(50),
		Field::make('text', 'avito_url', 'Авито')
			->set_width(50),
		Field::make('text', 'email', 'Email')
			->set_width(50),
		Field::make('text', 'phone', 'Телефон')
			->set_width(50),
		Field::make('text', 'designer_url', 'Ссылка на дизайнера')
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
	));
