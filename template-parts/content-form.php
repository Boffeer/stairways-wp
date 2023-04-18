<section id="section-product-calculate" class="shifter-callback section">
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
            <form action="<?php echo FORM_URLS['mail'];?>" class="shifter-callback__form">
              <div class="shifter-callback__form-fields">
                <label class="input input--tel">
                  <input class="input__field"
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
                </label>
                <!-- <div class="input-attach__wrapper"> -->
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
		        <!-- </div> -->
		          <div class="shifter-callback__form--box">
		            <button class="button button--primary shifter-callback__submit" type="submit">Отправить</button>
		            <p class="shifter-callback__privacy">
		                Нажимая кнопку “Отправить”, вы даете согласие на обработку
		                <a href="<?php echo THEME_OPTIONS['privacy_url']?>" target="_blank" class="link">персональных данных</a>
		            </p>
		          </div>
		      </form>
        </div>
  </div>
</section>
