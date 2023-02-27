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

/*

	Page

*/
Container::make('post_meta', 'page_info', 'Страница')
	->add_fields(array(
		Field::make('text', 'page_title', 'Заголовок для соцсетей')
			->set_width(30),
		Field::make('textarea', 'page_description', 'Описание для соцсетей')
			->set_width(30),
		Field::make('image', 'og_image', 'Картинка для соцсетей — og:image')
			->set_width(30)
			->set_value_type('url'),
	));

/*

	Stairs
	
*/
Container::make('post_meta', 'stairs_info', 'Лестницы')
	->where('post_type', '=', 'stairs')
	->add_fields(array(
		Field::make('complex', 'stairs_variations', 'Вариации лестницы')
			->set_layout('tabbed-horizontal')
			->add_fields( array(
	      Field::make( 'text', 'title', __( 'Название вариации' ) ),
	      Field::make( 'image', 'photo', __( 'Картинка вариации' ) ),
	      Field::make( 'textarea', 'desc', __( 'Описание вариации' ) ),
				Field::make('complex', 'hotspots', 'Плюсики на кратинке вариации')
					->set_layout('tabbed-horizontal')
					->add_fields( array(
			      Field::make( 'image', 'photo', __( 'Кариации' ) ),
			      Field::make( 'text', 'title', __( 'Заголовок' ) ),
			      Field::make( 'textarea', 'desc', __( 'Описание' ) ),
					))
    ))
	));

Container::make('term_meta', 'stairs_category_info', 'Категория')
	// ->where('post_type', '=', 'stairs')
	->where('term_taxonomy', '=', 'categories')
	->add_fields(array(
    Field::make( 'image', 'category_pic', __( 'Картинка категории' ) )
	));


Container::make('post_meta', 'stairs_cases', 'Кейсы')
	->where('post_type', '=', 'stairs')
	->add_fields(array(
    Field::make( 'association', 'product_cases', __( 'Кейсы' ) )
	    ->set_types( array(
        array(
          'type'      => 'post',
          'post_type' => 'cases',
        )
    ) )
  ));
Container::make('post_meta', 'c_stairs_features', 'Преимущества')
	->where('post_type', '=', 'stairs')
	->add_fields(array(
		Field::make('complex', 'stairs_features', 'Преимущества')
			->add_fields( array(
	      Field::make( 'text', 'suptitle', __( 'Над заголовокм' ) )
		      ->set_attribute('placeholder', 'Надежно'),
	      Field::make( 'text', 'title', __( 'Заголовок' ) ),
	      Field::make( 'textarea', 'desc', __( 'Описание' ) ),
	      Field::make( 'image', 'photo', __( 'Большая картинка' ) ),
				Field::make('media_gallery', 'pics', __('Картинки под описанием'))
    )),
	));


/*

	Cases
	
*/
Container::make('post_meta', 'cases_info', 'О кейсе')
	->where('post_type', '=', 'cases')
	->add_fields(array(
			Field::make('media_gallery', 'gallery', __('Фото кейсов')),
      Field::make( 'text', 'title', __( 'Название' ) ),
      Field::make( 'textarea', 'stats', __( 'Характеристики' ) ),
      Field::make( 'textarea', 'desc', __( 'Описание' ) ),
	));

/**
 * Reviews
 */
Container::make('post_meta', 'review_info', 'Отзывы')
	->where('post_type', '=', 'reviews')
	->add_fields(
		array(
			Field::make('text', 'review_name', 'Имя отзыва'),
			Field::make('text', 'review_city', 'Город отзыва'),
			Field::make('textarea', 'review_desc', 'Текст отзыва'),
			Field::make('media_gallery', 'review_gallery', __('Картинки отзыва'))
				->set_width(70)
				->set_type(array('image'))
				->set_duplicates_allowed(false),
		)
	);

