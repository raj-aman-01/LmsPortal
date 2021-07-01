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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'Io6~O]/!s_cHA#l=GdX@0?o0a.$g2_D>f/cJYolxIbJA`8,YE@#b,lz1G5wzf<Y:' );
define( 'SECURE_AUTH_KEY',  'JA|Mx<M U6lzu$;N+{O{DAM`ph< Y Fkk|iq0.H`BL.:8*RvNb! ,2s k^SBe<:)' );
define( 'LOGGED_IN_KEY',    'wY+|~Ot8Uoq%[3~6:~o)fg=mGp$c/]{c^@7T $:AH&}b7uRJJDeA62!0C6EBFudI' );
define( 'NONCE_KEY',        'S;fM B`oMetH =U4.jyhB&a6xwMx $6HF!k.}$:hr<<Tm*x/p>vBqmN<I}#WobXw' );
define( 'AUTH_SALT',        '-W)=SAWEK&MpKSm55}A2v;Nx/r7d--fKnJ$7b4IP?{GWFiGB9&tP(X$4;xwLg4c0' );
define( 'SECURE_AUTH_SALT', 'QPCe#VNTg0Rm%{!aS^giERQhf1Q)t0.L)rd5{QImkGFU_(]X!PRtjng6e<%1]>EC' );
define( 'LOGGED_IN_SALT',   'x[)Xp>3o_F18PE]zZ||E`88e-_gKrmH]f<^@g|1YlD8`&Vb}gt-tpS72]oIHYE)s' );
define( 'NONCE_SALT',       'EPF8evdUya}.3QUGD}}T83Ql2OuK3^-b:6fOZ~BT5:(}]8wj3|ex9xh%]A~mk.Vn' );

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
