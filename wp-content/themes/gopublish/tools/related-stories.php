<div class="clearspace"></div>

<div class="widgetwrap">

	<div class="titlewrap610">

		<h2>Related Content</h2>

	</div>

	<div id="permalinksidebar">
		<?php
		if ( function_exists( 'ddop_show_posts' ) ) {
			echo ddop_show_posts();
		}
		?>

		<h3>Other stories that might interest you...</h3>

		<?php
		if ( function_exists( 'similar_posts' ) ) {
			similar_posts();
		}
		?>

	</div>

	<div class="widgetfooter"></div>

</div>