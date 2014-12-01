/**
*
* Interstitial Ad Javascript
*
*/
googletag.cmd.push( function() {
	googletag.defineSlot(
		ad_data.ad_position,
		[1, 1],
		'div-gpt-ad-1398116137114-0'
	).addService( googletag.pubads() );
	googletag.defineOutOfPageSlot(
		ad_data.ad_position,
		'div-gpt-ad-1398116137114-0-oop'
	).addService( googletag.pubads() );
	googletag.pubads().collapseEmptyDivs(true);
	googletag.pubads().addEventListener('slotRenderEnded', function(event) {
		if ( ( event.slot.j === ad_data.ad_position) && !event.isEmpty ) {
			jQuery( '.interstitialAd' ).show();
		}
	});
	googletag.enableServices();
});

jQuery(document).ready(function($) {

	var close_overlay = function() {
		$(this).hide();
	};

	$('.interstitialAd').on("click", close_overlay);
	$('.close-interstitial').on("click", close_overlay);

});