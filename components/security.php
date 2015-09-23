<?php
function wpctb__init_security(){
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove WP version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

    // remove login errors
    add_filter( 'login_errors', create_function('$a', "return null;") );

	// thanks Acunetix
    if( function_exists( 'the_generator' ) ){
        // eliminate version for wordpress >= 2.4
        remove_filter( 'wp_head', 'wp_generator' );
        $actions = array( 'wp_head', 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' );
        foreach ( $actions as $action ) {
            remove_action( $action, 'the_generator' );
        }

        // for vars
        $GLOBALS['wp_db_version']    = intval( rand(9999, 99999) );
        $GLOBALS['manifest_version'] = intval( rand(99999, 999999) );
        $GLOBALS['tinymce_version']  = intval( rand(999999, 9999999) );
    }
}
add_action( 'init', 'wpctb__init_security' );

// remove l10n script (added in WP 3.1)
// this script help translate comments entities
// @ http://wpsecure.net/secure-wordpress-advanced/
if( ! is_admin() ){
    wp_deregister_script( 'l10n' );
}

// integrate: https://github.com/roots/soil

// should be placed as first lines in index.php
// ob_start( 'ob_gzhandler' ); // it's better via .htaccess, but..
// ini_set( 'zlib.output_compression', 4096 ); // setting to 'On' is not secure, http://php.net/manual/en/function.ini-set.php#106430

// disable dangerous functions
@ini_set( 'disable_functions', 'popen,exec,eval,system,passthru,proc_open,shell_exec,show_source,php,mail' );

// (try to) remove x-powered-by header
if( function_exists( 'header_remove' ) ){
	header_remove( 'X-Powered-By' ); // PHP 5.3+
}else{
	@ini_set( 'expose_php', 'off' );
}

// todo: test/integrate
// https://github.com/roots/roots-rewrites

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
