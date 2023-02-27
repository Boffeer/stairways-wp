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
<div id="case-<?php the_ID(); ?>" class="swiper-slide projects-gallery-slide">
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
    <p class="projects-gallery-title"><?php the_title(); ?></p>
    <ul class="projects-gallery-list">
        <li class="projects-gallery-list-element">
            Где и когда:
            <p>Пенза, 2022.</p>
        </li>
        <li class="projects-gallery-list-element">
            Ограждение:
            <p>закаленное стекло, толщиной 20 мм.</p>
        </li>
        <li class="projects-gallery-list-element">
            Ступени:
            <p>дуб.</p>
        </li>
    </ul>
    <button class="link link--underlined" data-poppa-open="abouts">
        <span class="link__text">Хочу так же</span>
    </button>
</div>
