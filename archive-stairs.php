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
  <section class="catalog section-page-m">
      <div class="container">
					<?php the_archive_title( '<h1 class="catalog-title section-title">', '</h1>' ); ?>
					<?php 
						$stairs = new WP_Query(array(
              'post_type' => 'stairs',
              'post_status' => 'publish',
              'posts_per_page' => -1,
            ));
					?>
					<?php if ( $stairs->have_posts() ) : ?>
          <div class="catalog-items">
						<?php
						/* Start the Loop */
						while ( $stairs->have_posts() ) :
							$stairs->the_post();

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
					<?php if ( $stairs->have_posts() ) : ?>
	          </div>
	        <?php endif; ?> 
      </div>
  </section>
</main>

<?php
get_footer();
