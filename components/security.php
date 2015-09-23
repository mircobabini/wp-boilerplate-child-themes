<?php
function wpctb__init_security(){
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove WP version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
}
add_action( 'init', 'wpctb__init_security' );

// integrate: https://github.com/roots/soil

// should be placed as first lines in index.php
// ob_start( 'ob_gzhandler' ); // it's better via .htaccess, but..
// ini_set( 'zlib.output_compression', 4096 ); // setting to 'On' is not secure, http://php.net/manual/en/function.ini-set.php#106430

// disable dangerous functions
@ini_set( 'disable_functions', 'popen,exec,system,passthru,proc_open,shell_exec,show_source,php' );

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
