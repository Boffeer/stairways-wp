<?php

add_filter('cfw_get_billing_checkout_fields', [$this, 'remove_checkout_fields'], 100);
add_filter('woocommerce_checkout_fields', [$this, 'unrequire_checkout_fields'], 2);
public function remove_checkout_fields($fields)
	{

		unset($fields['billing_last_name']);
		unset($fields['billing_postcode']);
		unset($fields['billing_state']);
		return $fields;
	}

	public function unrequire_checkout_fields($fields)
	{

		$fields['billing']['billing_last_name']['required']   = false;
		$fields['billing']['billing_postcode']['required']   = false;
		$fields['billing']['billing_state']['required']   = false;
		return $fields;
	}




	public function get_all_products($query, $type)
	{

		$result = '';
		// Цикл
		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();

				if ('archive' == $type) {
					ob_start();
					wc_get_template_part('content', 'product');
					$result .= ob_get_clean();
				} elseif ('block' == $type) {
					$product_id = get_the_ID();
					$pr = wc_get_product($product_id);
					$thumbnail = get_the_post_thumbnail_url($product_id);
					if (false == $thumbnail) {
						$thumbnail = get_field('default_product_img', 'options');
					}
					$result .= '
                    <div class="swiper-slide">
                        <a class="catalog__item product-preview" href="' . get_the_permalink($product_id) . '">
                            <div class="product-preview__inner">
                                <div class="product-preview__preview">
                                    <div class="product-preview__preview-inner">
                                        <img src="' . $thumbnail . '" />
                                    </div>
                                </div>';
					if ('' != $pr->get_price()) {
						$result .= '<div class="product-preview__price">' . $pr->get_price() . ' ₽</div>';
					} else {
						$result .= '<span class="product-preview__price">&nbsp;</span>';
					}
					$result .= '<div class="product-preview__content">
                                    <span class="product-preview__name">' . get_the_title($product_id) . '</span>
                                    <span class="product-preview__desc">' . get_field('preview_desc', $product_id) . '</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    ';
				} else {
					$result = false;
				}
			}
		} else {
			$result = false;
		}

		return $result;
	}




	public function get_pagination($paged = 1, $max_num_pages = 1)
	{

		$big = 999999999; // уникальное число для замены

		$args = array(
			'base'    => str_replace($big, '%#%', get_pagenum_link($big)),
			'format'  => '',
			'current' => $paged,
			'total'   => $max_num_pages,
			'prev_next' => false,
			'type' => 'array',
		);

		$result = paginate_links($args);
		$html = '
        <div class="products__pagin pagin">';
		if ($paged > 1) {
			$tt = $paged - 1;
			$html .= '
                <div data-page="' . $tt . '" onclick="next_prev($(this));" class="pagin__item_prev pagin__item">
                    <svg class="icon icon-arrowRight" viewBox="0 0 31 16">
                            <use xlink:href="' . THEME_URL . '/assets/icons/sprite.svg#arrowRight"></use>
                    </svg>
                </div>';
		} else {
			$html .= '
                <div data-page="" onclick="next_prev($(this));" class="pagin__item_prev pagin__item">
                    <svg class="icon icon-arrowRight" viewBox="0 0 31 16">
                        <use xlink:href="' . THEME_URL . '/assets/icons/sprite.svg#arrowRight"></use>
                    </svg>
                </div>';
		}

		$html .= '<ul class="page-numbers">';

		foreach ($result as $page) {

			$page = str_replace('<a', '<span', $page);
			$page = str_replace('a>', 'span>', $page);

			$html .= '<li onclick="get_page($(this));" >' . $page . '</li>';
		}
		$html .= '</ul>';

		if ($paged < $max_num_pages) {
			if (0 == $paged) {
				$next_page = 2;
			} else {
				$next_page = (int)$paged + 1;
			}
			$html .= '
                <div data-page="' . $next_page . '" onclick="next_prev($(this));" class="pagin__item pagin__item_next">
                    <svg class="icon icon-arrowRight" viewBox="0 0 31 16">
                        <use xlink:href="' . THEME_URL . '/assets/icons/sprite.svg#arrowRight"></use>
                    </svg>
                </div>';
		} else {
			$html .= '
                <div data-page="" onclick="next_prev($(this));" class="pagin__item_next pagin__item">
                    <svg class="icon icon-arrowRight" viewBox="0 0 31 16">
                        <use xlink:href="' . THEME_URL . '/assets/icons/sprite.svg#arrowRight"></use>
                    </svg>
                </div>';
		}

		$html .= '</div>';

		if ($paged < $max_num_pages) {

			$html .= '
            <div id="more-btn" onclick="show_more_btn($(this));" class="products__more-btn more-btn">
                <span class="more-btn__text">показать Еще</span>
                <span class="more-btn__arrow-more">
                    <svg class="icon icon-arrow" viewBox="0 0 22 22">
                        <use xlink:href="' . THEME_URL . '/assets/icons/sprite.svg#arrow"></use>
                    </svg>
                </span>
            </div>';
		}

		return $html;
