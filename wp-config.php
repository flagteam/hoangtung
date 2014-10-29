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
define('DB_NAME', 'hoangtung');

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
define('AUTH_KEY',         '|j9<0vP =6p+31hMqiq~>*i&xPb+u8Rrh!dQ,.+~a=JrM;1?n_*L(VNOYJ %;f3J');
define('SECURE_AUTH_KEY',  'JB(PpFS)UHRX+]cM{0+_Afc/S<{r%Sh_9gF-F]$] Z3yA6-|I}PB~u^b+O}<+4n%');
define('LOGGED_IN_KEY',    'B/I<HMwnAp.$G=OSllSt7^0!5z>Rn&_Bx~UrU|QIBd{w$f#m.]NVV2q)b/)xa |>');
define('NONCE_KEY',        '(3D}iQN<|f08-w&<:0F)w3Or~kyoB8/CVt`~xvtB=?~kDDb^Luk%.zjtd};+m%+t');
define('AUTH_SALT',        '_c>n1du?~_=Y7ach<+k4nxF}Lq|-!afrSWR/6)cb2eo0|Nui)PIP)dPicL-=Mly5');
define('SECURE_AUTH_SALT', 'T|OK4&/GS48=XdL+hP9M%AiI~G9iYx1B:~WyyO!?|HDCqQhzQY8;+ <m4,M9tXLR');
define('LOGGED_IN_SALT',   '*]|d0TtgRv[/N&13}7HR1=1M*Z|G=-Q kbhxq*~j$c*sLLg_j2-ni7evA.$tL,2n');
define('NONCE_SALT',       'U&BZf0H@ 5-1F h??-~JP25?EfY 8.~iJ[w_v/WS$oyrMqvVkR+{ye*>rpNZHCT@');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'vi');

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
