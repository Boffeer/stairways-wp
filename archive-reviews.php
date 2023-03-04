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
    <section class="sect-otzyvi-page">
        <div class="container">
            <div class="reviews__container">
                <div class="section-heading">
                    <h1 class="section-title reviews__title sect-otzyvi-page__title">Отзывы клиентов</h1>
                    <div class="section-heading__links">
                        <button data-poppa-open="otzyv-callback" class="link link--underlined">
                            <span class="link__text">НАПИСАТЬ ОТЗЫВ</span>
                        </button>

                        <?php if (THEME_OPTIONS['reviews_yandex_url'] != '') : ?>
	                        <a href="<?php echo THEME_OPTIONS['reviews_yandex_url']; ?>" class="link link--underlined">
	                            <span class="link__text">Отзывы на Яндекс Картах</span>
	                        </a>
	                      <?php endif; ?>
                    </div>
                </div>
                <div class="reviews-slider">
                    <div class="grid-masonry">
                        <div class="grid-sizer"></div>
													<?php if ( have_posts() ) : ?>
														<?php while ( have_posts() ) : ?>
															<?php the_post(); ?>
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
        </div>
    </section>
</main>

<?php
get_footer();
