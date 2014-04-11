<!-- begin r_sidebar -->

<div id="r_sidebar">

	<ul id="r_sidebarwidgeted">
	
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(3) ) : else : ?>
	
		<li id="links">
		<h2>Links</h2>
			<ul>
				<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
			</ul>
		</li>
	
		<li id="meta">
		<h2>Meta</h2>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<li><a href="http://www.wordpress.org/">WordPress</a></li>
				<?php wp_meta(); ?>
				<li><a href="http://validator.w3.org/check?uri=referer">XHTML</a></li>
			</ul>
		</li>
		
	<?php endif; ?>
	
	</ul>
	
</div>

<!-- end r_sidebar -->