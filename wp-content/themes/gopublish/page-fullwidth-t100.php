<?php
/*
Template Name: Full Width - Top 100
*/
?>
<?php get_header(); ?>


<div id="content">

	<div id="contentleft" style="width:940px">
	
		<div class="postarea" style="width:920px">
				
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php $title=get_post_meta($post->ID, title, true); if (!$title) { ?><h1><?php the_title(); ?></h1><?php } ?>

                <?php edit_post_link('(Edit This Page)', '<p>', '</p>'); ?>

            <div style="float:right;padding-left:10px;padding-bottom:10px;">

                <!-- BIM_T100_300_Mid2 -->
                <div id='div-gpt-ad-1398366494877-9' style='width:300px; height:250px;'>
                    <script type='text/javascript'>
                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1398366494877-9'); });
                    </script>
                </div>

            </div>

			<?php the_content(__('[Read more]'));?>

            <?php endwhile; else: ?>
			
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

            <?php endif; ?>

            <table width="900" border="0" cellspacing="5" cellpadding="0">

                <tr>

                    <td>
                        <!-- BIM_T100_middle468 -->
                        <div id='div-gpt-ad-1398366494877-13' style='width:468px; height:60px;'>

                            <script type='text/javascript'>
                                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1398366494877-13'); });
                            </script>

                        </div>

                    </td>
                    <td>
                        <!-- BIM_T100_Footer234 -->
                        <div id='div-gpt-ad-1398366494877-0' style='width:234px; height:60px;'>

                            <script type='text/javascript'>
                                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1398366494877-0'); });
                            </script>

                        </div>

                    </td>

                </tr>

            </table>

        </div>
		
	</div>
	
</div>

<!-- The main column ends  -->

<?php get_footer(); ?>