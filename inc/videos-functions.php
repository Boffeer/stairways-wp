<?php

/*
	@params $categories_ids array
 */

add_action( 'wp_ajax_get_videos', 'get_videos' );
add_action( 'wp_ajax_nopriv_get_videos', 'get_videos' );

function get_videos() {
	$categories_ids = json_decode(stripslashes($_POST['categories']));

	$videos;

	if (in_array(-1, $categories_ids)) {
		$videos = new WP_Query( array(
	    'post_type' => 'videos',
	    'post_status' => 'publish',
	    'posts_per_page' => '-1',
		));
	} else {
		$videos = new WP_Query( array(
	    'post_type' => 'videos',
	    'post_status' => 'publish',
	    'posts_per_page' => '-1',
			'tax_query' => array(
				array(
	       'relation' => 'OR',
	        [
	            'taxonomy' => 'videos-categories',
	            'field' => 'tag_id',
	            'terms' => $categories_ids,
	        ],
				),
			),
		));
	}

	// $cases = array();
	while ($videos->have_posts()) :
		$videos->the_post();
		ob_start();?>

	  <div class="swiper-slide videos-slide">
			<?php get_template_part( 'template-parts/content-videos', get_post_type() );?>
		</div>

	<?php endwhile;
	echo ob_get_clean();
	wp_die();
}
