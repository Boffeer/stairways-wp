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

$shortcode_help_text = 'Чтобы добавиь ссылку, напишите [link href="полная ссылка"]Текст текст ссылки[/link]';

/*

	Page

*/
Container::make('post_meta', 'page_info', 'Страница')
	->where('post_type', '!=', 'faq')
	->add_fields(array(
		Field::make('text', 'page_title', 'Заголовок для соцсетей')
			->set_width(30),
		Field::make('textarea', 'page_description', 'Описание для соцсетей')
			->set_width(30),
		Field::make('image', 'og_image', 'Картинка для соцсетей — og:image')
			->set_width(30)
			->set_value_type('url'),
	));

Container::make('post_meta', 'home_info', 'Настройки главной')
	->where('post_id', '=', '34')
	->or_where('post_id', '=', '39')
	->add_fields(array(
		    Field::make( 'association', 'home_categories', __( 'Категории на первом экране' ) )
		    	->set_max(4)
			    ->set_types( array(
		        array(
		          'type' => 'term',
		          'taxonomy' => 'categories',
		          'parent_id' => 0,
		        )
		    ) )
	))
	->add_fields(array(
		Field::make('complex', 'cases_favorite', 'Избранные примеры работ')
			->set_help_text('Выноска и видео отобразится только у 1, 3 и 5 работы, если не добавлять особую картинку, отобразится стандартная')
			->set_layout('tabbed-horizontal')
			->add_fields( array(
		    Field::make( 'association', 'case', __( 'Кейс' ) )
		    	->set_max(1)
			    ->set_types( array(
		        array(
		          'type'      => 'post',
		          'post_type' => 'cases',
		        )
		    ) ),
	      Field::make( 'image', 'photo', __( 'Особая картинка для главной' ) )
	      	->set_width(50),
	      Field::make( 'textarea', 'desc', __( 'Выноска описание' ) )
	      	->set_width(50),
	      Field::make( 'text', 'video_url', __( 'Ссылка на видео' ) ),
    )),
	))
	->add_fields(array(
		    Field::make( 'association', 'home_reviews', __( 'Отзывы' ) )
			    ->set_types( array(
		        array(
		          'type'      => 'post',
		          'post_type' => 'reviews',
		        )
		    ) )
	))
	->add_fields(array(
		    Field::make( 'media_gallery', 'why_gallery', __( 'Картинки в блоке с «Почему выбирают нас»' ) ),
		    Field::make( 'association', 'why_faq', __( 'ЧаВо в блоке «Почему выбирают нас»' ) )
			    ->set_types( array(
		        array(
		          'type'      => 'post',
		          'post_type' => 'faq',
		        )
		    ) ),
	))
	->add_fields(array(
		    Field::make( 'association', 'home_faq', __( 'ЧаВо внизу страницы' ) )
			    ->set_types( array(
		        array(
		          'type'      => 'post',
		          'post_type' => 'faq',
		        )
		    ) )
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
	      Field::make( 'textarea', 'desc', __( 'Описание вариации' ) )
	      	->set_help_text($shortcode_help_text),
				Field::make( 'complex', 'hotspots', 'Плюсики на кратинке вариации')
					->set_layout('tabbed-horizontal')
					->add_fields( array(
			      Field::make( 'image', 'photo', __( 'Вариации' ) ),
			      Field::make( 'text', 'title', __( 'Заголовок' ) ),
			      Field::make( 'textarea', 'desc', __( 'Описание' ) ),
			      Field::make( 'text', 'x_offset', __( 'Горизонтальный отступ' ) )
				      ->set_width(50),
			      Field::make( 'text', 'y_offset', __( 'Вертикальный отступ' ) )
				      ->set_width(50),
					))
    )),
    Field::make( 'association', 'stairs_faq', __( 'ЧаВо для этой лестницы' ) )
	    ->set_types( array(
        array(
          'type'      => 'post',
          'post_type' => 'faq',
        )
    )),
	  Field::make( 'textarea', 'accuracy_title', __( 'Заголовок до блока с болтами' ) )
	  	->set_width(30)
	  	->set_default_value("Каркас вырезаем
на автоматическом
ленточнопильном станке"),
	  Field::make( 'textarea', 'accuracy_bullets', __( 'Буллеты до блока с болтами' ) )
	  	->set_width(40)
	  	->set_default_value("Все элементы каркаса мы вырезаем на автоматическом ленточнопильном станке с ЧПУ. Это самый качественный и точный способ изготовить лестницу.

Элементы из листа вырезаются только с помощью лазерной резки и имеют точную конфигурацию и красивый внешний вид."),
	  Field::make( 'textarea', 'accuracy_hint', __( 'Подсказка до блока с болтами' ) )
	  	->set_width(30)
	  	->set_default_value("Погрешность при использовании
такого станка не превышает 0,1 мм на метр"),
	  Field::make( 'radio', 'bolts_visibility', __( 'Блок с болтами' ) )
			->set_options( array(
				'show' => __('Отображать'),
				'hide' => __('Скрыть'),
		)),
	  Field::make( 'radio', 'pretty_visibility', __( 'Блок «красиво» с цветами' ) )
			->set_options( array(
				'show' => __('Отображать'),
				'hide' => __('Скрыть'),
		)),
	));

Container::make('term_meta', 'stairs_category_info', 'Категория')
	// ->where('post_type', '=', 'stairs')
	->where('term_taxonomy', '=', 'categories')
	->add_fields(array(
    Field::make( 'image', 'category_pic', __( 'Картинка категории' ) )
	));


// Container::make('post_meta', 'stairs_cases', 'Кейсы')
// 	->where('post_type', '=', 'stairs')
// 	->add_fields(array(
//     Field::make( 'association', 'product_cases', __( 'Кейсы' ) )
// 	    ->set_types( array(
//         array(
//           'type'      => 'post',
//           'post_type' => 'cases',
//         )
//     ) )
//   ));
Container::make('post_meta', 'c_stairs_features', 'Преимущества')
	->where('post_type', '=', 'stairs')
	->add_fields(array(
		Field::make('complex', 'stairs_features', 'Преимущества')
			->setup_labels(array(
		    'plural_name' => 'преимущества',
		    'singular_name' => 'преимущество',
			))
			->add_fields( array(
	      Field::make( 'text', 'suptitle', __( 'Над заголовокм' ) )
		      ->set_attribute('placeholder', 'Надежно'),
	      Field::make( 'text', 'title', __( 'Заголовок' ) ),
	      Field::make( 'textarea', 'desc', __( 'Описание' ) ),
	      Field::make( 'image', 'photo', __( 'Большая картинка' ) ),
				Field::make('media_gallery', 'pics', __('Картинки под описанием'))
	    ))
			->set_help_text('В нечетных картинка справа, в четных — слева'),
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

/*
	Videos
*/
Container::make('post_meta', 'video_info', 'О видео')
	->where('post_type', '=', 'videos')
	->add_fields(array(
      Field::make( 'image', 'thumb', __( 'Обложка видео' ) )
      	->set_help_text('Если не добавлять, то автоматически поставит обложку видео с ютуба'),
      Field::make( 'text', 'video_url', __( 'Ссылка на видео на YoutTube' ) ),
	));

/*
	News
*/
Container::make('post_meta', 'video_info', 'О новости')
	->where('post_type', '=', 'news')
	->add_fields(array(
      Field::make( 'image', 'thumb', __( 'Обложка новости' ) ),
	));

/*
	Faq
*/
Container::make('post_meta', 'faq', 'Ворпос и ответ')
	->where('post_type', '=', 'faq')
	->add_fields(array(
      Field::make( 'image', 'thumb', __( 'Иконка вопроса' ) )
      	->set_width(30)
				->set_help_text('Не обязательна'),
			Field::make('text', 'question', 'Вопрос')
				->set_width(70)
				->set_help_text('Этот текст вопроса отобразится на сайте'),
			Field::make('textarea', 'answer', 'Ответ')
				->set_help_text('Тест добавится с сохранением всех переносов строк, сделанных вручную нажатием энтера'),
	));
