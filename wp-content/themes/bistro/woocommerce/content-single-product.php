<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<!-- add element sosmed -->
	<div class="container-sosmed">
		<a href="<?php echo 'https://twitter.com/intent/tweet?status='.$product->get_name().'+'.$product->get_permalink(); ?>" target="_blank" class="item-sosmed">
			<?php
				echo '<img src="'.site_url().'/wp-content/themes/bistro/assets/image/Twitter.png" class="img-sosmed" />';
			?>
			<p class="text-sosmed">Share di Twitter</p>
		</a>

		<a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$product->get_permalink(); ?>" target="_blank" class="item-sosmed item-center">
			<?php
				echo '<img src="'.site_url().'/wp-content/themes/bistro/assets/image/Facebook.png" class="img-sosmed" />';
			?>
			<p class="text-sosmed">Share di Facebook</p>
		</a>

		<a href="<?php echo 'https://web.whatsapp.com/send?text='.$product->get_name().' Link: '.$product->get_permalink() ?>" target="_blank" class="item-sosmed">
			<?php
				echo '<img src="'.site_url().'/wp-content/themes/bistro/assets/image/Whatsapp.png" class="img-sosmed" />';
			?>
			<p class="text-sosmed">Share di Whatsapp</p>
		</a>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
