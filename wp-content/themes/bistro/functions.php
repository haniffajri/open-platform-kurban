<?php
/**
 * Bistro engine room
 *
 * @package bistro
 */

/**
 * Set the theme version number as a global variable
 */
$theme          = wp_get_theme( 'bistro' );
$bistro_version = $theme['Version'];

$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Load the individual classes required by this theme
 */
require_once( 'inc/class-bistro.php' );
require_once( 'inc/class-bistro-customizer.php' );
require_once( 'inc/class-bistro-integrations.php' );
require_once( 'inc/bistro-template-hooks.php' );
require_once( 'inc/bistro-template-functions.php' );
require_once( 'inc/plugged.php' );

/**
 * Do not add custom code / snippets here.
 * While Child Themes are generally recommended for customisations, in this case it is not
 * wise. Modifying this file means that your changes will be lost when an automatic update
 * of this theme is performed. Instead, add your customisations to a plugin such as
 * https://github.com/woothemes/theme-customisations
 */

// ============= add custom css =================
wp_enqueue_style( 'storefront-style-custom', '/wp-content/themes/bistro/style-custom.css', $storefront_version );

// =========== custom font ==================
function sb_add_google_fonts() {
    wp_enqueue_style( 'sb-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'sb_add_google_fonts' );

// ============= hide tab detail product ================s
function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    unset($tabs['seller']);
    unset($tabs['more_seller_product']);
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );

// ========================= spilt quantity in chart ===========

function separate_individual_cart_items( $cart_item_data, $product_id ) {
	$unique_cart_item_key = md5( microtime() . rand() );
	$cart_item_data['unique_key'] = $unique_cart_item_key;
	return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'separate_individual_cart_items', 10, 2 );

function split_multiple_quantity_products_to_separate_cart_items( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {
    if ( $quantity > 1 ) {
        WC()->cart->set_quantity( $cart_item_key, 1 );
        for ( $i = 1; $i <= $quantity -1; $i++ ) {
            $cart_item_data['unique_key'] = md5( microtime() . rand() . "Hi Mom!" );
            WC()->cart->add_to_cart( $product_id, 1, $variation_id, $variation, $cart_item_data );
        }
    }
}
add_action( 'woocommerce_add_to_cart', 'split_multiple_quantity_products_to_separate_cart_items', 10, 6 );

// ============================ store name on detail product ======================

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

function custom_single_product_summary() {
    global $product;
    $seller = get_post_field( 'post_author', $product->get_id());
	$author = get_user_by( 'id', $seller );
	$store_info = dokan_get_store_info( $author->ID );

    echo '<div class="product_meta_store">
	    <span class="posted_in">Dari: 
            <span class="store_name_meta">'.$store_info['store_name'].'</span>
        </span>	
    </div>';
}
add_action( 'woocommerce_single_product_summary', 'custom_single_product_summary', 45);
