<?php
/*
Template Name: Multimedia
*/
?>

<?php get_header(); ?>
<?php $mmcheck = get_option('msno'); if ($mmcheck == "msno402841m") { ?>

<div id="content">

	<div id="contentleft">
	
		<div class="postarea" style="margin-bottom:10px;">
	
<?php $slideshowwidth = get_theme_mod('mm-width'); $slideshowheight = get_theme_mod('mm-height'); $sswidth = (int)$slideshowwidth; $ssheight = (int)$slideshowheight;  $sswidthgallery = $sswidth; $ssheightgallery = $ssheight - 50; $videowidth = get_theme_mod('mm-width'); $videoheight = get_theme_mod('mm-height'); $videoheight -= 50; ?>

<div class="scrollheading" style="border-bottom:1px solid #aaaaaa;margin-bottom:8px;">Featured Multimedia Presentation</div>

                <?php $recent = new WP_Query("cat=".get_theme_mod('mm-featured')."&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>	
		<a style="font-size:20px;line-height:40px;padding-bottom:10px;font-weight:bold" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
                    <?php $slideshow = get_post_meta($post->ID, slideshow, true); if ($slideshow) { $showalbum = "[slideshow id =" . $slideshow . " w=590 h=400]"; echo do_shortcode($showalbum); ?><div style="margin-bottom:5px"></div>
                     <?php $slideshowcredit = get_post_meta($post->ID, slideshowcredit, true); if ($slideshowcredit) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $slideshowcredit; ?></p></div><?php } ?>
                     <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>

                    <?php } else if (get_post_meta($post->ID, soundslides, true)) { ?>

                        <?php $soundslides = get_post_meta($post->ID, soundslides, true); if ($soundslides) { $pattern = "/height=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "height='400'", $soundslides); $pattern = "/width=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "width='590'", $soundslides); echo $soundslides; } ?>

                            <?php $soundslidescredit = get_post_meta($post->ID, soundslidescredit, true); if ($soundslidescredit) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $soundslidescredit; ?></p></div><?php } ?>
                            <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>

                    <?php } else { ?><!--end soundslides section-->

                           <?php $video = get_post_meta($post->ID, video, true); if ($video) { $pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "height=400", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "width='590'", $video); echo $video; } ?>
                           <?php $videographer = get_post_meta($post->ID, videographer, true); if ($videographer) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $videographer; ?></p></div><?php } ?>
                           <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                         <?php } ?><!--end video section-->
<?php  ?>

                <?php endwhile; ?>
		</div>
		
	
<?php if ((get_theme_mod('mm-cat1') == -1) || (get_theme_mod('mm-cat1-count') == 0)) { } else { ?>
<div id="homepageleft" style="float:left;width:300px;margin-right:10px;">

       		<div style="clear:both"></div><div class="widgetwrap"><div class="titlewrap280"><h2><a href="<?php echo cat_id_to_slug(get_theme_mod('mm-cat1')); ?>"><?php echo cat_id_to_name(get_theme_mod('mm-cat1')); ?></a></h2></div>
<div class="widgetbody">


<?php $count = 0; $catvariable = get_theme_mod('mm-cat1'); $limitvariable = get_theme_mod('mm-cat1-count'); ?>
<?php
 $querystr = "
SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->postmeta AS video ON(
$wpdb->posts.ID = video.post_id
AND video.meta_key = 'video'
)
LEFT JOIN $wpdb->postmeta AS slideshow ON(
$wpdb->posts.ID = slideshow.post_id
AND slideshow.meta_key = 'slideshow'
)
LEFT JOIN $wpdb->postmeta AS soundslides ON(
$wpdb->posts.ID = soundslides.post_id
AND soundslides.meta_key = 'soundslides'
)
LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->term_taxonomy.term_id = $catvariable
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->posts.post_status = 'publish'
HAVING video.meta_value != ''
OR slideshow.meta_value != ''
OR soundslides.meta_value != ''
ORDER BY post_date DESC LIMIT $limitvariable
    ";
 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>

<?php $count=0;?>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?><?php $count++; ?>

         <?php $video = get_post_meta($post->ID, video, true); $slideshow = get_post_meta($post->ID, slideshow, true); $soundslides = get_post_meta($post->ID, soundslides, true); ?>

          <?php if ($video) { ?>
                      <?php $mediacount++; ?>
                      
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>
                      
                      <p><?php the_time('F j, Y') ?></p>
                      <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                      <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                           <?php $video = get_post_meta($post->ID, video, true); if ($video) { $pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "height=' " . $videoheight . " '", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "width=' " . $videowidth . " '", $video); echo $video; } ?>

                           <?php $videographer = get_post_meta($post->ID, videographer, true); if ($videographer) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $videographer; ?></p></div><?php } ?>
                           <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

          <?php if ($soundslides) { ?>
                      <?php $mediacount++; ?>
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>
                      <p><?php the_time('F j, Y') ?></p>
                      <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                       <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                           <?php if ($soundslides) { $pattern = "/height=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "height=' " . $videoheight . " '", $soundslides); $pattern = "/width=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "width=' " . $videowidth . " '", $soundslides); echo $soundslides; } ?>
                            <?php $soundslidescredit = get_post_meta($post->ID, soundslidescredit, true); if ($soundslidescredit) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $soundslidescredit; ?></p></div><?php } ?>
                            <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

          <?php if ($slideshow) { ?>
                <?php $mediacount++; ?>
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>
                <p><?php the_time('F j, Y') ?></p>
                <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                     <?php $slideshow = get_post_meta($post->ID, slideshow, true); ?>
                     <?php if ($slideshow) { $showalbum = "[slideshow id =" . $slideshow . " w=" . $sswidthgallery . " h=" . $ssheightgallery ."]"; echo do_shortcode($showalbum); ?><div style="margin-bottom:5px"></div><?php } ?>
                     <?php $slideshowcredit = get_post_meta($post->ID, slideshowcredit, true); if ($slideshowcredit) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $slideshowcredit; ?></p></div><?php } ?>
                     <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>

                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

      <div style="clear:both"></div>

   <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>
                <h3><a href="<?php echo cat_id_to_slug(get_theme_mod('mm-cat1')); ?>">View All</a></h3>
                </div><div class="widgetfooter"></div></div>
                </div>
