<?php get_header(); ?>

           <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
           <?php $teamschedulecheck = get_post_meta($post->ID, opponent, true); $staffposition = get_post_meta($post->ID, name, true); ?>
           <?php endwhile; else: ?>
           
           <?php endif; ?>

<?php if ($staffposition) { include(TEMPLATEPATH."/staff.php"); } else { ?>
<?php if ($teamschedulecheck) { include(TEMPLATEPATH."/teamschedule.php"); } else { ?>


<div id="content">

   <div id="contentleft">
   
       <div class="postarea">
       

       <?php include(TEMPLATEPATH."/breadcrumb.php");?>

           <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php $photographer = get_post_meta($post->ID, photographer, true); $teasertitle = get_post_meta($post->ID, teasertitle, true); $teaser = get_post_meta($post->ID, teaser, true); $grade = get_post_meta($post->ID, grade, true); $reviewthumbnail = get_post_meta($post->ID, reviewthumbnail, true); $showratings = get_post_meta($post->ID, showratings, true); $audio = get_post_meta($post->ID, audio, true); $photographer = get_post_meta($post->ID, photographer, true); $caption = get_post_meta($post->ID, caption, true); $video = get_post_meta($post->ID, video, true); $trailer = get_post_meta($post->ID, trailer, true); $slideshow = get_post_meta($post->ID, slideshow, true); $gallery = get_post_meta($post->ID, gallery, true); $soundslidescredit = get_post_meta($post->ID, soundslidescredit, true); $soundslides = get_post_meta($post->ID, soundslides, true); $slideshowcredit = get_post_meta($post->ID, slideshowcredit, true); $jobtitle = get_post_meta($post->ID, jobtitle, true); $writer = get_post_meta($post->ID, writer, true); $related = get_post_meta($post->ID, related, true); $videographer = get_post_meta($post->ID, videographer, true); ?>
                            <?php $slideshowwidth = get_theme_mod('mm-width'); $slideshowheight = get_theme_mod('mm-height'); $sswidth = $slideshowwidth; $ssheight = $slideshowheight; $sswidthgallery = $sswidth; $ssheightgallery = $ssheight - 50; $videowidth = get_theme_mod('mm-width'); $videoheight = get_theme_mod('mm-height'); $videoheight -= 50;  ?>

		<?php $mmcheck = get_option('msno'); if (($mmcheck == "msno402841m") && (get_theme_mod('mm-display')=="Above Story")) { ?>
			<?php if ($video) { ?>
				<?php $pattern = "/height=\"[0-9]*\"/"; $video1 = preg_replace($pattern, "height='400'", $video); $pattern = "/width=\"[0-9]*\"/"; $video1 = preg_replace($pattern, "width='590'", $video1); ?>
				<div style="margin-bottom:15px">
				<?php echo $video1; ?>
					<?php if ($videographer) { ?><p class="photocredit" style="padding-bottom:0px">Video Credit: <?php echo $videographer; ?></p><?php } ?>
				</div> 
			<?php } ?>
		<?php } ?>	
			
           <h1 style="line-height:40px"><?php the_title(); ?></h1>

                   <div id="permalinkphotobox">

                       <?php if ($teasertitle) { ?>
                        	<?php if ($trailer) { $pattern = "/height=\"[0-9]*\"/"; $trailer = preg_replace($pattern, "height='250'", $trailer); $pattern = "/width=\"[0-9]*\"/"; $trailer = preg_replace($pattern, "width='300'", $trailer); echo $trailer; ?><div style="margin-bottom:15px"></div><?php } ?>


                          <div id="teaserbox" style="float:right;background:none;">

                             <a href="<?php the_permalink(); ?>" class="teasertitle"><?php echo $teasertitle; ?></a>
                             <?php if ($teaser) { ?><p class="teasertext"><?php echo $teaser; ?></p><?php } ?>
                             <?php if ($grade) { ?><p class="teasergrade">Our Rating: <?php echo $grade; ?></p><?php } ?>
            				<?php if ($audio) { $audioplayer = "[audio: " . $audio . "]"; if (function_exists('insert_audio_player')) { insert_audio_player($audioplayer); }} ?>
                           </div>

<?php if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'permalink', array('class' => 'permalinkimage')); } ?>


                                    <?php if ($photographer) { ?><p class="photocredit">Photo Credit: <?php echo $photographer; ?></p><?php } ?>
                                    <?php if ($caption) { ?><p class="photocaption"><?php echo $caption; ?></p><?php } else { ?><p style="font-size:1px">.</p><?php } ?>


                             <?php if ($showratings=="Yes") { ?><div class="ratingsbox"><p class="teasertitle">What's Your Rating of <?php echo $teasertitle; ?>?</p><?php if (function_exists('wp_gdsr_render_article')) { wp_gdsr_render_article(10); } ?></div><?php } ?>

                       <?php } else { ?>


                        <?php if ($audio) { $audioplayer = "[audio:" . $audio . "]"; if (function_exists('insert_audio_player')) { insert_audio_player($audioplayer); } ?><div style="margin-bottom:15px"></div><?php } ?>

                <?php if (($mmcheck == "msno402841m") && (get_theme_mod('mm-display')=="Overlay")) { ?>

                          <?php if ($video) { ?>
                      <?php $mediacount++; ?>
                <div class="videoplay2"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox" style="font-size:22px;line-height:30px;">Watch Video</a></div><div style="clear:both"></div>

                       <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                           <?php if ($video) { $pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "height=' " . $videoheight . " '", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "width=' " . $videowidth . " '", $video); echo $video; } ?>
                           <?php $videographer = get_post_meta($post->ID, videographer, true); if ($videographer) { ?><div class="mmdivider"><p class="photographer">Video Credit: <?php echo $videographer; ?></p></div><?php } ?>
                       </div>
         <?php } ?>

          <?php if ($slideshow) { $mediacount++; ?>


                <div class="videoplay2"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox" style="font-size:22px;line-height:30px;">Watch Slideshow</a></div><div style="clear:both"></div>
                       <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                     <?php if ($slideshow) { $showalbum = "[slideshow id =" . $slideshow . " w=" . $sswidthgallery . " h=" . $ssheightgallery ."]"; echo do_shortcode($showalbum); ?><div style="margin-bottom:15px"></div><?php } ?>
                     <?php $slideshowcredit = get_post_meta($post->ID, slideshowcredit, true); if ($slideshowcredit) { ?><div class="mmdivider"><p class="photographer">Slideshow Credit: <?php echo $slideshowcredit; ?></p></div><?php } ?>
                       </div>
          <?php } ?>

          <?php if ($soundslides) { ?>
                      <?php $mediacount++; ?>
                <div class="videoplay2"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox" style="font-size:22px;line-height:30px;">Watch Slideshow</a></div><div style="clear:both"></div>
                       <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                           <?php if ($soundslides) { $pattern = "/height=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "height=' " . $videoheight . " '", $soundslides); $pattern = "/width=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "width=' " . $videowidth . " '", $soundslides); echo $soundslides; } ?>
                           <?php $soundslidecredit = get_post_meta($post->ID, soundslidescredit, true); if ($soundslidescredit) { ?><div class="mmdivider"><p class="photographer">Slideshow Credit: <?php echo $soundslidescredit; ?></p></div><?php } ?>
                       </div>
         <?php } ?>
                
                
                
                
            	<?php } ?><!--end of mm overlay-->
                
		<?php if (($mmcheck != "msno402841m") || (get_theme_mod('mm-display')=="Beside Story")) { ?>
                        
                        <?php if ($video) { $pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "height='250'", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "width='300'", $video); echo $video; } ?>
                       <?php if ($videographer) { ?><p class="photocredit">Video Credit: <?php echo $videographer; ?></p><?php } ?>
                                                
         <?php } ?>
                        
                        <?php if ($slideshow) { $showalbum = "[slideshow id =" . $slideshow . " w=302 h=200]"; echo do_shortcode($showalbum); ?><div style="margin-bottom:15px"></div><?php } ?>
                        
                        <?php if ($gallery) { $showalbum = "[nggallery id =" . $gallery . " w=50 h=50]"; echo do_shortcode($showalbum); ?><?php } ?>

                       <?php if ($slideshowcredit) { ?><p class="photocredit">Credit Credit: <?php echo $slideshowcredit; ?></p><?php } ?>

