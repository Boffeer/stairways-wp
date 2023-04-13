<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stairways
 */
?>
<?php get_header(); ?>
  <main class="main">
      <?php
        // $hero_categories = carbon_get_post_meta(get_the_ID(), 'home_categories');
        // $hero_categories_ids = array();
        
        // foreach ($hero_categories as $category) :
        //     $hero_categories_ids[] = $category['id'];
        // endforeach;
      ?>
      <?php //if (!empty($hero_categories_ids)) : ?>
      <div class="hero-categories">
          <div class="container hero-categories__container">
            <?php

              // $hero_categories = get_terms(array(
              //     'orderby' => 'none',
              //     'taxonomy' => 'categories',
              //     'hide_empty'    => false,
              //     'include' => $hero_categories_ids,
              //     'orderby' => 'include',
              // ));

              $metal_category_id = 4;
              $hero_first_card_products_ids = array(45, 49, 329, 56);
              $hero_products_ids = array(
                $hero_first_card_products_ids,
                64,
                58,
                62,
              );
            ?>

            <div class="hero-categories__gallery">
                <?php foreach ($hero_products_ids as $product_index => $product_id) : ?>
                  <?php
                    if (is_array($product_id)) :
                      $category = get_term($metal_category_id, 'categories');
                      $title = $category->name;
                      $permalink = get_term_link($metal_category_id);
                    else :
                      global $post;
                      $post = $product_id;
                      setup_postdata($product_id);
                      $title = get_the_title();
                      $permalink = get_the_permalink();
                    endif;
                  ?>
                  <article class="hero-categories-card <?php echo $product_index === 0 ? 'hero-categories-card--current' : '';?>">
                        <?php
                          if ($product_index == 0) :
                            $thumbnail = boffeer_get_image_url_by_id(carbon_get_term_meta($metal_category_id, 'category_pic'));
                          else :
                            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            if ($thumbnail == "") {
                                $card_image_id = carbon_get_post_meta(get_the_ID(), 'stairs_variations')[0]['photo'];
                                $thumbnail = boffeer_get_image_url_by_id($card_image_id);
                            }
                          endif;
                        ?>
                        <picture class="hero-categories-card__pic">
                          <?php if ($thumbnail != '') : ?>
                            <img
                              src="<?php echo $thumbnail; ?>"
                              alt="<?php echo $title; ?>"
                              class="hero-categories-card__img"
                            >
                          <?php endif; ?>
                        </picture>
                      <h3 class="hero-categories-card__title">
                          <a href="<?php echo $permalink ?>" class="hero-categories-card__link">
                            <?php echo $title; ?>
                          </a>
                      </h3>
                      <?php if (is_array($product_id)) : ?>
                        <div class="hero-categories-card__subcategories">
                            <?php foreach ($product_id as $child_id) : ?>
                              <?php
                                global $post;
                                $post = $child_id;
                                setup_postdata($child_id);
                                $title = get_the_title();
                                $permalink = get_the_permalink();
                              ?>
                              <?php
                                $child_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                if ($child_thumbnail == "") {
                                    $child_category_image_id = carbon_get_post_meta(get_the_ID(), 'stairs_variations')[0]['photo'];
                                    $child_thumbnail = boffeer_get_image_url_by_id($child_category_image_id);
                                }
                              ?>
                              <?php if ($child_thumbnail != '') : ?>
                                <a href="<?php echo the_permalink()?>" class="hero-categories-card__subcategory">
                                  <?php the_title(); ?>
                                </a>
                                <picture class="hero-categories-card__subcategory-pic">
                                  <img class="hero-categories-card__subcategory-img"
                                    src="<?php echo $child_thumbnail; ?>"
                                    alt="<?php the_title(); ?>"
                                  >
                                </picture>
                              <?php endif; ?>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </div>
                      <?php endif; ?>
                  </article>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
          </div>
      </div>
      <?php //endif; ?>

      <section class="offer section">
          <div class="container offer__container">
              <h1 class="offer__title heading_title">Лестницы на&nbsp;металлокаркасе в&nbsp;Москве</h1>
              <div class="offer__subtitle">
                  Произведем в Пензе, доставим в ваш регион. <br> В Москве есть наши
                  <div class="offer__link link link--underlined">
                      <span class="link__text offer__link--text">дилеры</span>,
                      <div class="offer__link--tooltip">
                          <h2 class="offer__link--tooltip--title">Дилеры “Первая ступень” в Москве</h2>
                          <div class="offer__link--tooltip--text">
                              <p>ООО “Лестницы-стар” ИП Лестницын О.Н.</p><br><br>
                              <p>Свяжитесь с нами, все расскажем</p>
                              <a href="<?php echo THEME_OPTIONS['phone_href'];?>"><?php echo THEME_OPTIONS['phone'];?></a>
                          </div>
                      </div>
                  </div>
                  <div class="offer__link link link--underlined">
                      <span class="link__text offer__link--text">замерщики</span> и
                      <div class="offer__link--tooltip">
                          <h2 class="offer__link--tooltip--title">Дилеры “Первая ступень” в Москве</h2>
                          <div class="offer__link--tooltip--text">
                              <p>ООО “Лестницы-стар” ИП Лестницын О.Н.</p><br><br>
                              <p>Свяжитесь с нами, все расскажем</p>
                              <a href="<?php echo THEME_OPTIONS['phone_href'];?>"><?php echo THEME_OPTIONS['phone'];?></a>
                          </div>
                      </div>
                  </div>
                  <div class="offer__link link link--underlined">
                      <span class="link__text offer__link--text">монтажники</span>.
                      <div class="offer__link--tooltip">
                          <h2 class="offer__link--tooltip--title">Дилеры “Первая ступень” в Москве</h2>
                          <div class="offer__link--tooltip--text">
                              <p>ООО “Лестницы-стар” ИП Лестницын О.Н.</p><br><br>
                              <p>Свяжитесь с нами, все расскажем</p>
                          </div>
                          <a class="offer__link--tooltip--link" href="<?php echo THEME_OPTIONS['phone_href'];?>"><?php echo THEME_OPTIONS['phone'];?></a>
                      </div>
                  </div>
              </div>
              <ul class="offer__bullets">
                  <li class="offer-bullet">
                      <img src="<?php echo THEME_STATIC; ?>/img/bullets-about/work-long.svg" alt="Работаем с 2014 года" class="offer-bullet__icon">
                      <p class="offer-bullet__desc">Работаем <br> с 2014 года</p>
                  </li>
                  <li class="offer-bullet">
                      <img src="<?php echo THEME_STATIC; ?>/img/bullets-about/own.svg" alt="Собственное производство в Пензе" class="offer-bullet__icon">
                      <p class="offer-bullet__desc">Собственное производство <br> в Пензе</p>
                  </li>
                  <li class="offer-bullet">
                      <img src="<?php echo THEME_STATIC; ?>/img/bullets-about/install.svg" alt="Возможна самостоятельная установка" class="offer-bullet__icon">
                      <p class="offer-bullet__desc">Возможна самостоятельная установка</p>
                  </li>
                  <li class="offer-bullet">
                      <img src="<?php echo THEME_STATIC; ?>/img/bullets-about/warranty.svg" alt="Честная гарантия от 2 до 5 лет" class="offer-bullet__icon">
                      <p class="offer-bullet__desc">Честная гарантия <br> от 2 до 5 лет</p>
                  </li>
                  <li class="offer-bullet">
                      <img src="<?php echo THEME_STATIC; ?>/img/bullets-about/honets.svg" alt="Честная стоимость и точный расчет" class="offer-bullet__icon">
                      <p class="offer-bullet__desc">Честная стоимость и&nbsp;точный расчет</p>
                  </li>
                  <li class="offer-bullet">
                      <img src="<?php echo THEME_STATIC; ?>/img/bullets-about/locations.svg" alt="Уже в 130 городах России" class="offer-bullet__icon">
                      <p class="offer-bullet__desc">Уже <br> в 130 городах <br> России</p>
                  </li>
              </ul>
          </div>
      </section>

      <section class="quiz container" id="quiz">
          <div class="quiz__container">
              <div class="quiz__desc">
                  <h2 class="quiz__title">
                      Ответьте на 5-6 вопросов и получите <br> расчет лестницы
                      <span class="text--colored">с точностью 98% за 10 минут!</span>
                  </h2>
                  <p class="quiz__hint">
                      Познакомьтесь с вариантами форм лестниц, типами каркаса и другими <br> параметрами. Выберите подходящий. Если есть вопросы — звоните.
                  </p>
                  <a href="<?php echo THEME_OPTIONS['phone_href'];?>" class="quiz__phone js-phone"><?php echo THEME_OPTIONS['phone'];?></a>
              </div>
              <picture class="quiz__pic"><img src="<?php echo THEME_STATIC; ?>/img/quiz/hero.png" alt="" class="quiz__img"></picture>
              <form action="<?php echo FORM_URLS['mail'];?>" class="quiz__questions">
                  <div class="quiz-status">
                      Шаг <span class="quiz-status__step">1/6</span>
                      <span class="quiz-status__name">Выберите форму лестницы</span>
                  </div>
                  <div class="swiper quiz-carousel">
                      <div class="swiper-pagination quiz-pagination"></div>
                      <div class="swiper-wrapper">
                          <div
                            class="swiper-slide quiz-slide quiz-slide--prints quiz-slide--5-answers"
                            data-step-name="Выберите форму лестницы"
                          >
                              <label class="quiz-answer">
                                  <input
                                    type="radio"
                                    name="q1"
                                    class="quiz-answer__radio"
                                    checked
                                    value="Прямой марш"
                                    data-value="1"
                                  >
                                  <span class="quiz-answer__check"></span>
                                  <span class="quiz-answer__desc">Прямой марш</span>
                                  <picture class="quiz-answer__pic">
                                      <img src="<?php echo THEME_STATIC; ?>/img/quiz/1-1.png" alt="" class="quiz-answer__img">
                                  </picture>
                              </label>
                              <label class="quiz-answer">
                                  <input
                                    type="radio"
                                    name="q1"
                                    class="quiz-answer__radio"
                                    value="Г-образная"
                                    data-value="2"
                                  >
                                  <span class="quiz-answer__check"></span>
                                  <span class="quiz-answer__desc">Г-образная</span>
                                  <picture class="quiz-answer__pic">
                                      <img src="<?php echo THEME_STATIC; ?>/img/quiz/1-2.png" alt="" class="quiz-answer__img">
                                  </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q1"
                                  class="quiz-answer__radio"
                                  value="П-образная"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">П-образная</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/1-3.png" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q1"
                                  class="quiz-answer__radio"
                                  value="Винтовая"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Винтовая</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/1-4.png" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q1"
                                  class="quiz-answer__radio"
                                  value="Не решили"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Не решили</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/1-5.svg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                          </div>
                          <div
                            class="swiper-slide quiz-slide quiz-slide--3-answers"
                            data-step-name="Выберите тип лестницы"
                            data-condition="q1!=4"
                            >
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q2"
                                  class="quiz-answer__radio"
                                  value="На металлокаркасе"
                                  checked
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">На металлокаркасе</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/2-1.jpg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q2"
                                  class="quiz-answer__radio"
                                  value="Консольная"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Консольная</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/2-2.jpg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q2"
                                  class="quiz-answer__radio"
                                  value="Лестница для дачи"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc"> Эконом For Life <br> из дерева </span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/2-3.jpg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                          </div>
                          <div
                            class="swiper-slide quiz-slide quiz-slide--6-answers"
                            data-step-name="Выберите тип каркаса"
                            data-condition="q1!=4&&q2==1"
                          >
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q3"
                                  class="quiz-answer__radio"
                                  value="Ломаный косоур"
                                  checked
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Ломаный косоур</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/3-1.jpg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q3"
                                  class="quiz-answer__radio"
                                  value="Монокосоур"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Монокосоур</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/3-2.jpg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q3"
                                  class="quiz-answer__radio"
                                  value="Тетива из листа Perfect"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Тетива из листа Perfect</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/3-3.jpg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q3"
                                  class="quiz-answer__radio"
                                  value="Тетива из листа Z"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Тетива из листа Z</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/3-4.jpg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q3"
                                  class="quiz-answer__radio"
                                  value="Монокосоур из листа"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Монокосоур из листа</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/3-5.jpg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q3"
                                  class="quiz-answer__radio"
                                  value="Закрытый каркас"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Закрытый каркас</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/3-6.jpg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                          </div>
                          <div
                            class="swiper-slide quiz-slide quiz-slide--4-answers"
                            data-step-name="Выберите материал ступеней"
                            data-condition="q2!=3"
                          >
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q4"
                                  class="quiz-answer__radio"
                                  value="Ясень"
                                  checked>
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Ясень</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/4-1.jpg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q4"
                                  class="quiz-answer__radio"
                                  value="Дуб"
                                >
                              <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Дуб</span>
                                <picture class="quiz-answer__pic">
                                  <img src="<?php echo THEME_STATIC; ?>/img/quiz/4-2.jpg" alt="" class="quiz-answer__img">
                                </picture>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q4"
                                  class="quiz-answer__radio"
                                  value="Без ступеней"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Без ступеней</span>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q4"
                                  class="quiz-answer__radio"
                                  value="Другой материал"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Другой материал</span>
                              </label>
                          </div>
                          <div class="swiper-slide quiz-slide quiz-slide--3-answers" data-step-name="Вам известны размеры проема?">
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q5"
                                  class="quiz-answer__radio"
                                  value="Да"
                                  checked
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Да</span>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q5"
                                  class="quiz-answer__radio"
                                  value="Замерю сам, если расскажете как"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Замерю сам, если расскажете как</span>
                              </label>
                              <label class="quiz-answer">
                                <input
                                  type="radio"
                                  name="q5"
                                  class="quiz-answer__radio"
                                  value="Нужен замерщик"
                                >
                                <span class="quiz-answer__check"></span>
                                <span class="quiz-answer__desc">Нужен замерщик</span>
                              </label>
                          </div>
                          <div class="swiper-slide quiz-slide" data-step-name="Опишите кратко свою задачу и известные вам параметры">
                              <div class="quiz__form-layout">
                                  <label class="input input--tel">
                                    <input
                                      class="input__field"
                                      required
                                      name="user_tel"
                                      type="tel"
                                      placeholder="Телефон"
                                      maxlength="25"
                                      minlength="10"
                                      data-value-missing="Напишите телефон"
                                      data-value-invalid="Проверьте корректность телефона"
                                      autocomplete="tel"
                                    >
                                  </label>
                                   <label class="input input--name">
                                    <input
                                      class="input__field"
                                      name="user_name"
                                      type="text"
                                      placeholder="Ваше имя"
                                      data-value-missing="Напишите имя"
                                      data-value-invalid="Что-то не так с введенным именем"
                                      autocomplete="name"
                                    >
                                  </label>
                                   <label class="textarea">
                                    <textarea class="textarea__field" name="user_message" placeholder="Опишите известные вам параметры проема и прикрепите фото  и схему ниже, если есть"></textarea>
                                  </label> <label class="input-attach input-attach--on">
                                    <input
                                      class="input-attach__field"
                                      name="user_file"
                                      type="file"
                                    >
                                    <span class="input-attach__box-icon">
                                    <svg class="input-attach__icon">
                                      <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/attach.svg#attach" />
                                    </svg>
                                  </span>
                                    <span class="input-attach__text link link--underlined"><span class="link__text">Прикрепить файл</span></span>
                                  </label>
                              </div>
                              <button class="quiz__submit button button--secondary button--on" type="submit">Отправить</button>
                          </div>
                      </div>
                      <div class="swiper-buttons quiz-buttons">
                          <div class="swiper-button-prev quiz-button-prev button button--ghost">Назад</div>
                          <div class="swiper-button-next quiz-button-next button button--secondary button--on">Далее
                              <svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M8.31349 1.34772C7.99807 1.03941 7.99807 0.53954 8.31349 0.231231C8.62891 -0.0770772 9.14032 -0.0770772 9.45574 0.231231L13.7634 4.44176C14.0789 4.75007 14.0789 5.24993 13.7634 5.55824L9.45574 9.76877C9.14032 10.0771 8.62891 10.0771 8.31349 9.76877C7.99807 9.46046 7.99807 8.96059 8.31349 8.65228L11.2424 5.78947H0.807692C0.361617 5.78947 0 5.43601 0 5C0 4.56399 0.361617 4.21053 0.807692 4.21053H11.2424L8.31349 1.34772Z" fill="white"/>
                              </svg>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </section>

      <section class="why section">
          <div class="container why__container">
              <div class="section-heading">
                  <h2 class="why__title section-title">Почему выбирают лестницы «Первая ступень»? </h2>
                  <div class="section-heading__links">
                      <!-- <a href="" class="link link--underlined"><span class="link__text offer__link--text">О нашем производстве</span></a> -->
                  </div>
              </div>
              <p class="section__desc why__desc">
                  Более 15 лет мы занимаемся только лестницами на металлическом каркасе, и знаем как реализовывать проекты
                  <br> с лучшим соотношением цены и качества. У нас собственное производство, 20 мастеров с опытом до 25 лет, поэтому
                  <br> мы уверенно несем ответственность за свою работу и даем честные гарантии.
              </p>
              <div class="why__content">
                  <div class="why-media">
                      <img class="why-media__img" src="<?php echo THEME_STATIC; ?>/img/why/why-hero.jpg">
                      <p class="why-media__desc">
                          На ваши вопросы отвечает основатель компании "Первая ступень" Алексей Марышев
                      </p>
                  </div>
                  <?php $why_slides = [];//carbon_get_post_meta(get_the_ID(), 'why_gallery'); ?>
                  <?php if (!empty($why_slides)) : ?>
