<?php //foreach ($hero_categories as $category_index => $category) : ?>
<?php
/*
  Временно вынесли сюда, т.к. была задача хардово вывести ссылки
 */
?>
<article class="hero-categories-card <?php echo $category_index === 0 ? 'hero-categories-card--current' : '';?>">
  <?php $category_image_id = carbon_get_term_meta($category->term_id, 'category_pic'); ?>
    <picture class="hero-categories-card__pic">
      <?php if ($category_image_id != '') : ?>
        <img
          src="<?php echo boffeer_get_image_url_by_id($category_image_id); ?>"
          alt="<?php echo $category->name; ?>"
          class="hero-categories-card__img"
        >
      <?php endif; ?>
    </picture>
  <h3 class="hero-categories-card__title">
      <a href="<?php echo get_term_link($category->term_id)?>" class="hero-categories-card__link"><?php echo $category->name; ?></a>
  </h3>
  <?php
    $child_categories = get_terms(array(
      'orderby' => 'none',
      'taxonomy' => 'categories',
      'hide_empty'    => false,
      'parent' => $category->term_id,
    ));
  ?>
  <?php if (!empty($child_categories)) : ?>
    <div class="hero-categories-card__subcategories">
        <?php foreach ($child_categories as $child) : ?>
          <?php $child_category_image_id = carbon_get_term_meta($child->term_id, 'category_pic'); ?>
          <?php if ($child_category_image_id != '') : ?>
            <a href="<?php echo get_term_link($child->term_id)?>" class="hero-categories-card__subcategory"><?php echo $child->name; ?></a>
            <picture class="hero-categories-card__subcategory-pic">
              <img class="hero-categories-card__subcategory-img"
                src="<?php echo boffeer_get_image_url_by_id($child_category_image_id); ?>"
                  alt="<?php echo $child->name; ?>"
                  >
            </picture>
          <?php endif; ?>
        <?php endforeach;?>
      </div>
    <?php endif; ?>
</article>
