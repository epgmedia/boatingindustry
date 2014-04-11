	
<?php $loopcounter=0; $sportscount = get_theme_mod('sports-count'); if ($sportscount == '') { $sportscount = 4; } ?>
<div id="homepagetopsports">
                    <div id="slider">
                    
<div id="slideshow">
                            <?php $count=0;?>
                    <?php query_posts('showposts='.$sportscount.'&cat='.get_theme_mod('sports-scrollbox-cat')); ?>
                    

                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<div class="cycle">
		
			<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'topstories', array('class' => 'sliderimage'));  } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="sliderimage" style="width:608px;" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="sliderimage" style="width:608px;" /></a><?php } } ?>
			
					
		<?php if (get_theme_mod('sports-scroll-teaser') == "Show") { ?>	
			<div class="sportsdesc">
				<h3><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
			</div>
		<?php } ?>		
			
		</div>

                    <?php endwhile; else: ?>
                    <?php endif; ?>
                            
                        
                    </div> <!-- end slideshow -->

<div id="slideshow_navigationsports"><div id="pager"></div></div>

			</div>	
			</div>