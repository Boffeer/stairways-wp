<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package stairways
 */

?>
        <footer class="footer">
            <div class="container footer__container">
                <div class="footer__about">
                    <a href="#" class="logo footer__logo">
                        <picture class="logo__pic">
                            <img src="<?php echo THEME_STATIC; ?>/img/common/logo-white.svg" alt="Первя ступень" class="logo__img">
                        </picture>
                    </a>
                    <p class="footer__address">Офис в Москве: <br> ул. Большая Полянка, д. 31Г.</p>
                    <div class="footer__contacts">
                        <a href="tel:+74959746937" class="footer__phone js-phone">+7 (495) 974-69-37</a>
                        <a href="mailto:sale@steppnz.ru" class="footer__email">sale@steppnz.ru</a>
                    </div>
                    <p class="footer__worktime _only-mobile">Ежедневно с 10:00 до 20:00</p>
                </div>
                <nav class="footer-nav">
                    <ul class="footer-nav__list">
                        <?php
                            $clients_menu_id = 11; 
                            $footer_menu = wp_get_nav_menu_items($clients_menu_id);
                        ?>
                        <li class="footer-nav__item"><?php echo wp_get_nav_menu_object($clients_menu_id)->name; ?></li>
                        <?php foreach ($footer_menu as $nav) : ?>
                            <li class="footer-nav__item">
                                <a href="<?php echo $nav->url;?>" class="footer-nav__link <?php echo $nav->object_id == get_the_ID() ? 'footer-nav__link--current' : ''?>"><?php echo $nav->title; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="footer-nav__list">
                        <li class="footer-nav__item">Лестницы</li>
                        <li class="footer-nav__item">
                            <a href="#" class="footer-nav__link">Каталог лестниц</a>
                        </li>
                        <li class="footer-nav__item">
                            <a href="#" class="footer-nav__link">Наши работы</a>
                        </li>
                    </ul>
                    <ul class="footer-nav__list">
                        <li class="footer-nav__item">О компании</li>
                        <li class="footer-nav__item">
                            <a href="#" class="footer-nav__link">О нас</a>
                        </li>
                        <li class="footer-nav__item">
                            <a href="#" class="footer-nav__link">Производство</a>
                        </li>
                        <li class="footer-nav__item">
                            <a href="#" class="footer-nav__link">Статьи</a>
                        </li>
                        <li class="footer-nav__item">
                            <a href="#" class="footer-nav__link">Видео</a>
                        </li>
                        <li class="footer-nav__item">
                            <a href="#" class="footer-nav__link">Вакансии</a>
                        </li>
                        <li class="footer-nav__item">
                            <a href="#" class="footer-nav__link">Контакты</a>
                        </li>
                    </ul>
                </nav>
                <div class="footer__socials">
                    <div class="footer__socials-buttons">
                        <a href="" class="button button--secondary button--icon-right footer__button footer__button--has-text">
                            <svg class="button__icon">
        						<use xlink:href="<?php echo THEME_STATIC; ?>/img/common/viber.svg#viber" />
        					</svg>
                            <span class="button__text">Написать в Viber</span>
                        </a>
                        <a href="" class="button button--secondary button--icon-right footer__button footer__button--has-text">
                            <svg class="button__icon">
        						<use xlink:href="<?php echo THEME_STATIC; ?>/img/common/whatsapp.svg#whatsapp" />
        					</svg>
                            <span class="button__text">Написать в WhatsApp</span>
                        </a>
                        <a href="" class="footer__button footer__button-vk button--ghost">
                            <svg class="button__icon">
        						<use xlink:href="<?php echo THEME_STATIC; ?>/img/common/vk.svg#vk" />
        					</svg>
                        </a>
                        <a href="" class="footer__button footer__button-yt button--ghost">
                            <svg class="button__icon" width="28" height="20" viewBox="0 0 28 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26.9086 1.71686C25.8979 0.497419 24.0319 0 20.4681 0H7.53164C3.88631 0 1.98863 0.529505 0.981716 1.82778C0 3.09361 0 4.9587 0 7.54004V12.4601C0 17.4609 1.1648 20 7.53164 20H20.4682C23.5587 20 25.2712 19.5611 26.3791 18.4849C27.5152 17.3814 28 15.5795 28 12.4601V7.54004C28 4.8178 27.924 2.9417 26.9086 1.71686ZM17.9761 10.6793L12.1017 13.7954C11.9704 13.865 11.8267 13.8996 11.6833 13.8996C11.5209 13.8996 11.3589 13.8552 11.2154 13.767C10.9451 13.6008 10.7801 13.3035 10.7801 12.9829V6.77072C10.7801 6.45059 10.9447 6.15357 11.2144 5.98728C11.4842 5.82098 11.8197 5.80961 12.0996 5.95721L17.974 9.0532C18.2729 9.21069 18.4606 9.52385 18.461 9.86551C18.4614 10.2075 18.2745 10.5211 17.9761 10.6793Z" fill="white"/>
                            </svg>
                        </a>
                    </div>
                    <p class="footer__socials-worktime ">Ежедневно с 10:00 до 20:00</p>
                </div>
                <div class="footer__bottom">
                    <p class="footer__copy">© 2014-2019. Все права защищены.</p>
                    <a href="#" class="footer__link">Политика конфиденциальности данных</a>
                    <a href="#" class="footer__creator">Сделано в СЕМЬ ПАП:</a>
                </div>
            </div>
        </footer>
    </div>

     <section class="poppa modal" id="pod-callback">
    <div class="modal__inner">
        <h2 class="modal__title">Вам нужна винтовая лестница <br> на металлокаркасе?</h2>
        <div class="modal__group">
            <form action="./callback.php" class="form-callback shifter__form">
                <fieldset class="radio__row">
                    <label class="radio">
                        <input type="radio" name="user_connect" class="radio__input">
                        <span class="radio__check"></span>
                        <span class="radio__title">Телефон</span>
                    </label>
                    <label class="radio">
                        <input type="radio" name="user_connect" class="radio__input">
                        <span class="radio__check"></span>
                        <span class="radio__title">Telegram</span>
                    </label>
                    <label class="radio">
                        <input type="radio" name="user_connect" class="radio__input">
                        <span class="radio__check"></span>
                        <span class="radio__title">WhatsApp</span>
                    </label>
                </fieldset>
                <fieldset class="form-callback__row">
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

                    <button class="button button--secondary button--icon-right nt-btn" type="submit">         
                      <span class="button__text">Отправить</span>
                    </button>
                </fieldset>
            </form>
        </div>
    </div>
