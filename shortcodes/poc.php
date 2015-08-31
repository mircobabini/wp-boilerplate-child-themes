<?php
function sc_name( $attributes, $content = null ){
	// $value = $attributes['key'];
	// $content = do_shortcode( $content );

	$html = '';
	return $html;
}
add_shortcode( 'name', 'sc_name' );

// EXAMPLES

// [contatti]random html[/contatti]
function sc_contatti( $atts, $content = '' ){
	$html = '<div class="box-contatti">'.$content.'</div>';
	return $html;
};
add_shortcode( 'contatti', 'sc_contatti' );

/*
[one_third_btns]
	[one_third_btn href="/prenotazione-privati/"]Prenotazione Privati[/one_third_btn]
	[one_third_btn href="/prenotazione-scuole/"]Prenotazione Scuole[/one_third_btn]
	[one_third_btn href="/open-days/" type="success"]Open Days[/one_third_btn]
[/one_third_btns]
*/
function sc_buttons( $args, $c = '' ){
	$c = do_shortcode( $c );
	return '<div class="row">'.$c.'</div>';
}
function sc_button( $args, $c = '' ){
	$href = $args['href'];
	$type = isset( $args['type'] ) ? $args['type'] : 'primary';

	$c = strtoupper( $c );
	return '<div class="col-sm-4" style="text-align: center;"><a class="btn btn-'. $type .' btn-icon btn-lg" style="color: white; border-radius: 0px; padding: 16px 20px; font-size: 20px;" href="'. $href .'">'. $c .'</a></div>';
}
add_shortcode( 'one_third_btns', 'sc_buttons' );
add_shortcode( 'one_third_btn', 'sc_button' );

// recursive do_shortcode
// usage example:
// 	remove_filter( 'the_content', 'do_shortcode', 11 );
// 	add_filter( 'the_content', 'do_shortcode_r', 100 );
function do_shortcode_r( $string ){
	$compiled = do_shortcode( $string );
	if( $compiled != $string ){
		return do_shortcode_r( $string );
	}

	return $compiled;
}
