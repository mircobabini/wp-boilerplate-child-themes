<?php
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
