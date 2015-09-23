<?php
function disable_autosave(){
	wp_deregister_script( 'autosave' );
}
add_action( 'admin_init', 'disable_autosave' );

// customizer: http://www.wpexplorer.com/theme-customizer-introduction/
