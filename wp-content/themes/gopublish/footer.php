</div><!--innerwrap-->

<?php

if ( ! is_page( 'mdce2012' ) && get_theme_mod( 'display-leader-footer' ) == "Yes" ) {
	include( TEMPLATEPATH . "/leaderboardfoot.php" );
}
?>


<!-- begin footer -->

<div style="clear:both;"></div>
</div><!--wrap-->

<div id="footer">
	<p>
		Copyright &copy; <?php echo date( 'Y' ); ?> &bull; <a href="<?php if ( get_theme_mod( 'google-apps' ) ) {
			echo get_theme_mod( 'google-apps' );
		} else {
			bloginfo( 'url' );
		} ?>"><?php bloginfo( 'name' ); ?></a> &bull;
		<a href="http://www.boatingindustry.com/advertising-info/">ADVERTISE</a> &bull;
	</p>

</div>

<?php wp_footer(); ?>


<?php if ( get_theme_mod( 'analytics' ) == 'Yes' ) { ?>

	<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', '<?php echo get_theme_mod('analytics_code'); ?>']);
		_gaq.push(['_trackPageview']);

		(function () {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();

	</script>

<?php } ?>

<!-- Quantcast Tag -->
<script type="text/javascript">
	var _qevents = _qevents || [];

	(function () {
		var elem = document.createElement('script');
		elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
		elem.async = true;
		elem.type = "text/javascript";
		var scpt = document.getElementsByTagName('script')[0];
		scpt.parentNode.insertBefore(elem, scpt);
	})();

	_qevents.push({
		qacct: "p-0948HkAy_Q_06"
	});
</script>

<noscript>
	<div style="display:none;">
		<img src="//pixel.quantserve.com/pixel/p-0948HkAy_Q_06.gif" border="0" height="1" width="1" alt="Quantcast" />
	</div>
</noscript>
<!-- End Quantcast tag -->

</body>
</html>