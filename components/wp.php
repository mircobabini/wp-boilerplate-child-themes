<?php
/* check user role */
//   usage
//     user_is( 'administrator' );
//   commodities
//     function is_administrator(){ return user_is( 'administrator' ); }
//     function is_editor(){ return user_is( 'editor' ); }
function user__is( $role, $user_id = null ){
	$user = is_numeric( $user_id ) ? get_userdata( $user_id ) : wp_get_current_user();
	if( ! $user ) return false;

	return in_array( $role, (array)$user->roles );
}

/* @requires https://wordpress.org/plugins/wp-user-avatar/ */
if( defined( 'WPUA_VERSION' ) ){
	function user__get_avatar_url( $id_or_email, $size = 64 ){
		$get_avatar = get_avatar( $id_or_email, $size );
		preg_match( "/src=\"(.*?)\"/i", $get_avatar, $matches );
		return $matches[1];
	}
	function user__get_user_avatar_url( $user ){
		$attachment_id = get_user_meta( $user->ID, 'wp_user_avatar', true );
		if( $attachment_id ){
			return wp_get_attachment_thumb_url( $attachment_id );
		}

		return user__get_avatar_url( $user->ID );
	}
}