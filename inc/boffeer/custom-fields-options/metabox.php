<?php
if (!defined('ABSPATH')) {
	exit; // exit if accessed directly
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Container::make('post_meta', 'Custom Data')
// 	->show_on_post_type('page')
// 	->show_on_template('templates/main-page.php')
// 	->add_fields(array(
// 		Field::make('image', 'crb_photo'),
// 	));

Container::make('post_meta', 'page_info', 'Страница')
	->add_fields(array(
		Field::make('text', 'page_title', 'Page title')
			->set_width(30),
		Field::make('textarea', 'page_description', 'Page description')
			->set_width(30),
		Field::make('image', 'og_image', 'og:image')
				->set_width(30)
			->set_value_type('url'),
		Field::make('radio', 'show_footer', __('Подвал'))
			->set_width(30)
			->set_default_value('Показывать')
			->set_options(
				array(
					'show' => "Показывать",
					'hide' => "Скрыть",
				)
			),
	));

Container::make('post_meta', 'stairs_info', 'Лестницы')
	->where('post_type', '=', 'stairs')
	->add_fields(array(
		Field::make('complex', 'stairs_variations', 'Вариации лестницы')
			->set_layout('tabbed-horizontal')
			->add_fields( array(
	      Field::make( 'text', 'title', __( 'Название вариации' ) ),
	      Field::make( 'image', 'photo', __( 'Картинка вариации' ) ),
	      Field::make( 'text', 'desc', __( 'Описание вариации' ) ),
				Field::make('complex', 'hotspots', 'Плюсики на кратинке вариации')
					->set_layout('tabbed-horizontal')
					->add_fields( array(
			      Field::make( 'image', 'photo', __( 'Кариации' ) ),
			      Field::make( 'text', 'title', __( 'Заголовок' ) ),
			      Field::make( 'text', 'desc', __( 'Описание' ) ),
					))
    ))
	));
Container::make('post_meta', 'stairs_info', 'Кейсы')
	->where('post_type', '=', 'stairs')
	->add_fields(array(
    Field::make( 'association', 'product_cases', __( 'Кейсы' ) )
	    ->set_types( array(
        array(
          'type'      => 'post',
          'post_type' => 'post',
        )
    ) )
  ));
Container::make('post_meta', 'stairs_info', 'Преимущества')
	->where('post_type', '=', 'stairs')
	->add_fields(array(
		Field::make('complex', 'stairs_features', 'Преимущества')
			->add_fields( array(
	      Field::make( 'text', 'suptitle', __( 'Над заголовокм' ) )
		      ->set_attribute('placeholder', 'Надежно'),
	      Field::make( 'text', 'title', __( 'Заголовок' ) ),
	      Field::make( 'rich_text', 'desc', __( 'Описание' ) ),
	      Field::make( 'image', 'photo', __( 'Большая картинка' ) ),
				Field::make('media_gallery', 'pics', __('Картинки под описанием'))
    )),
	));

/**
 * Reviews
 */
Container::make('post_meta', 'review_info', 'Отзывы')
	->where('post_type', '=', 'reviews')
	->add_fields(
		array(
			Field::make('text', 'review_name', 'Имя отзыва'),
			Field::make('text', 'review_link', 'Ссылка на отзыв'),
			Field::make('textarea', 'review_desc', 'Текст отзыва'),
			Field::make('image', 'review_photo', 'Фото отзыва')
				->set_width(30)
				->set_value_type('url'),
			Field::make('radio', 'stars', __('Звездность отзыва'))
				->set_width(30)
				->set_default_value('5')
				->set_options(
					array(
						'5' => 5,
						'4' => 4,
						'3' => 3,
						'2' => 2,
						'1' => 1,
					)
				),
			Field::make('media_gallery', 'review_gallery', __('Картинки отзыва'))
				->set_width(70)
				->set_type(array('image'))
				->set_duplicates_allowed(false),
		)
	);

