<?php
// CONSTANTS FOR WP-CONFIG: https://codex.wordpress.org/Editing_wp-config.php
// Explanations: http://wpengineer.com/2382/wordpress-constants-overview/
// Generator: http://generatewp.com/wp-config/

ini_set( 'date.timezone', 'Europe/Rome' );

// useful for apis (and not using admin-ajax.php)
// define( 'DISABLE_WP_CRON', true );
// define( 'WP_USE_THEMES', true );
// define( 'SHORTINIT', true );

/** The charset/collation of the database */
!defined( 'DB_CHARSET' ) && define( 'DB_CHARSET', 'utf8' );
!defined( 'DB_COLLATE' ) && define( 'DB_COLLATE', 'utf8_general_ci' );

!defined( 'FS_CHMOD_DIR' )  && define( 'FS_CHMOD_DIR', ( 0755 & ~ umask() ) );
!defined( 'FS_CHMOD_FILE' ) && define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );
!defined( 'FS_CONNECT_TIMEOUT' ) && define( 'FS_CONNECT_TIMEOUT', 30 );
!defined( 'FS_TIMEOUT' ) && define( 'FS_TIMEOUT', 30 );
// ignore FTP login to install plugins or stuff
!defined( 'FS_METHOD' )  && define( 'FS_METHOD', 'direct' );

$basedir = '/web';
!defined( 'FTP_BASE' ) && define( 'FTP_BASE', $basedir );
!defined( 'FTP_USER' ) && define( 'FTP_USER', 'username' );
!defined( 'FTP_PASS' ) && define( 'FTP_PASS', 'password' );
!defined( 'FTP_HOST' ) && define( 'FTP_HOST', 'ftp.example.org' );
!defined( 'FTP_SSL' )  && define( 'FTP_SSL', false );
define( 'FTP_CONTENT_DIR', FTP_BASE.'/wp-content/' );
define( 'FTP_PLUGIN_DIR ', FTP_BASE.'/wp-content/plugins/' );

!defined( 'DISABLE_WP_CRON' )      && define( 'DISABLE_WP_CRON', false );
!defined( 'WP_CRON_LOCK_TIMEOUT' ) && define( 'WP_CRON_LOCK_TIMEOUT', 60 );
// different approach to cron running
!defined( 'ALTERNATE_WP_CRON' ) && define( 'ALTERNATE_WP_CRON', false );

// when in the administration area, the memory can be increased or decreased from the WP_MEMORY_LIMIT by defining WP_MAX_MEMORY_LIMIT.
// this has to be put before wp-settings.php inclusion
!defined( 'WP_MEMORY_LIMIT' )     && define( 'WP_MEMORY_LIMIT', '256M' );
!defined( 'WP_MAX_MEMORY_LIMIT' ) && define( 'WP_MAX_MEMORY_LIMIT', '256M' );
@ini_set( 'memory_limit', WP_MEMORY_LIMIT );

// define( 'WP_HTTP_BLOCK_EXTERNAL', true );
// define( 'WP_ACCESSIBLE_HOSTS', 'api.wordpress.org,*.github.com' );

define( 'IMAGE_EDIT_OVERWRITE', true );

define( 'MEDIA_TRASH', false ); // Enables the trash function for Media files
define( 'IMAGE_EDIT_OVERWRITE', false); // Allows overwriting images when editing them

/* WordPress Cache & Compression */
define( 'WP_CACHE',            true );
define( 'COMPRESS_CSS',        true );
define( 'COMPRESS_SCRIPTS',    true );
define( 'CONCATENATE_SCRIPTS', true );
define( 'ENFORCE_GZIP',        true );

/* FTP */
define( 'FTP_USER', 'test' );
define( 'FTP_PASS', 'pass' );
define( 'FTP_HOST', 'host' );
define( 'FTP_SSL',  false );

/* Updates */
define( 'AUTOMATIC_UPDATER_DISABLED', true ); // Disable all automatic updates
define( 'WP_AUTO_UPDATE_CORE', false ); // Disable all core updates

