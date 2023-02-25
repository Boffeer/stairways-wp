<?php

if (!function_exists('get_phone_url')) :
		function get_phone_url($phone) {
			return 'tel:' . preg_replace('/\D/i', '', $phone);
		}
endif;
