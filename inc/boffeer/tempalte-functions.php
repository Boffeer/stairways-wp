<?php

if (!function_exists('boffer_get_header_meta')) :
	function boffeer_get_header_meta() {
		ob_start(); ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<meta name="format-detection" content="telephone=no" />
		<?php
		$page_id = get_the_ID();
		$title = carbon_get_post_meta($page_id, 'page_title');
		$desc = carbon_get_post_meta($page_id, 'page_description');
		$og_image = carbon_get_post_meta($page_id, 'og_image');
		?>
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?php echo get_site_url(); ?>" />
		<?php if ($title) : ?>
			<title><?php echo $title; ?></title>
			<meta property="og:title" content="<?php echo $title; ?>" />
		<?php endif; ?>
		<?php if ($desc) : ?>
			<meta name="description" content="<?php echo $desc; ?>">
			<meta property="og:description" content="<?php echo $desc; ?>" />
		<?php endif; ?>
		<meta property="og:image" content="<?php echo $og_image; ?>" />
		<?php return ob_get_clean();
	}
endif;

// GET IMAGE BY ID
	// <picture class="carousel-bg__pic">
							// <source srcset="<?php echo wp_get_attachment_image_url($slide, 'full') ?>.webp" type="image/webp" />
							<!-- <img class="carousel-bg__img" src="<?php echo wp_get_attachment_image_url($slide, 'full') ?>" alt="<?php echo get_alt_title(); ?>" /> -->
