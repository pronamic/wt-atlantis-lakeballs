jQuery(document).ready(function($) {
	if($.browser.msie && parseInt($.browser.version, 10) < 9) {
		$("img").each(function() {
			$(this).removeAttr("width");
			$(this).removeAttr("height");
		});
	}
});