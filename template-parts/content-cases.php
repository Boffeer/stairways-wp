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
    $case = array(
        'gallery' => carbon_get_post_meta(get_the_ID(), 'gallery'),
    );
?>
<div id="case-<?php the_ID(); ?>" data-id="<?php the_ID(); ?>" class="swiper-slide projects-gallery-slide">
    <div class="swiper projects-gallery-carousel-children" data-swiper="main" data-swiper-pagination data-swiper-touch>
        <div class="swiper-wrapper">
            <?php foreach ($case['gallery'] as $slide) : ?>
                <div class="swiper-slide projects-gallery-children-slide">
                    <img src="<?php echo boffeer_get_image_url_by_id($slide); ?>" alt="<?php the_title(); ?>">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <?php 
        $case_title = carbon_get_post_meta(get_the_ID(), 'title');
        if ($case_title == '') :
            $case_title = get_the_title();
        endif;
    ?>
    <p class="projects-gallery-title js-button__get-content"
        data-content-get="cases"
        data-case-id="<?php the_ID(); ?>"
        >
        <?php echo $case_title; ?>
    </p>
    <?php echo get_case_stats(get_the_ID()); ?>
    <button
        class="link link--underlined js-button__formname"
        data-poppa-open="form-callback"
        data-form="#form-callback .form-callback"
        data-form-name="Хочу также: Кейс «<?php echo $case_title; ?>»"
        type="button">
        <span class="link__text">Хочу так же</span>
    </button>
</div>
