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
  <div class="breadcrumbs container">
      <ul class="breadcrumbs__list">
          <li class="breadcrumbs__item">
              <a href="/">Главная</a>
          </li>
          <li class="breadcrumbs__item">
              <a href="">Лестницы</a>
          </li>
          <li class="breadcrumbs__item">
              На металлокаркасе
          </li>
      </ul>
  </div>
  <section class="catalog section-page-m">
      <div class="container">
					<?php the_archive_title( '<h1 class="catalog-title section-title">', '</h1>' ); ?>
					<?php if ( have_posts() ) : ?>
          <div class="catalog-items">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content-categories', get_post_type() );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
					<?php if ( have_posts() ) : ?>
	          </div>
	        <?php endif; ?> 
      </div>
  </section>
</main>

<?php
get_sidebar();
get_footer();
