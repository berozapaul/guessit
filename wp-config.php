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
define('DB_NAME', 'wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'go');

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
define('AUTH_KEY',         '$(ut.3l-uTtBPa^Jkqg+Ec.cvRjpiXO/%CX+BVfOG%hG*ADKZM<a^{X3eo3x21^a');
define('SECURE_AUTH_KEY',  '*DC:Yf=/&jV+r9]>@&*y}NtICJ6`~m9r;)bKixRyU9.&<|/jNtjX%M7|-#7dPy+u');
define('LOGGED_IN_KEY',    'w>%M8gwt_Wy4+%zl-b~0ej>:[mjWkF_2,VlM<l2MJwN+c_N!.T1+IK+:3Rbd`n|N');
define('NONCE_KEY',        '=$HbKCXk8+?a[G+L!~%GD5,x&$X7^Y[r(a(=zh<6!>C^B%Wm,4e4E}l$SWNJGe#y');
define('AUTH_SALT',        '{gz3Af2tF0[H[W|[ 4A!diW[@]9aquPlXuY-|iV,^wy2h9[;xcLL.75tL+o@`%1;');
define('SECURE_AUTH_SALT', 'p8+iOa}WSvg(!2+u_mEWIKFeBG-H,O_D7&DsFS>YO;&o-gc^z~]ny!Sn>z#?t6-K');
define('LOGGED_IN_SALT',   'Qr=-SQJ|H%er&H!SAOvIpE+fx/+vl8[5I3rA:?t1_,AM2Ogf)gAUGmK+ME+OcLMs');
define('NONCE_SALT',       '2iu:|slUcpK-kQWEut1x}@NjY`L|d+j+aX9=-&lP_QOCF>5!j!q>3^ox*EWg)dBz');

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
