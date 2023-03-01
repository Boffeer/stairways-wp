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
    $video_url = carbon_get_post_meta(get_the_ID() ,'video_url');
    $video_id = get_yt_id($video_url);

    $video_thumb = carbon_get_post_meta(get_the_ID(), 'thumb');
    $is_default_yt_thumb = false;
    if ($video_thumb == '') :
        $video_thumb = "https://i.ytimg.com/vi/{$video_id}/hqdefault.jpg";
        $is_default_yt_thumb = true;
    endif;

    if ($is_default_yt_thumb === false) :
        $video_thumb = boffeer_get_image_url_by_id($video_thumb);
    endif;
?>
<article class="videos-card">
    <div class="videos-card__media">
        <picture class="videos-card__pic">
          <img src="<?php echo $video_thumb; ?>" alt="<?php the_title(); ?>" class="videos-card__img">
        </picture>
        <a class="videos-card__play" href="<?php echo $video_url; ?>" data-fancybox type="button">
            <svg class="videos-card__icon">
                <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/play-icon.svg#play"></use>
            </svg>
        </a>
    </div>
    <h3 class="videos-card__title">
        <a href="<?php echo $video_url; ?>" data-fancybox class="videos-card__link">
            <?php the_title(); ?>
        </a>
    </h3>
</article>