define( 'DISALLOW_FILE_MODS', true ); /* updates to themes/plugins */
define( 'DISALLOW_FILE_EDIT', true ); /* editors of themes/plugins */

define( 'WP_ALLOW_REPAIR', false ); // only if needed, usage: /wp-admin/maint/repair.php
define( 'DO_NOT_UPGRADE_GLOBAL_TABLES', true );
print_r( @get_defined_constants() );

// for analysis
define( 'SAVEQUERIES', true );
if ( current_user_can( 'administrator' ) ) {
    ?><pre><?php
	global $wpdb; print_r( $wpdb->queries );
    ?></pre><?php
}

define( 'EMPTY_TRASH_DAYS',  30 ); // 0 = disabled
define( 'AUTOSAVE_INTERVAL', 10 ); // secs
define( 'WP_POST_REVISIONS', false ); // int or false

// for moving default folders use followings:
// WP_CONTENT_DIR, WP_CONTENT_URL, WP_PLUGIN_DIR, WP_PLUGIN_URL, UPLOADS
// for moving theme directory:
// it's not possibile, but it's possibile to add a new folder for themes using: register_theme_directory

// maybe useful when moving a website to production
// try to move (duplicator) a site to a test.domain.it subdomain
// after that, once moved the domain.it cname, try loading with RELOCATE set to true
// it should fix everything (accordingly to: https://codex.wordpress.org/Changing_The_Site_URL#Relocate_method)
// worth a try
// !defined('WP_SITEURL') && define('WP_SITEURL', 'http://'.$_SERVER['SERVER_NAME']);
// !defined('WP_HOME') && define('WP_HOME', WP_SITEURL);
define( 'WP_SITEURL', 'http://domain.it' );
define( 'WP_HOME', 'http://domain.it' );
define( 'RELOCATE', false );


// wordpress queries
//   http://benmarshall.me/wordpress-sql-queries/

// VARIOUS
// support shortcodes everywhere: http://stephanieleary.com/2010/02/using-shortcodes-everywhere/
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );

add_filter( 'comment_text', 'shortcode_unautop' );
add_filter( 'comment_text', 'do_shortcode' );

add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );

add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );

// change excerpt length/text
add_filter( 'excerpt_length', function(){ return 20; }, 99 );
add_filter( 'excerpt_more', function($t){ return '&hellip;'; }, 99 );

// remove automatic paragraphs adding
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

