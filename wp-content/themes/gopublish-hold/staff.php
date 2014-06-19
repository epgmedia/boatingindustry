<?php $name = get_post_meta($post->ID, name, true); $staffposition = get_post_meta($post->ID, staffposition, true); ?>

<div id="content">




<div id="sidebar">


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="titlewrap300"><h2>Staff Profile</h2></div><div class="widgetbody">

<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'permalink', array('class' => 'staffimage')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="staffimage" style="width:300px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="staffimage" style="width:300px" /></a><?php } } ?>



		<h1 style="font-weight: bold; margin-bottom:5px;font-size:14px"><?php echo $name; ?><?php if ($staffposition) { ?> –– <?php echo $staffposition; } ?></h1>

		<?php the_content();?><div style="clear:both"></div>

</div><div class="widgetfooter"></div>
		<?php endwhile; else: ?>
		<?php endif; ?>

	

<?php
 $querystr = "
SELECT * FROM $wpdb->posts
JOIN $wpdb->postmeta AS photographer ON(
$wpdb->posts.ID = photographer.post_id
AND photographer.meta_key = 'photographer'
AND photographer.meta_value = '$name'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY post_date DESC
";

 $pageposts = $wpdb->get_results($querystr, OBJECT);

?><?php $count = 0; $exitkey=0; ?>
 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

      <?php $count++; if ($count==1) { ?><div class="clear:both"></div><div class="titlewrap300"><h2>Photos by <?php echo $name; ?></h2></div><div class="widgetbody"><?php $exitkey=1; ?> <?php } ?>

      <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>


  <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>

<?php if ($exitkey==1) { ?></div><div class="widgetfooter"></div><?php $exitkey=0; } ?>

<?php
 $querystr = "
SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->postmeta AS slideshowcredit ON(
$wpdb->posts.ID = slideshowcredit.post_id
AND slideshowcredit.meta_key = 'slideshowcredit'
AND slideshowcredit.meta_value = '$name'
)
LEFT JOIN $wpdb->postmeta AS soundslidescredit ON(
$wpdb->posts.ID = soundslidescredit.post_id
AND soundslidescredit.meta_key = 'soundslidescredit'
AND soundslidescredit.meta_value = '$name'
)
AND $wpdb->posts.post_status = 'publish'
HAVING soundslidescredit.meta_value != ''
OR slideshowcredit.meta_value != ''
ORDER BY post_date DESC
";

 $pageposts = $wpdb->get_results($querystr, OBJECT);

?><?php $count = 0; ?>
 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

      <?php $count++; if ($count==1) { ?><div class="clear:both"></div><div class="titlewrap300"><h2>Slideshows by <?php echo $name; ?></h2></div><div class="widgetbody"><?php $exitkey=1; ?> <?php } ?>

      <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>


  <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>

<?php if ($exitkey==1) { ?></div><div class="widgetfooter"></div><?php $exitkey=0; } ?>


<?php
 $querystr = "
SELECT * FROM $wpdb->posts
JOIN $wpdb->postmeta AS videographer ON(
$wpdb->posts.ID = videographer.post_id
AND videographer.meta_key = 'videographer'
AND videographer.meta_value = '$name'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY post_date DESC
";

 $pageposts = $wpdb->get_results($querystr, OBJECT);

?><?php $count = 0; ?>
 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

      <?php $count++; if ($count==1) { ?><div class="clear:both"></div><div class="titlewrap300"><h2>Videos by <?php echo $name; ?></h2></div><div class="widgetbody"><?php $exitkey=1; ?> <?php } ?>

      <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>


  <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>

<?php if ($exitkey==1) { ?></div><div class="widgetfooter"></div><?php $exitkey=0; } ?>

</div><!--end sidebar-->


	<div id="contentleft">
	
			

        <div class="postarea">
<div class="breadcrumb">Browse: Home / Staff / Stories Written by <?php echo $name; ?></div>


<?php
 $querystr = "
SELECT * FROM $wpdb->posts
JOIN $wpdb->postmeta AS writer ON(
$wpdb->posts.ID = writer.post_id
AND writer.meta_key = 'writer'
AND writer.meta_value = '$name'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY post_date DESC
";

 $pageposts = $wpdb->get_results($querystr, OBJECT);

?>
<?php $mediacount=0; ?>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>


            <?php $photographer = get_post_meta($post->ID, photographer, true); $teasertitle = get_post_meta($post->ID, teasertitle, true); $teaser = get_post_meta($post->ID, teaser, true); $grade = get_post_meta($post->ID, grade, true); $reviewthumbnail = get_post_meta($post->ID, reviewthumbnail, true); $showratings = get_post_meta($post->ID, showratings, true); $feature_photo = get_post_meta($post->ID, feature_photo, true); $audio = get_post_meta($post->ID, audio, true); $caption = get_post_meta($post->ID, caption, true); $video = get_post_meta($post->ID, video, true); $trailer = get_post_meta($post->ID, trailer, true); $soundslides = get_post_meta($post->ID, soundslides, true); $soundslidescredit = get_post_meta($post->ID, soundslidescredit, true); $slideshow = get_post_meta($post->ID, slideshow, true); $slideshowcredit = get_post_meta($post->ID, slideshowcredit, true); $videographer = get_post_meta($post->ID, videographer, true); ?>
<?php $slideshowwidth = get_theme_mod('mm-width'); $slideshowheight = get_theme_mod('mm-height'); $sswidth = (int)$slideshowwidth; $ssheight = (int)$slideshowheight;  $sswidthgallery = $sswidth; $ssheightgallery = $ssheight - 50; ?>

                       <?php if ($teasertitle) { ?>
                          <div id="teaserbox" style="float:right;margin-left:10px">

<?php global $post; $feature_photo = get_post_meta($post->ID, review_thumbnail, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'ae', array('class' => 'reviewthumbnail')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="reviewthumbnail" style="width:60px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="reviewthumbnail" style="width:60px" /></a><?php } } ?>

                             <?php if ($teasertitle) { ?><a href="<?php the_permalink(); ?>" class="teasertitle"><?php echo $teasertitle; ?></a><?php } else { the_title(); } ?>
                             <p class="teasertext"><?php echo $teaser; ?></p>
                             <?php if ($grade) { ?><p class="teasergrade">Our Rating: <?php echo $grade; ?></p><?php } ?>
                             <?php if ($audio) { ?><div style="clear:both;margin-bottom:15px;"></div><?php $audioplayer = "[audio:" . $audio . "]"; $audioplayer = apply_filters('the_content', $audioplayer ); echo $audioplayer; } ?>
                           </div>
                       <?php } else { ?>

<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'archive', array('class' => 'categoryimage')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="categoryimage" style="width:200px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="categoryimage" style="width:200px" /></a><?php } } ?>

                       <?php } ?>

                <h1 style="margin-bottom:10px; font-size:20px; font-weight:normal"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                   <p style="padding-bottom: 8px"><?php snowriter(); ?><?php the_time('F j, Y'); ?> &nbsp;<?php edit_post_link('(Edit Story)', '', ''); ?></p>

		<?php the_content_limit(290, "Read More");?><div style="clear:both"></div>


			<div class="postmeta2">
                <?php the_tags('<p><span class="tags">Tags: ', ', ', '</span></p>'); ?> 
			</div>

  <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>
        </div> <!-- end postarea -->


		
		</div> <!--content - do not edit below-->
		
	</div>
	
