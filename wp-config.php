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
define( 'AUTH_KEY',          'E{)T0m|b0S63(w>a~Npy`g^67bo-tu$0GIeA><!;(YVBd_[ug>0k.*K ()MONRIp' );
define( 'SECURE_AUTH_KEY',   '}$KV{iCM#:a[zF!*.^4fLOcxKHb.Fo#pnzDF^G*?#*)%Kk&@Wo&uU9?gO.Jxh}zn' );
define( 'LOGGED_IN_KEY',     't3Q)b8EZ%vf+6}z6SK+A=!10^z#AYpG`5DHuTJz?N^Z QF&XS;i+x6->_@fmXnxJ' );
define( 'NONCE_KEY',         '1W&+1Hd0r7Itf937:^&)SJL9_rBgUStz~F<TpT)f029hCt?~_PQ2mieW$#}7 hSh' );
define( 'AUTH_SALT',         'n]w3 |yiZ,%J?1n7,3c*aq82g([DaH;gvakK92Rd9;AS[0l!M=X|4sqmVYv.ro#l' );
define( 'SECURE_AUTH_SALT',  'Is-eV/SaJU@_.S7stUUH*}jL68T<SU(BD[>)JyYzAHO,<w@jnUoiQ;/j7.|P/dh^' );
define( 'LOGGED_IN_SALT',    '7y;+~JY_|{Tfk9LEAU_{%Z5HMu~4_NS~H:{NEEdYaJ?)yu(n~oG*dTOF,ynL|t]4' );
define( 'NONCE_SALT',        '5Gx]_Y^#R{HejXToI]c)dCU+!a(CByI96_4Aq}W+p-%#y8^=!pQmlMN|,OL{ht0)' );
define( 'WP_CACHE_KEY_SALT', '6IZ@1D,-r=eym&lV3{+8~F(JSzoYfc*J5uvh$-,!v3NDyA~?,]F(K Kz2F}trMLE' );


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
