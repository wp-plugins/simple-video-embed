(function($) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source should reside in
	 * this file.
	 * 
	 * Note that this assume you're going to use jQuery, so it prepares the $
	 * function reference to be used within the scope of this function.
	 * 
	 * From here, you're able to define handlers for when the DOM is ready:
	 * 
	 * $(function() {
	 * 
	 * });
	 * 
	 * Or when the window is loaded: $( window ).load(function() {
	 * 
	 * });
	 * 
	 * ...and so on.
	 * 
	 * Remember that ideally, we should not attach any more than a single
	 * DOM-ready or window-load handler for any particular page. Though other
	 * scripts in WordPress core, other plugins, and other themes may be doing
	 * this, we should try to minimize doing that in our own work.
	 */

	$(document).ready(function() {

		// img lazy load
		if ($.isFunction($.fn.unveil)) {
			$("img").unveil();
		}

		$(".arrow-right").bind("click", function(event) {
			event.preventDefault();
			$(".wpsve-list-container").stop().animate({
				scrollLeft : "+=336"
			}, 750);
		});
		$(".arrow-left").bind("click", function(event) {
			event.preventDefault();
			$(".wpsve-list-container").stop().animate({
				scrollLeft : "-=336"
			}, 750);
		});
/*
		if ($.isFunction($.fn.owlCarousel)) {
			$('.wpsve-video-container').each(function() {
				var carousel = $(".owl-carousel").owlCarousel({
					margin : 10,
					loop : true,
					center : true,
					lazyLoad : false,
					responsiveClass : true,
					nav : true,
					dotsEach : true,
					navText : [ '<i class="dashicons dashicons-before dashicons-arrow-left-alt2"></i>', '<i class="dashicons dashicons-before dashicons-arrow-right-alt2"></i>' ],
					responsive : {
						0 : {
							items : 2
						},
						500 : {
							items : 3
						},
						600 : {
							items : 4
						},
						1000 : {
							items : 5
						}
					}
				});
			});

		}*/
	});

})(jQuery);

// Load the IFrame Player API code asynchronously.
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var wpsvePlayers = {};

function onYouTubeIframeAPIReady() {
	var playlist = document.getElementsByClassName('wpsve-video-container');
	for (var i = 0; i < playlist.length; ++i) {
		var item = playlist[i].getElementsByTagName("iframe")[0];
		var playerNumber = item.id;
		wpsvePlayers[playerNumber] = new YT.Player(item.id, {
			events : {
				'onReady' : function(e) {
					e.target.setVolume(e.target.getVolume()); // hack to init
					// player for
					// owl
				},
				'onStateChange' : onPlayerStateChange
			}
		});
	}
}

function onPlayerStateChange(event) {
	jQuery('.owl-carousel', jQuery(event.target.getIframe()).closest('.wpsve-youtube')).trigger('to.owl.carousel', [ event.target.getPlaylistIndex(), 300 ]);
}
