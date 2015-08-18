<?php
// todo: use the same register/enqueue login from assets/init.php

// http://plugins.svn.wordpress.org/html5shiv/tags/3.7.2.1/html5shiv.php
// The latest HTML5 JavaScript shiv for IE to recognise and style the HTML5 elements
function wpctb__html5shiv_cdn() {
		wp_deregister_script( 'respond' );
		wp_deregister_script( 'html5shiv' );
		wp_deregister_script( 'html5shiv-printshiv' );

		wp_enqueue_script( 'respond',             '//cdn.jsdelivr.net/respond/1.4.2/respond.min.js', array(), '', false );
		wp_enqueue_script( 'html5shiv',           '//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.js', array(), '', false );
		wp_enqueue_script( 'html5shiv-printshiv', '//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv-printshiv.js', array(), '', false );
}
if( ! is_admin() ){
	add_action( 'wp_enqueue_scripts', 'wpctb__html5shiv_cdn' );
}

// better idea is targetting the browsers (lt IE 9)
// but conditional register works only for styles at the moment

// workaround: Conditional polyfills http://stackoverflow.com/a/16221114/1160173
// soon we will be able to use this solution: http://stackoverflow.com/a/14364765/1160173
/*
$conditional_scripts = array(
    'html5shiv'           => '//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.js',
    'html5shiv-printshiv' => '//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv-printshiv.js',
    'respond'             => '//cdn.jsdelivr.net/respond/1.4.2/respond.min.js'
);
foreach ( $conditional_scripts as $handle => $src ) {
    wp_enqueue_script( $handle, $src, array(), '', false );
}
add_filter( 'script_loader_tag', function( $tag, $handle ) use ( $conditional_scripts ) {
    if ( array_key_exists( $handle, $conditional_scripts ) ) {
        $tag = "<!--[if lt IE 9]>$tag<![endif]-->";
    }
    return $tag;
}, 10, 2 );
*/