<?php if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'permalink', array('class' => 'permalinkimage')); } ?>

                              <?php if ($photographer) { ?><p class="photocredit">Photo Credit: <?php echo $photographer; ?></p><?php } ?>
                              <?php if ($caption) { ?><p class="photocaption"><?php echo $caption; ?></p><?php } ?>
                         <?php } ?>


                       <?php $related = get_post_meta($post->ID, related, true); if ($related != "No") { ?>
                             <div style="clear:both;margin-bottom:15px;"></div>						
                             			<div class="widgetwrap">

<?php /* COMMENTED OUT RELATED CONTENT WITHIN STORY TEXT

<div class="titlewrap280"><h2>Related Content</h2></div>

                             <div id="permalinksidebar">
                                  <?php if (function_exists('ddop_show_posts') ) { echo ddop_show_posts(); } ?>
                                  <h3>Other stories that might interest you...</h3>
                                  <?php if ( function_exists('similar_posts')) { similar_posts (); } ?>

                             </div>

*/ ?>

<div class="widgetfooter"></div></div>
                        <?php } ?>   
                   </div>


                    <p><?php snowriter(); ?><?php the_time('F j, Y'); ?>  <?php edit_post_link('(Edit)', '', ''); ?> <br /> Filed under <?php the_category(', ') ?></p>

            <?php the_content(__('Read more'));?><div style="clear:both;"></div>
            <div class="postmeta">
                <?php the_tags('<p><span class="tags">Tags: ', ', ', '</span></p>'); ?> 
            </div>
  

           <?php endwhile; else: ?>
           
           <p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
           
       </div>

   		<div style="clear:both;"></div>
   		
   		<?php if (get_theme_mod('comments')=="Enable") { ?>
   		
           <div class="widgetwrap"><div class="titlewrap610"><h2>Comments</h2></div>
       <div class="widgetbody">
			<?php $commentspolicy = get_theme_mod('comments-policy'); if ($commentspolicy) echo '<p>'.$commentspolicy.'</p>'; ?>

           	<?php comments_template(); // Get wp-comments.php template ?>
           
       </div><div class="widgetfooter"></div></div>
       
       <?php } ?>
       
   </div>



   
<?php include(TEMPLATEPATH."/sidebar.php");?>
       


</div>

<!-- The main column ends  -->

<?php }} ?><!--end of else from sports schedule check and staff check at top-->

<?php get_footer(); ?>