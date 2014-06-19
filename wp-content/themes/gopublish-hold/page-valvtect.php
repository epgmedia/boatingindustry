<?php
/*
Template Name: ValvTect
*/
?>
<?php get_header(); ?>

<div id="content">

	<div id="contentleft">
	
		<div class="postarea">
	
		<?php include(TEMPLATEPATH."/breadcrumb.php");?>
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php $title=get_post_meta($post->ID, title, true); if (!$title) { ?><h1><?php the_title(); ?></h1><?php } ?>


				<?php edit_post_link('(Edit This Page)', '<p>', '</p>'); ?>

<div style="float: right; width: 125px;">
<!-- BIM_Targeted_ValvTect_125x250 -->
<div id='div-gpt-ad-1377033861419-0' style='width:125px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1377033861419-0'); });
</script>
</div>
</div>
		
			<?php the_content(__('[Read more]'));?>
		 			
			<?php endwhile; else: ?>
			
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
						
		</div>
		
	</div>
	
<?php include(TEMPLATEPATH."/sidebar.php");?>

</div>
<script type="text/javascript">
(function() {
    $('div.postArea').append("<p class=sublink><i>Subscribe to the <a href=http://www.boatingindustry.com/newsletter-signup/ target=_blank>Boating Industry Enewsletter</a></i></p>");
})();
</script>


<!-- The main column ends  -->

<?php get_footer(); ?>