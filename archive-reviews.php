<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stairways
 */

get_header();
?>

<main>
    <?php echo get_breadcrumbs(); ?>

    <section class="reviews sect-otzyvi-page page-reviews-masonry">
        <div class="container">
            <div class="reviews__container">
                <div class="section-heading">
                    <h1 class="section-title reviews__title sect-otzyvi-page__title">Отзывы клиентов</h1>
                    <div class="section-heading__links">
                        <div class="section-heading__links-scroll">
                            <div class="section-heading__links-track">
                                <button data-poppa-open="otzyv-callback" class="link-popup">
                                    <span class="link__text">НАПИСАТЬ ОТЗЫВ</span>
                                </button>
                                <?php if (THEME_OPTIONS['reviews_yandex_url']) : ?>
                                    <a href="<?php echo THEME_OPTIONS['reviews_yandex_url']; ?>" target="_blank" class="link link-regular link--external">
                                        <span class="link__text">Отзывы на Яндекс Картах</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tabs__toggler-container" data-tabs="reviews">
                    <button class="tabs__toggler" type="button">На нашем сайте</button>
                    <button class="tabs__toggler" type="button">На Яндекс.Картах</button>
                </div>
                <div class="tabs__page-container" data-tabs="reviews">
                    <div class="tabs__page">
                        <div class="reviews-slider">
                            <?php
                                $reviews = new WP_Query(array(
                                    'post_type' => 'reviews',
                                    'post_status' => 'publish',
                                    'orderby' => 'rand',
                                    'posts_per_page' => -1,
                                ));
                            ?>
                            <div class="grid-masonry">
                                <div class="grid-sizer"></div>
        						<?php if ( $reviews->have_posts() ) : ?>
        							<?php while ( $reviews->have_posts() ) : ?>
        								<?php $reviews->the_post(); ?>
        		                        <div class="grid-item-masonry">
            								<?php get_template_part( 'template-parts/content-reviews', get_post_type() ); ?>
        		                        </div>
        							<?php endwhile; ?>
        						<?php else : ?>
        							<?php get_template_part( 'template-parts/content', 'none' ); ?>
        						<?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="tabs__page">
                        <div style="overflow:hidden;position:relative;">
                        <iframe style="width:100%;height:600px;border:1px solid #e6e6e6;border-radius:8px;box-sizing:border-box" src="https://yandex.ru/maps-reviews-widget/80752297824?comments"></iframe>
                        <a href="https://yandex.by/maps/org/pervaya_stupen/80752297824/" target="_blank" style="box-sizing:border-box;text-decoration:none;color:#b3b3b3;font-size:10px;font-family:YS Text,sans-serif;padding:0 20px;position:absolute;bottom:8px;width:100%;text-align:center;left:0;overflow:hidden;text-overflow:ellipsis;display:block;max-height:14px;white-space:nowrap;padding:0 16px;box-sizing:border-box">Первая ступень на карте Пензы — Яндекс Карты</a></div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
