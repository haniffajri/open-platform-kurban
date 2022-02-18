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

// ============= add js css =================
wp_enqueue_script( 'storefront-js-custom', '/wp-content/themes/bistro/js-custom.js', $storefront_version );


// =========== custom font ==================
function add_google_fonts() {
    wp_enqueue_style( 'sb-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

// ============= hide tab detail product ================s
function woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    unset($tabs['seller']);
    unset($tabs['more_seller_product']);
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_reviews_tab', 98 );

// ========================= spilt quantity in chart ===========

function separate_individual_cart_items( $cart_item_data, $product_id ) {
	$unique_cart_item_key = md5( microtime() . rand() );
	$cart_item_data['unique_key'] = $unique_cart_item_key;
	return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'separate_individual_cart_items', 10, 2 );

function split_multiple_quantity_products_to_separate_cart_items( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {
    if ( $quantity > 1 ) {add_filter('woocommerce_checkout_fields', 'njengah_override_checkout_fields');
 
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

// ========================= checkout ======================================

add_filter( 'woocommerce_checkout_fields' , 'remove_checkout_fields' ); 

function remove_checkout_fields( $fields ) { 
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['order']['order_comments']);
    return $fields; 
}

function override_checkout_fields($fields) {
    $fields['billing']['billing_first_name']['placeholder'] = 'Nama Depan';
    $fields['billing']['billing_last_name']['placeholder'] = 'Nama Belakang';
    $fields['billing']['billing_email']['placeholder'] = 'emailku@domain.com ';
    $fields['billing']['billing_phone']['placeholder'] = 'Nomor WhatsApp 08xxx ';
     
    return $fields;
     
}
add_filter('woocommerce_checkout_fields', 'override_checkout_fields');
     

// ================== choose radio button before checkout ==========================

function new_payment_field( $checkout ) {
    woocommerce_form_field( 'payment_method_data', array(
	'type' => 'radio',
   	'class' => array('form-row-wide', 'update_totals_on_change' ),
   	'options' => array('1' => 'BCA','2' => 'Mandiri',),
   	'label'  => __("Pilih salah satu metode pembayaran"),
	'required'=>true,
    ), $checkout->get_value('payment_method_data', 10, 4));
}
add_action( 'woocommerce_after_order_notes', 'new_payment_field' );

function filter_woocommerce_form_field_radio( $field, $key, $args, $value ) {
    // Based on key
    if ( $key == 'payment_method_data' ) {
        if ( ! empty( $args['options'] ) ) {
            $field = '<div class="payment-list-custom"><ul>';
            foreach ( $args['options'] as $option_key => $option_text ) {
                $field .= '<li>';
                $field .= '<input type="radio" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" />';
                $field .= '<label>' . esc_html( $option_text ) . '</label>';
                $field .= '</li>';
            }
            $field .= '</ul></div>';
        }
    }
    return $field;
}
add_filter( 'woocommerce_form_field_radio', 'filter_woocommerce_form_field_radio', 10, 4 );

function custom_field_validate() {
   if (!$_POST['payment_method_data']) { 
	wc_add_notice(__('Anda memilih metode pembayaran') , 'error'); 
   }
}
add_action('woocommerce_after_checkout_validation', 'custom_field_validate');

function save_payment_method_data( $order_id ) {
    if ( !empty( $_POST['payment_method_data'] ) ) {
        update_post_meta( $order_id, 'Payment Method', $_POST['payment_method_data']);
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'save_payment_method_data' );

function display_payment_method($order){
   echo'<p>'.__('Payment Method').': ';
   $allergic = get_post_meta( $order->ID, 'Payment Method', true );
   if ($allergic==1) { echo "BCA";} else {echo "Mandiri";}
   echo '</p>';
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'display_payment_method', 10, 1 );

// ==================== show name qurban ===============

// function add_name_of_person_qurban_field() {
//     echo '<table class="variations" cellspacing="0">
//           <tbody>
//               <tr>
//               <td class="label"><label for="color">Nama Penqurban</label></td>
//               <td class="value">
//                   <input type="text" name="name-of-person-qurban" value="" />                      
//               </td>
//           </tr>                               
//           </tbody>
//       </table>';
// }
// add_action( 'woocommerce_before_add_to_cart_button', 'add_name_of_person_qurban_field' );

// function name_of_person_qurban_validation() { 
//     if ( empty( $_REQUEST['name-of-person-qurban'] ) ) {
//         wc_add_notice( __( 'Anda belum mengisi nama penqurban', 'woocommerce' ), 'error' );
//         return false;
//     }
//     return true;
// }
// add_action( 'woocommerce_add_to_cart_validation', 'name_of_person_qurban_validation', 10, 3 );

// function save_name_of_person_qurban_field( $cart_item_data, $product_id ) {
//     if( isset( $_REQUEST['name-of-person-qurban'] ) ) {
//         $cart_item_data[ 'name_of_person_qurban' ] = $_REQUEST['name-of-person-qurban'];
//         /* below statement make sure every add to cart action as unique line item */
//         $cart_item_data['unique_key'] = md5( microtime().rand() );
//     }
//     return $cart_item_data;
// }
// add_action( 'woocommerce_add_cart_item_data', 'save_name_of_person_qurban_field', 10, 2 );

function render_meta_on_cart_and_checkout( $cart_data, $cart_item = null ) {
    $custom_items = array();
    if( !empty( $cart_data ) ) {
        $custom_items = $cart_data;
    }
    if( isset( $cart_item['name_of_person_qurban'] ) ) {
        $custom_items[] = array( "name" => 'Kurban atas nama', "value" => $cart_item['name_of_person_qurban'] );
    }
    return $custom_items;
}
add_filter( 'woocommerce_get_item_data', 'render_meta_on_cart_and_checkout', 10, 2 );

function dokan_product_seller_info_item( $item_data, $cart_item ) {
    $vendor = dokan_get_vendor_by_product( $cart_item['product_id'] );

    if ( ! $vendor || ! $vendor->get_id() ) {
        return $item_data;
    }

    $item_data[] = array(
        'name'  => __( 'Vendor', 'dokan-lite' ),
        'value' => $vendor['name_of_person_qurban'],
    );

    return $item_data;
}
add_filter( 'dokan_product_seller_info', 'dokan_product_seller_info_item', 10, 2 );

function name_of_person_qurban_order_meta_handler( $item_id, $values, $cart_item_key ) {
    if( isset( $values['name_of_person_qurban'] ) ) {
        wc_add_order_item_meta( $item_id, "name_of_person_qurban", $values['name_of_person_qurban'] );
    }
}
add_action( 'woocommerce_add_order_item_meta', 'name_of_person_qurban_order_meta_handler', 1, 3 );

function change_checkout_button_text( $button_text ) {
   return 'Kurban Sekarang';
}
add_filter( 'woocommerce_order_button_text', 'change_checkout_button_text' );

// ============= romove search header ===================
function remove_storefront_header_search() {
    remove_action( 'storefront_header', 'storefront_product_search', 40 );
}
add_action( 'init', 'remove_storefront_header_search' );

// ================= clikck add to cart direct halaman cart ===================
add_filter ('woocommerce_add_to_cart_redirect', function( $url, $adding_to_cart ) {
    return wc_get_cart_url();
}, 10, 2 ); 

// ===================== remove downloads and addresses on my account =====================
function remove_my_account_links( $menu_links ){
	unset( $menu_links['edit-address'] );
	unset( $menu_links['downloads'] );
	return $menu_links;
}
add_filter ( 'woocommerce_account_menu_items', 'remove_my_account_links' );

// ================================================
