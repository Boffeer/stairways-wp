<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package stairways
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="https://gmpg.org/xfn/11">
  <meta name="format-detection" content="telephone=no">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="wrapper">
<div class="menu-city">
    <?php $cities = carbon_get_theme_option('contacts_cities'); ?>
    <p class="menu-city__text">Ваш город — </p>
    <svg class="menu-city__icon" width="12" height="17" viewBox="0 0 12 17" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5.99866 1C2.42773 1 0.401808 4.1275 1.15707 7.45201C1.69496 9.81942 4.94308 16 5.99869 16C6.98499 16 10.294 9.81741 10.8403 7.45201C11.6005 4.15991 9.59051 1 5.99866 1ZM6.00018 7.85256C4.96926 7.85256 4.13373 7.00386 4.13373 5.95662C4.13373 4.90937 4.96926 4.06067 6.00018 4.06067C7.03111 4.06067 7.86664 4.90937 7.86664 5.95662C7.86664 7.00386 7.03111 7.85256 6.00018 7.85256Z" stroke="#69788C"/>
    </svg>
    <span class="menu-city__add-c"><span class="city-picker__current">Москва?</span></span>
    <button class="menu-city__btn">
        <svg width="6" height="8" viewBox="0 0 6 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 1L4 4L1 7" stroke="white" stroke-width="2"/>
        </svg>            
    </button>
    <div class="menu-city__popup-list" data-parent-block>
        <div class="menu-city__popup-list--block">
            <div class="menu-city__popup-list--top">
                <p class="menu-city__popup-list--title">Выбор города</p>
                <button class="esc-block" data-esc>
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 4.66688L10.6669 0L12 1.33312L7.33312 6L12 10.6669L10.6669 12L6 7.33312L1.33312 12L0 10.6669L4.66688 6L0 1.33312L1.33312 0L6 4.66688Z" fill="#2B3B50"/>
                </svg>                            
            </button>
            </div>
            <div class="menu-city__popup-list--bottom">
                <ul class="city_block__list">
                    <?php foreach ($cities as $city) : ?>
                        <li class="city-picker__element city_block__list-element <?php echo $city['city'] === 'Москва' ? '_active' : ''?>" data-city="<?php echo $city['city']; ?>">
                            <?php echo $city['city']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<header class="header">
    <div class="header__container container">

        <div class="header__mobile">
            <a href="<?php echo get_home_link(); ?>" class="logo header__logo">
                <picture class="logo__pic">
                    <img src="<?php echo THEME_STATIC; ?>/img/common/logo.svg" alt="Первя ступень" class="logo__img">
                </picture>
            </a>
            <button class="gamburger">
              <span></span><span></span><span></span>
          </button>
        </div>
        <div class="header__desc">
            <div class="header__top">
                <nav class="header__nav header__top-nav">
                    <ul class="header__nav-list">
                        <li class="header__nav-item">
                            <div class="dropdown city-picker">
                                <span class="dropdown--title city-picker__current" data-dropdown> г. Москва</span>
                                <div class="dropdown__body">
                                    <h2 class="dropdown__body-title">Выбор города</h2>
                                    <ul class="dropdown__body--list">
                                        <?php foreach ($cities as $city) : ?>
                                            <li class="city-picker__element dropdown__body--list-element <?php echo $city['city'] === 'Москва' ? '_active' : ''?>" data-city="<?php echo $city['city']; ?>">
                                                <?php echo $city['city']; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <?php
                            $clients_pages_menu_id = get_nav_menu_locations()['clients']; 
                            $header_menu = wp_get_nav_menu_items($clients_pages_menu_id);
                        ?>
                        <?php if (is_array($header_menu)) : foreach ($header_menu as $nav) : ?>
                            <li class="header__nav-item">
                                <a href="<?php echo $nav->url;?>" class="header__nav-link <?php echo $nav->object_id == get_the_ID() ? 'header__nav-link--current' : ''?>"><?php echo $nav->title; ?></a>
                            </li>
                        <?php endforeach; endif; ?>
                    </ul>
                </nav>
                <div class="header__contacts">
                    <a href="#quiz" class="header__contacts-calc">
                        <svg class="header__contacts-calc-icon">
                            <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/rocket.svg#rocket"></use>
                          </svg>
                        <span class="button__text">Рассчитать стоимость за 10 минут</span>
                    </a>
                    <a href="<?php echo THEME_OPTIONS['phone_href']; ?>" class="header__contacts-call">
                        <span class="_only-desktop"><?php echo THEME_OPTIONS['phone'] ?></span>
                        <span class="_only-mobile">Позвонить нам</span>
                    </a>
                </div>
            </div>

            <div class="header__bottom">
                <a href="<?php echo get_home_link(); ?>" class="logo header__logo">
                    <picture class="logo__pic">
                        <img src="<?php echo THEME_STATIC; ?>/img/common/logo.svg" alt="Первя ступень" class="logo__img">
                    </picture>
                </a>
                <nav class="header__nav header__bottom-nav">
                    <?php 
                        $header_categories = carbon_get_theme_option('header_categories');
                        $header_categories_ids = array();
                        
                        foreach ($header_categories as $category) :
                            $header_categories_ids[] = $category['id'];
                        endforeach;

                        $header_categories = get_terms(array(
                            'orderby' => 'none',
                            'taxonomy' => 'categories',
                            'hide_empty'    => false,
                            'include' => $header_categories_ids,
                        ));
                    ?>
                    <ul class="header__nav-list">
                        <?php foreach ($header_categories as $category) : ?>
                            <?php
                                $child_categories = get_terms(array(
                                    'orderby' => 'none',
                                    'taxonomy' => 'categories',
                                    'hide_empty'    => false,
                                    'parent' => $category->term_id,
                                ));
                            ?>
                            <?php if (!empty($child_categories)) : ?>
                            <li class="header__nav-item" data-catalog>
                                <div class="dropdown dropdown--variable">
                                    <span class="dropdown--title" data-dropdown><?php echo $category->name; ?></span>
                                    <div class="dropdown__body dropdown__body--wide">
                                        <ul class="dropdown__body--list">
