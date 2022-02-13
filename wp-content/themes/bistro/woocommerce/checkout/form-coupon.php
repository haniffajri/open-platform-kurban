<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

// change form coupon become to notice login

?>
<div class="woocommerce-form-coupon-toggle">
	<div class="woocommerce-info woocommerce-info-custom">
		<?php
			echo '<img src="'.site_url().'/wp-content/themes/bistro/assets/image/icon-user-notice.png" />
			Sudah memiliki akun?
			<a href="'.site_url().'/my-account/" style="margin-left: 4px;" >Masuk</a>';
		?>
	</div>
</div>

