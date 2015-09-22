<?php
/* secure define */
function __define( $name, $value, $case_insensitive = false ){
	// compact implementation
	// !defined( $name ) && define( $name, $value, $case_insensitive );

	if( defined( $name ) ){
		return false; // already done, skip
	}

	define( $name, $value, $case_insensitive );
	return true; // done
}

/* debug utils */
function wp_debug__( $bool ){
	__define( 'WP_DEBUG', $bool );

	if( ! WP_DEBUG ){
		wp_debug__log( false );
		wp_debug__display( false );
	}

	return WP_DEBUG;
}
function wp_debug__log( $bool, $file = null ){
	@ini_set( 'log_errors', $bool ? 'On' : 'Off' );
	__define( 'WP_DEBUG_LOG', $bool );
}
function wp_debug__display( $bool ){
	@ini_set( 'display_errors', $bool ? 'On' : 'Off' );
    @ini_set( 'display_startup_errors', $bool ? 'On' : 'Off' );
	__define( 'WP_DEBUG_DISPLAY', $bool );
}

/* basic class */
class wpctb{
	protected $values = array();

	public function __get( $key ){
		if( isset( $this->values[ $key ] ) ){
			return $this->values[ $key ];
		}else{
			return null;
		}
	}

	public function __set( $key, $value ){
		$this->values[ $key ] => $value;
	}
}
