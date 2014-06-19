<?php
/**
 * Theme Sidebars
 * Date: 5/5/14
 */

if ( function_exists('register_sidebars') ) {
	if (
		(get_theme_mod('sno-layout') == "Option 3") || (get_theme_mod('sno-layout') == "Option 6")
	) {
		register_sidebar(array('name'=>'Non-Home Sidebar',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap300"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
		register_sidebar(array('name'=>'Home Full Width Column',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap610"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
		register_sidebar(array('name'=>'Home Bottom Left',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap280"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
		register_sidebar(array('name'=>'Home Bottom Right',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap280"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
		register_sidebar(array('name'=>'Home Sidebar',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap300"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
		register_sidebar(array('name'=>'Ads Sidebar',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap160"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
	} else {
		register_sidebar(array('name'=>'Non-Home Sidebar',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap300"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
		register_sidebar(array('name'=>'Home Full Width Column',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap610"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
		register_sidebar(array('name'=>'Home Narrow Column',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap160"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
		register_sidebar(array('name'=>'Home Wide Column',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap400"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
		register_sidebar(array('name'=>'Home Sidebar',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap300"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
		register_sidebar(array('name'=>'Ads Sidebar',
							   'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
							   'after_widget' => '</div><div class="widgetfooter"></div></div>',
							   'before_title' => '</div><div class="titlewrap160"><h2>',
							   'after_title' => '</h2></div><div class="widgetbody">',
			));
	}
}

if ( function_exists('register_sidebars') ) {

	register_sidebars( 1,
		array(
			'name' => 'showcases',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widgettitle">',
			'after_title' => '</h2>'
		)
	);

}