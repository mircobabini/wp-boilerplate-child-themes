<?php
// CONSTANTS FOR WP-CONFIG: https://codex.wordpress.org/Editing_wp-config.php
// Explanations: http://wpengineer.com/2382/wordpress-constants-overview/
// Generator: http://generatewp.com/wp-config/
ini_set( 'date.timezone', 'Europe/Rome' );

/* TOOLS */
// allows overwriting images when editing them
__define( 'IMAGE_EDIT_OVERWRITE', true);

/* MEMORY */
// todo: this should be only for admin area
// this has to be put before wp-settings.php inclusion
__define( 'WP_MEMORY_LIMIT',     '256M' );
__define( 'WP_MAX_MEMORY_LIMIT', '256M' );
@ini_set( 'memory_limit', WP_MEMORY_LIMIT );

/* DATABASE & FILE SYSTEM */
// charset/collation of the database
__define( 'DB_CHARSET', 'utf8' );
__define( 'DB_COLLATE', 'utf8_general_ci' );
// permissions
__define( 'FS_CHMOD_DIR',  ( 0755 & ~ umask() ) );
__define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );
// timeouts
__define( 'FS_CONNECT_TIMEOUT', 30 );
__define( 'FS_TIMEOUT', 30 );
// ignore FTP login to install plugins or stuff
__define( 'FS_METHOD', 'direct' );


/* DEBUGGING */
__define( 'WPCTB__DEV', true );

if( ! defined( 'WP_DEBUG' ) ){
	/* no    debug: false, false, false */
	/* operativity: true, false, false */
	/* soft  debug: true, true, false */
	/* hard  debug: true, true, true */
	if( wp_debug__( true ) ){
		wp_debug__log( true );
		wp_debug__display( false );
	}
}

/* you need hardcore debug? */
// ini_set( 'log_errors', 'On' );
// ini_set( 'display_errors', 'On' );

// load non-minified version of wp core assets
__define( 'SCRIPT_DEBUG', WPCTB__DEV );
// to result in a faster administration area, all Javascript files are concatenated into one URL.
// if Javascript is failing to work in your administration area, you can try disabling this feature
__define( 'CONCATENATE_SCRIPTS', !WPCTB__DEV );
// saves the database queries to a array and that array can be displayed to help analyze those queries.
// example: global $wpdb; print_r( $wpdb->queries );
__define( 'SAVE_QUERIES', WPCTB__DEV );

/* OPTIMIZATIONS */
// remove or limit revisions
// example: define( 'WP_POST_REVISIONS', false );
__define( 'WP_POST_REVISIONS', WPCTB__DEV ? 20 : 3  ); // int or false
__define( 'EMPTY_TRASH_DAYS',  WPCTB__DEV ? 0  : 14 ); // 0 = disabled
__define( 'AUTOSAVE_INTERVAL', WPCTB__DEV ? 10 : 30 ); // secs
__define( 'MEDIA_TRASH', false ); // Enables the trash function for Media files

// cache and compression
__define( 'WP_CACHE',         !WPCTB__DEV );
__define( 'ENFORCE_GZIP',     !WPCTB__DEV );
__define( 'COMPRESS_CSS',     !WPCTB__DEV );
__define( 'COMPRESS_SCRIPTS', !WPCTB__DEV );

/* UPDATES */
__define( 'AUTOMATIC_UPDATER_DISABLED', true ); // Disable all automatic updates
__define( 'WP_AUTO_UPDATE_CORE', false ); // Disable all core updates

/* SECURITY */
// file editing
__define( 'DISALLOW_FILE_MODS', true ); /* updates to themes/plugins */
__define( 'DISALLOW_FILE_EDIT', true ); /* editors of themes/plugins */
// crons
__define( 'DISABLE_WP_CRON',   false );
__define( 'ALTERNATE_WP_CRON', false );
__define( 'WP_CRON_LOCK_TIMEOUT', 60 );

/* MAINTENANCE */
// really useful when moving to production:
// 1st: try the website forcing WP_SITEURL/WP_HOME
// 2nd: when ready, set RELOCATE to true and perform a login from wp-login.php
// 3rd: comment all these lines again, you're done
// $__siteurl = 'http://domain.it'; // 'http://'.$_SERVER['SERVER_NAME'])
// __define( 'WP_SITEURL', $__siteurl );
// __define( 'WP_HOME',    $__siteurl );
// __define( 'RELOCATE',   false );
// need to repair database? usage: /wp-admin/maint/repair.php
// __define( 'WP_ALLOW_REPAIR', false );
// __define( 'DO_NOT_UPGRADE_GLOBAL_TABLES', true );
// print_r( @get_defined_constants() );

/* FTP */
// __define( 'FTP_BASE', '/web' );
// __define( 'FTP_USER', 'test' );
// __define( 'FTP_PASS', 'pass' );
// __define( 'FTP_HOST', 'host' );
// __define( 'FTP_SSL',  false );
// __define( 'FTP_CONTENT_DIR', FTP_BASE.'/wp-content/' );
// __define( 'FTP_PLUGIN_DIR ', FTP_BASE.'/wp-content/plugins/' );

