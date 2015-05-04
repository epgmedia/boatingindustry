<?php
/** Header.php */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="distribution" content="global" />
	<meta name="robots" content="follow, all" />
	<meta name="language" content="en, sv" />
	<meta name="google-site-verification" content="adTkru0tJemGZVG64x0QpaoxVodEng4ryMyAjuNGswI" />
	<title><?php bloginfo( 'name' ); ?><?php if ( wp_title( '', false ) ) {
			echo ' : ';
			wp_title( '' );
		} else {
			echo ' : ';
			bloginfo( 'description' );
		} ?></title>
	<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo( 'version' ); ?>" />
	<!-- leave this for stats please -->

	<link rel="Shortcut Icon" href="<?php echo get_theme_mod( 'favicon' ); ?>" type="image/x-icon" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo( 'rss_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo( 'atom_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_get_archives( 'type=monthly&format=link' ); ?>

	<?php wp_head(); ?>

</head>

<body>

<?php after_header(); ?>

<div id="pagetop"></div>

<div id="wrap">

	<?php if ( get_theme_mod( 'leaderboard-location' ) == "Above Header" ) {

		get_template_part( 'leaderboardhead' );

	} ?>

	<div id="header">

		<?php if ( get_theme_mod( 'header_blog_title' ) == 'Image' ) { ?>

			<a href="<?php echo get_option( 'home' ); ?>/"><img src="<?php echo get_theme_mod( 'header-image' ); ?>" style="width:<?php echo get_theme_mod( 'header-width' ); ?>px;height:<?php echo get_theme_mod( 'header-height' ); ?>px" alt="<?php bloginfo( 'description' ); ?>" /></a>

		<?php } else if ( get_theme_mod( 'header_blog_title' ) == 'SubscribeAd' ) { ?>

			<div class="left logo">

				<a href="<?php echo get_option( 'home' ); ?>/">
					<img src="<?php echo get_theme_mod( 'header-image' ); ?>" alt="<?php bloginfo( 'description' ); ?>" class="brandLogo" />
				</a>

			</div>

			<div class="right subscribeAd">

				<a href="<?php echo get_theme_mod( 'subscribe-link' ); ?>"><img src="<?php echo get_theme_mod( 'subscribe-image' ); ?>" style="width:<?php echo get_theme_mod( 'subscribe-width' ); ?>px;height:<?php echo get_theme_mod( 'subscribe-height' ); ?>px;border:none;" alt="Subscribe Today" /></a>

			</div>

		<?php } else { ?>

			<a href="<?php echo get_option( 'home' ); ?>/"><h1><?php bloginfo( 'name' ); ?></h1></a>

			<p><?php bloginfo( 'description' ); ?></p>

		<?php } ?>

	</div>

	<div id="navbar">

		<div id="navbarleft">

			<ul id="nav">

				<?php wp_nav_menu( array( 'menu' => 'Top Menu' ) ); ?>

			</ul>

		</div>

		<div id="navbarright">

			<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">

				<input type="search" name="s" id="searchbox" placeholder="Search our site..." />
				<input type="image" style="vertical-align:top;" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" alt="Search" />

			</form>

		</div>

	</div>


	<?php if ( get_theme_mod( 'bottomnav' ) == "Show" ) { ?>

		<div id="subnavbar">

			<ul id="subnav">

				<?php wp_nav_menu( array( 'menu' => 'Bottom Menu' ) ); ?>

			</ul>

		</div>

	<?php } ?>

	<?php if ( ! is_page( 'mdce2012' ) && get_theme_mod( 'leaderboard-location' ) == "Below Header" ) {

		include( TEMPLATEPATH . "/leaderboardhead.php" );

	} ?>

	<div class="innerwrap">