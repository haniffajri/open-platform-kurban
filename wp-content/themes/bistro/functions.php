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
