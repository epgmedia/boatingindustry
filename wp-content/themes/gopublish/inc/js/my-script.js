/**
 *
 * snoData object
 *
 * scroll_style      = get_theme_mod('sports-scroll-style')
 * is_scroll_visible = get_theme_mod('sports-scrollbox-visible')
 * scroll_speed      = get_theme_mod('sports-speed')
 * scroll_transition = get_theme_mod('sports-transition')
 * scroll_number     = get_theme_mod('sports-scrollbox-number')
 *
 * bscroll_style
 * bscroll_style      = get_theme_mod('breaking-scroll-style')
 * bis_scroll_visible = get_theme_mod('breaking-visible')
 * bscroll_speed      = get_theme_mod('breakingnews-speed')
 * bscroll_transition = get_theme_mod('breakingnews-transition')
 * bscroll_number     = get_theme_mod('breaking-scroll-number')
 *
 * slideshow_transition = get_theme_mod('top-stories-transition')
 * slideshow_speed      = get_theme_mod('top-stories-trans-speed')
 * slideshow_automate   = get_theme_mod('top-stories-automate')
 * slideshow_timeout    = get_theme_mod('top-stories-speed')
 *
 * // alert( object_name.some_string) ; // alerts 'Some string to translate'
 */

/**
 * Homepage Slider
 *
 */
jQuery(document).ready(function($) {
	var slideTimeout = 0;
	var slidePause = false;
	var slidePauseOnPagerHover = false;
	if (snoData.slideshow_automate == 'On') {
		slideTimeout = parseInt(snoData.slideshow_timeout, 10);  // milliseconds between slide transitions (0 to disable auto advance)
		slidePause = true; // true to enable "pause on hover"
		slidePauseOnPagerHover = true;  // true to pause when hovering over pager link
	}
	$('#slideshow').cycle({
		fx               : snoData.slideshow_transition, // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		pager            : '#pager',  // selector for element to use as pager container
		speed            : snoData.slideshow_speed,
		timeout          : slideTimeout,  // milliseconds between slide transitions (0 to disable auto advance)
		pause            : slidePause, // true to enable "pause on hover"
		pauseOnPagerHover: slidePauseOnPagerHover  // true to pause when hovering over pager link
	});

	if (snoData.scroll_style !== '') {
		var cscroll_style = snoData.scroll_style;
		if (snoData.scroll_style == 'vertical') {
			var scroll_items = snoData.scroll_number;
		}
	}

	$('.newsticker-jcarousellite').jCarouselLite({
		//snoData.scroll_style : true,
		visible: snoData.is_scroll_visible,
		auto   : snoData.scroll_speed,
		speed  : snoData.scroll_transition,
		scroll : scroll_items
	});

	if (snoData.bscroll_style == 'vertical') {
		var bscroll_items = snoData.bscroll_number;
	}

	$(".newsticker2-jcarousellite").jCarouselLite({
		//snoData.bscroll_style : true,
		visible: snoData.bis_scroll_visible,
		auto   : snoData.bscroll_speed,
		speed  : snoData.bscroll_transition,
		scroll : bscroll_items
	});

	$(".newsticker3-jcarousellite").jCarouselLite({
		//snoData.bscroll_style : true,
		visible: snoData.bis_scroll_visible,
		auto   : snoData.bscroll_speed,
		speed  : snoData.bscroll_transition,
		scroll : bscroll_items
	});

});


jQuery(document).ready(function($) {

	var subscribe_html =
		'<p class="sublink">' +
			'<i>Subscribe to the <a href="http://www.boatingindustry.com/newsletter-signup/" target="_blank">Boating Industry Enewsletter</a></i>' +
		'</p>';

	$('div.postArea').append(subscribe_html);

});

sfHover = function () {
	if (!document.getElementsByTagName) {

		return false;
	}

	var sfEls = document.getElementById("nav").getElementsByTagName("li");

	// if you only have one main menu - delete the line below
	var sfEls1 = document.getElementById("subnav").getElementsByTagName("li");

	for (var i = 0; i < sfEls.length; i++) {
		sfEls[i].onmouseover = function () {
			this.className += " sfhover";
		}
		sfEls[i].onmouseout = function () {
			this.className = this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}

	// if you only have one main menu - delete the "for" loop below //
	for (var i = 0; i < sfEls1.length; i++) {
		sfEls1[i].onmouseover = function () {
			this.className += " sfhover1";
		}
		sfEls1[i].onmouseout = function () {
			this.className = this.className.replace(new RegExp(" sfhover1\\b"), "");
		}
	}
}

if (window.attachEvent) {
	window.attachEvent("onload", sfHover);
}

/*

*/