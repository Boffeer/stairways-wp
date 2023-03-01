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
    $news_thumb_id = carbon_get_post_meta(get_the_ID(), 'thumb');
    $news_thumb = boffeer_get_image_url_by_id($news_thumb_id);
?>
<article class="news-card">
    <?php if ($news_thumb_id != '') : ?>
        <picture class="news-card__pic">
            <img src="<?php echo $news_thumb; ?>" alt="<?php the_title(); ?>" class="news-card__img">
        </picture>
    <?php endif; ?>
    <h3 class="news-card__title">
        <a href="<?php the_permalink(); ?>" class="nes-card__link">
            <?php the_title()?>
        </a>
    </h3>
</article>
