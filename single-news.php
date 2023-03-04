<?php get_header(); ?>

      <main>
          <div class="breadcrumbs container">
              <ul class="breadcrumbs__list">
                  <li class="breadcrumbs__item">
                      <a href="/">Главная</a>
                  </li>
                  <li class="breadcrumbs__item">
                      <a href="">Лестницы</a>
                  </li>
                  <li class="breadcrumbs__item">
                      На металлокаркасе
                  </li>
              </ul>
          </div>
          <section class="sect-delivery section-page-m">
              <div class="container">
                  <h1 class="section-title sect-delivery__title"><?php the_title(); ?></h1>
                  <?php
                      $news_thumb_id = carbon_get_post_meta(get_the_ID(), 'thumb');
                      $news_thumb = boffeer_get_image_url_by_id($news_thumb_id);
                  ?>
                  <?php if ($news_thumb_id != '') : ?>
                    <img class="sect-delivery__big" src="<?php echo $news_thumb; ?>" alt="<?php the_title(); ?>">
                  <?php endif;?>
                  <div class="sect-delivery__container wysiwyg">
                      <div class="sect-delivery__left">
                          <?php the_content(); ?>
                      </div>
                      <?php if (do_shortcode('lwptoc')) : ?>
                        <div class="sect-delivery__content">
                            <?php echo do_shortcode('[lwptoc]')?>
                        </div>
                      <?php endif; ?>
                  </div>
              </div>
          </section>

          <section class="shifter shifter-bottom section">
              <div class="container shifter__container">
                  <div class="shifter__card">
                      <div class="shifter__content">
                          <h2 class="shifter__title section-title">
                              Остались вопросы?<br> Свяжитесь с нами!
                          </h2>
                          <p class="shifter__desc">
                              10 минут консультации заменят 2 часа поиска в интернете. Обычно ответ оказывается точным и полным, чем от бесконечных поисков по сайтам. Консультация бесплатна.
                          </p>
                          <a href="tel:+78412234345" class="shifter__phone js-phone link link--underlined">
                              <span class="link__text offer__link--text">+7 (8412) 23-43-45</span>
                          </a>
                          <button class="button button--primary" data-poppa-open="callback">Заказать звонок</button>
                      </div>
                      <picture class="shifter__pic">
                          <img src="<?php echo THEME_STATIC; ?>/img/shifter/question-hero.png" alt="" class="shifter__img">
                      </picture>
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
                      <form action="<?php echo FORM_URLS['mail']; ?>" class="shifter-callback__form">
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
                              <textarea class="textarea__field" placeholder="Напишите пару интересных слов о нашей работе :)"></textarea>
                              </label> <label class="input-attach @@className">
                              <input
                                class="input-attach__field"
                                name="user_file"
                                type="file"
                              >
                              <span class="input-attach__box-icon">
                              <svg class="input-attach__icon">
                                <use xlink:href="./img/common/attach.svg#attach" />
                              </svg>
                              </span>
                              <span class="input-attach__text link link--underlined"><span class="link__text">Прикрепить файл</span></span>
                              </label>
                          </div>
                          <div class="shifter-callback__form--box">
                              <button class="button button--primary shifter-callback__submit">Отправить</button>
                              <p class="shifter-callback__privacy">
                                  Нажимая кнопку “Отправить”, вы даете согласие на обработку
                                  <a href="#" class="link">персональных данных</a>
                              </p>
                          </div>
                      </form>
                  </div>
              </div>
          </section>
      </main>

<?php get_footer(); ?>
