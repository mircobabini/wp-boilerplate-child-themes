<?php
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