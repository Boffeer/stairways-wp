<?php get_header(); ?>
<main>
	<?php echo get_breadcrumbs(); ?>
    <section class="page-contacts section-page-m">
        <div class="container">
            <h1 class="section-title page-contacts__title"><?php the_title(); ?></h1>
            <div class="page-contacts__box">
                <div class="page-contacts__left">
                    <div class="page-contacts__desc">
                    		<?php 
                    			$contacts_cities = carbon_get_theme_option('contacts_cities');
                    		?>
                    		<?php foreach ($contacts_cities as $key => $city) : ?>
	                        <article class="page-contacts-city bayan accordion accordion--has-icon">
	                            <div class="accordion__head">
	                                <h3 class="accordion__title"><?php echo $city['city']; ?></h3>
	                            </div>
	                            <div class="accordion__body">
		                            	<?php foreach ($city['locations'] as $location) : ?>
	                                <div class="page-contacts-city__location accordion__body--container" data-address="<?php echo $location['address'];?>">
	                                    <h3 class="accordion__desc">
	                                    	<?php echo $location['title']; ?>
	                                    </h3>
	                                    <div class="accordion__contacts">
	                                        <a href="#" class="link link--geo">
	                                            <span class="link--line"><?php echo $location['address'];?></span>
	                                            <span class="link--line"><span>Режим работы:</span> <?php echo $location['worktime']?></span>
	                                        </a>
	                                        <a href="<?php echo get_phone_url($location['phone']);?>" class="link link--tel"><?php echo $location['phone']; ?></a>
	                                        <a href="mailto:<?php echo $location['email'];?>" class="link link--email"><?php echo $location['email']?></a>
	                                    </div>
	                                    <div class="accordion__mess">
		                                    	<?php if ($location['whatsapp'] != '') : ?>
		                                        <a href="<?php echo $location['whatsapp']?>" class="accordion__mess--whatsapp"></a>
		                                      <?php endif; ?>
		                                    	<?php if ($location['viber'] != '') : ?>
		                                        <a href="<?php echo $location['viber']?>" class="accordion__mess--viber"></a>
		                                      <?php endif; ?>
		                                    	<?php if ($location['messenger_phone'] != '') : ?>
		                                        <a href="<?php echo get_phone_url($location['messenger_phone']) ?>" class="accordion__mess--phone"><?php echo $location['messenger_phone'];?></a>
		                                      <?php endif; ?>
	                                    </div>
	                                    <button class="accordion__mess--marshrut button button--primary">Проложить маршрут</button>
	                                </div>
		                              <?php endforeach; ?>
	                            </div>
	                        </article>
	                      <?php endforeach; ?>
                    </div>
                </div>
                <div class="page-contacts__right">
                    <div class="page-contacts__map" id="map-contact"></div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>