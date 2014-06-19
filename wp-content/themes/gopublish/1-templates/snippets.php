<?php


/** Checks for some multi Media Shit **/

$mmcheck = get_option( 'msno' );
if ( $mmcheck == "msno402841m" ) { ?>


	<?php if ( $slideshow ) {
		$mediacount ++; ?>


		<div class="videoplay2">
			<a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title(); ?>" class="thickbox" style="font-size:22px;line-height:30px;">View Slideshow</a>
		</div>
		<div style="clear:both"></div>
		<div id="media<?php echo $mediacount; ?>" style="display: none;">
			<?php if ( $slideshow ) {
				$showalbum = "[slideshow id =" . $slideshow . " w=" . $sswidthgallery . " h=" . $ssheightgallery . "]";
				echo do_shortcode( $showalbum ); ?>
				<div style="margin-bottom:15px"></div><?php } ?>
			<?php $slideshowcredit = get_post_meta( $post->ID, slideshowcredit, true );
			if ( $slideshowcredit ) { ?>
				<div class="mmdivider">
				<p class="photographer">Credit: <?php echo $slideshowcredit; ?></p></div><?php } ?>
		</div>
	<?php } ?>

	<?php if ( $soundslides ) { ?>
		<?php $mediacount ++; ?>
		<div class="videoplay2">
			<a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title(); ?>" class="thickbox" style="font-size:22px;line-height:30px;">View Slideshow</a>
		</div>
		<div style="clear:both"></div>
		<div id="media<?php echo $mediacount; ?>" style="display: none;">
			<?php if ( $soundslides ) {
				$pattern     = "/height=\"[0-9]*\"/";
				$soundslides = preg_replace( $pattern, "height=' " . $videoheight . " '", $soundslides );
				$pattern     = "/width=\"[0-9]*\"/";
				$soundslides = preg_replace( $pattern, "width=' " . $videowidth . " '", $soundslides );
				echo $soundslides;
			} ?>
			<?php $soundslidecredit = get_post_meta( $post->ID, soundslidescredit, true );
			if ( $soundslidescredit ) { ?>
				<div class="mmdivider">
				<p class="photographer">Credit: <?php echo $soundslidescredit; ?></p></div><?php } ?>
		</div>
	<?php } ?>


<?php }

/**
 * Breaking news
 *
 * Goes in header below sidebar.
 */

if ( get_theme_mod( 'breakingnews-location' ) == "Header" ) { ?>

	<?php $scrollspeed = get_theme_mod( 'breakingnews-speed' ); ?>

	<?php $bncheck = get_option( 'bsno' );

	if ( $bncheck == "bsno837625b" ) {

		include( TEMPLATEPATH . "/tools/breakingnews.php" );

	} ?>

<?php } ?>


I took it out of the Leaderboardhead.php file.

<!--
	<div id="leaderboardright">

		 <?php $leaderurlsmall=get_theme_mod('leader-url-small'); $leaderimagesmall=get_theme_mod('leader-image-small');
if ($leaderurlsmall) echo '<a target="_blank" href="'.$leaderurlsmall.'">'; if ($leaderimagesmall) echo '<img src="'.$leaderimagesmall.'" class="leaderimageright" />'; if ($leaderurlsmall) echo '</a>'; ?>

	</div> -->

