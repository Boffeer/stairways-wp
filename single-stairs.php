<?php get_header(); ?>

<?php echo get_breadcrumbs(); ?>
<?php $stair_product = get_stair_info(get_the_ID()); ?>
<section class="product-page">
    <div class="container">
        <div class="product-page-content">
            <div class="product-page--picture">
                <?php foreach ($stair_product['variations'] as $key => $variation) : ?>
                    <div class="product-page__inner-pic <?php echo $key == 0 ? '_active' : '';?>">
                        <?php $first_variation = $stair_product['variations'][0]; ?>
                        <img class="product-page--picture--img"
                            src="<?php echo boffeer_get_image_url_by_id($variation['photo']); ?>"
                            alt="<?php echo $variation['title'];?>">
                        <?php foreach ($variation['hotspots'] as $key => $hotspot) : ?>
                            <?php if (
                                $hotspot['photo'] != "" || 
                                $hotspot['title'] != "" || 
                                $hotspot['desc'] != ""
                            ) : ?>
                                <button class="product-page--circle" style="--left-offset: <?php echo $hotspot['x_offset'];?>; --top-offset: <?php echo $hotspot['y_offset']; ?>">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.00065 0.833344C9.64498 0.833344 10.1673 1.35568 10.1673 2.00001V7.83334H16.0007C16.645 7.83334 17.1673 8.35568 17.1673 9.00001C17.1673 9.64434 16.645 10.1667 16.0007 10.1667H10.1673V16C10.1673 16.6443 9.64498 17.1667 9.00065 17.1667C8.35632 17.1667 7.83398 16.6443 7.83398 16V10.1667H2.00065C1.35632 10.1667 0.833984 9.64434 0.833984 9.00001C0.833984 8.35568 1.35632 7.83334 2.00065 7.83334L7.83398 7.83334V2.00001C7.83398 1.35568 8.35632 0.833344 9.00065 0.833344Z" fill="white"/>
                                    </svg>
                                    <span class="product-page--circle--popup">
                                        <?php if ($hotspot['photo'] != "") : ?>
                                        <img src="<?php echo boffeer_get_image_url_by_id($hotspot['photo']); ?>"
                                             alt="Подробнее" class="product-page--circle--img">
                                        <?php endif; ?>
                                        <?php if ($hotspot['title'] != "") : ?>
                                            <span class="product-page--circle--title">
                                                <?php echo $hotspot['title']; ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ($hotspot['desc'] != "") : ?>
                                            <span class="product-page--circle--text">
                                                <?php echo nl2br($hotspot['desc'])?>
                                            </span>
                                        <?php endif; ?>
                                    </span>
                                </button>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="product-page--right-content">
                <h1 class="product-page-title section-title">
                    <?php the_title(); ?>
                </h1>
                <div class="product-page-seciton product-page__product-info">
                    <div class="product-page--views">
                        <?php foreach ($stair_product['variations'] as $key => $variation) : ?>
                            <div class="product-page--views--element <?php echo $key == 0 ? '_active' : ''; ?>"
                                 data-id="<?php the_ID(); ?>"
                                 data-src="<?php echo THEME_STATIC; ?>/img/catalog/catalog-2.jpg">
                                <img
                                    class="product-page--views--picture"
                                    src="<?php echo boffeer_get_image_url_by_id($variation['photo']); ?>"
                                    alt="<?php echo $variation['title']; ?>">
                                <p class="product-page--views--text"><?php echo $variation['title']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="product-page--views--block-text">
                        <?php foreach ($stair_product['variations'] as $key => $variation) : ?>
                            <p class="product-page--views--block-text-descr <?php echo $key == 0 ? '_active' : ''; ?>">
                                <?php echo nl2br(do_shortcode($variation['desc']));?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="product-page-list">
                    <a href="#section-product-features" class="product-page-list--link link--underlined">
                         <svg class="product-page-list__icon">
                            <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/arrow-down-sharp.svg#arrow-down-sharp" />
                        </svg>
                        <span class="link__text offer__link--text">Подробнее о преимуществах</span>
                    </a>
                    <a href="#section-product-cases" class="product-page-list--link link--underlined">
                        <svg class="product-page-list__icon">
                            <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/arrow-down-sharp.svg#arrow-down-sharp" />
                        </svg>
                        <span class="link__text offer__link--text">Наши работы</span>
                    </a>
                    <a href="#section-product-difference" class="product-page-list--link link--underlined">
                        <svg class="product-page-list__icon">
                            <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/product-question-circle.svg#product-question-circle" />
                        </svg>
                        <span class="link__text offer__link--text">Чем отличается косоур от тетивы?</span>
                    </a>
                </div>
                <div class="product-page-btn">
                    <a href="#section-product-calculate" class="button button--primary product-page-btn__button">Рассчитать стоимость</a>
                    <a href="#section-product-consult" class="button button--primary-white product-page-btn__button">получить консультацию</a>
                </div>
            </div>
            <?php
                $order_conditions = carbon_get_theme_option('order_conditions'); 
            ?>
            <?php if (!empty($order_conditions)) : ?>
                <div class="product-page__accordions accordions">
                    <header class="accordions__header">
                        <h2 class="accordions__title">Условия заказа</h2>
                    </header>
                    <div class="accordions__body">
                    <?php
                        $order_conditions_ids = array();
                        foreach ($order_conditions as $faq) :
                            $order_conditions_ids[] = $faq['id'];
                        endforeach;

                        $order_conditions_faq = new WP_Query(array(
                            'post_type' => 'faq',
                            'post_status' => 'publish',
                            'post__in' => $order_conditions_ids,
                            'orderby' => 'post__in',
                        ));
                      ?>
                      <?php while ($order_conditions_faq->have_posts()) : ?>
                        <?php $order_conditions_faq->the_post(); ?>
                            <?php get_template_part( 'template-parts/content-faq', get_post_type() ); ?>
                      <?php endwhile; ?>
                      <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>




