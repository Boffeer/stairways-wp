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
    $faq_question = carbon_get_post_meta(get_the_ID(), 'question');
    $faq_answer = carbon_get_post_meta(get_the_ID(), 'answer');
    $faq_icon = carbon_get_post_meta(get_the_ID(), 'thumb');
?>
<article class="bayan accordion <?php echo $faq_icon != '' ? "accordion--has-icon" : ''; ?>">
    <div class="accordion__head">
        <?php if ($faq_icon != "") : ?>
            <img src="<?php echo boffeer_get_image_url_by_id($faq_icon); ?>" alt="<?php echo $faq_question; ?>" class="accordion__icon">
        <?php endif; ?>
         <h3 class="accordion__title">
             <?php echo $faq_question; ?>
         </h3>
    </div>
    <div class="accordion__body">
        <p class="accordion__desc">
             <?php echo nl2br($faq_answer); ?>
        </p>
    </div>
</article>
