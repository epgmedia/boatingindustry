<?php
/*
Template Name: Sports Center
*/
?>


<?php get_header(); ?>
<?php $sccheck = get_option('ssno'); if ($sccheck == "ssno928462s") { ?>

<div id="content">

	<div id="contentleft">
	
<div class="breadcrumbwrap"><?php include(TEMPLATEPATH."/breadcrumb.php"); ?></div>

			<?php if (get_theme_mod('sports-stories-scrollbox') == "Display") include(TEMPLATEPATH . "/sports-stories-scrollbox.php"); ?>


<!--set season variable to limit following queries to current season-->	
<?php $currentyear = date("Y"); $currentmonth = date("m");  if ($currentmonth >= "07") {$spring = $currentyear +1; $seasoncheck = "$currentyear" . "-" . "$spring"; } else {$fall = $currentyear - 1; $seasoncheck = "$fall" . "-" . "$currentyear";} ?>

<!--start of recent results-->


                	<div class="widgetwrap"><div style="clear:both"></div><div class="titlewrap610"><h2 style="margin:0px 0px 0px 0px">Recent Results</h2></div>
               <div style="clear:both"></div>
<div class="widgetbody">

<table class="schedule" id="myTable3">
    <thead>
        <tr>
            <th style="text-indent:4px">Sport</th>
            <th>Team</th>
            <th>Date</th>
            <th>Opponent</th>
            <th>Location</th>
            <th>Score</th>
            <th style="text-align:center">W/L</th>
        </tr>
    </thead>

    <tbody>

<?php $count = 0; ?>

<?php
 $querystr = "
SELECT * FROM $wpdb->posts
JOIN $wpdb->postmeta AS date ON(
$wpdb->posts.ID = date.post_id
AND date.meta_key = 'date'
)
JOIN $wpdb->postmeta AS opponent ON(
$wpdb->posts.ID = opponent.post_id
AND opponent.meta_key = 'opponent'
)
JOIN $wpdb->postmeta AS season ON(
$wpdb->posts.ID = season.post_id
AND season.meta_value = '$seasoncheck'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY date.meta_value DESC
";

 $pageposts = $wpdb->get_results($querystr, OBJECT);

?>
<?php $maxcount = get_theme_mod('recent-results'); if ($maxcount == "") { $maxcount = 20; } ?>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

<?php $ourscore = get_post_meta($post->ID, ourscore, true); if ($ourscore != "") { ?>  <!--filters out games without results-->
<?php $count++; if ($count <= $maxcount) { ?>

<?php if ($alt) { $alt = ""; } else { $alt = "altclass"; } ?> 

     <tr class="rosterrow<?php echo $alt;?>" style="border-bottom:1px solid #AAAAAA">
            <td style="text-indent:4px"><a href="<?php the_permalink(); ?>"><?php echo get_post_meta($post->ID, sport, true);?></a></td>
            <td><?php $teamlevel = get_post_meta($post->ID, teamlevel, true);?><?php echo $teamlevel; ?></td>
            <td><?php $r=get_post_meta($post->ID, date, true); $date = explode("-",$r); echo date("D, M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";?></td>
            <td><?php $gamesummary = get_post_meta($post->ID, gamesummary, true); if ($gamesummary == "") {echo get_post_meta($post->ID, opponent, true); } else { ?><a href="<?php the_permalink();?>" rel="bookmark" title="Read Game Summary"><?php echo get_post_meta($post->ID, opponent, true); } ?></td>
            <td><?php $location = get_post_meta($post->ID, location, true);?><?php echo $location; ?></td>
            <td><?php $ourscore = get_post_meta($post->ID, ourscore, true); $theirscore = get_post_meta($post->ID, theirscore, true); if ($ourscore=="") { } else if ($theirscore == "") { echo $ourscore; } else {echo $ourscore ;?>-<?php echo $theirscore; } ?> <?php edit_post_link('(Edit)', '', ''); ?></td>
            <td style="text-align:center"><?php if ($ourscore == "") {} else { if ($ourscore==$theirscore) { ?>T<?php } else if (($theirscore=="") && ($ourscore!="")) {} else if($ourscore > $theirscore) { ?>W<?php } else if ($ourscore < $theirscore) { ?>L<?php }} ?></td>
        </tr>



<?php } ?><!--end of count check-->
<?php } ?><!--end of results check-->

  <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>
<tr><td colspan=7>Click on any sport above to see a full schedule for that sport.</td></tr>
</tbody>
</table>	
</div><div class="widgetfooter"></div>
</div>
<!--end of recent results-->


<!--start of update now list-->

<?php if (is_user_logged_in()) { ?><!--only shows this table to logged in users-->

                	<div class="widgetwrap"><div style="clear:both"></div><div class="titlewrap610"><h2 style="margin:0px 0px 0px 0px">Ready to be Updated -- Only Shows for Logged in Users</h2></div>
               <div style="clear:both"></div>
<div class="widgetbody">
<table class="schedule" id="myTable3">
    <thead>
        <tr>
            <th style="text-indent:4px">Sport</th>
            <th>Team</th>
            <th>Date</th>
            <th>Opponent</th>
            <th>Location</th>
            <th>Score</th>
            <th style="text-align:center">W/L</th>
        </tr>
    </thead>

    <tbody>

<?php $count = 0; ?>

<?php
 $querystr = "
SELECT * FROM $wpdb->posts
JOIN $wpdb->postmeta AS date ON(
$wpdb->posts.ID = date.post_id
AND date.meta_key = 'date'
)
JOIN $wpdb->postmeta AS opponent ON(
$wpdb->posts.ID = opponent.post_id
AND opponent.meta_key = 'opponent'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY date.meta_value ASC
";

 $pageposts = $wpdb->get_results($querystr, OBJECT);

?>


 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

<?php $ourscore = get_post_meta($post->ID, ourscore, true); if ($ourscore == "") { ?>  <!--filters out games with results-->

<?php $count++; if ($count < 21) { ?>

<?php if ($alt) { $alt = ""; } else { $alt = "altclass"; } ?> 

     <tr class="rosterrow<?php echo $alt;?>" style="border-bottom:1px solid #AAAAAA">
            <td style="text-indent:4px"><a href="<?php the_permalink(); ?>"><?php echo get_post_meta($post->ID, sport, true);?></a></td>
            <td><?php $teamlevel = get_post_meta($post->ID, teamlevel, true);?><?php echo $teamlevel; ?></td>
            <td><?php $r=get_post_meta($post->ID, date, true); $date = explode("-",$r); echo date("D, M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";?></td>
            <td><?php $gamesummary = get_post_meta($post->ID, gamesummary, true); if ($gamesummary == "") {echo get_post_meta($post->ID, opponent, true); } else { ?><a href="<?php the_permalink();?>" rel="bookmark" title="Read Game Summary"><?php echo get_post_meta($post->ID, opponent, true); } ?></td>
            <td><?php $location = get_post_meta($post->ID, location, true);?><?php echo $location; ?></td>
            <td><?php $ourscore = get_post_meta($post->ID, ourscore, true); $theirscore = get_post_meta($post->ID, theirscore, true); if ($ourscore=="") { } else if ($theirscore == "") { echo $ourscore; } else {echo $ourscore ;?>-<?php echo $theirscore; } ?> <?php edit_post_link('(Add Score)', '', ''); ?></td>
            <td style="text-align:center"><?php if ($theirscore == "") {} else {?><?php if ($ourscore > $theirscore) { ?>W<?php } else { ?>L<?php }} ?></td>
        </tr>

<?php } ?><!--end of count check-->
<?php } ?><!--end of results check-->

  <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>

</tbody>
</table>	
</div><div class="widgetfooter"></div>
</div>
<?php } ?>

<!--end of update now list-->


<!--start of upcoming games-->
<?php $count = 0; ?>

                	<div class="widgetwrap"><div style="clear:both"></div><div class="titlewrap610"><h2 style="margin:0px 0px 0px 0px">Upcoming Games</h2></div>
                 <div style="clear:both"></div>
<div class="widgetbody">

<table class="schedule">
    <thead>
        <tr>
            <th style="text-indent:4px">Sport</th>
            <th>Team</th>
            <th>Date</th>
            <th>Time</th>
            <th>Opponent</th>
            <th>Location</th>
        </tr>
    </thead>

    <tbody>

<?php
 $querystr = "
SELECT * FROM $wpdb->posts
JOIN $wpdb->postmeta AS date ON(
$wpdb->posts.ID = date.post_id
AND date.meta_key = 'date'
)
JOIN $wpdb->postmeta AS opponent ON(
$wpdb->posts.ID = opponent.post_id
AND opponent.meta_key = 'opponent'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY date.meta_value ASC
";

 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>

<?php $maxcount = get_theme_mod('upcoming-games'); if ($maxcount == "") { $maxcount = 20; } ?>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

						<?php  //to check against expiration date; 
							$currentdate = date("Ymd"); 
							$expirationdate = get_post_meta($post->ID, date, true); 
              						$expirestring = str_replace("-","",$expirationdate);
              						if ( $expirestring >= $currentdate ) { ?>

<?php $count++; if ($count <= $maxcount) { ?>

<?php if ($alt) { $alt = ""; } else { $alt = "altclass"; } ?> 

     <tr class="rosterrow<?php echo $alt;?>" style="border-bottom:1px solid #AAAAAA">
            <td style="text-indent:4px"><a href="<?php the_permalink(); ?>"><?php echo get_post_meta($post->ID, sport, true);?></a></td>
            <td><?php echo get_post_meta($post->ID, teamlevel, true);?></td>
            <td><?php $r=get_post_meta($post->ID, date, true); $date = explode("-",$r); echo date("D, M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";?></td>
            <td><?php echo get_post_meta($post->ID, time, true);?></td>
            <td><?php echo get_post_meta($post->ID, opponent, true);?></td>
            <td><?php $location = get_post_meta($post->ID, location, true);?><?php echo $location; ?> <?php edit_post_link('(Edit)', '', ''); ?></td>
        </tr>

<?php } ?><!--end of count limiter-->
<?php } ?><!--expiration date check-->

  <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>

<tr><td colspan=6>Click on any sport above to see a full schedule for that sport.</td></tr>
</tbody>
</table>	
</div><div class="widgetfooter"></div>
</div>


<!--end of upcoming games-->


		</div>

		

<!-- begin sidebar -->

	<div id="sidebar">
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(6) ) : else : ?>
		<?php endif; ?>
	</div>


<!-- end sidebar -->
		
</div>

<!-- The main column ends  -->

<?php get_footer(); ?>
<?php } else { ?>
<div id="content">

	<div id="contentleft">
	The Sports Center Add-On feature can be added to your site by filling out this <a href="http://www.schoolnewspapersonline.com/add-on-features/addons-upgrades/">order form</a>.
	</div>
</div>

<?php get_footer(); ?>

<? } ?>