<section id="section-product-cases" class="prod-items section">
    <div class="container">
        <h2 class="section-title">Произвели 130+ лестниц<br> на монокосоуре</h2>
        <div class="projects-gallery">
            <div class="projects-gallery-carousel">
                <?php
                  $product_cases = new WP_Query(array(
                      'post_type' => 'cases',
                      'orderby' => 'rand',
                      'posts_per_page' => 6,
                  ));
                ?>
                <?php while ($product_cases->have_posts()) : ?>
                  <?php
                    $product_cases->the_post();
                   ?>
                    <div class="projects-gallery-slide projects-gallery-carousel__slide" dataset>
                        <?php get_template_part( 'template-parts/content-cases', get_post_type() ); ?>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <button class="prod-items__show tabs-7p__more-content" type="button">Показать еще</button>
        </div>
    </div>
</section>
<section id="section-product-features" class="prod-info">
    <div class="container">
        <div class="prod-info-variations">
            <?php foreach ($stair_product['variations'] as $key => $variation) : ?>
                <div class="prod-info-variations__variation  <?php echo $key == 0 ? '_active' : '';?>">
                    <?php foreach ($variation['stairs_features'] as $feature_index => $feature) : ?>
                        <div class="prod-info-sect">
                            <div class="prod-info-text">
                                <?php if ($feature['suptitle']) : ?>
                                    <p class="prod-info-text__pod"><?php echo $feature['suptitle']; ?></p>
                                <?php endif ;?>
                                <?php if ($feature['title']) : ?>
                                    <h2 class="prod-info-text__title section-title"><?php echo $feature['title']; ?></h2>
                                <?php endif; ?>
                                <?php if ($feature['desc']) : ?>
                                    <p class="prod-info-text__descr"><?php echo $feature['desc']; ?></p>
                                <?php endif; ?>
                                <?php if (count($feature['pics']) > 0) : ?>
                                    <div class="prod-info-text__img">
                                        <?php foreach ($feature['pics'] as $pic_id) : ?>
                                        <img src="<?php echo boffeer_get_image_url_by_id($pic_id); ?>" alt="">
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="prod-info-picture">
                                <?php if ($feature['photo'] != '') : ?>
                                    <img src="<?php echo boffeer_get_image_url_by_id($feature['photo']); ?>" alt="">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="sect-photo">
    <img class="sect-photo__picture" src="<?php echo THEME_STATIC; ?>/img/proud/background.jpg" alt="Высокая точность конструкции">
    <div class="container">
        <h2 class="sect-photo__title">Высокая<br> точность
            <br> конструкции
        </h2>
    </div>