<?php } ?>

<!--end of first bottom section-->
<!--start of second bottom section-->

<?php if ((get_theme_mod('mm-cat2') == -1) || (get_theme_mod('mm-cat2-count') == 0)) { } else { ?>

<div id="homepageright" style="float:left;width:300px;margin-right:0px">

       		<div style="clear:both"></div><div class="widgetwrap"><div class="titlewrap280"><h2><a href="<?php echo cat_id_to_slug(get_theme_mod('mm-cat2')); ?>"><?php echo cat_id_to_name(get_theme_mod('mm-cat2')); ?></a></h2></div>

		<div class="widgetbody">

<?php $count = 0; $catvariable = get_theme_mod('mm-cat2'); $limitvariable = get_theme_mod('mm-cat2-count'); ?>
<?php
 $querystr = "
SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->postmeta AS video ON(
$wpdb->posts.ID = video.post_id
AND video.meta_key = 'video'
)
LEFT JOIN $wpdb->postmeta AS slideshow ON(
$wpdb->posts.ID = slideshow.post_id
AND slideshow.meta_key = 'slideshow'
)
LEFT JOIN $wpdb->postmeta AS soundslides ON(
$wpdb->posts.ID = soundslides.post_id
AND soundslides.meta_key = 'soundslides'
)
LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->term_taxonomy.term_id = $catvariable
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->posts.post_status = 'publish'
HAVING video.meta_value != ''
OR slideshow.meta_value != ''
OR soundslides.meta_value != ''
ORDER BY post_date DESC LIMIT $limitvariable
    ";
 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>

<?php $count=0;?>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?><?php $count++; ?>

         <?php $video = get_post_meta($post->ID, video, true); $slideshow = get_post_meta($post->ID, slideshow, true); $soundslides = get_post_meta($post->ID, soundslides, true); ?>

          <?php if ($video) { ?>
                      <?php $mediacount++; ?>
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>

                      <p><?php the_time('F j, Y') ?></p>
                      <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                      <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                           <?php if ($video) { $pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "height=' " . $videoheight . " '", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "width=' " . $videowidth . " '", $video); echo $video; } ?>
                           <?php $videographer = get_post_meta($post->ID, videographer, true); if ($videographer) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $videographer; ?></p></div><?php } ?>
                           <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                         
                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

          <?php if ($soundslides) { ?>
                      <?php $mediacount++; ?>
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>

                      <p><?php the_time('F j, Y') ?></p>
                      <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                       <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                           <?php if ($soundslides) { $pattern = "/height=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "height=' " . $videoheight . " '", $soundslides); $pattern = "/width=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "width=' " . $videowidth . " '", $soundslides); echo $soundslides; } ?>
                            <?php $soundslidescredit = get_post_meta($post->ID, soundslidescredit, true); if ($soundslidescredit) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $soundslidescredit; ?></p></div><?php } ?>
                            <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

          <?php if ($slideshow) { ?>
                <?php $mediacount++; ?>
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>

                <p><?php the_time('F j, Y') ?></p>
                <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                     <?php $slideshow = get_post_meta($post->ID, slideshow, true); ?>
                     <?php if ($slideshow) { $showalbum = "[slideshow id =" . $slideshow . " w=" . $sswidthgallery . " h=" . $ssheightgallery ."]"; echo do_shortcode($showalbum); ?><div style="margin-bottom:5px"></div><?php } ?>
                     <?php $slideshowcredit = get_post_meta($post->ID, slideshowcredit, true); if ($slideshowcredit) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $slideshowcredit; ?></p></div><?php } ?>
                     <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

      <div style="clear:both"></div>

   <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>
                <h3><a href="<?php echo cat_id_to_slug(get_theme_mod('mm-cat2')); ?>">View All</a></h3>
                </div><div class="widgetfooter"></div></div>
                </div>

