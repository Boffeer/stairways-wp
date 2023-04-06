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
					<?php if ( have_posts() ) : ?>

			      <div class="news-gallery">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'template-parts/content-news', get_post_type() ); ?>

							<?php endwhile; ?>
						</div>

					<?php else :  ?>
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; ?>

					<div class="button button--primary button--wide news__button-more">
						<?php the_posts_navigation();?>
					</div>
			</div>
	</section>
</main><!-- #main -->

<?php
get_footer();