</section>

<section id="section-product-difference" class="sect-carcas section section-product-difference">
        <?php foreach ($stair_product['variations'] as $key => $variation) : ?>
        <div class="section-product-difference-pin">
            <div class="section-product-difference__variation <?php echo $key == 0 ? '_active' : '';?>">
                <div class="container sect-carcas__container">
                    <div class="sect-carcas--info">
                        <?php $accuracy = array(
                        'title' => $variation['accuracy_title'],
                        'bullets' => explode_textarea_matrix($variation['accuracy_bullets']),
                        'hint' => $variation['accuracy_hint'],
                    ); ?>
                    <?php if ($accuracy['title'] != '') : ?>
                    <h2 class="section-title">
                        <?php echo $accuracy['title']; ?>
                    </h2>
                    <?php endif; ?>
                    <div class="sect-carcas--info-text">
                        <?php if (count($accuracy['bullets']) > 0) : ?>
                            <div class="sect-carcas__top">
                                <?php foreach ($accuracy['bullets'] as $bullet) : ?>
                                    <p class="sect-carcas__top-text"><?php echo $bullet; ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="sect-carcas__bottom">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 0C12.3183 0 12.6235 0.126428 12.8485 0.351472C13.0736 0.576515 13.2 0.88174 13.2 1.2V4.8C13.2 5.11826 13.0736 5.42348 12.8485 5.64853C12.6235 5.87357 12.3183 6 12 6C11.6817 6 11.3765 5.87357 11.1515 5.64853C10.9264 5.42348 10.8 5.11826 10.8 4.8V1.2C10.8 0.88174 10.9264 0.576515 11.1515 0.351472C11.3765 0.126428 11.6817 0 12 0ZM12 18C12.3183 18 12.6235 18.1264 12.8485 18.3515C13.0736 18.5765 13.2 18.8817 13.2 19.2V22.8C13.2 23.1183 13.0736 23.4235 12.8485 23.6485C12.6235 23.8736 12.3183 24 12 24C11.6817 24 11.3765 23.8736 11.1515 23.6485C10.9264 23.4235 10.8 23.1183 10.8 22.8V19.2C10.8 18.8817 10.9264 18.5765 11.1515 18.3515C11.3765 18.1264 11.6817 18 12 18ZM24 12C24 12.3183 23.8736 12.6235 23.6485 12.8485C23.4235 13.0736 23.1183 13.2 22.8 13.2H19.2C18.8817 13.2 18.5765 13.0736 18.3515 12.8485C18.1264 12.6235 18 12.3183 18 12C18 11.6817 18.1264 11.3765 18.3515 11.1515C18.5765 10.9264 18.8817 10.8 19.2 10.8H22.8C23.1183 10.8 23.4235 10.9264 23.6485 11.1515C23.8736 11.3765 24 11.6817 24 12ZM6 12C6 12.3183 5.87357 12.6235 5.64853 12.8485C5.42348 13.0736 5.11826 13.2 4.8 13.2H1.2C0.88174 13.2 0.576515 13.0736 0.351472 12.8485C0.126428 12.6235 0 12.3183 0 12C0 11.6817 0.126428 11.3765 0.351472 11.1515C0.576515 10.9264 0.88174 10.8 1.2 10.8H4.8C5.11826 10.8 5.42348 10.9264 5.64853 11.1515C5.87357 11.3765 6 11.6817 6 12ZM20.4852 20.4852C20.2602 20.7102 19.955 20.8365 19.6368 20.8365C19.3186 20.8365 19.0134 20.7102 18.7884 20.4852L16.2432 17.94C16.0246 17.7137 15.9037 17.4106 15.9064 17.0959C15.9091 16.7813 16.0353 16.4803 16.2578 16.2578C16.4803 16.0353 16.7813 15.9091 17.0959 15.9064C17.4106 15.9037 17.7137 16.0246 17.94 16.2432L20.4852 18.7872C20.5968 18.8986 20.6853 19.031 20.7457 19.1767C20.8061 19.3224 20.8371 19.4785 20.8371 19.6362C20.8371 19.7939 20.8061 19.9501 20.7457 20.0957C20.6853 20.2414 20.5968 20.3738 20.4852 20.4852ZM7.7568 7.7568C7.53177 7.98177 7.2266 8.10814 6.9084 8.10814C6.5902 8.10814 6.28503 7.98177 6.06 7.7568L3.516 5.2128C3.29083 4.98779 3.16427 4.68255 3.16416 4.36422C3.16404 4.0459 3.29039 3.74057 3.5154 3.5154C3.74041 3.29023 4.04565 3.16367 4.36398 3.16356C4.6823 3.16344 4.98763 3.28979 5.2128 3.5148L7.7568 6.06C7.98177 6.28503 8.10814 6.5902 8.10814 6.9084C8.10814 7.2266 7.98177 7.53177 7.7568 7.7568ZM3.516 20.4852C3.29103 20.2602 3.16466 19.955 3.16466 19.6368C3.16466 19.3186 3.29103 19.0134 3.516 18.7884L6.0612 16.2432C6.1719 16.1286 6.30431 16.0372 6.45072 15.9743C6.59712 15.9114 6.75458 15.8783 6.91392 15.8769C7.07325 15.8755 7.23127 15.9059 7.37875 15.9662C7.52622 16.0266 7.6602 16.1157 7.77287 16.2283C7.88555 16.341 7.97465 16.475 8.03499 16.6225C8.09532 16.7699 8.12569 16.9279 8.1243 17.0873C8.12292 17.2466 8.08981 17.4041 8.02692 17.5505C7.96403 17.6969 7.87261 17.8293 7.758 17.94L5.214 20.4852C5.10255 20.5968 4.97021 20.6853 4.82453 20.7457C4.67885 20.8061 4.5227 20.8371 4.365 20.8371C4.2073 20.8371 4.05115 20.8061 3.90547 20.7457C3.75979 20.6853 3.62745 20.5968 3.516 20.4852ZM16.2432 7.7568C16.0182 7.53177 15.8919 7.2266 15.8919 6.9084C15.8919 6.5902 16.0182 6.28503 16.2432 6.06L18.7872 3.5148C19.0122 3.28963 19.3175 3.16307 19.6358 3.16296C19.9541 3.16284 20.2594 3.28919 20.4846 3.5142C20.7098 3.73921 20.8363 4.04445 20.8364 4.36278C20.8366 4.6811 20.7102 4.98643 20.4852 5.2116L17.94 7.7568C17.715 7.98177 17.4098 8.10814 17.0916 8.10814C16.7734 8.10814 16.4682 7.98177 16.2432 7.7568Z" fill="#2B3B50"/>
                            </svg>
                            <?php if ($accuracy['hint'] != '') : ?>
                                <p class="sect-carcas__bottom-text"><?php echo nl2br($accuracy['hint']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($variation['bolts_visibility'] == 'show') : ?>
                <div class="container product-details-shifter__container <?php echo $key == 0 && $variation['bolts_visibility'] == 'show' ? '_active' : '';?>">
                    <div class="sect-carcas--background">
                        <div class="sect-carcas__inner">
                            <p class="sect-carcas--background--pod">Быстро</p>
                            <h2 class="sect-carcas--background--title">Сборка на болтах</h2>
                            <p class="sect-carcas--background--descr">Все элементы каркаса собираются на болтах и не требуют сварки и покраски на монтаже. Каркас можно установить даже самостоятельно по нашей инструкции</p>
                        </div>
                        <img class="sect-carcas--background--img" src="<?php echo THEME_STATIC; ?>/img/proud/bolt.png" alt="">
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
</section>


<?php foreach ($stair_product['variations'] as $key => $variation) : ?>
<?php if ($variation['pretty_visibility'] == 'show') : ?>
    <section class="sect-colors <?php echo $key == 0 ? '_active' : '';?>">
        <div class="sect-colors--background"></div>
        <div class="container">
            <img src="<?php echo THEME_STATIC; ?>/img/proud/block-color.jpg" alt="" class="sect-colors__picture">
            <div class="sect-colors__content">
                <p class="sect-colors-pod">КРАСИВО</p>
                <h2 class="sect-colors-title">Красим только<br> порошковой краской</h2>
                <p class="sect-colors-descr">Мы красим каркас лестницы на монокосоуре порошковой краской на высокотехнологичном оборудовании. Это дает самый качественный результат и высокую стойкость по сравнению с любыми другими красками. Красим в любой цвет по RAL с использованием
                    спецэффектов шагрень, муар, глянец, матовый, металлик.</p>
                <div class="sect-colors-bottom">
                    <div class="sect-colors-bottom__left">
                        <p class="sect-colors-bottom__title">Цвета</p>
                        <img class="sect-colors-bottom__left-img" src="<?php echo THEME_STATIC; ?>/img/proud/colors.svg" alt="">
                    </div>
                    <div class="sect-colors-bottom__right">
                        <p class="sect-colors-bottom__title">Текстуры</p>
                        <ul class="sect-colors-bottom__list">
                            <li class="sect-colors-bottom__element">
                                <img src="<?php echo THEME_STATIC; ?>/img/proud/texture-1.svg" alt="">
                                <p class="sect-colors-bottom__element-title">Шагрень</p>
                            </li>
                            <li class="sect-colors-bottom__element">
                                <img src="<?php echo THEME_STATIC; ?>/img/proud/texture-2.svg" alt="">
                                <p class="sect-colors-bottom__element-title">Муар</p>
                            </li>
                            <li class="sect-colors-bottom__element">
                                <img src="<?php echo THEME_STATIC; ?>/img/proud/texture-3.svg" alt="">
                                <p class="sect-colors-bottom__element-title">Металлик</p>
                            </li>
                            <li class="sect-colors-bottom__element">
                                <img src="<?php echo THEME_STATIC; ?>/img/proud/texture-4.svg" alt="">
                                <p class="sect-colors-bottom__element-title">Глянец</p>
                            </li>
                            <li class="sect-colors-bottom__element">
                                <img src="<?php echo THEME_STATIC; ?>/img/proud/texture-5.svg" alt="">
                                <p class="sect-colors-bottom__element-title">Матовый</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php endforeach; ?>

<?php $base_product_faq = carbon_get_theme_option('base_product_faq'); ?>
<?php
    if (empty($base_product_faq)) :
        $base_product_faq = carbon_get_post_meta(get_option('page_on_front'), 'home_faq');
        // foreach ($home_faq as $faq) :
        //     $order_conditions_ids[] = $faq['id'];
        // endforeach;
    endif;
?>
<?php if (!empty($base_product_faq)):?>
<section class="faq section">
    <div class="container faq__container">
        <h2 class="section-title faq__title">Отвечаем на ваши вопросы</h2>
        <div class="faq__cards">
          <?php
            $base_product_faq_ids = array();
            foreach ($base_product_faq as $faq) :
                $base_product_faq_ids[] = $faq['id'];
            endforeach;

            $base_product_faq = new WP_Query(array(
                'post_type' => 'faq',
                'post_status' => 'publish',
                'post__in' => $base_product_faq_ids,
                'orderby' => 'post__in',
            ));
          ?>
          <?php while ($base_product_faq->have_posts()) : ?>
            <?php $base_product_faq->the_post(); ?>
                <div>
                    <?php get_template_part( 'template-parts/content-faq', get_post_type() ); ?>
                <div>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/content-consult' ); ?>
<?php get_template_part( 'template-parts/content-form' ); ?>

<?php get_footer(); ?>
