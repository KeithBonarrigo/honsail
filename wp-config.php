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
define('DB_NAME', 'honsail-wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
/*define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');*/
define('AUTH_KEY',         '}HH1i#V%<FLL!BAO),hx@]LC>TCgVQ_IAUBFzw};]Pu=6{&WbSmX+2n2df:&J!AN');
define('SECURE_AUTH_KEY',  'Au8V6=4gj:>!fwDn|;MqgP2XWJ*V![i>C4RRt }Y#x0gW1FU9?(oVqHa;v24qU.A');
define('LOGGED_IN_KEY',    '+&2u[&=W*|5VJfzB6-$Xz:o2s,Vs{+E>TA-::R$vtA{I&PU[$I~5yk?`Sj#_^-+Z');
define('NONCE_KEY',        '?=+w P3Tsk%yX2=O,yT_?n H;o.Hnrr7]5<gI-M`=*rxgt_fD5ZnCg?2RmA+c+2;');
define('AUTH_SALT',        '4JGPb|=yj:!_5;+02gaG!{u&dhJDEG|855-sW-n*-rgW=}69t2UVQHe+,dLt?y%l');
define('SECURE_AUTH_SALT', '&d7 R/QU:)c,QwA/KY5q=PwVcNJQ(izJ+GBE~Ab>NYqB[J8Y.?.Fmw:;8 Itc.y&');
define('LOGGED_IN_SALT',   '2< G}UbRExpZZ(2d^#|!8DMcA$M@.)3WEeP4yjM{qz[^_vfG;c#0d4xR~kLd:<;y');
define('NONCE_SALT',       'HvJ+Qt;$9i|2MWi<D_Brv7qU7{AT(wuyHt5AKezb,H+BNG`^-Yv-#U`m*0:4=PAK');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
