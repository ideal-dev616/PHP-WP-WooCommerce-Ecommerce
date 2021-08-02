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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'weapon' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'XCh<S8?f_KT$?L/-,rWyw.I|:zakddD; LC7B>3IIA8uw3F.@*D HhPCIZZL;Vn}' );
define( 'SECURE_AUTH_KEY',  'ReKVY)xd8civ|H?*H%dR[O)zRn$Whaov~Rj(b8wu+.yD Ui%xXJf-LE_edW~1U{C' );
define( 'LOGGED_IN_KEY',    'Gp$>y #O()vuzj,+k@tq:}M?G3eBM[Hl`}~.,#6NhA,VKzc6-]$cc=k!zE?VwQ9{' );
define( 'NONCE_KEY',        'O*y &M@7bO*&Xs8tx%<*e%Cwf04pDyLU:] TIE:oU@?pi<Job|Kqi#Gkn1=x]y#S' );
define( 'AUTH_SALT',        '8=]BVjXS&]`SSbfAuW[O*z#Q=03:cy+FG&XA^6?o 6_;Qxe-[|6-g%{8z<1F.ANw' );
define( 'SECURE_AUTH_SALT', '<d=xR1Yj7W6PE;%p1leYhx]>/7&[><xzH~vR=Z+y0!:!d3k<c#-mBPCw]zlk( F`' );
define( 'LOGGED_IN_SALT',   'r8;F_,P/;f;bFHluth`&t#dT&Mtj;.sO[Z]|</XKz2 k?7);Np{mU@/fn%Ve/x^@' );
define( 'NONCE_SALT',       '/#.BRpTD!,wIErViaD/op,qWrhk)o6a8I2gBW.WU`Y<2.|4MGs<WYo6TpI8QqV8K' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
