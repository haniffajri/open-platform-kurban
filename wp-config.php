<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_qurban' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '0^nn}.emH;^v]N*;s~ $347<phQJXk8MfW,=Zd<zDr;LH8zpI?~qsQq5D=}O99Bb' );
define( 'SECURE_AUTH_KEY',  'tca~5E%=99Y)XIj]@o?^c!z/3p6P M=f@1-Xy*0`7~n/47obok@iz6IUtkidWCzJ' );
define( 'LOGGED_IN_KEY',    '8=2xU.:Tv7C#T/KKl{S,~NpHkK9->jBsWgzU!Xj~&]L;YQ4Gp=?qP)s~oc2/^Qt%' );
define( 'NONCE_KEY',        '4R2!oDOGcOtOZH@L9~x-P&&IE/J6M^}HEm+VPq (?[>;^F|Df0|`),Ica+wjooSB' );
define( 'AUTH_SALT',        'xI1ZK9Xg0Obq?%:NO~l1(SO`rlFa*l=HIGqJE6MJWa>Pb%Hs%&o&3HVtpht[PFE{' );
define( 'SECURE_AUTH_SALT', '$Q+eX<&W$-UzOv:|B,ku1Ng1!==gp4M,1e01BVaJLolQe.^lwNgZaOd)#LS2UR)2' );
define( 'LOGGED_IN_SALT',   'l]CN8#kqF0pJfkeqC+k[R9TRSOZAC=xl(t#KXVLAyzrke$1+#];Ll4|$:|FV=bW8' );
define( 'NONCE_SALT',       '5&0dn2rwHI4FKLygp[b|CElf$m/hho4iI`NM&@@FxPc?cJY,Wj&H^CPwQU/i91;/' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