<!--                     <div class="why__content-slider">
                        <div class="why__content-top">
                            <div class="swiper why-carousel-top why-gallery">
                                <div class="swiper-wrapper">
                                  <?php foreach ($why_slides as $slide_position => $slide_id) : ?>
                                    <div class="swiper-slide why-slide">
                                        <picture class="why__pic">
                                          <img
                                            class="why__img"
                                            src="<?php echo boffeer_get_image_url_by_id($slide_id); ?>"
                                            alt="Фото <?php echo $slide_position; ?>"
                                          >
                                        </picture>
                                    </div>
                                  <?php endforeach; ?>
                                </div>
                                <div class="swiper-pagination why-pagination"></div>
                            </div>
                        </div>
                        <div class="why__content-bottom">
                            <div class="swiper why-carousel-bottom why-gallery">
                                <div class="swiper-wrapper">
                                  <?php foreach ($why_slides as $thumb_position => $thumb_id) : ?>
                                    <div class="swiper-slide why-slide">
                                        <picture class="why__pic">
                                          <img
                                            class="why__img"
                                            src="<?php echo boffeer_get_image_url_by_id($thumb_id); ?>"
                                            alt="Фото <?php echo $thumb_position; ?>"
                                          >
                                        </picture>
                                    </div>
                                  <?php endforeach; ?>
                                </div>
                                <div class="swiper-pagination why-pagination"></div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
 -->                  <?php endif; ?>

                  <?php $why_faq = carbon_get_post_meta(get_the_ID(), 'why_faq'); ?>
                  <?php if (!empty($why_faq)) : ?>
                    <div class="why__faq">
                        <?php
                          $why_faq_ids = array();
                          foreach ($why_faq as $faq) :
                            $why_faq_ids[] = $faq['id'];
                          endforeach;
                          $why_faq = new WP_Query(array(
                              'post_type' => 'faq',
                              'post_status' => 'publish',
                              'post__in' => $why_faq_ids,
                              'orderby' => 'post__in',
                          ));
                        ?>
                        <?php while ($why_faq->have_posts()) : ?>
                          <?php $why_faq->the_post(); ?>
                          <?php get_template_part( 'template-parts/content-faq', get_post_type() ); ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                  <?php endif; ?>

              </div>
              <div class="why__numbers numbers-about">
                  <div class="numbers-about-card">
                      <p class="numbers-about-card__digit">8</p>
                      <p class="numbers-about-card__desc">лет опыта в производстве <br> и установке лестниц из металла</p>
                  </div>
                  <div class="numbers-about-card">
                      <p class="numbers-about-card__digit">1025</p>
                      <p class="numbers-about-card__desc">лестниц изготовили</p>
                  </div>
                  <div class="numbers-about-card">
                      <p class="numbers-about-card__digit">14350</p>
                      <p class="numbers-about-card__desc">ступеней построили</p>
                  </div>
              </div>
          </div>
      </section>

      <section class="shifter">
          <div class="container shifter__container">
              <div class="shifter__card">
                  <div class="shifter__content">
                      <h2 class="shifter__quote">
                          Надежность лестницы и ее техническое совершенство <br> — это еще полдела. Лестница должна быть красивой, <br> тогда это настоящий повод для радости.
                      </h2>
                  </div>
                  <picture class="shifter__pic">
                      <img src="<?php echo THEME_STATIC; ?>/img/shifter/shifter-hero.png" alt="" class="shifter__img">
                  </picture>
              </div>
          </div>
      </section>

      <section class="proud section">
          <div class="container proud__container">
              <h2 class="proud__title section-title">Мы гордимся своими лестницами</h2>
              <?php
                $cases_favorite = carbon_get_post_meta(get_the_ID(), 'cases_favorite');
              ?>
              <div class="proud__gallery">
                  <?php foreach ($cases_favorite as $favorite_position => $favorite) : ?>
                    <?php
                      global $post;
                      $favorite_post = get_post($favorite['case'][0]['id']);
                      $post = $favorite_post;
                      setup_postdata($favorite_post);
                     ?>
                    <article class="proud-card <?php echo ($favorite_position % 2 == 0) ? 'proud-card--has-callout' : ''; ?>">
                        <div class="proud-card__hero">
                            <a href="#" class="proud-card__media js-button__get-content" data-case-id="<?php the_id(); ?>">
                                <?php
                                  $favorite_thumb = $favorite['photo']; 
                                  if ($favorite_thumb == '') :
                                    $favorite_thumb = carbon_get_post_meta(get_the_ID(), 'gallery')[0];
                                  endif;
                                ?>
                                <picture class="proud-card__pic">
                                  <img src="<?php echo boffeer_get_image_url_by_id($favorite_thumb); ?>" alt="<?php the_title(); ?>" class="proud-card__img">
                                </picture>
                            </a>
                            <div class="proud-card__desc">
                                <div class="proud-card__info">
                                    <h3 class="proud-card__title">
                                        <?php $case_title = carbon_get_post_meta(get_the_ID(), 'title'); ?>
                                        <a  class="proud-card__link js-button__get-content"
                                            href="#" 
                                            data-content-get="cases"
                                            data-case-id="<?php the_ID(); ?>"
                                        >
                                          <?php echo $case_title; ?>
                                        </a>
                                    </h3>
                                    <?php $favorite_stats = explode_textarea_matrix(carbon_get_post_meta(get_the_ID(), 'stats')); ?>
                                    <?php if (!empty($favorite_stats)) : ?>
                                      <ul class="proud-card-stats">
                                          <?php foreach($favorite_stats as $stat) : ?>
                                            <?php $current_stat = boffeer_explode_textarea($stat); ?>
                                            <?php if (isset($current_stat[0]) || isset($current_stat[1])) : ?>
                                              <li class="proud-card-stats__item">
                                                <span class="proud-card-stats__name"><?php echo $current_stat[0]; ?></span>
                                                <span class="proud-card-stats__value"><?php echo isset($current_stat[1]) ? $current_stat[1] : ''; ?></span>
                                              </li>
                                            <?php endif; ?>
                                          <?php endforeach; ?>
                                      </ul>
                                    <?php endif;?>
                                </div>
                                <button
                                  class="proud-card__cta link link--underlined js-button__formname"
                                  data-poppa-open="form-callback"
                                  data-form="#form-callback .form-callback"
                                  data-form-name="Хочу также: Кейс «<?php echo $case_title; ?>»"
                                  data-poppa-open="abouts">
                                    <span class="link__text">Хочу так же</span>
                                  </button>
                            </div>
                        </div>
                        <?php if ($favorite_position % 2 == 0) : ?>
                          <div class="proud-card__callout" data-rellax-speed="1.3">
                              <div class="proud-card__callout--box">
                                <?php if ($favorite['desc'] != '') : ?>
                                  <h4 class="porud-card__callout-title">
                                    <?php echo nl2br($favorite['desc']); ?>
                                  </h4>
                                <?php endif; ?>
                                <?php if ($favorite['video_url'] != '') : ?>
                                  <a href="<?php echo $favorite['video_url']; ?>" data-fancybox class="play-button">
                                    <svg class="play-button__icon">
                                      <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/play-icon.svg#play" />
                                    </svg>
                                    <span class="link link--underlined"><span class="link__text">Смотреть видео</span></span>
                                  </a>
                                <?php endif;?>
                              </div>
                          </div>
                        <?php endif; ?>
                    </article>
                  <?php endforeach; ?>
                  <?php wp_reset_postdata(); ?>
              </div>
              <!-- <button class="proud_show-btn">Показать еще</button> -->
          </div>
      </section>

      <section class="projects section">
          <div class="container projects__container">
              <h2 class="section-title projects__title">Наши новые проекты</h2>
              <div class="tabs">
                  <div class="tabs-7p">
                    <form class="tabs-7p__industries tabs-7p__industries--clickable filters-7p"
                          action="<?php echo admin_url( 'admin-ajax.php' );?>"
                          data-action="get_filtered_cases"
                    >
                      <div class="filters-7p__scrollarea">
                        <div class="filters-7p__track">
                          <label class="tabs-7p-tab tabs-7p-tab--total">
                              <input type="radio" name="filter" class="tabs-7p-tab__input" value="-1" checked>
                              <span class="tabs-7p-tab__text">Все</span>
                          </label>
                        </div>
                      </div>
                      <div class="tabs-7p__more">
                          <?php
                            $categories = get_terms(array(
                                'orderby'    => 'none',
                                'taxonomy'   => 'categories',
                                'hide_empty' => true,
                            ));
                          ?>
                          <button class="tabs__toggler tabs-7p__more-button" title="" type="button">
                              Все категории
                              <span class="button-more__dot"></span>
                              <span class="button-more__dot"></span>
                              <span class="button-more__dot"></span>                  
                          </button>
                          <div class="tabs-7p__industries-dropdown">
                            <?php foreach ($categories as $category) : ?>
                              <?php if ($category->count < 2) continue; ?>
                              <label class="tabs-7p-tab">
                                <input type="radio" name="filter" class="tabs-7p-tab__input" value="<?php echo $category->term_id; ?>">
                                <span class="tabs-7p-tab__text"><?php echo $category->name; ?></span>
                              </label>
                            <?php endforeach; ?>
                          </div>
                      </div>
                    </form>
                  </div>
                  <div class="tabs__page-container tabs-7p__content" data-tabs="projects">
                      <div class="tabs__page">
                          
                          <div class="projects-top">
                              <p class="projects-top-text">
                                  Здесь отображается какой-то текст про все лестницы. Можно упомянуть о чем-то, что лежит не на поверхности в других разделах, или каких-то новых преимуществах. При переключении вкладок, на них рассказывается вкратце о типах и видах лестниц. А ссылка справа
                                  может меняться на более конкретную.
                              </p>
                              <a href="cases" class="projects-top-link link link--underlined">
                                  <span class="link__text">
                                      Все проекты
                                  </span>
                              </a>
                          </div>
                           
                          <div class="projects-gallery" data-swiper="main" data-swiper-destroy="true" data-swiper-pagination data-swiper-navigation data-breakpoints='{"0": {"slidesPerView" : 1, "autoHeight": true},"602": {"spaceBetween": 16}, "992": {"spaceBetween": 24}, "1300": {"spaceBetween": 36, "autoHeight": true}}'
                              data-swiper-slide="3">
                               
                                  <div class="swiper projects-gallery-carousel">
                                      <div class="swiper-wrapper">

                                        <?php
                                          $home_cases = new WP_Query(array(
                                              'post_type' => 'cases',
                                              'post_status' => 'publish',
                                              'orderby' => 'rand',
                                          ));
                                        ?>
                                        <?php while ($home_cases->have_posts()) : ?>
                                          <?php
                                            $home_cases->the_post();
                                           ?>
                                            <div class="swiper-slide projects-gallery-slide">
                                                <?php get_template_part( 'template-parts/content-cases', get_post_type() ); ?>
                                            </div>
                                        <?php endwhile; ?>
                                        <?php wp_reset_postdata(); ?>
                                      </div>
                                  </div>
                                  <div class="swiper-buttons projects-gallery-buttons">
                                      <div class="swiper-button-prev"></div>
                                      <div class="swiper-button-next"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <section class="shifter shifter-form-main">
          <div class="container shifter__container">
              <div class="shifter__card">
                  <div class="shifter__content">
                      <h2 class="shifter__title section-title">Хотите посмотреть еще?</h2>
                      <p class="shifter__desc">
                          Получите подборку из 50 наших лучших работ, <br> и вы точно найдете подходящий вам вариант! <br> Куда отправить?
                      </p>
                          
                      <form action="<?php echo FORM_URLS['mail'];?>" class="form form-callback shifter__form">
                          <input type="hidden" name="form_name" value="Получите подборку из 50 наших лучших работ, и вы точно найдете подходящий вам вариант!  Куда отправить?" readonly>
                          <div class="radio__row">
                              <label class="radio">
                                <input type="radio" name="user_connect" value="Телефон" class="radio__input" checked>
                                <span class="radio__check"></span>
                                <span class="radio__title">Телефон</span>
                              </label>
                              <label class="radio">
                                <input type="radio" name="user_connect" value="Telegram" class="radio__input">
                                <span class="radio__check"></span>
                                <span class="radio__title">Telegram</span>
                              </label>
                                              <label class="radio">
                                <input type="radio" name="user_connect" value="WhatsApp" class="radio__input">
                                <span class="radio__check"></span>
                                <span class="radio__title">WhatsApp</span>
                              </label>
                          </div>
                          <div class="form-callback__row">
                              <label class="input input--tel">
                                <input
                                  class="input__field"
                                  required
                                  name="user_tel"
                                  type="tel"
                                  placeholder="Телефон"
                                  maxlength="25"
                                  minlength="10"
                                  data-value-missing="Напишите телефон"
                                  data-value-invalid="Проверьте корректность телефона"
                                  autocomplete="tel"
                                >
                              </label>
                               <label class="input input--name">
                                <input
                                  class="input__field"
                                  name="user_name"
                                  type="text"
                                  placeholder="Ваше имя"
                                  data-value-missing="Напишите имя"
                                  data-value-invalid="Что-то не так с введенным именем"
                                  autocomplete="name"
                                >
                              </label>

                              <button class="button button--secondary button--icon-left nt-btn">
                                <svg class="button__icon">
                                  <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/download.svg#download" />
                                </svg>
                                <span class="button__text">Получить каталог</span>
                              </button>
                          </div>
                      </form>
                  </div>
                  <picture class="shifter__pic">
                      <img src="<?php echo THEME_STATIC; ?>/img/shifter/callback-hero.png" alt="" class="shifter__img">
                  </picture>
              </div>
          </div>
      </section>

      <section class="reviews section">
          <div class="container">
              <div class="reviews__container">
                  <div class="section-heading">
                      <h1 class="section-title reviews__title sect-otzyvi-page__title">Отзывы клиентов</h1>
                      <div class="section-heading__links">
                        <div class="section-heading__links-scroll">
                          <div class="section-heading__links-track">
                            <button data-poppa-open="otzyv-callback" class="link-popup">
                                <span class="link__text">НАПИСАТЬ ОТЗЫВ</span>
                            </button>
                            <a href="reviews" class="link link-regular">
                                <span class="link__text">Отзывы на нашем сайте</span>
                            </a>
                            <?php if (THEME_OPTIONS['reviews_yandex_url']) : ?>
                              <a class="link link-regular link--external"href="<?php echo THEME_OPTIONS['reviews_yandex_url']; ?>" target="_blank">
                                  <span class="link__text">Отзывы на Яндекс Картах</span>
                              </a>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="reviews-slider" data-swiper="main" data-swiper-slide="2" data-breakpoints='{"0": {"slidesPerView": 1}, "600": {"slidesPerView": 2, "spaceBetween": 16}, "992": {"spaceBetween": 24}, "1300": {"spaceBetween": 36}}' data-swiper-pagination data-swiper-navigation
                      data-swiper-touch>
                      <div class="swiper reviews-carousel">
                          <div class="swiper-wrapper">
                            <?php $home_reviews = carbon_get_post_meta(get_the_ID(), 'home_reviews'); ?>
                            <?php foreach ($home_reviews as $review_position => $review) : ?>
                              <?php
                                global $post;
                                $favorite_review = get_post($review['id']);
                                $post = $favorite_review;
                                setup_postdata($favorite_review);
                               ?>
                              <div class="swiper-slide reviews-slide">
                                  <?php get_template_part( 'template-parts/content-reviews', get_post_type() ); ?>
                              </div>
                              <?php endforeach; ?>
                              <?php wp_reset_postdata(); ?>
                          </div>
                      </div>
                      <div class="swiper-pagination"></div>
                      <div class="swiper-buttons reviews-gallery-buttons">
                          <div class="swiper-button-prev projects-gallery-button-prev"></div>
                          <div class="swiper-button-next projects-gallery-button-next"></div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <?php
        $news = new WP_Query(array(
            'post_type' => 'news',
            'post_status' => 'publish',
        ));
      ?>
      <?php if ($news->have_posts()) : ?>
      <section class="news">
          <div class="container news__container">
              <h2 class="section-title news__title">Статьи от наших экспертов</h2>
              <div class="news-slider" data-swiper="main" data-swiper-destroy="true" data-breakpoints='{"601": {"slidesPerView": 2}, "720": {"slidesPerView": 3, "spaceBetween": 16}, "992": {"slidesPerView": 4, "spaceBetween": 24}, "1300": {"slidesPerView": 4, "spaceBetween": 36}}' data-swiper-navigation
                  data-swiper-touch>
                  <div class="swiper news-carousel">
                      <div class="swiper-wrapper">
                          <?php while ($news->have_posts()) : ?>
                            <?php $news->the_post(); ?>
                              <div class="swiper-slide news-slide">
                                <?php get_template_part( 'template-parts/content-news', get_post_type() ); ?>
                              </div>
                          <?php endwhile; ?>
                          <?php wp_reset_postdata(); ?>
                      </div>
                  </div>
                  <div class="swiper-buttons">
                      <div class="swiper-button-prev"></div>
                      <div class="swiper-button-next"></div>
                  </div>
              </div>
              <button class="button button--primary button--wide _only-mobile news__button-more" type="button">Смотреть больше</button>
          </div>
      </section>
      <?php endif; ?>

      <?php
        $videos = new WP_Query(array(
            'post_type' => 'videos',
            'post_status' => 'publish',
        ));
      ?>
      <?php if ($videos->have_posts()) : ?>
      <section class="videos section">
          <div class="container videos__container">
              <h2 class="section-title faq__title">Видео</h2>
               <div class="tabs">
                  <div class="tabs-7p">
                    <form class="tabs-7p__industries tabs-7p__industries--clickable filters-7p"
                          action="<?php echo admin_url( 'admin-ajax.php' );?>"
                          data-action="get_videos"
                    >
                      <div class="filters-7p__scrollarea">
                        <div class="filters-7p__track">
                          <label class="tabs-7p-tab tabs-7p-tab--total">
                              <input type="radio" name="filter" class="tabs-7p-tab__input" value="-1" checked>
                              <span class="tabs-7p-tab__text">Все</span>
                          </label>
                        </div>
                      </div>
                      <div class="tabs-7p__more">
                          <?php
                            $videos_categories = get_terms(array(
                                'orderby'    => 'none',
                                'taxonomy'   => 'videos-categories',
                                'hide_empty' => true,
                            ));
                          ?>
                          <button class="tabs__toggler tabs-7p__more-button" title="" type="button">
                              Все категории
                              <span class="button-more__dot"></span>
                              <span class="button-more__dot"></span>
                              <span class="button-more__dot"></span>                  
                          </button>
                          <div class="tabs-7p__industries-dropdown">
                            <?php foreach ($videos_categories as $category) : ?>
                              <label class="tabs-7p-tab">
                                <input type="radio" name="filter" class="tabs-7p-tab__input" value="<?php echo $category->term_id; ?>">
                                <span class="tabs-7p-tab__text"><?php echo $category->name; ?></span>
                              </label>
                            <?php endforeach; ?>
                          </div>
                      </div>
                    </form>
                  </div>
                  <div class="tabs__page-container" data-tabs="video">
                      <div class="tabs__page">
                          <div class="videos-slider" data-swiper="main" data-swiper-destroy="true" data-breakpoints='{"601": {"slidesPerView": 2, "autoHeight": true}, "720": {"slidesPerView": 3, "spaceBetween": 16}, "992": {"slidesPerView": 4, "spaceBetween": 24}, "1300": {"slidesPerView": 4, "spaceBetween": 36}}' data-swiper-navigation
                              data-swiper-touch>
                              <div class="swiper videos-carousel">
                                  <div class="swiper-wrapper">
                                      <?php while ($videos->have_posts()) : ?>
                                        <?php
                                          $videos->the_post();
                                         ?>
                                          <div class="swiper-slide videos-slide">
                                              <?php get_template_part( 'template-parts/content-videos', get_post_type() ); ?>
                                          </div>
                                      <?php endwhile; ?>
                                      <?php wp_reset_postdata(); ?>
                                  </div>
                              </div>
                              <div class="swiper-buttons videos-buttons">
                                  <div class="swiper-button-prev videos-button-prev"></div>
                                  <div class="swiper-button-next videos-button-next"></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <?php endif;?>

      <?php $home_faq_items = carbon_get_post_meta(get_the_ID(), 'home_faq'); ?>
      <?php if (!empty($home_faq_items)) : ?>
      <section class="faq">
          <div class="container faq__container">
              <h2 class="section-title faq__title">Отвечаем на ваши вопросы</h2>
              <div class="faq__cards">
                  <?php
                    $home_faq_ids = array();
                    foreach ($home_faq_items as $faq) :
                      $home_faq_ids[] = $faq['id'];
                    endforeach;
                    $home_faq = new WP_Query(array(
                        'post_type' => 'faq',
                        'post_status' => 'publish',
                        'post__in' => $home_faq_ids,
                        'orderby' => 'post__in',
                    ));
                  ?>
                  <?php while ($home_faq->have_posts()) : ?>
                    <?php $home_faq->the_post(); ?>
                    <?php get_template_part( 'template-parts/content-faq', get_post_type() ); ?>
                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?>
              </div>
              <button class="button button--primary button--primary-white button--wide faq__button">Показать еще</button>
          </div>
      </section>
      <?php endif; ?>

      <section class="shifter shifter-bottom section">
          <div class="container shifter__container">
              <div class="shifter__card">
                  <div class="shifter__content">
                      <h2 class="shifter__title section-title">
                          Не нашли ответа? <span class="shifter__title--color"> Задайте свой вопрос!</span>
                      </h2>
                      <p class="shifter__desc">
                          10 минут консультации заменят 2 часа поиска в интернете. Обычно ответ оказывается точным и полным, чем от&nbsp;бесконечных поисков по сайтам. Консультация бесплатна.
                      </p>
                      <a href="<?php echo THEME_OPTIONS['phone_href'];?>" class="shifter__phone js-phone link link--underlined">
                          <span class="link__text offer__link--text"><?php echo THEME_OPTIONS['phone'];?></span>
                      </a>
                      <button class="button button--primary" data-poppa-open="form-callback">Заказать звонок</button>
                  </div>
                  <picture class="shifter__pic">
                      <img src="<?php echo THEME_STATIC; ?>/img/shifter/question-hero.png" alt="" class="shifter__img">
                  </picture>
              </div>
          </div>
      </section>

      <section class="locations">
          <div class="container locations__container">
              <h2 class="section-title locations__title">Наши лестницы по всей России</h2>
              <p class="location__desc">
                  Работаем по всей России. Для нас нет четких рамок и границ. Наше производство в Пензе.<br> Наши мастера и офисы — в 12 городах России, а наши лестницы установлены в 43 разных городах.3
              </p>
              <div class="locatoin-addresses" style="display: none;" >
                <?php $contacts_cities = carbon_get_theme_option('contacts_cities'); ?>
                <?php foreach ($contacts_cities as $city) : foreach ($city['locations'] as $location) : ?>
                  <span class="location-addresses__item" data-address="<?php echo $location['address']; ?>"></span>
                <?php endforeach; endforeach;?>
              </div>
              <div id="map"></div>
          </div>
      </section>

      <section class="work section">
          <div class="container work__container">
              <div class="work__top">
                  <div class="text-dropdown link--underlined">
                      <h2 class="section-title work__title city-picker">
                          Как мы работаем в
                          <span class="dropdown">
                            <span class="link__text offer__link--text city-picker__current" data-dropdown>г. Москва</span>
                            <span class="dropdown__body">
                                <p class="dropdown__body-title">Выбор города</p>
                                <ul class="dropdown__body--list">
                                  <?php $cities = carbon_get_theme_option('contacts_cities'); ?>
                                  <?php foreach ($cities as $city) : ?>
                                      <li class="city-picker__element dropdown__body--list-element <?php echo $city['city'] === 'Москва' ? '_active' : ''?>" data-city="<?php echo $city['city']; ?>">
                                        <a href="<?php echo $city['url']?>"><?php echo $city['city']; ?></a>
                                      </li>
                                  <?php endforeach; ?>
                                </ul>
                            </span>
                          </span>
                      </h2>
                  </div>
              </div>

              <div class="work-block__overflow">
                <div class="work-block__track">
                  <ol class="work__list">
                      <li class="work-bullet">
                          <h3 class="work-bullet__title">
                              Позвоните нам или оставьте заявку на&nbsp;сайте
                          </h3>
                          <a href="<?php echo THEME_OPTIONS['phone_href'];?>" class="work-bullet__phone js-phone"><?php echo THEME_OPTIONS['phone'];?></a>
                          <p class="work-bullet__desc">
                              Опытные консультанты помогут подобрать тип и конструктив лестницы, наиболее подходящий для Вашего дома. Мы ответим на все Ваши вопросы, проконсультируем по материалам, сделаем предварительный расчёт стоимости Вашей лестницы.
                          </p>
                      </li>
                      <li class="work-bullet">
                          <h3 class="work-bullet__title">Вызовите мастера для замера</h3>
                          <p class="work-bullet__desc">
                              Мастер в удобное для Вас время подъедет на объект, произведёт замер и проконсультирует по всем вопросам. Результаты 3D замера лягут в основу Вашего проекта и точного расчёта стоимости работ.
                          </p>
                      </li>
                      <li class="work-bullet">
                          <h3 class="work-bullet__title">Составим 3D-проект лестницы, рассчитаем точную смету</h3>
                          <p class="work-bullet__desc">
                              В проектировании мы используем самые современные технологии, базирующиеся на результатах 3D замера. Формируется эскиз проекта, визуализация, деталировка. Такая технология позволяет сделать точный расчёт цены. Доплат и корректировок цены не будет.
                          </p>
                      </li>
                      <li class="work-bullet">
                          <h3 class="work-bullet__title">Изготовим лестницу</h3>
                          <p class="work-bullet__desc">
                              Изготовление производится на базе собственного производства, используется высокоточное итальянское оборудование. Все детали многократно проверяются по качеству и размерам. После изготовления — внутренняя приёмка заказа главным инженером.
                          </p>
                      </li>
                      <li class="work-bullet">
                          <h3 class="work-bullet__title">Доставим лестницу на ваш объект</h3>
                          <p class="work-bullet__desc">
                              Комплектующие упаковываются для транспортировки в изолон толщиной 2 мм, гарантирующий сохранность. Доставка на объект производится транспортом компании после согласования с заказчиком и подготовки площадки.
                          </p>
                      </li>
                  </ol>
                </div>
              </div>
          </div>
      </section>

      <section class="time">
          <div class="container time__container">
              <h2 class="section-title time__title">Ценим и бережем ваше&nbsp;время</h2>
              <div class="time__gallery">
                  <article class="time-card">
                      <h3 class="time-card__title">Смета с точностью 98%&nbsp;за&nbsp;5&nbsp;минут</h3>
                      <p class="time-card__desc">
                          Мы уже столько сделали лестниц, что научились понимать вас с полуслова с закрытыми глазами. И можем рассчитать стоимость на консультации за 10 минут.
                      </p>
                  </article>
                  <article class="time-card">
                      <h3 class="time-card__title">Металлический каркас <br> лестницы за 7-14 дней</h3>
                      <p class="time-card__desc">
                          Срок изготовления металлического каркаса лестницы и ограждений составляет от 7-ми до 14-ти дней. Срок изготовления деревянных ступеней от 15-ти до 30-ти дней.
                      </p>
                  </article>
                  <picture class="time__pic">
                      <img src="<?php echo THEME_STATIC; ?>/img/time-save/time-hero.png" alt="" class="time__img">
                  </picture>
                  <article class="time-card">
                      <h3 class="time-card__title">3D проект лестницы за&nbsp;2&nbsp;дня</h3>
                      <p class="time-card__desc">
                          Наш инженер-проектировщик предоставит Вам схему лестницы прямо на объекте в день замера. Полноценный 3D-проект со всеми размерами будет готов в течение 2-х дней.
                      </p>
                  </article>
                  <article class="time-card">
                      <h3 class="time-card__title">Монтаж лестницы <br> на&nbsp;объекте за 4-8 часов</h3>
                      <p class="time-card__desc">
                          Монтаж лестницы на объекте занимает от 4-х до 8-ми часов в зависимости от сложности конструкции.
                      </p>
                  </article>
              </div>
          </div>
      </section>

      <section class="shifter-callback section">
          <div class="shifter-callback__container container">
              <div class="shifter-callback-card">
                  <div class="shfiter-form__info">
                      <h2 class="shifter-callback__title section-title">Узнайте стоимость <br> лестницы за 5 минут!</h2>
                      <p class="shifter-callback__desc">
                          Заполните форму, и мы подберем лучший вариант лестницы специально под ваши запросы. Или сделаем что-то абсолютно уникальное.
                          <br>
                          <br> Просто укажите известные размеры проема в заявке, а мы перезвоним вам и назовем точную стоимость лестницы.
                      </p>
                  </div>
                  <form
                    class="shifter-callback__form"
                    action="<?php echo FORM_URLS['mail'];?>"
                  >
                      <input type="hidden" name="form_name" value="Узнайте стоимость лестницы за 5 минут!" readonly>
                      <div class="shifter-callback__form-fields">
                          <label class="input input--tel">
                            <input
                              class="input__field"
                              required
                              name="user_tel"
                              type="tel"
                              placeholder="Телефон"
                              maxlength="25"
                              minlength="10"
                              data-value-missing="Напишите телефон"
                              data-value-invalid="Проверьте корректность телефона"
                              autocomplete="tel"
                            >
                          </label>
                           <label class="input input--name">
                            <input
                              class="input__field"
                              name="user_name"
                              type="text"
                              placeholder="Ваше имя"
                              data-value-missing="Напишите имя"
                              data-value-invalid="Что-то не так с введенным именем"
                              autocomplete="name"
                            >
                          </label>
                           <label class="textarea">
                            <textarea class="textarea__field" name="user_message" placeholder="Опишите свою задачу и укажите известные размеры проема"></textarea>
                          </label> <label class="input-attach">
                            <input
                              class="input-attach__field"
                              name="user_file"
                              type="file"
                            >
                            <span class="input-attach__box-icon">
                            <svg class="input-attach__icon">
                              <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/attach.svg#attach" />
                            </svg>
                          </span>
                            <span class="input-attach__text link link--underlined"><span class="link__text">Прикрепить файл</span></span>
                          </label>
                      </div>
                      <div class="shifter-callback__form--box">
                          <button class="button button--primary shifter-callback__submit" type="submit">Отправить</button>
                          <p class="shifter-callback__privacy">
                              Нажимая кнопку “Отправить”, вы даете согласие на <br> обработку 
                              <a href="<?php echo THEME_OPTIONS['privacy_url'];?>" class="link">персональных данных</a>
                          </p>
                      </div>
                  </form>
              </div>
          </div>
      </section>
  </main>
<?php get_footer(); ?>