</section>
 <section class="poppa modal modal-callback" id="form-callback">
    <div class="modal__inner">
        <h2 class="modal__title">Наш менеджер позвонит <br> вам в течение 5 минут</h2>
        <div class="modal__group">
            <form action="./callback.php" class="form-callback shifter__form">
                <fieldset class="radio__row">
                    <label class="radio">
                      <input type="radio" name="user_connect" class="radio__input">
                      <span class="radio__check"></span>
                      <span class="radio__title">Телефон</span>
                    </label>
                                        <label class="radio">
                      <input type="radio" name="user_connect" class="radio__input">
                      <span class="radio__check"></span>
                      <span class="radio__title">Telegram</span>
                    </label>
                                        <label class="radio">
                      <input type="radio" name="user_connect" class="radio__input">
                      <span class="radio__check"></span>
                      <span class="radio__title">WhatsApp</span>
                    </label>
                </fieldset>
                <fieldset class="form-callback__row">
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

                    <button class="button button--secondary button--icon-right nt-btn" type="submit">         
                        <span class="button__text">Отправить</span>
                    </button>
                </fieldset>
            </form>
        </div>
    </div>
</section>


<div class="poppa poppa--no-scroll poppa--wide" id="abouts">
    <div class="poppa-abouts">
        <div class="poppa__overlay--container">
            <div class="poppa-slider">
                <div class="swiper poppa-slider--swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide poppa-slider--slide">
                            <img src="<?php echo THEME_STATIC; ?>/img/common/about-video.jpg" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo THEME_STATIC; ?>/img/common/about-1.jpg" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo THEME_STATIC; ?>/img/common/about-1.jpg" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo THEME_STATIC; ?>/img/common/about-1.jpg" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo THEME_STATIC; ?>/img/common/about-1.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="poppa__aligner">
                <section class="poppa modal modal-abouts">
                    <div class="modal__inner">
                        <h2 class="modal__title">Лестница на&nbsp;стальном монокосоуре с&nbsp;площадкой</h2>
                        <div class="modal__group">
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
                            <p class="modal__group--desc">
                                Элегантная лестница на тетиве из листа толщиной 8 мм. Ограждение из стекла зажато между пластинами каркаса и не имеет видимых узлов соединений. Благодаря такому подходу конструкция смотрится монолитной. Ступени из ясеня со встроенной интеллектуальной
                                подсветкой. Зажигается последовательно при приближении к лестнице. Скорость зажигания, время срабатывания, и множество других настроек можно изменить с помощью блока управления подсветкой.
                            </p>
                            <button class="modal__group--btn">
                                Хочу так же
                            </button>
                            <div class="modal__group--counter">
                                <div class="modal__group--count">
                                    <img class="modal__group--count--icon" src="<?php echo THEME_STATIC; ?>/img/common/arrow-down.svg" alt="">
                                    <div class="modal__group--count--n">
                                        <span class="modal__group--count__index"></span>/<span class="modal__group--count__all"></span>
                                    </div>
                                    <p>Листайте вниз для просмотра фото</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<section class="poppa modal" id="otzyv-callback" >
    <div class="modal__inner">
        <h2 class="modal__title modal__title--review">Оставьте свой отзыв о нашей<br> работе прямо сейчас</h2>
        <div class="modal__group">
            <form action="./callback.php" class="form-callback shifter__form">
                <fieldset class="form-callback__row">
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
                     <label class="input input--name">
                      <input
                        class="input__field"
                        name="user_name"
                        type="text"
                        placeholder="Ваша фамилия"
                        data-value-missing="Напишите фамилию"
                        data-value-invalid="Что-то не так с введенным фамилией"
                        autocomplete="name"
                      >
                    </label> <select class="form-control select" data-trigger name="choices-single-default" id="choices-single-default">
                        <option value="">Выберите город</option>
                        <option value="msk">Москва</option>
                        <option value="pnz">Пенза</option>
                        <option value="krd">Краснодар</option>
                    </select> <label class="input input--tel">
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
                     <label class="textarea">
                      <textarea class="textarea__field" placeholder="Напишите пару интересных слов о нашей работе :)"></textarea>
                    </label>


                    <label class="input-attach">
                        <input
                          class="input-attach__field"
                          name="user_file"
                          type="file"
                        >
                        <span class="input-attach__box-icon">
                        <svg class="input-attach__icon">
                          <use xlink:href="<?php echo THEME_STATIC; ?>/img/common/attach-white.svg#attach-white" />
                        </svg>
                      </span>
                        <span class="input-attach__text link link--underlined"><span class="link__text">Прикрепить файл</span></span>
                      </label>
                    <div class="form-bottom-send">
                        <button class="button button--secondary button--icon-right nt-btn" type="button">         
                            <span class="button__text">Отправить</span>
                        </button>
                        <p class="form-policy-in-btn">
                            Нажимая кнопку “Отправить”, вы даете согласие на <br>обработку персональных данных
                        </p>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>
 <section class="poppa modal modal-thanks" id="thanks">
    <div class="modal__inner">
        <div class="modal-thanks__icon">
            <svg width="28" height="21" viewBox="0 0 28 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 10L10 18L26 2" stroke="white" stroke-width="4"/>
            </svg>
        </div>
        <h2 class="modal__title">Спасибо<br> за обращение</h2>
        <div class="modal__group">
            <p class="modal-thanks__text">Наш менеджер свяжется с вами<br> в ближайшее время</p>
            <a class="modal-thanks__link" href="">Перейти на главную</a>
        </div>
    </div>
</section>

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;apikey=55053583-9704-4e95-8a17-d5e58aa501ff&_v=20230217195447"></script>
<?php wp_footer(); ?>

</body>
</html>
