<?php
/**
 * Display categories item
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stairways
 */

?>

<div id="categories-<?php the_ID(); ?>" class="catalog-items--block">
    <a href="<?php the_permalink(); ?>" class="catalog-items--link">
        <?php $categories_thumb_id = carbon_get_post_meta(get_the_ID(), 'stairs_variations')[0]['photo']; ?>
        <?php if ($categories_thumb_id != '') : ?>
            <picture class="catalog-items__pic">
                <img
                  src="<?php echo boffeer_get_image_url_by_id($categories_thumb_id); ?>"
    	            alt="<?php the_title(); ?>" class="catalog-items__img">
            </picture>
        <?php endif; ?>
        <h3 class="catalog-items--title">
        	<?php the_title(); ?>
        </h3>
    </a>
</div>