// filter out hard-coded width, height attributes on all images: https://gist.github.com/4557917
function remove_thumbnail_dims($html) {
	// Loop through all <img> tags
	if (preg_match_all('/<img[^>]+>/ims', $html, $matches)) {
		foreach ($matches as $match) {
			// Replace all occurences of width/height
			$clean = preg_replace('/(width|height)=["\'\d%\s]+/ims', "", $match);
			// Replace with result within html
			$html = str_replace($match, $clean, $html);
			// error_log($match);
		}
	}
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dims', 10 );
add_filter( 'the_content', 'remove_thumbnail_dims', 10 );
add_filter( 'get_avatar','remove_thumbnail_dims', 10 );

// human_time_diff explanation
// https://codex.wordpress.org/Function_Reference/human_time_diff
{
	?>
	<?php // To print an entry's time ("2 days ago"): ?>
	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>

	<?php // Internationalized version: ?>
	<?php printf( _x( '%s ago', '%s = human-readable time difference', 'your-text-domain' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>

	<?php // For comments: ?>
	<?php printf( _x( '%s ago', '%s = human-readable time difference', 'your-text-domain' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
	<?php
}

// log in as any user
wp_set_auth_cookie( $user_id );

// setup email content to html by default
// usage: wp_mail( 'someonesemail@example.com', 'Hello!', '<b>strong bodies.</b>' );
add_filter( 'wp_mail_content_type', function(){ return 'text/html'; });

// change logo to the admin login page
add_action( 'login_head', 'wptc__admin_login_logo');
function wptc__admin_login_logo(){
	?>
	<style type="text/css">
		h1 a {
			background-image:url('<?php echo get_stylesheet_directory_uri()."/img/logo.png" ?>') !important;
			margin-bottom: 10px;
			padding: 20px;
		}
	</style>
	<?php
	// <script type="text/javascript">window.onload = function(){document.getElementById("login").getElementsByTagName("a")[0].href = "'. home_url() . '";document.getElementById("login").getElementsByTagName("a")[0].title = "Go to site";}</script>';
}

// add support to posts/pages/ctps
add_action( 'init', function(){
	// add excerpt to pages
	add_post_type_support( 'page', 'excerpt' );
} );

// change admin credits
add_filter( 'admin_footer_text', 'wptc__admin_footer_text' );
function wptc__admin_footer_text( $default_text ) {
	return '<span id="footer-thankyou">Powered by <a href="http://sedweb.it">SED Web</a><span>';
}

// OPTIMIZATIONS / SECURITY
// remove or limit revisions
// example: define( 'WP_POST_REVISIONS', false );
define( 'WP_POST_REVISIONS', WPTC__DEBUG ? 20 : 5 );

// remove elements from the header: http://www.smashingmagazine.com/2011/12/10-tips-optimize-wordpress-theme/#remove-elements-from-the-header

// force perfect jpg images (compression set to 100% instead of 90% i.e. no compression at all)
// someone said that with 80%/85% you may not even notice the difference
// after changing, consider using Regenerate Thumbnails plugin to affect even old images
add_filter( 'jpeg_quality', function(){ return 100; } );
add_filter( 'wp_editor_set_quality', function(){ return 100; } );

// add_filter( 'jpeg_quality', create_function( '', 'return 100;' ) );
// add_filter( 'jpeg_quality', array( 'Returnable', '__return_int_100' ) );

class Returnable{
	public static function __callStatic( $methodname, $args = array() ){
		$marker = '__return_';
		if( ! substr( $methodname, 0, strlen($marker) ) == $marker ){
			trigger_error( 'Invalid method name Returnable::'.$methodname, E_USER_ERROR );
			return;
		}

		$rawvalue = substr( $methodname, strlen($marker) );

		$stems = explode( '_', $rawvalue, 2 );
		switch( count( $stems ) ){
			case 2:
				list( $cast, $value ) = $stems;
				break;
			case 1:
				$value = reset( $stems );
				break;
		}

		$valid_casts = array( 'bool', 'float', 'int' );
		if( ! $cast || ! in_array( $cast, $valid_casts ) ){
			return $value;
		}

		$coercion = "{$cast}val";
		return $coercion( $value );
	}
}

/* from: http://www.askapache.com/wordpress/advanced-wp-config-php-tweaks.html */
/**#@+
 * DEBUGGING STUFF
 */
/** display of notices during development. if false, error_reporting is E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR otherwise E_ALL */
!defined('WP_DEBUG') && define('WP_DEBUG', false);

/** The SAVEQUERIES definition saves the database queries to a array and that array can be displayed to help analyze those queries.
 *  The information saves each query, what function called it, and how long that query took to execute.  */
!defined('SAVE_QUERIES') && define('SAVE_QUERIES', WP_DEBUG);

!defined('ACTION_DEBUG') && define('ACTION_DEBUG', WP_DEBUG);

/** This will allow you to edit the scriptname.dev.js files in the wp-includes/js and wp-admin/js directories.  */
!defined('SCRIPT_DEBUG') && define('SCRIPT_DEBUG', WP_DEBUG);

/** Add define('WP_DEBUG_LOG', true); to enable php debug logging to WP_CONTENT_DIR/debug.log */
//!defined('WP_DEBUG_LOG') && define('WP_DEBUG_LOG', true);

/** This determines whether errors should be printed to the screen as part of the output or if they should be hidden from the user.
 *  Add define('WP_DEBUG_DISPLAY', false); to wp-config.php to use the globally configured setting for display_errors and not force it to On */
!defined('WP_DEBUG_DISPLAY') && define('WP_DEBUG_DISPLAY', false);

// + secure your keys
// https://api.wordpress.org/secret-key/1.1/