<?php } ?>

	</div><!--end of contentleft-->

<div id="sidebar">

<?php if ((get_theme_mod('mm-cat3') == -1) || (get_theme_mod('mm-cat3-count') == 0)) { } else {  ?>

       		<div style="clear:both"></div><div class="widgetwrap"><div class="titlewrap300"><h2><a href="<?php echo cat_id_to_slug(get_theme_mod('mm-cat3')); ?>"><?php echo cat_id_to_name(get_theme_mod('mm-cat3')); ?></a></h2></div>

		<div class="widgetbody">

<?php $count = 0; $catvariable = get_theme_mod('mm-cat3'); $limitvariable = get_theme_mod('mm-cat3-count'); ?>
<?php
 $querystr = "
SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->postmeta AS video ON(
$wpdb->posts.ID = video.post_id
AND video.meta_key = 'video'
)
LEFT JOIN $wpdb->postmeta AS slideshow ON(
$wpdb->posts.ID = slideshow.post_id
AND slideshow.meta_key = 'slideshow'
)
LEFT JOIN $wpdb->postmeta AS soundslides ON(
$wpdb->posts.ID = soundslides.post_id
AND soundslides.meta_key = 'soundslides'
)
LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->term_taxonomy.term_id = $catvariable
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->posts.post_status = 'publish'
HAVING video.meta_value != ''
OR slideshow.meta_value != ''
OR soundslides.meta_value != ''
ORDER BY post_date DESC LIMIT $limitvariable
    ";
 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>

<?php $count=0;?>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?><?php $count++; ?>

         <?php $video = get_post_meta($post->ID, video, true); $slideshow = get_post_meta($post->ID, slideshow, true); $soundslides = get_post_meta($post->ID, soundslides, true); ?>

          <?php if ($video) { ?>
                      <?php $mediacount++; ?>
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>

                      <p><?php the_time('F j, Y') ?></p>
                      <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                      <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                           <?php if ($video) { $pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "height=' " . $videoheight . " '", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "width=' " . $videowidth . " '", $video); echo $video; } ?>
                           <?php $videographer = get_post_meta($post->ID, videographer, true); if ($videographer) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $videographer; ?></p></div><?php } ?>
                           <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

          <?php if ($soundslides) { ?>
                      <?php $mediacount++; ?>
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>

                      <p><?php the_time('F j, Y') ?></p>
                      <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                       <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                           <?php if ($soundslides) { $pattern = "/height=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "height=' " . $videoheight . " '", $soundslides); $pattern = "/width=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "width=' " . $videowidth . " '", $soundslides); echo $soundslides; } ?>
                            <?php $soundslidescredit = get_post_meta($post->ID, soundslidescredit, true); if ($soundslidescredit) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $soundslidescredit; ?></p></div><?php } ?>
                            <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

          <?php if ($slideshow) { ?>
                <?php $mediacount++; ?>
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>

                <p><?php the_time('F j, Y') ?></p>
                <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                     <?php $slideshow = get_post_meta($post->ID, slideshow, true); ?>
                     <?php if ($slideshow) { $showalbum = "[slideshow id =" . $slideshow . " w=" . $sswidthgallery . " h=" . $ssheightgallery ."]"; echo do_shortcode($showalbum); ?><div style="margin-bottom:5px"></div><?php } ?>
                     <?php $slideshowcredit = get_post_meta($post->ID, slideshowcredit, true); if ($slideshowcredit) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $slideshowcredit; ?></p></div><?php } ?>
                     <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

      <div style="clear:both"></div>

   <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>
                <h3><a href="<?php echo cat_id_to_slug(get_theme_mod('mm-cat3')); ?>">View All</a></h3>
                </div><div class="widgetfooter"></div></div>

<?php } ?>
<!--end of top right section-->
<!--start of bottom right section-->

