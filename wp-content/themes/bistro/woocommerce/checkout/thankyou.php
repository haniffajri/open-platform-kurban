<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order">
					<?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<li class="woocommerce-order-overview__date date">
					<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
					<strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>


				<li class="woocommerce-order-overview__total total">
					<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<?php if ( $order->get_payment_method_title() ) : ?>
					<li class="woocommerce-order-overview__payment-method method">
						<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>

						<?php echo'<strong>';
							$allergic = get_post_meta( $order->ID, 'Payment Method', true );
							if ($allergic==1) { echo "BCA";} else {echo "Mandiri";}
							echo '</strong>';
						?>
					</li>

					<li class="woocommerce-order-overview__payment-method method">
						<?php esc_html_e( 'Nomor Rekening:', 'woocommerce' ); ?>

						<?php echo'<strong>';
								
							$account_name = "";
							$account_number = "";
							$bacs_info  = get_option( 'woocommerce_bacs_accounts');
							foreach ( $bacs_info as $account ) {
								$bank_name = esc_attr( wp_unslash( $account['bank_name'] ) );
								if ($allergic==1) {
									if (strtolower($bank_name) == strtolower('BCA')) {
										$account_name = esc_attr( wp_unslash( $account['account_name'] ) );
										$account_number = esc_attr( $account['account_number'] );
									}
								} elseif ($allergic==2) {
									if (strtolower($bank_name) == strtolower('Mandiri')) {
										$account_name = esc_attr( wp_unslash( $account['account_name'] ) );
										$account_number = esc_attr( $account['account_number'] );
									}
								}	
							}

							echo $account_number;
							echo '</strong>';
						?>
					</li>

					<li class="woocommerce-order-overview__payment-method method">
						<?php esc_html_e( 'Nama Rekening:', 'woocommerce' ); ?>

						<?php echo'<strong>';		
							$account_name = "";
							$account_number = "";
							$bacs_info  = get_option( 'woocommerce_bacs_accounts');
							foreach ( $bacs_info as $account ) {
								$bank_name = esc_attr( wp_unslash( $account['bank_name'] ) );
								
								if ($allergic==1) {
									if (strtolower($bank_name) == strtolower('BCA')) {
										$account_name = esc_attr( wp_unslash( $account['account_name'] ) );
										$account_number = esc_attr( $account['account_number'] );
									}
								} elseif ($allergic==2) {
									if (strtolower($bank_name) == strtolower('Mandiri')) {
										$account_name = esc_attr( wp_unslash( $account['account_name'] ) );
										$account_number = esc_attr( $account['account_number'] );
									}
								}	
							}

							echo $account_name;
							echo '</strong>';
						?>
					</li>
				<?php endif; ?>
			</ul>

		<?php endif; ?>

		<!-- Detail -->
		<h2 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">Detail Kurban</h2>

			<ul class="woocommerce-order-overview woocommerce-order-overview-custom woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order woocommerce-notice-title-custom">
					<div>Hewan Kurban</div>
					<div>Nama Pekurban</div>
				</li>

				<?php 
					$order = wc_get_order( $order->get_id() );
					$order_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
					foreach ( $order_items as $item_id => $item ) {
						$product = $item->get_product();
						$meta_data = "";
						foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
							$value = $args['autop'] ? wp_kses_post( $meta->display_value ) : wp_kses_post( make_clickable( trim( $meta->display_value ) ) );
							$meta_data = $value;	
						}

						echo '<li class="woocommerce-order-overview__date date">
							<div>
								<p class="order_detail_title_custom">'.$product->name.'</p>
								<p style="color: #969696;">'.$order->get_formatted_line_subtotal( $item ).'</p>
							</div>
							<div>'.$meta_data.'</div>
						</li>';
					}				
				?>
			</ul>

	<?php else : ?>
		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
	<?php endif; ?>

</div>
