<?php
// best idea is targetting the browsers (lt IE 9)
// but conditional register works only for styles at the moment

// workaround: Conditional polyfills http://stackoverflow.com/a/16221114/1160173
// soon we will be able to use this solution: http://stackoverflow.com/a/14364765/1160173
global $conditional_scripts;
$conditional_scripts = array(
    'html5shiv'           => '//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.js',
    'html5shiv-printshiv' => '//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv-printshiv.js',
    'respond'             => '//cdn.jsdelivr.net/respond/1.4.2/respond.min.js'
);

function wpctb__ltie9support() {
        global $conditional_scripts;
        foreach ( $conditional_scripts as $handle => $src ) {
            wp_deregister_script( $handle );
            wp_enqueue_script( $handle, $src, array(), '', false );
        }
}
if( ! is_admin() ){
	add_action( 'wp_enqueue_scripts', 'wpctb__ltie9support' );
}

global $conditional_scripts;
add_filter( 'script_loader_tag', function( $tag, $handle ) use ( $conditional_scripts ) {
    if ( array_key_exists( $handle, $conditional_scripts ) ) {
        $tag = "<!--[if lt IE 9]>$tag<![endif]-->";
    }
    return $tag;
}, 10, 2 );
