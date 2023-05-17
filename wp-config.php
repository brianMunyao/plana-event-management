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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'plana-event-management' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

/** Database hostname */
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
define( 'AUTH_KEY',         ';)2l^48Vb~R)ZcYM#FBi/Y9[& ac%9V7^Ks&nQPJ>l2TJYr)x,Q7KrM(bMd(KvOG' );
define( 'SECURE_AUTH_KEY',  ', y9QwX=4eXRyF,O-[%nKQGBom#m%OU=<@Oyn,MGf3X)Oe:yGVI+{<zG(u;::h$r' );
define( 'LOGGED_IN_KEY',    '[`3aA/E) B`|kX@xsulZlC~ctjSfbRLOK9 /!Vz:SE=,9UGSPA]}{WsVzX^n^(+a' );
define( 'NONCE_KEY',        'Mr#vkt@C&n#%qK_S}g[_pwQKjY71a6|d@IhPH*cx!FW-#^xe8f@#[?hoQpl`{`9E' );
define( 'AUTH_SALT',        'qxw#J_BsvL;v% _}XobGJh{Y_2xwz:k38(Ua[k4X54(xEBK{9QT?~63`5GCq?IJ!' );
define( 'SECURE_AUTH_SALT', '0L5ep} n?%RceW}V!^w`t{4Ld{|UJb t%~yI.]vSETE=R`gVlkCH&K8 W>OvX?ao' );
define( 'LOGGED_IN_SALT',   'KhyWGf^{#8ggZbU@MS#f?&CwTLAvJ?&JXzh![f.,e<2]/`>S<=>m).otlsQs^^>i' );
define( 'NONCE_SALT',       'cQXNg4Yy=-%<r1Pu*z3?u~<_QMnKM5e uY{5>Qhli](I8Pb,?E@k0I5a5^=0rv%d' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