<?php if ((get_theme_mod('mm-cat4') == -1) || (get_theme_mod('mm-cat4-count') == 0)) { } else { ?>

       		<div style="clear:both"></div><div class="widgetwrap"><div class="titlewrap300"><h2><a href="<?php echo cat_id_to_slug(get_theme_mod('mm-cat4')); ?>"><?php echo cat_id_to_name(get_theme_mod('mm-cat4')); ?></a></h2></div>

		<div class="widgetbody">

<?php $count = 0; $catvariable = get_theme_mod('mm-cat4'); $limitvariable = get_theme_mod('mm-cat4-count'); ?>
<?php
 $querystr = "
SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->postmeta AS video ON(
$wpdb->posts.ID = video.post_id
AND video.meta_key = 'video'
)
LEFT JOIN $wpdb->postmeta AS slideshow ON(
$wpdb->posts.ID = slideshow.post_id
AND slideshow.meta_key = 'slideshow'
)
LEFT JOIN $wpdb->postmeta AS soundslides ON(
$wpdb->posts.ID = soundslides.post_id
AND soundslides.meta_key = 'soundslides'
)
LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->term_taxonomy.term_id = $catvariable
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->posts.post_status = 'publish'
HAVING video.meta_value != ''
OR slideshow.meta_value != ''
OR soundslides.meta_value != ''
ORDER BY post_date DESC LIMIT $limitvariable
    ";
 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>

<?php $count=0;?>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?><?php $count++; ?>

         <?php $video = get_post_meta($post->ID, video, true); $slideshow = get_post_meta($post->ID, slideshow, true); $soundslides = get_post_meta($post->ID, soundslides, true); ?>

          <?php if ($video) { ?>
                      <?php $mediacount++; ?>
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>

                      <p><?php the_time('F j, Y') ?></p>
                      <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                      <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                           <?php if ($video) { $pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "height=' " . $videoheight . " '", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "width=' " . $videowidth . " '", $video); echo $video; } ?>
                           <?php $videographer = get_post_meta($post->ID, videographer, true); if ($videographer) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $videographer; ?></p></div><?php } ?>
                           <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

          <?php if ($soundslides) { ?>
                      <?php $mediacount++; ?>
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>

                      <p><?php the_time('F j, Y') ?></p>
                      <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                       <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                           <?php if ($soundslides) { $pattern = "/height=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "height=' " . $videoheight . " '", $soundslides); $pattern = "/width=\"[0-9]*\"/"; $soundslides = preg_replace($pattern, "width=' " . $videowidth . " '", $soundslides); echo $soundslides; } ?>
                            <?php $soundslidescredit = get_post_meta($post->ID, soundslidescredit, true); if ($soundslidescredit) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $soundslidescredit; ?></p></div><?php } ?>
                            <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

          <?php if ($slideshow) { ?>
                <?php $mediacount++; ?>
<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'videothumb', array('class' => 'mmthumb')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="mmthumb" style="width:90px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="mmthumb" style="width:90px" /></a><?php } } ?>

                <p><?php the_time('F j, Y') ?></p>
                <div class="videoplay"><a href="#TB_inline?inlineId=media<?php echo $mediacount; ?>&height=<?php echo $ssheight; ?>&width=<?php echo $sswidth; ?>" title="<?php the_title();?>" class="thickbox"><?php the_title(); ?></a></div><div style="clear:both"></div>
                <div id = "media<?php echo $mediacount; ?>" style = "display: none;">
                     <?php $slideshow = get_post_meta($post->ID, slideshow, true); ?>
                     <?php if ($slideshow) { $showalbum = "[slideshow id =" . $slideshow . " w=" . $sswidthgallery . " h=" . $ssheightgallery ."]"; echo do_shortcode($showalbum); ?><div style="margin-bottom:5px"></div><?php } ?>
                     <?php $slideshowcredit = get_post_meta($post->ID, slideshowcredit, true); if ($slideshowcredit) { ?><div class="mmdivider"><p class="photographer">Credit: <?php echo $slideshowcredit; ?></p></div><?php } ?>
                     <?php $writer = get_post_meta($post->ID, writer, true); if ($writer) { ?><p class="mmteaser"><a href="<?php the_permalink(); ?>">Read full text</a> of accompanying story.</p><?php } ?>
                      </div><div style="clear:both"></div><div class="mmline"></div>
          <?php } ?>

      <div style="clear:both"></div>

   <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>
                <h3><a href="<?php echo cat_id_to_slug(get_theme_mod('mm-cat4')); ?>">View All</a></h3>
                </div><div class="widgetfooter"></div></div>

<?php } ?>

</div>
		
</div>

<!-- The main column ends  -->

<?php get_footer(); ?>
<?php } else { ?>
<div id="content">

	<div id="contentleft">
	The Multimedia Add-On feature can be added to your site by filling out this <a href="http://www.schoolnewspapersonline.com/add-on-features/addons-upgrades/">order form</a>.
	</div>
</div>

<?php get_footer(); ?>

<? } ?>