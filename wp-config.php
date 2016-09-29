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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'nitrous');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'W?|jVAh$+}bmkB+PwPAstwL.v1u?&9 V[Gh[`4}2:/_Tk!wdtkmcZTrM|Wz,yoXU');
define('SECURE_AUTH_KEY',  'F#rJ!uVYQQwf^Sk<$1S8v(CjZN8[[[-r|K7-W+W1m(R(pH9.k,DL<2dez2[tio1P');
define('LOGGED_IN_KEY',    ')4Op NkG24qY8H4].7N|]*CHr#<5%j`}@?uZ@y?WN2hM!.UpaQ#RJVDLvb!Di1R5');
define('NONCE_KEY',        '3(A8yB vJ>W[%/$SAo44#aJ?^|J{w}0!edUUt!T~#{rJ^)2]wtJs-,f9:t{QD&uN');
define('AUTH_SALT',        'z`82cBG9Dx+V8.?^c-hOSJa#8/H6E=*qgnihpok0pIx3#Y$TrSA/6h.6]r)?f{bJ');
define('SECURE_AUTH_SALT', '(~n)Y{!Gar!oSH@N3B#Mw}t0W3&?kNeSa<_t:Vq0LI4y0^x5$9WD/F&wS:?v`7eF');
define('LOGGED_IN_SALT',   'Z-K-?k0zx* 6#,`vfqin%umVb6QKIhLOCr.goaTUO!,])tW4k/B]2a2zU]HRnCr>');
define('NONCE_SALT',       '(>xY!Kk{w!=TYs!GD)u]SF(*^Oe`(1}uH0vPP^CT)Blavg=KHTdW0Iz[ ([!T8.;');

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
