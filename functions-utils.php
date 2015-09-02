<?php
/* check user role */
//   usage
//     user__is( 'administrator' );
//   commodities
//     function is_administrator(){ return user__is( 'administrator' ); }
//     function is_editor(){ return user__is( 'editor' ); }
function user__is( $role, $user_id = null ){
	$user = is_numeric( $user_id ) ? get_userdata( $user_id ) : wp_get_current_user();
	if( ! $user ){
		return false;
	}

	return in_array( $role, (array)$user->roles );
}

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}