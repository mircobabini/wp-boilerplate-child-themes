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
