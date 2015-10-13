<?php
/* aux error function v1.0.4 */
if( ! function_exists( 'wpctb__setup_error' ) ) :
function wpctb__setup_error( $error = null ){
	if( $error === null ){
		$error  = "<h2>Error, check this procedure</h2><br/>";
		$error .= "<small><b>1.</b></small> Activate SED Web Security plugin (it's a mandatory)";
		$error .= "<br/><br/>";
		$error .= "<small><b>2.</b></small> Place the line below just before the requirement of wp-settings.php:";
		$error .= "<br/><br/>";
		$error .= "<code>require_once ABSPATH.'/wp-content/plugins/sedweb-security/wpctb-bootstrap.php';</code>";
		$error .= "<br/><br/>";
		$error .= "<b>After that, reload.</b>";
		$error .= "<br/><br/>";
		$error .= "<br/><br/>";
		$error .= "<b>Are you stuck in this page?</b>";
		$error .= "<br/><br/>";
		$error .= "Temporary place a <code>return;</code> before anything else into your <code>functions.php</code>, then reload.";
	}

	function_exists( 'wp_die' ) ? wp_die($error) : die($error);
}
endif;
