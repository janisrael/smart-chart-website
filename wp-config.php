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
define( 'DB_NAME', 'sc_website' );

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
define( 'AUTH_KEY',         'O-&_Quv8`8.fS`& /9`l@57NJM D<ay59EResM<,)vv8x8XUuwp!=?Ux@Z[E8w/J' );
define( 'SECURE_AUTH_KEY',  '6Lskv!hF8CB/kz*Z]._Yfk%b%aV{/6MT-*v|0xG:t?I&T4O_Z1[|rrXjO#MhS%.V' );
define( 'LOGGED_IN_KEY',    'azg%R lchQ_Ga6g1oevPvf[H=y{@t/lchAgj_#|q (]hDq)E;R*G>U{/mIU7&*H|' );
define( 'NONCE_KEY',        '1H]UFvC*j1-rD98/88@N#lQ]w2K0Av>,Pc}KCw(]7YQ {SMS<ol:Brc^l19X#gV1' );
define( 'AUTH_SALT',        'pj12QsLY|~cVL0k=Z2t4:dI%3f4tpw@njo6h`Djm&QHsO.*++&`p@9dR(ty)<5]1' );
define( 'SECURE_AUTH_SALT', '-K!}2Rqw-*//x^tW@.bfK|fEHfHw;ad<.t_?w Y2$v|_r?uMc}5HyxyGrkl{nlTO' );
define( 'LOGGED_IN_SALT',   'y@EXbNfK&!yZe]/2-n:a-],41KfxL<}GSA&H>(jJq|^MaQV0Dj4v:N!j|WXJMdoQ' );
define( 'NONCE_SALT',       '&2lf&+h||NL|[fMqQbCu^+rw,evP{DO_m}4o-#cC`ozE,}8DTfCZvQ[f@60x|Jrc' );

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
