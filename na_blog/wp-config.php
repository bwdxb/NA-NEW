<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'na_db' );

/** MySQL database username */
define( 'DB_USER', 'na_user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'TB#o98KJULJ$jYN' );

/** MySQL hostname */
define( 'DB_HOST', 'db' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'R*wTSbVj,Pm_B$RI[F|on2s)C{kDK?AdbzvGe^1RX}<or`2kGf]>PjmLh&`ozV4T' );
define( 'SECURE_AUTH_KEY',  'rv~r`f&IoB=!K,P#,oCDzl~ n$J7u/jU3)9PA#XLeh*PzYc@Ut=(T-FqfhC,H0#.' );
define( 'LOGGED_IN_KEY',    '{h=I2HDJ%gDCq_E![nyITtmXUulqG>#[8YNN@  q2dtjm(hcdZ|oal+c=bQD4Gsj' );
define( 'NONCE_KEY',        '7:(,p_sSfbuh;2?+n@@pOrtqgj?M^/be3leZ4i=K]# ^T2JCqi=;5kzgZgDpC2l ' );
define( 'AUTH_SALT',        '({4:Jm@L|21rkqmO[}cn#O-DjRQZf~[PJ+|QP8wums9.]Gfzx.i82}>@cc(8rzQv' );
define( 'SECURE_AUTH_SALT', 't%~K 0>=<URKr+-S?9&^Aeu#+VT I)S~0q*:T/Bp[YCimfaOMRl5mLk:)T]GwrqJ' );
define( 'LOGGED_IN_SALT',   'm}.LC+lwDF7AXG4WO,Uvw;JW&Bc6)0SzBEF2T^vg7v%F1JIx9.&|18n%X#J2W,sw' );
define( 'NONCE_SALT',       'T6/Otmi]UzWj~|`;Sl|?RZ++jdPrUbZl+JjkDxvfm%{FZ#i5(08&t)D%@eJ+LZ,m' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_na_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
