<?php
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