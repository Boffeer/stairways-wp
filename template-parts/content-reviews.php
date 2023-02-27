<?php
/**
 * Display categories item
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stairways
 */

?>


<?php
    $review = array(
        'name' => carbon_get_post_meta(get_the_ID(), 'review_name'),
        'city' => carbon_get_post_meta(get_the_ID(), 'review_city'),
        'desc' => carbon_get_post_meta(get_the_ID(), 'review_desc'),
        'gallery' => carbon_get_post_meta(get_the_ID(), 'review_gallery'),
    );
?>


<article class="reviews-card">
    <h3 class="reviews-card__title">
        <?php echo $review['name']; ?>
        <?php if ($review['city'] != '') : ?>
            <br>
            <?php echo $review['city']; ?>
        <?php endif; ?>
    </h3>
    <p class="reviews-card__desc">
        <?php echo nl2br($review['desc']); ?>
    </p>
    <div class="reviews__photos">
        <?php foreach ($review['gallery'] as $slide) : ?>
            <a href="<?php echo boffeer_get_image_url_by_id($slide); ?>" data-fancybox="reviews-<?php the_ID(); ?>" class="reviews__media">
                <picture class="reviews__pic">
                    <img
                        src="<?php echo boffeer_get_image_url_by_id($slide); ?>"
                        alt="Фото из отзыва от <?php echo $review['name']; ?>" class="reviews__img">
                </picture>
            </a>
        <?php endforeach; ?>
        <button class="button reviews__photos-more">+5</button>
    </div>
</article>
