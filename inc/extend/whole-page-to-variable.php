<?php
// add_action( 'wp_head', function(){ ob_start( 'smashing_callback' ); } );
// add_action( 'wp_footer', function(){ ob_end_flush(); } );

function smashing_callback( $content ) {
   // Feel free to do things to the content here
   $content = str_replace( 'great', 'awesome', $content );
   echo $content;
}