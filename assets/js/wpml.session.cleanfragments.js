// requirements
var func_name = this.window['function_exists'];
var func_exists = typeof func_name === 'function';
if( ! func_exists ){
	function function_exists(func_name) {
		//  discuss at: http://phpjs.org/functions/function_exists/
		// original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// improved by: Steve Clay
		// improved by: Legaev Andrey
		// improved by: Brett Zamir (http://brett-zamir.me)
		//   example 1: function_exists('isFinite');
		//   returns 1: true

		if (typeof func_name === 'string') {
			func_name = this.window[func_name];
		}

		return typeof func_name === 'function';
	}
}
if( ! function_exists( 'addEventListener' ) ){
	function addEventListener(el, eventName, handler) {
		if (el.addEventListener) {
			el.addEventListener(eventName, handler);
		} else {
			el.attachEvent('on' + eventName, function(){
				handler.call(el);
			});
		}
	}
}
if( ! function_exists( 'forEachElement' ) ){
	function forEachElement(selector, fn) {
		var elements = document.querySelectorAll(selector);
		for (var i = 0; i < elements.length; i++)
			fn(elements[i], i);
	}
}

// fix wpml cache issues when switching between languages
forEachElement('#lang_sel_footer a', function(el, i){
	addEventListener(el, 'click', function(){
		window.sessionStorage.wc_fragments = null;
	});
});
