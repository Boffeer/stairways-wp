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
    <?php 
        $case_title = carbon_get_post_meta(get_the_ID(), 'title');
        if ($case_title == '') :
            $case_title = get_the_title();
        endif;
    ?>
    <p class="projects-gallery-title">
        <?php echo $case_title; ?>
    </p>
    <?php $case_stats = explode_textarea_matrix(carbon_get_post_meta(get_the_ID(), 'stats')); ?>
    <?php if ($case_stats[0] != '') : ?>
        <ul class="projects-gallery-list">
        <?php foreach($case_stats as $stat) : ?>
            <?php $current_stat = boffeer_explode_textarea($stat); ?>
            <?php if (isset($current_stat[0]) || isset($current_stat[1])) : ?>
                <li class="projects-gallery-list-element">
                    <?php echo $current_stat[0]; ?>
                    <p><?php echo isset($current_stat[1]) ? $current_stat[1] : ''; ?></p>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    <?php endif;?>
    <button class="link link--underlined" data-poppa-open="abouts">
        <span class="link__text">Хочу так же</span>
    </button>
</div>
