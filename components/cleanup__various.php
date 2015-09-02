<?php
if( is_admin() ){
	// remove help tab
	add_filter( 'contextual_help_list', function(){
		global $current_screen;
		$current_screen->remove_help_tabs();
	} ); /* todo: test it! */

	// hide wordpress update notifications for "non administrators"
	add_action( 'admin_head', function(){
		if( ! current_user_can( 'update_core' ) ){
			remove_action( 'admin_notices', 'update_nag', 3 );
		}
	}, 1 );

	// remove Tools menu for non administrators
	if( ! user__is( 'administrator' ) ){
		add_action( 'admin_menu', function(){
			remove_menu_page( 'tools.php' );
		} );
	}
}

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter( 'the_content', 'bones_filter_ptags_on_images' );

// custom excerpt-more
/*
function wpctb__excerpt_more( $text ){
	// $text = 'whatever';
	return $text;
}
add_filter( 'excerpt_more', 'wpctb__excerpt_more' );
*/

// needs tests

// hide hard urls, use relative ones
// https://gist.github.com/wycks/2315279

// Rewrite static theme assets and plugins directory (WordPress)
// https://gist.github.com/wycks/2315295