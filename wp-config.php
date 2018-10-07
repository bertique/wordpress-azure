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

//Using environment variables for DB connection information

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define('DB_NAME', getenv('DATABASE_NAME'));

/** MySQL database username */
define('DB_USER', getenv('DATABASE_USERNAME'));

/** MySQL database password */
define('DB_PASSWORD',getenv('DATABASE_PASSWORD'));

/** MySQL hostname */
define('DB_HOST', getenv('DATABASE_HOST'));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Turn OFF auto updates **/
define( 'AUTOMATIC_UPDATER_DISABLED', true );

/* Security for Wordpress : 
you may wish to disable the plugin or theme editor to prevent overzealous users from being able to edit sensitive files and 
potentially crash the site. Disabling these also provides an additional layer of security if a hacker gains access to a 
well-privileged user account.
Note : If your plugin or theme you use with your app requires editing of the files , comment the line below for 'DISALLOW_FILE_EDIT'
*/
define('DISALLOW_FILE_EDIT', true);


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '<*e*Qy<n)b:W/dZC+ooSTf/D7P*];Z3Md`cykg7^#pD;:$q=a<-T^u2$m~+WIuOB');
define('SECURE_AUTH_KEY',  '8/2@&!U0XIc7g>{@ }-bkC*/4-MWU+K%5#&(W9/=;S<[|zR`;mIDZ/@{xLpBXQH>');
define('LOGGED_IN_KEY',    ']:o`1s=rX-o<T$0uJ2Qp#${my_o{C^Qc!n<)|M`V|dk);w(7=o,]-xbfI?oh(90Y');
define('NONCE_KEY',        'DQyQ-us+lhgy<(1]-aS(+Elkse,;2cWY/h5R]8l=-Lul(XV:ned4t$.%>Nm<<[q$');
define('AUTH_SALT',        'I&:p8~*!_x=GdU]m6>NL/f+OPzx)|y1L~h+fkkOh^kj.Y{*HsDY=?U5bWv=kt.~P');
define('SECURE_AUTH_SALT', 'dN=su}^aN{@fq4WE=sSI-p ]_+(T`<h7;!(*Q:4Qx^v>mf^|6Up.*,xE;vT-S]A}');
define('LOGGED_IN_SALT',   'x+hjzZAewqjVzWA+a|+D]PPPbxN`F}5*vYv0rDlzvg[y}slR>_&w+Gm>2I*bkC>G');
define('NONCE_SALT',       'cj4RTh2`+kk+h}/^C++/0MyV!^:CY#/lCfLZajJvC|4lobg>7NdFYi<8t7#(QKMU');

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

//Chosing server variable to get the proper host name (direct connection vs via WAF)
$http_host = isset($_SERVER['HTTP_X_ORIGINAL_HOST']) ? 'HTTP_X_ORIGINAL_HOST' : 'HTTP_HOST';

//Protocol selection when behind a WAF
$http_protocol = "http";

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) == 'https') {
	$_SERVER['HTTPS'] = 'on';
	$http_protocol = "https";
}
if (isset($_SERVER['HTTP_X_FORWARDED_PORT']) && $_SERVER['HTTP_X_FORWARDED_PORT'] > 0 && $_SERVER['HTTP_X_FORWARDED_PORT'] < 65535) {
	$_SERVER['SERVER_PORT']	= $_SERVER['HTTP_X_FORWARDED_PORT'];
}

//Relative URLs for swapping across app service deployment slots 
define('WP_HOME', $http_protocol . '://'. filter_input(INPUT_SERVER, $http_host, FILTER_SANITIZE_STRING));
define('WP_SITEURL', $http_protocol . '://'. filter_input(INPUT_SERVER, $http_host, FILTER_SANITIZE_STRING));
define('WP_CONTENT_URL', '/wp-content');
define('DOMAIN_CURRENT_SITE', filter_input(INPUT_SERVER, $http_host, FILTER_SANITIZE_STRING));


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
