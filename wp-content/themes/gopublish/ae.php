<?php
/*
Template Name: A&E
*/
?>


<?php get_header(); ?>
<?php $acheck = get_option( 'asno' );
if ( $acheck == "asno836158a" ) { ?>

	<div id="content">

		<div id="contentleft" style="width:610px">

			<?php if ( get_theme_mod( 'ae-featured' ) != "-1" ) { ?>

				<div class="postarea" style="width:590px;margin-bottom:10px;">

					<div class="breadcrumb" style="width:590px;margin-bottom:5px;clear:both;">Featured <?php the_title(); ?> Review</div>
					<?php $recent = new WP_Query( "cat=" . get_theme_mod( 'ae-featured' ) . "&showposts=1" );
					while ( $recent->have_posts() ) : $recent->the_post();
						$do_not_duplicate[$post->ID] = $post->ID; ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" style="font-size:20px;line-height:40px;padding-bottom:10px;font-weight:bold"><?php the_title(); ?></a>

						<?php $trailer = get_post_meta( $post->ID, trailer, true );
						$feature_photo = get_post_meta( $post->ID, feature_photo, true );
						$caption = get_post_meta( $post->ID, caption, true );
						$photographer = get_post_meta( $post->ID, photographer, true );
						$teasertitle = get_post_meta( $post->ID, teasertitle, true );
						$teaser = get_post_meta( $post->ID, teaser, true );
						$grade = get_post_meta( $post->ID, grade, true );
						$reviewthumbnail = get_post_meta( $post->ID, reviewthumbnail, true );
						$showratings = get_post_meta( $post->ID, showratings, true ); ?>
						<?php if ( $trailer ) { ?>
							<div id="reviewside">
								<?php if ( $trailer ) {
									$pattern = "/height=\"[0-9]*\"/";
									$trailer = preg_replace( $pattern, "height='250'", $trailer );
									$pattern = "/width=\"[0-9]*\"/";
									$trailer = preg_replace( $pattern, "width='300'", $trailer );
									echo $trailer;
								} ?>

								<?php if ($teaser) { ?>
								<div class="teaserbox">
									<?php if ( $teasertitle ) { ?>
										<p class="teasertitle"><?php echo $teasertitle; ?></p><?php } ?>
									<p class="teasertext"><?php echo $teaser; ?></p>
									<?php if ( $grade ) { ?>
										<p class="teasergrade">Our Rating: <?php echo $grade; ?></p><?php } ?>
								</div>
								<?php if ( $showratings == "Yes" ) { ?>
									<div class="ratingsbox">
									<p class="teasertitle">What's Your Rating of <?php echo $teasertitle; ?>?</p><?php if ( function_exists( 'wp_gdsr_render_article' ) ) {
										wp_gdsr_render_article( 10 );
									} ?></div><?php } ?>
								<?php } ?><!--end of teaser check-->
							</div>

							<!--end of sidebar box option 1-->
						<? } else if ( $caption ) { ?>
							<div id="reviewside">
								<?php global $post;
								$feature_photo = get_post_meta( $post->ID, feature_photo, true );
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'permalink', array( 'class' => 'permalinkimage' ) );
								} else if ( $feature_photo ) {
									?><a href="<?php the_permalink(); ?>">
									<img src="<?php echo $feature_photo; ?>" class="permalinkimage" style="width:298px" />
									</a><?php
								} else {
									global $wpdb;
									$attachment_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1" );
									$attachment    = wp_get_attachment_url( $attachment_id );
									if ( $attachment ) {
										?><a href="<?php the_permalink(); ?>">
										<img src="<?php echo $attachment; ?>" class="permalinkimage" style="width:298px" />
										</a><?php }
								} ?>

								<?php if ( $photographer ) { ?>
									<p class="photocredit"><?php echo $photographer; ?></p><?php } ?>
								<?php if ( $caption ) { ?><p class="photocaption"><?php echo $caption; ?></p><?php } ?>
								<?php if ($teaser) { ?>
								<div class="teaserbox">
									<?php if ( $teasertitle ) { ?>
										<p class="teasertitle"><?php echo $teasertitle; ?></p><?php } ?>
									<p class="teasertext"><?php echo $teaser; ?></p>
									<?php if ( $grade ) { ?>
										<p class="teasergrade">Our Rating: <?php echo $grade; ?></p><?php } ?>
								</div>
								<?php if ( $showratings == "Yes" ) { ?>
									<div class="ratingsbox">
									<p class="teasertitle">What's Your Rating of <?php echo $teasertitle; ?>?</p><?php if ( function_exists( 'wp_gdsr_render_article' ) ) {
										wp_gdsr_render_article( 10 );
									} ?></div><?php } ?>

								<?php } ?><!--end of teaser without thumbnail-->
							</div>
							<!--end of sidebar box option 2-->
						<?php } else if ( $teaser ) { ?><!--end of feature photo if statement-->
							<div id="reviewside">
								<div class="teaserbox">


									<?php global $post;
									$feature_photo = get_post_meta( $post->ID, review_thumbnail, true );
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'ae', array( 'class' => 'reviewthumbnail' ) );
									} else if ( $feature_photo ) {
										?><a href="<?php the_permalink(); ?>">
										<img src="<?php echo $feature_photo; ?>" class="reviewthumbnail" style="width:60px" />
										</a><?php
									} else {
										global $wpdb;
										$attachment_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1" );
										$attachment    = wp_get_attachment_url( $attachment_id );
										if ( $attachment ) {
											?><a href="<?php the_permalink(); ?>">
											<img src="<?php echo $attachment; ?>" class="reviewthumbnail" style="width:60px" />
											</a><?php }
									} ?>

									<?php if ( $teasertitle ) { ?>
										<p class="teasertitle"><?php echo $teasertitle; ?></p><?php } ?>
									<p class="teasertext"><?php echo $teaser; ?></p>
									<?php if ( $grade ) { ?>
										<p class="teasergrade">Our Rating: <?php echo $grade; ?></p><?php } ?>
								</div>
								<?php if ( $showratings == "Yes" ) { ?>
									<div class="ratingsbox">
									<p class="teasertitle">What's Your Rating of <?php echo $teasertitle; ?>?</p><?php if ( function_exists( 'wp_gdsr_render_article' ) ) {
										wp_gdsr_render_article( 10 );
									} ?></div><?php } ?>
							</div><!--end of sidebar box option 3-->
						<?php } ?><!--end of teaser with thumbnail-->

						<!--start of main story body-->
						<p><?php snowriter();
							the_time( 'F j, Y' );
							edit_post_link( '(Edit)', ' &bull; ', '' ); ?></p>        <?php the_excerpt(); ?>
						<p>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Continue Reading &raquo</a>
						</p>
						<div style="clear:both;"></div>

					<?php endwhile; ?>

				</div>
				<div style="clear:both"></div>

			<?php } ?>

			<?php if (( get_theme_mod( 'ae-cat1' ) == "-1" ) || ( get_theme_mod( 'ae-cat1-count' ) == "0" )) {
			} else { ?>
			<div id="homepageleft" style="float:left;width:300px;margin-right:10px">

				<div class="widgetwrap">
					<div class="titlewrap280"><h2>
							<a href="<?php echo cat_id_to_slug( get_theme_mod( 'ae-cat1' ) ); ?>"><?php echo cat_id_to_name( get_theme_mod( 'ae-cat1' ) ); ?></a>
						</h2></div>
					<div class="widgetbody">

						<?php $count = 0;
						$recent = new WP_Query( "cat=" . get_theme_mod( 'ae-cat1' ) . "&showposts=" . get_theme_mod( 'ae-cat1-count' ) );
						while ( $recent->have_posts() ) : $recent->the_post();
							if ( $post->ID != $do_not_duplicate[$post->ID] ) { ?>

								<?php $photographer = get_post_meta( $post->ID, photographer, true );
								$teasertitle        = get_post_meta( $post->ID, teasertitle, true );
								$teaser             = get_post_meta( $post->ID, teaser, true );
								$grade              = get_post_meta( $post->ID, grade, true );
								$reviewthumbnail    = get_post_meta( $post->ID, reviewthumbnail, true );
								$showratings        = get_post_meta( $post->ID, showratings, true ); ?>

								<?php global $post;
								$feature_photo = get_post_meta( $post->ID, review_thumbnail, true );
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'ae', array( 'class' => 'reviewthumbnail' ) );
								} else if ( $feature_photo ) {
									?><a href="<?php the_permalink(); ?>">
									<img src="<?php echo $feature_photo; ?>" class="reviewthumbnail" style="width:60px" />
									</a><?php
								} else {
									global $wpdb;
									$attachment_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1" );
									$attachment    = wp_get_attachment_url( $attachment_id );
									if ( $attachment ) {
										?><a href="<?php the_permalink(); ?>">
										<img src="<?php echo $attachment; ?>" class="reviewthumbnail" style="width:60px" />
										</a><?php }
								} ?>

								<?php if ( $teasertitle ) { ?>
									<a href="<?php the_permalink(); ?>" class="teasertitle"><?php echo $teasertitle; ?></a><?php } else {
									the_title();
								} ?>
								<p class="teasertext"><?php echo $teaser; ?></p>
								<?php if ( $grade ) { ?>
									<p class="teasergrade">Our Rating: <?php echo $grade; ?></p><?php } ?>
								<div style="clear:both"></div>
								<div style="border-bottom:1px solid #aaaaaa;margin:15px 0px 15px 0px;"></div>
							<?php } endwhile; ?>

						<h3><a href="<?php echo cat_id_to_slug( get_theme_mod( 'ae-cat1' ) ); ?>">View All</a></h3>
					</div>
					<div class="widgetfooter"></div>
				</div>
			</div>

			<?php } ?><!--end of category and count check-->

			<?php if (( get_theme_mod( 'ae-cat2' ) == "-1" ) || ( get_theme_mod( 'ae-cat2-count' ) == "0" )) {
			} else { ?>
			<div id="homepageright" style="width:300px;margin-right:0px;">

				<div class="widgetwrap">
					<div class="titlewrap280"><h2>
							<a href="<?php echo cat_id_to_slug( get_theme_mod( 'ae-cat2' ) ); ?>"><?php echo cat_id_to_name( get_theme_mod( 'ae-cat2' ) ); ?></a>
						</h2></div>
					<div class="widgetbody">

						<?php $count = 0;
						$recent = new WP_Query( "cat=" . get_theme_mod( 'ae-cat2' ) . "&showposts=" . get_theme_mod( 'ae-cat2-count' ) );
						while ( $recent->have_posts() ) : $recent->the_post();
							if ( $post->ID != $do_not_duplicate[$post->ID] ) { ?>

								<?php $photographer = get_post_meta( $post->ID, photographer, true );
								$teasertitle        = get_post_meta( $post->ID, teasertitle, true );
								$teaser             = get_post_meta( $post->ID, teaser, true );
								$grade              = get_post_meta( $post->ID, grade, true );
								$reviewthumbnail    = get_post_meta( $post->ID, reviewthumbnail, true );
								$showratings        = get_post_meta( $post->ID, showratings, true ); ?>

								<?php global $post;
								$feature_photo = get_post_meta( $post->ID, review_thumbnail, true );
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'ae', array( 'class' => 'reviewthumbnail' ) );
								} else if ( $feature_photo ) {
									?><a href="<?php the_permalink(); ?>">
									<img src="<?php echo $feature_photo; ?>" class="reviewthumbnail" style="width:60px" />
									</a><?php
								} else {
									global $wpdb;
									$attachment_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1" );
									$attachment    = wp_get_attachment_url( $attachment_id );
									if ( $attachment ) {
										?><a href="<?php the_permalink(); ?>">
										<img src="<?php echo $attachment; ?>" class="reviewthumbnail" style="width:60px" />
										</a><?php }
								} ?>

								<?php if ( $teasertitle ) { ?>
									<a href="<?php the_permalink(); ?>" class="teasertitle"><?php echo $teasertitle; ?></a><?php } else {
									the_title();
								} ?>
								<p class="teasertext"><?php echo $teaser; ?></p>
								<?php if ( $grade ) { ?>
									<p class="teasergrade">Our Rating: <?php echo $grade; ?></p><?php } ?>
								<div style="clear:both"></div>
								<div style="border-bottom:1px solid #aaaaaa;margin:15px 0px 15px 0px;"></div>
							<?php } endwhile; ?>

						<h3><a href="<?php echo cat_id_to_slug( get_theme_mod( 'ae-cat2' ) ); ?>">View All</a></h3>
					</div>
					<div class="widgetfooter"></div>
				</div>
			</div>

			<?php } ?><!--end of category and count check-->
		</div>
		<!--end of contentleft-->

		<div id="sidebar">

			<?php if (( get_theme_mod( 'ae-cat3' ) == "-1" ) || ( get_theme_mod( 'ae-cat3-count' ) == "0" )) {
			} else { ?>
			<div style="clear:both"></div>
			<div class="widgetwrap">
				<div class="titlewrap300"><h2>
						<a href="<?php echo cat_id_to_slug( get_theme_mod( 'ae-cat3' ) ); ?>"><?php echo cat_id_to_name( get_theme_mod( 'ae-cat3' ) ); ?></a>
					</h2></div>
				<div class="widgetbody">
					<?php $count = 0;
					$recent = new WP_Query( "cat=" . get_theme_mod( 'ae-cat3' ) . "&showposts=" . get_theme_mod( 'ae-cat3-count' ) );
					while ( $recent->have_posts() ) : $recent->the_post(); ?>
						<?php if ( $count > 1 ) { ?>
							<div style="border-bottom:1px solid #aaaaaa;margin:15px 0px 19px 0px;"></div><?php } ?>
						<?php $audio = get_post_meta( $post->ID, audio, true );
						$showratings = get_post_meta( $post->ID, showratings, true );
						$teasertitle = get_post_meta( $post->ID, teasertitle, true ); ?>

						<a href="<?php the_permalink(); ?>" style="font-size:14px;line-height:30px;padding-bottom:10px;font-weight:bold"><?php if ( $teasertitle ) {
								echo $teasertitle;
							} else {
								the_title();
							} ?></a>

						<?php global $post;
						$feature_photo = get_post_meta( $post->ID, review_thumbnail, true );
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'homethumb', array( 'class' => 'reviewthumbnail' ) );
						} else if ( $feature_photo ) {
							?><a href="<?php the_permalink(); ?>">
							<img src="<?php echo $feature_photo; ?>" class="reviewthumbnail" style="width:70px" />
							</a><?php
						} else {
							global $wpdb;
							$attachment_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1" );
							$attachment    = wp_get_attachment_url( $attachment_id );
							if ( $attachment ) {
								?><a href="<?php the_permalink(); ?>">
								<img src="<?php echo $attachment; ?>" class="reviewthumbnail" style="width:70px" />
								</a><?php }
						} ?>

						<?php the_content_limit( 190 ); ?>
						<?php if ( $audio ) {
							$audioplayer = "[audio:" . $audio . "]";
							if ( function_exists( 'insert_audio_player' ) ) {
								insert_audio_player( $audioplayer );
							}
						} ?>
						<?php if ( $showratings == "Yes" ) { ?><?php if ( function_exists( 'wp_gdsr_render_article' ) ) {
							wp_gdsr_render_article( 10 );
						} ?><?php } ?>
						<div style="clear:both"></div>
						<div style="border-bottom:1px solid #aaaaaa;margin:15px 0px 15px 0px;"></div>
					<?php endwhile; ?>

					<h3><a href="<?php echo cat_id_to_slug( get_theme_mod( 'ae-cat3' ) ); ?>">View All</a></h3>

				</div>
				<div class="widgetfooter"></div>
			</div>
			<?php } ?><!--end category and count check-->

			<?php if (( get_theme_mod( 'ae-cat4' ) == "-1" ) || ( get_theme_mod( 'ae-cat4-count' ) == "0" )) {
			} else { ?>
			<div style="clear:both"></div>
			<div class="widgetwrap">
				<div class="titlewrap300"><h2>
						<a href="<?php echo cat_id_to_slug( get_theme_mod( 'ae-cat4' ) ); ?>"><?php echo cat_id_to_name( get_theme_mod( 'ae-cat4' ) ); ?></a>
					</h2></div>
				<div class="widgetbody">

					<?php $count = 0;
					$recent = new WP_Query( "cat=" . get_theme_mod( 'ae-cat4' ) . "&showposts=" . get_theme_mod( 'ae-cat4-count' ) );
					while ( $recent->have_posts() ) : $recent->the_post();
						if ( $post->ID != $do_not_duplicate[$post->ID] ) { ?>

							<?php $photographer = get_post_meta( $post->ID, photographer, true );
							$teasertitle        = get_post_meta( $post->ID, teasertitle, true );
							$teaser             = get_post_meta( $post->ID, teaser, true );
							$grade              = get_post_meta( $post->ID, grade, true );
							$showratings        = get_post_meta( $post->ID, showratings, true ); ?>

							<?php global $post;
							$feature_photo = get_post_meta( $post->ID, review_thumbnail, true );
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'ae', array( 'class' => 'reviewthumbnail' ) );
							} else if ( $feature_photo ) {
								?><a href="<?php the_permalink(); ?>">
								<img src="<?php echo $feature_photo; ?>" class="reviewthumbnail" style="width:60px" />
								</a><?php
							} else {
								global $wpdb;
								$attachment_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1" );
								$attachment    = wp_get_attachment_url( $attachment_id );
								if ( $attachment ) {
									?><a href="<?php the_permalink(); ?>">
									<img src="<?php echo $attachment; ?>" class="reviewthumbnail" style="width:60px" />
									</a><?php }
							} ?>

							<?php if ( $teasertitle ) { ?>
								<a href="<?php the_permalink(); ?>" class="teasertitle"><?php echo $teasertitle; ?></a><?php } else {
								the_title();
							} ?>
							<p class="teasertext"><?php echo $teaser; ?></p>
							<?php if ( $grade ) { ?>
								<p class="teasergrade">Our Rating: <?php echo $grade; ?></p><?php } ?>
							<div style="clear:both"></div>
							<div style="border-bottom:1px solid #aaaaaa;margin:15px 0px 15px 0px;"></div>
						<?php } endwhile; ?>
					<h3><a href="<?php echo cat_id_to_slug( get_theme_mod( 'ae-cat4' ) ); ?>">View All</a></h3>
				</div>
				<div class="widgetfooter"></div>
			</div>

			<?php } ?><!--end of category and count check-->

		</div>

	</div>

	<!-- The main column ends  -->

	<?php get_footer(); ?>
<?php } else { ?>
	<div id="content">

		<div id="contentleft">
			The A&E Section Page Add-On feature can be added to your site by filling out this
			<a href="http://www.schoolnewspapersonline.com/add-on-features/addons-upgrades/">order form</a>.
		</div>
	</div>

	<?php get_footer(); ?>

<? } ?>