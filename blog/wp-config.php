<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'otonomic_blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'otoOTO2611');

/** MySQL hostname */
define('DB_HOST', 'dbmaster.otonomic.com');

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
define('AUTH_KEY',         '/++)S.v=+r;zYYDok7%#c|9MU5]>Ku-;q[KMSE4AEn>~#KwD3!b%}66yuy6t^@,x');
define('SECURE_AUTH_KEY',  '$TAcdGrQ^GsH%NF=P,IEstA?2f`t!G--LueF-c[.~Le{6KT:b|aBA%Rg0;fYwuvH');
define('LOGGED_IN_KEY',    'K=T/Ip_|WVW2 ;h_5qddlyR%Nbt,9eh|Ts0j_Kj <RX_K#3&kWh :}/,ZmM$Ft4D');
define('NONCE_KEY',        'Yd:Dz$vhr{a#We|K$m]dX|dbB{~os(!DY9qu*5xJ`Rn~VpIyQN/]7?]`W%bnnvx,');
define('AUTH_SALT',        '@ro@S>S:bnFkCK;T|Gf}5P|X97e-IszY%Z)IMZy/B)Cy|_Y:yGZ-IxkC|XLKmv15');
define('SECURE_AUTH_SALT', 'H:J}U+8-a.;2&cf/wmL6+ qt3g+XTr_LA4vI#=y?$8FW++*_Erf-U-y2osTqWXu-');
define('LOGGED_IN_SALT',   '+SnB~c??T^Ns%ds#Azhs~lA#to$Vat]QCm)W:QO%$idPC%pG</KP-LiLvR+hKW,w');
define('NONCE_SALT',       '<Higq6[Hsm0}c[J4H^`t<AJ IZMl-(xI]G z4-|?/y-D^g+e?|2q~$y,84JhV)?:');

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
