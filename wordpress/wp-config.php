<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'peregrine-offplan');

/** MySQL database username */
define('DB_USER', 'peregrine_user');

/** MySQL database password */
define('DB_PASSWORD', 'peregrine_pwd');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[CSgQv$Bpz.Mzt.^}Ryy8O4,r{pA]g(!<[Y{Q`ZNO%IFsez@>C{DsB5DK3POtr2e');
define('SECURE_AUTH_KEY',  'N!=geNnylTgG`{:KzB*pqu!me;wTDk?9{Oux,nXNj.V1b#_UhUAm7/s1>vYGAwf6');
define('LOGGED_IN_KEY',    'R=TZB4+).8>jY+f>+Bw5x|An__%P-+w*rHMz+l:o/.*-s@F@/f#d|x+9fp+O_euG');
define('NONCE_KEY',        '$,Y|-^[VsOgVg#P<_U9W._R1ro^o,Ebo.Mao8q6t{2O O@y +k3r=,^J4f*E^}sq');
define('AUTH_SALT',        'A&-Z0=p9h[pUH,-P)(# PZ|(anEmXs0:ZI1s5ls%^PkBT+a1R+jR1IS+WbS${KZg');
define('SECURE_AUTH_SALT', 'pu>%^&=BTL$;0%{54GUAa`[UFpR4z)-LZ59rG%T:.|jPGW6,ju=^90!k+4D #fOR');
define('LOGGED_IN_SALT',   '>FX9~h?s]F7HrB889<^0yq+JHpKEv D)XXSL=7@1,i|ZKQhuy/Gf`@s00X0iHH5p');
define('NONCE_SALT',       'D10m;=.OW>B[!*`fPf.cEnKfP]WXG+=tF`h``}7@}>#uFzM-#1VR+XiT2TZl)+.q');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
