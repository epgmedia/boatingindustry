<div id="slideshow">
<?php 
$homeslidecats = get_theme_mod('catconfig_homeslides');
query_posts('cat=' . $homeslidecats . '&orderby=date&order=DESC');
$i = 1; while (have_posts()) : the_post(); 
	$thumbnail_id    = get_post_thumbnail_id($post->ID);
	if ($thumbnail_id!='') {
		$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));
		$thumbnail_url = $thumbnail_image[0]->guid;
		if ($thumbnail_image && isset($thumbnail_image[0])) {
		?>
		<div class="cycle">
			<a href="<?php the_permalink(); ?>" ><img src="<?php echo bloginfo('template_url'); ?>/timthumb.php?src=<?php echo $thumbnail_url; ?>&w=965&h=388&zc=1" width="965" height="388" alt="" /></a>
			
			<div class="desc" <?php if (get_theme_mod('homepage_photo_text') == 'No') { ?>style="background:none;"<?php } ?>>
				<p><?php if (get_theme_mod('homepage_photo_text') != 'No') { ?> <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a><?php } ?></p>
			</div>
			
		</div>
		<?php
		}
	}
	?>			
<?php 
$i++; endwhile;
?>

</div><!-- end of #slideshow -->
<div id="slideshow_navigation"><div id="pager"></div></div><!-- end slideshow navigation -->
