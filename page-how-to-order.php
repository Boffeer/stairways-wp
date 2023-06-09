<?php get_header(); ?>

      <main>
          <?php echo get_breadcrumbs(); ?>
          <section class="sect-delivery section-page-m">
              <div class="container">
                  <h1 class="section-title sect-delivery__title">Как заказать лестницу?</h1>
                  <!-- <img class="sect-delivery__big" src="<?php echo THEME_STATIC; ?>/img/delivery/base.jpg" alt=""> -->
                  <div class="sect-delivery__container">
                      <div class="sect-delivery__left">
                          <div class="sect-delivery__step" data-step="1" id="step-1">
                              <span class="sect-delivery__step--count">1 этап</span>
                              <h2 class="sect-delivery__step--title">Определение стоимости лестницы</h2>
                              <p class="sect-delivery__step--text">Для расчета стоимости лестницы потребуются размеры проема. Замерить можно по нашей инструкции.</p>
                              <a class="sect-delivery__step--download" href="https://fs.7pap-dev.ru/wp-content/uploads/2023/03/instrukcija-po-zameru.docx" download>Скачать инструкцию</a>
                              <p class="sect-delivery__step--text">Для более точного расчета пришлите нам несколько фото вашего проема. Мы укажем размеры, которые потребуются.</p>
                              <div class="sect-delivery__step--info">
                                  <p class="sect-delivery__step--info-text">Обращаем внимание, что делать замер — не страшно. Вся процедура занимает 5-10 минут. Удобнее проводить ее вдвоем. Это позволит точно рассчитать конфигурацию и стоимость лестницы</p>
                              </div>
                              <div class="shifter-callback-card">
                                  <div class="shfiter-form__info">
                                      <h2 class="shifter-callback__title section-title">Узнайте стоимость лестницы за 5 минут!</h2>
                                      <p class="shifter-callback__desc">
                                          Заполните форму, и мы подберем лучший вариант лестницы специально под ваши запросы. <br> Или сделаем что-то абсолютно уникальное.
                                          <br>
                                          <br> Просто укажите известные размеры проема в заявке, а мы перезвоним вам и назовем точную стоимость лестницы.
                                      </p>
                                  </div>
                                  <form action="<?php echo FORM_URLS['mail'];?>" class="shifter-callback__form">
                                    <input type="hidden" readonly name="form_name" value="Узнайте стоимость лестницы за 5 минут!"> 
                                      <div class="shifter-callback__form-fields">
                                          <label class="input input--tel input--init">
                                          <input class="input__field" required="" name="user_tel" type="tel" placeholder="+7 (___) ___-__-__" maxlength="25" minlength="10" data-value-missing="Напишите телефон" data-value-invalid="Проверьте корректность телефона" autocomplete="tel">
                                        </label>
                                        <label class="input input--name input--init">
                                          <input class="input__field" name="user_name" type="text" placeholder="Ваше имя" data-value-missing="Напишите имя" data-value-invalid="Что-то не так с введенным именем" autocomplete="name">
                                        </label>
                                        <label class="textarea" data-initial-height="94">
                                          <textarea class="textarea__field" placeholder="Напишите пару интересных слов о нашей работе :)"></textarea>
                                        </label>
                                        <label class="input-attach">
                                          <input class="input-attach__field" name="user_file" type="file">
                                          <span class="input-attach__box-icon">
                                            <svg class="input-attach__icon">
                                              <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/attach.svg#attach"></use>
                                            </svg>
                                          </span>
                                          <span class="input-attach__text link link--underlined"><span class="link__text">Прикрепить файл</span></span>
                                        </label>
                                      </div>
                                      <div class="shifter-callback__form--box">
                                          <button class="button button--primary shifter-callback__submit">Отправить</button>
                                          <p class="shifter-callback__privacy">
                                              Нажимая кнопку “Отправить”, вы даете согласие на<br> обработку
                                              <a href="<?php echo THEME_OPTIONS['privacy_url']; ?>" target="_blank" class="link">персональных данных</a>
                                          </p>
                                      </div>
                                  </form>

                              </div>
                              <div class="sect-delivery__step--text">
                                  Получив замеры мы строим конфигурацию лестницы, определяем материалы, стоимость и направляем вам коммерческое предложение.<br><br> Завершение данного этапа – это выезд
                                  <span class="sect-delivery__step--text--info" data-tooltip="Если в вашем регионе нет замерщика,
                                  то мы проверим все размеры помещения
                                  удаленно на подготовленной нами
                                  визуализации проема.">замерщика</span> для уточнения размеров и консультации на месте. Обсудите с ним цвета, места и способы крепления лестницы и другие технические вопросы.
                              </div>
                          </div>
                          <div class="sect-delivery__step" data-step="2" id="step-2">
                              <span class="sect-delivery__step--count">2 этап</span>
                              <h2 class="sect-delivery__step--title">Заключение договора, внесение предоплаты</h2>
                              <p class="sect-delivery__step--text">Когда нюансы учтены, согласованы стоимость и сроки, мы заключаем
                                  <span class="sect-delivery__step--text--info" data-tooltip="Оригиналами договора можем обменяться по почте,
                                  в офисе, или электронно в соответствии с ФЗ-63
                                  «Об электронной подписи». Получать специальную
                                  электронную подпись при этом не нужно.
                                  Для юридических лиц возможен обмен документами
                                  через СБИС или ДИАДОК">договор.</span> Когда договор подписан вносится предоплата в размере 50% от стоимости изделий. Оплачивать удобно. Мы вышлем счет, в котором нужно отсканировать
                                  QR-код приложением вашего банка.</p>
                              <a href="" class="sect-delivery__step--download" download="">Скачать пример договора</a>
                          </div>
                          <div class="sect-delivery__step" data-step="3" id="step-3">
                              <span class="sect-delivery__step--count">3 этап</span>
                              <h2 class="sect-delivery__step--title">Проектирование и согласование</h2>
                              <p class="sect-delivery__step--text">После внесения предоплаты ваш заказ поступает в работу к инженеру-конструктору. Он прорабатывает детали, выстраивает лестницу, делает визуализацию для наглядности.
                                  <br><br> Еще на этом этапе мы согласовываем цвета изделий. Подбираем цвет, если нужно подобрать «под ламинат».
                                  <br><br> В результате вы получите лист согласования с точной схемой, размерами и описанием лестницы. Это еще один этап контроля!</p>
                              <div class="sect-delivery__step--info">
                                  <p class="sect-delivery__step--info-text">Не подписывайте лист согласования, не проверив все полностью и не изучив детали. Если что-то не понятно, вы всегда можете обратиться за разъяснениями к вашему менеджеру или конструктору.</p>
                              </div>
                              <p class="sect-delivery__step--text">Когда вы убедились, что все как надо, лист согласования нужно подписать и отправить нам скан или подписать электронно. Это даже удобно.</p>
                          </div>
                          <div class="sect-delivery__step" data-step="4" id="step-4">
                              <span class="sect-delivery__step--count">4 этап</span>
                              <h2 class="sect-delivery__step--title">Изготовление лестницы</h2>
                              <p class="sect-delivery__step--text">
                                  Теперь лестница поступает в цех для <span data-tooltip="Срок изготовления занимает от двух недель
                                  до двух месяцев в зависимости от сложности
                                  и объема работ. Сроки всегда прописываются
                                  в договоре заранее">изготовления.</span> По окончанию, мы отправим вам фото-видео отчет о проделанной работе. Когда вы ознакомитесь с отчетом, нужно доплатить оставшуюся часть стоимости изготовления, а нам подготовить
                                  лестницу к отправке и монтажу.
                              </p>
                              <p class="sect-delivery__step--text section-text--bold">
                                Пример фото-видео отчета:
                              </p>
                              <div class="reviews__container">
                                <div class="reviews__photos">
                                    <?php $review = carbon_get_post_meta(312, 'review_gallery');?>
                                    <?php foreach ($review as $slide) : ?>
                                        <a href="<?php echo boffeer_get_image_url_by_id($slide); ?>" data-fancybox="reviews" class="reviews__media">
                                            <picture class="reviews__pic">
                                                <img
                                                    src="<?php echo boffeer_get_image_url_by_id($slide); ?>"
                                                    alt="" class="reviews__img">
                                            </picture>
                                        </a>
                                    <?php endforeach; ?>
                                    <button class="button reviews__photos-more">+5</button>
                                </div>
                              </div>
                          </div>
                          <div class="sect-delivery__step" data-step="5" id="step-5">
                              <span class="sect-delivery__step--count">5 этап</span>
                              <h2 class="sect-delivery__step--title">Доставка и монтаж</h2>
                              <p class="sect-delivery__step--text">
                                  Доставим лестницу нашим транспортом «от двери до двери». Если заказан монтаж, то монтажники приезжают вместе с лестницей. Каркас лестницы, устанавливается от 2 до 4 часов. Лестница со ступенями и ограждениями ставится от 1 до 3 дней.
                                  <br><br> Монтаж лестницы возможно провести самостоятельно. Мы изготовим лестницу таким образом, чтобы все собиралось умелыми мастерами с минимумом инструмента. Список совместимого инструмента для монтажа лестницы, вы
                                  можете скачать по кнопке ниже.
                              </p>
                              <a class="sect-delivery__step--download" href="https://fs.7pap-dev.ru/wp-content/uploads/2023/03/spisok-instrumenta-dlja-montazha.docx" download>Скачать</a>
                              <p class="sect-delivery__step--text">Когда лестница установлена, остается лишь подписать акт выполненных работ, оплатить монтаж и пользоваться вашей новой лестницей!</p>
                          </div>
                      </div>
                      <div class="sect-delivery__content">

                          <?php 
                            // Получить ссылку на видео из первого
                            global $post;
                            $cases_favorite_first = carbon_get_post_meta(get_option('page_on_front'), 'cases_favorite')[0];
                            $case_id = $cases_favorite_first['case'][0]['id'];
                            $favorite_post = get_post($case_id);
                            $post = $favorite_post;
                            setup_postdata($favorite_post);

                            $video_url = $cases_favorite_first['video_url'];//carbon_get_post_meta(get_the_ID(), 'video_url');
                            $video_id = '';

                            if ($video_url != '') {
                              $video_id = get_yt_id($video_url);
                            }

                            $case_title = carbon_get_post_meta(get_the_ID(), 'title');

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
                          <?php if ($video_id != '') : ?>
                            <article class="videos-card">
                                <div class="videos-card__media">
                                    <picture class="videos-card__pic">
                                      <img src="<?php echo $video_thumb; ?>" alt="<?php echo $case_title; ?>" class="videos-card__img">
                                    </picture>
                                    <a class="videos-card__play" href="<?php echo $video_url; ?>" data-fancybox type="button">
                                        <svg class="videos-card__icon">
                                            <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/play-icon.svg#play"></use>
                                        </svg>
                                    </a>
                                </div>
                                <h3 class="videos-card__title">
                                    <a href="<?php echo $video_url; ?>" data-fancybox class="videos-card__link">
                                        <?php echo $case_title; ?>
                                    </a>
                                </h3>
                            </article>
                          <?php endif; ?>
                          <?php wp_reset_postdata(); ?>
                          
                          <span class="sect-delivery__content--title">Содержание</span>
                          <ol class="sect-delivery__list">
                              <li class="sect-delivery__list--element _active" data-step-content="1"><a href="#step-1">Определение стоимости лестницы</a></li>
                              <li class="sect-delivery__list--element" data-step-content="2"><a href="#step-2">Заключение договора, внесение
                              предоплаты</a></li>
                              <li class="sect-delivery__list--element" data-step-content="3"><a href="#step-3">Проектирование и согласование</a></li>
                              <li class="sect-delivery__list--element" data-step-content="4"><a href="#step-4">Изготовление лестницы</a></li>
                              <li class="sect-delivery__list--element" data-step-content="5"><a href="#step-5">Доставка и монтаж</a></li>
                          </ol>
                      </div>
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
                          <button class="button button--primary" data-poppa-open="form-callback">Заказать звонок</button>
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
                          <input type="hidden" readonly name="form_name" value="Узнайте стоимость лестницы за 5 минут!"> 
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
                                <textarea class="textarea__field" name="user_message" placeholder="Напишите пару интересных слов о нашей работе :)"></textarea>
                              </label>
                              <label class="input-attach">
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
                              <button class="button button--primary shifter-callback__submit">Отправить</button>
                              <p class="shifter-callback__privacy">
                                  Нажимая кнопку “Отправить”, вы даете согласие на обработку
                                  <a href="<?php echo THEME_OPTIONS['privacy_url']; ?>" target="_blank" class="link">персональных данных</a>
                              </p>
                          </div>
                      </form>
                  </div>
              </div>
          </section>
      </main>

<?php get_footer(); ?>
