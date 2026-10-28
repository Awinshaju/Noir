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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '[YF|2pn%}lVHNBdx6L yLy?(!O@h3@)CvU8qDY?3eAJ&p}O>%O4~VBsiWy`7ec&K' );
define( 'SECURE_AUTH_KEY',   '@WOiF2]`_bK5q4<u~<F)D`5t(]{-o5Ctm|{#5i%:UP%}r10/[Ot[R3ptxK]X5e@1' );
define( 'LOGGED_IN_KEY',     '#,:K,&^]5rBx9}s_TsNaZ3a1Me%k:iR.P[NMSDt#3D$i$Kk@/COPJ+v$8/k>K:uc' );
define( 'NONCE_KEY',         'IgSGT~4MD.X IXN79*`BxDHP&OdpyX<T4-MYpIhDYY|ly)X$<}OHEED_dk2ZMQNa' );
define( 'AUTH_SALT',         '_ Ow~%)4~9JAL9VALKqNg{q_x>z$o4VtZ35Cb^HzA#6g`C&6Vl1K:9Kl-K2QJC%{' );
define( 'SECURE_AUTH_SALT',  'yQ+S,Yh0@zc$;6#NVA~&H!@:r1%_FScxhYOa>YHb((@HJguk4T;H`MaP=`505_s@' );
define( 'LOGGED_IN_SALT',    'WV.oQJ!C;_VrVx5wY/uY {~Y|i;aFsV3ZK{qvPM`Z@z.Ws*;)O]S ~xv{^m2:xGT' );
define( 'NONCE_SALT',        'ch[|e R[L;<7IFaRJm=*blO1.fsm;^/S&9y-q(])X$D0*UIT3ezIcshhsCe*Mjt<' );
define( 'WP_CACHE_KEY_SALT', '-dASyC[!v{z5W068B&}c`y[o(.7{pXX%(F&,nMlU= l_sv=G@QqW7H86j#0E^{Tm' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
