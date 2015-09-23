<?php
// change admin credits
function wpctb__admin_footer_text( $default_text ){
	return '<span id="footer-thankyou">Made by <a href="http://sedweb.it">SED Web</a> with ♥<span>';
}
add_filter( 'admin_footer_text', 'wpctb__admin_footer_text' );
