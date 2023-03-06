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
  <section class="catalog-project section-page-m">
      <div class="container">
          <h2 class="catalog-title section-title">
          	<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
          </h2>
          <div class="tabs">
				    <div class="tabs-7p">
				      <form
					      	class="tabs-7p__industries tabs-7p__industries--clickable filters-7p"
							    action="<?php echo admin_url( 'admin-ajax.php' );?>"
							    data-action="get_filtered_cases"
				      	>
				        <div class="filters-7p__scrollarea">
				          <div class="filters-7p__track">
				            <label class="tabs-7p-tab tabs-7p-tab--total">
				                <input type="checkbox" name="filter" class="tabs-7p-tab__input" value="-1" checked>
				                <span class="tabs-7p-tab__text">Все</span>
				            </label>
				          </div>
				        </div>
	            	<?php
	                $categories = get_terms(array(
	                    'orderby' => 'none',
	                    'taxonomy' => 'categories',
	                    'hide_empty'    => true,
	                ));
	              ?>
				        <div class="tabs-7p__more">
				            <button class="tabs__toggler tabs-7p__more-button" title="" type="button">
				                Все категории
				                <span class="button-more__dot"></span>
				                <span class="button-more__dot"></span>
				                <span class="button-more__dot"></span>                  
				            </button>
				            <div class="tabs-7p__industries-dropdown">
				            	<?php foreach ($categories as $category) : ?>
					              <label class="tabs-7p-tab">
					                <input type="checkbox" name="filter" class="tabs-7p-tab__input" value="<?php echo $category->term_id; ?>">
					                <span class="tabs-7p-tab__text"><?php echo $category->name; ?></span>
					              </label>
					            <?php endforeach; ?>
				            </div>
				        </div>
				      </form>
				    </div>
				    <div class="tabs__page-container tabs-7p__content" data-tabs="projects">
			        <div class="tabs__page">
	                <div class="projects-gallery">
	                    <div class="swiper projects-gallery-carousel">
	                        <div class="swiper-wrapper">
															<?php if ( have_posts() ) : ?>
																<?php

																/* Start the Loop */
																while ( have_posts() ) :
																	the_post();

																	/*
																	 * Include the Post-Type-specific template for the content.
																	 * If you want to override this in a child theme, then include a file
																	 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
																	 */
																	get_template_part( 'template-parts/content-cases', get_post_type() );

																endwhile;
																?>
															<?php endif; ?>
	                        </div>
	                    </div>
	                    <div class="swiper-buttons projects-gallery-buttons">
	                        <div class="swiper-button-prev"></div>
	                        <div class="swiper-button-next"></div>
	                    </div>
	                </div>
	            </div>
		        </div>
			    </div>
			</div>
  </section>
</main>

<?php
get_sidebar();
get_footer();
