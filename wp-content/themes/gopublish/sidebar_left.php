<!-- begin l_sidebar -->

<div id="l_sidebar">

	<ul id="l_sidebarwidgeted">
	
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>
	
		<li id="categories-1">
		<h2>Categories</h2>
			<ul>
				<?php wp_list_categories('sort_column=name&title_li='); ?>
			</ul>
		</li>
	
		<li id="archives">
		<h2>Archives</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</li>
		
	<?php endif; ?>
	
	</ul>
	
</div>

<!-- end l_sidebar -->