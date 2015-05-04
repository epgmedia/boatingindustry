		</div><!--innerwrap-->

		<?php if ( ! is_page( 'mdce2012' ) && get_theme_mod( 'display-leader-footer' ) == "Yes" ) {
			include( TEMPLATEPATH . "/leaderboardfoot.php" );
		} ?>
	</div><!--wrap-->

	<div id="footer">
		<p>
			Copyright &copy; <?php echo date( 'Y' ); ?> &bull; <a href="<?php if ( get_theme_mod( 'google-apps' ) ) {
				echo get_theme_mod( 'google-apps' );
			} else {
				bloginfo( 'url' );
			} ?>"><?php bloginfo( 'name' ); ?></a> &bull;
			<a href="http://www.boatingindustry.com/advertising-info/">ADVERTISE</a> &bull;
			<a href="https://plus.google.com/109143106922726430364" rel="publisher">Google+</a>
		</p>
		<?php wp_footer(); ?>
	</div>

	<?php include 'analytics-tags.php'; ?>

</body>
</html>