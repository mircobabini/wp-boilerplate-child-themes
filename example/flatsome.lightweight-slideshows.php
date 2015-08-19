<?php
// how to provide well-sized images based on mobile detection
// the images, generated on the fly, are cached into a specific directory
if( ! is_admin() ){
    add_action( 'init', function(){
        remove_shortcode( 'ux_banner' );
        add_shortcode( 'ux_banner', 'womanly_ux_banner' );
    });
}
function womanly_ux_banner( $args, $content = null ){
    if( wpmd_is_tablet() ){
        $args['bg'] = wpthumb( $args['bg'], 'width=1000&height=590&crop=1&crop_from_position=center,top&jpeg_quality=80' );
    }else if( wpmd_is_phone() ){
        $args['bg'] = wpthumb( $args['bg'], 'width=768&height=590&crop=1&crop_from_position=center,top&jpeg_quality=80' );
    }else{
        $args['bg'] = wpthumb( $args['bg'], 'width=1600&height=590&crop=1&crop_from_position=center,top&jpeg_quality=80' );
    }

    return uxbannerShortcode( $args, $content );
}