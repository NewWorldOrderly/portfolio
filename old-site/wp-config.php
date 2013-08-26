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
define('DB_NAME', 'bryanduckworth_com_8');

/** MySQL database username */
define('DB_USER', 'xwnpqtad');

/** MySQL database password */
define('DB_PASSWORD', 'nV^3ScnF');

/** MySQL hostname */
define('DB_HOST', 'mysql-1.bryanduckworth.com');

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
define('AUTH_KEY',         'i;PaFav+uic6?OW8BX(@w2u7G*dp+RWuNN`:_%L3kyFt7xTzi$lD|0VHmE5d*XFY');
define('SECURE_AUTH_KEY',  'S9vWrfPDg`qVY(kG7lpHsNM8HcVU;oAfPr"_vd6;mfL!:|QODkWFaX:0+U_pTJCs');
define('LOGGED_IN_KEY',    ':fRRMrIqQqkZQZ+QVy*(4%PmT_NM8!K2"+^p@JE3bK+o%);#$2Y"q/EiSK6W|MNf');
define('NONCE_KEY',        'tkHxS&k#p#|O72)mzAcCNIeVkpX`wcrCIkAe3Uj|mWgela7jM6//Ri*J:yl1!IBP');
define('AUTH_SALT',        '/x2xJNQt:D(N`%VKUDW3E)xM)XOv4k4?*4MuzTR2l"`?l1/5P9nBZ"g*vV~n@0)n');
define('SECURE_AUTH_SALT', 'UnNiWw1LmSDL@9ViCztXjjG|en&vlVG?NQ!DFA$X%+qr*zlb_T~Lk+kSV?Tp(h5?');
define('LOGGED_IN_SALT',   'sVIWTanm8l$QgiWc1!gYG3t2FXW@&5DHljzwoSXE:Rx4nozLcgJ+*cfTS%buh+sm');
define('NONCE_SALT',       'ttxw7~&p+j%SncvHm77h*quirnB8xQYzi7nO|_2B#*i+KW7!?_#O%BlN;lp)tR1U');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_cjdpeb_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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