<!--                                             <li class="dropdown__body--list-element">
                                                <?php $category_image_id = carbon_get_term_meta($category->term_id, 'category_pic'); ?>
                                                <?php if ($category_image_id != '') : ?>
                                                    <img
                                                        src="<?php echo boffeer_get_image_url_by_id($category_image_id); ?>"
                                                        alt="<?php echo $category->name; ?>"
                                                        class="dropdown__body--list-element-img">
                                                <?php endif;?>
                                                <a href="<?php echo get_term_link($category->term_id)?>"><?php echo $category->name; ?></a>
                                            </li>
 -->                                            
                                            <?php foreach ($child_categories as $child) : ?>
                                            <li class="dropdown__body--list-element">
                                                <?php $child_category_image_id = carbon_get_term_meta($child->term_id, 'category_pic'); ?>
                                                <?php if ($child_category_image_id != '') : ?>
                                                    <img
                                                        src="<?php echo boffeer_get_image_url_by_id($child_category_image_id); ?>"
                                                        alt="<?php echo $child->name; ?>"
                                                        class="dropdown__body--list-element-img">
                                                <?php endif;?>
                                                <a href="<?php echo get_term_link($child->term_id)?>"><?php echo $child->name; ?></a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <?php else : ?>
                                <li class="header__nav-item" data-catalog>
                                    <a href="<?php echo get_term_link($category->term_id)?>" class="header__nav-link">
                                        <?php echo $category->name; ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>

                    <?php
                        $about_menu_id = get_nav_menu_locations()['about']; 
                        $header_about_menu = wp_get_nav_menu_items($about_menu_id);
                    ?>
                    <?php if (is_array($header_about_menu)) : if (!empty($header_about_menu)) : ?>
                        <ul class="header__nav-list">
                            <?php foreach ($header_about_menu as $nav) : ?>
                                <li class="header__nav-item">
                                    <a href="<?php echo $nav->url;?>" class="header__nav-link"><?php echo $nav->title; ?></a>
                                    <?php /*
                                    <a href="#" class="header__nav-link header__nav-link-dropdown">О компании</a>
                                    <span class="button-more">
                                        <span class="button-more__dot"></span>
                                        <span class="button-more__dot"></span>
                                        <span class="button-more__dot"></span>
                                    </span>
                                    */ ?>
                                    <?php /* Убирает временно меню
                                    <ul class="header__nav-list__dropdown-block">
                                        <li class="header__nav-list__dropdown-element">
                                            <a class="header__nav-list__dropdown-link" href="">Производство</a>
                                        </li>
                                        <li class="header__nav-list__dropdown-element _active">
                                            <a class="header__nav-list__dropdown-link" href="">Статьи</a>
                                        </li>
                                        <li class="header__nav-list__dropdown-element">
                                            <a class="header__nav-list__dropdown-link" href="">Вакансии</a>
                                        </li>
                                        <li class="header__nav-list__dropdown-element">
                                            <a class="header__nav-list__dropdown-link" href="">Контакты</a>
                                        </li>
                                    </ul>
                                    */
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; endif; ?>
                </nav>
            </div>
            <div class="header_mobile_menu" data-parent-block>
                <div class="header_mobile_menu__block">
                    <button class="esc-block" data-esc>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 4.66688L10.6669 0L12 1.33312L7.33312 6L12 10.6669L10.6669 12L6 7.33312L1.33312 12L0 10.6669L4.66688 6L0 1.33312L1.33312 0L6 4.66688Z" fill="#2B3B50"/>
                        </svg>                            
                    </button>
                    <a href="<?php echo get_home_link(); ?>" class="logo header__logo header_mobile_menu__logo">
                        <picture class="logo__pic">
                            <img src="<?php echo THEME_STATIC; ?>/img/common/logo.svg" alt="Первя ступень" class="logo__img">
                        </picture>
                    </a>
                    <ul class="header_mobile_menu__list-catalog">
                        <?php foreach ($header_categories as $category) : ?>
                            <?php
                                $child_categories = get_terms(array(
                                    'orderby' => 'none',
                                    'taxonomy' => 'categories',
                                    'hide_empty'    => false,
                                    'parent' => $category->term_id,
                                ));
                            ?>
                                <li class="header_mobile_menu__list-element <?php echo isCurrentUrlMatch(get_term_link($category->term_id)) ? '_active' : '';?>">
                                    <a href="<?php echo get_term_link($category->term_id); ?>">
                                        <?php echo $category->name;?>
                                    </a>
                                </li>
                            <?php if (!empty($child_categories)) : ?>
                                <?php foreach ($child_categories as $child) : ?>
                                    <li class="header_mobile_menu__list-element <?php echo isCurrentUrlMatch(get_term_link($child->term_id)) ? '_active' : '';?>">
                                        <a href="<?php echo get_term_link($child->term_id);?>"><?php echo $child->name; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </ul>

                    <ul class="header_mobile_menu__list-all-menu">
                        <?php foreach ($header_menu as $nav) : ?>
                            <li class="header_mobile_menu__list-all-element <?php echo isCurrentUrlMatch($nav->url) ? '_active' : '';?>">
                                <a href="<?php echo $nav->url;?>"><?php echo $nav->title; ?></a>
                            </li>
                        <?php endforeach; ?>
                        <?php foreach ($header_about_menu as $nav) : ?>
                            <li class="header_mobile_menu__list-all-element <?php echo isCurrentUrlMatch($nav->url) ? '_active' : '';?>">
                                <a href="<?php echo $nav->url;?>"><?php echo $nav->title; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="city_block">
                        <p class="city_block__title">Ваш регион — <span class="city-picker__current">Москва?</span></p>
                        <ul class="city_block__list">
                            <?php foreach ($cities as $city) : ?>
                                <li class="city-picker__element city_block__list-element <?php echo $city['city'] === 'Москва' ? '_active' : ''?>" data-city="<?php echo $city['city']; ?>">
                                    <?php echo $city['city']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <a href="#quiz" class="header_mobile_menu__btn header_mobile_menu__calc">Рассчитать смету за 10 минут</button>
                    <a href="<?php echo THEME_OPTIONS['phone_href']; ?>" class="header_mobile_menu__btn header_mobile_menu__feedback">Позвонить нам</a>

                </div>
            </div>

        </div>
    </div>
</header>
