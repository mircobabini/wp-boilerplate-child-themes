<?php
add_action('wp_head', 'smashing_buffer_start');
add_action('wp_footer', 'smashing_buffer_end');

function smashing_buffer_start() {
   ob_start( 'smashing_callback' );
}

function smashing_buffer_end() {
   ob_end_flush();
}

function smashing_callback( $content ) {
   // Feel free to do things to the content here
   $content = str_replace( 'great', 'awesome', $content );
   echo $content;
}