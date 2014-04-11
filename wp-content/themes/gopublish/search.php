<?php get_header(); ?>

<div id="content">

	<div id="contentleft">
	
		<div class="postarea">
	
		<?php include(TEMPLATEPATH."/breadcrumb.php");  $mediacount=0; ?>
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>

                       <?php $photographer = get_post_meta($post->ID, photographer, true); $teasertitle = get_post_meta($post->ID, teasertitle, true); $teaser = get_post_meta($post->ID, teaser, true); $grade = get_post_meta($post->ID, grade, true); $reviewthumbnail = get_post_meta($post->ID, reviewthumbnail, true); $showratings = get_post_meta($post->ID, showratings, true); $audio = get_post_meta($post->ID, audio, true); $video = get_post_meta($post->ID, video, true);?>
                       <?php if ($teasertitle) { ?>
                          <div id="teaserbox" style="float:right">

<?php global $post; $feature_photo = get_post_meta($post->ID, review_thumbnail, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'ae', array('class' => 'reviewthumbnail')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="reviewthumbnail" style="width:60px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="reviewthumbnail" style="width:60px" /></a><?php } } ?>

                             <?php if ($teasertitle) { ?><a href="<?php the_permalink(); ?>" class="teasertitle"><?php echo $teasertitle; ?></a><?php } else { the_title(); } ?>
                             <p class="teasertext"><?php echo $teaser; ?></p>
                             <?php if ($grade) { ?><p class="teasergrade">Our Rating: <?php echo $grade; ?></p><?php } ?>
                             <?php if ($audio) { ?><div style="clear:both;margin-bottom:15px;"></div><?php $audioplayer = "[audio:" . $audio . "]"; if (function_exists('insert_audio_player')) { insert_audio_player($audioplayer); } } ?>
                           </div>
                       <?php } else { ?>

<?php if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'archive', array('class' => 'categoryimage'));} ?>

				<?php if ($video) { $pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "height='150'", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "width='200'", $video); ?><div style="float:right;width:200px;margin-bottom:15px;margin-left:10px"><?php echo $video; ?></div><?php } ?>
                <?php if ($audio) { ?><div style="width:300px;"><?php $audioplayer = "[audio:" . $audio . "]"; if (function_exists('insert_audio_player')) { insert_audio_player($audioplayer); } echo '</div>'; } ?>


                       <?php } ?>
<p><?php snowriter(); ?><?php the_time('F j, Y'); ?><?php edit_post_link('(Edit)', ' &bull; ', ''); ?> <br /> Filed under <?php the_category(', ') ?></p> 

			<?php the_content_limit(300, "Read more &raquo;"); ?><div style="clear:both;"></div>
			
			<div class="postmeta2">
				<p><span class="tags">Tags: <?php the_tags('') ?></span></p>
			</div>
			
			<?php endwhile; else: ?>
			
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
			<p><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>
			
		</div>
				
	</div>
	
<?php include(TEMPLATEPATH."/sidebar.php");?>
		
</div>

<!-- The main column ends  -->

<?php get_footer(); ?>