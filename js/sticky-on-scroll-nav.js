(function($) {

$(window).load(function() {

	var wrapper = $("div.big-wrapper:first");
	var header = $("#k-theheader");
	var headerheight = header.height();
	var nav = $("#k-thenavbar");
	var navheight = nav.height();

	$(window).on("scroll", function(e) {

		if ($(this).scrollTop() > headerheight) {
			// sticky nav only if screen is larger than 800px
			if ($(this).width() > 800 ) {
				nav.addClass("fixed-nav");
				nav.find(".blog-menu").find("a").css("padding", "16px 20px");
				if ($(this).scrollTop() > headerheight + nav.height()) {
					nav.css("background-color", "rgba(0,0,0,0.8)");
				}
				wrapper.css("padding-top", navheight + "px");
			}
		} else {
			nav.removeClass("fixed-nav");
			nav.css("background-color", "#1D1D1D");
			nav.find(".blog-menu").find("a").css("padding", "27px 20px");
			wrapper.css("padding-top", "0px");
		}

	});

});

})( jQuery );