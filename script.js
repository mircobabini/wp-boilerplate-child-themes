(function($d, $w){


// ==== jQuery noConflict Wrapper ====
// The jQuery library included with WordPress is set to the noConflict() mode (see wp-includes/js/jquery/jquery.js).
// This is to prevent compatibility problems with other JavaScript libraries that WordPress can link.
jQuery(document).ready(function($) {
    // Inside of this function, $() will work as an alias for jQuery()
    // and other libraries also using $ will not be accessible under this shortcut
});

window.addEventListener('load', function() {
	/* fastclick (wanna load it the async way via js? http://jasonshimmy.com/2014/02/11/adding-fastclick-js-quick-and-easy/) */
	( !!window.FastClick ) && FastClick.attach( document.body );
}, false);


})(document, window);
