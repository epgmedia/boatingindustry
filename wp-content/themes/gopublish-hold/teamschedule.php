<!--start of schedule-->

<div id="content">

	<div id="contentleft">
	
                <?php $seasoncheck = get_post_meta($post->ID, season, true); ?>
                <?php $sport = get_post_meta($post->ID, sport, true); ?>

<div class="breadcrumbwrap"><div class="breadcrumb">Browse: Home / Sports Center / <?php echo $seasoncheck; ?> <?php echo $sport; ?></div></div>
                <div style="clear:both"></div>

<div class="widgetwrap"><div class="titlewrap610"><h2><?php echo $seasoncheck; ?> <?php echo $sport; ?></h2></div>
<div class="widgetbody" style="margin-bottom:0px">
<table class="schedule" id="myTable3">
    <thead>
        <tr>
            <th style="text-indent:4px">Sport</th>
            <th>Team Level</th>
            <th>Date</th>
            <th>Time</th>
            <th>Opponent</th>
            <th>Location</th>
            <th>Score</th>
            <th style="text-align:center">W/L</th>
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
JOIN $wpdb->postmeta AS sport ON(
$wpdb->posts.ID = sport.post_id
AND sport.meta_value = '$sport'
)
JOIN $wpdb->postmeta AS season ON(
$wpdb->posts.ID = season.post_id
AND season.meta_value = '$seasoncheck'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY date.meta_value ASC
";

 $pageposts = $wpdb->get_results($querystr, OBJECT);

?>


 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>





<?php if ($alt) { $alt = ""; } else { $alt = "altclass"; } ?> 

     <tr class="rosterrow<?php echo $alt;?>" style="border-bottom:1px solid #AAAAAA">
            <td style="text-indent:4px"><?php echo get_post_meta($post->ID, sport, true);?></td>
            <td><?php echo get_post_meta($post->ID, teamlevel, true);?></td>
            <td><?php $r=get_post_meta($post->ID, date, true); $date = explode("-",$r); echo date("D, M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";?></td>
            <td><?php echo get_post_meta($post->ID, time, true);?></td>
            <td><?php $gamesummary = get_post_meta($post->ID, gamesummary, true); if ($gamesummary == "") {echo get_post_meta($post->ID, opponent, true); } else { ?><a href="<?php the_permalink();?>" rel="bookmark" title="Read Game Summary"><?php echo get_post_meta($post->ID, opponent, true); } ?></td>
            <td><?php $location = get_post_meta($post->ID, location, true);?><?php echo $location; ?></td>
            <td><?php $ourscore = get_post_meta($post->ID, ourscore, true); $theirscore = get_post_meta($post->ID, theirscore, true); if ($ourscore=="") { } else if ($theirscore == "") { echo $ourscore; } else {echo $ourscore ;?>-<?php echo $theirscore; } ?> <?php edit_post_link('(Edit)', '', ''); ?></td>
            <td style="text-align:center"><?php if ($ourscore == "") {} else { if ($ourscore==$theirscore) { ?>T<?php } else if (($theirscore=="") && ($ourscore!="")) {} else if($ourscore > $theirscore) { ?>W<?php } else if ($ourscore < $theirscore) { ?>L<?php }} ?></td>
        </tr>



  <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>

</tbody>
</table>	

<!--end of schedule-->
<!--start of season drop down list-->
<?php $querystr = "
SELECT * FROM $wpdb->posts
JOIN $wpdb->postmeta AS season ON(
$wpdb->posts.ID = season.post_id
AND season.meta_key = 'season'
)
JOIN $wpdb->postmeta AS sport ON(
$wpdb->posts.ID = sport.post_id
AND sport.meta_value = '$sport'
)
JOIN $wpdb->postmeta AS date ON(
$wpdb->posts.ID = date.post_id
AND date.meta_key = 'date'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY season.meta_value ASC
";
 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>



     <form name="jump3" style="margin:0px 0px 20px 20px">
     <select name="menu3" onChange="location=document.jump3.menu3.options[document.jump3.menu3.selectedIndex].value;" value="GO">
     <option value="">Select a Different Season</option>
       <?php $namecheck="";?>
       <?php if ($pageposts): ?>
         <?php foreach ($pageposts as $post): ?>
           <?php setup_postdata($post); ?>


                <?php $seasoncheck = get_post_meta($post->ID, season, true);?> 
                <?php if ($loopcheck == $seasoncheck) {} else { ?>
                <option value="<?php the_permalink(); ?>"><?php echo $seasoncheck; ?></option>
                <?php $loopcheck = $seasoncheck;?>
                <?php } ?>
           <?php endforeach; ?>
         <?php else : ?>
       <?php endif; ?>

     </select>
     </form>

<!--end of season drop down list-->
</div>    <div class="widgetfooter"></div></div>



</div>

<!-- begin sidebar -->

<div id="sidebar">



<?php
 $querystr = "
SELECT * FROM $wpdb->posts
JOIN $wpdb->postmeta AS player ON(
$wpdb->posts.ID = player.post_id
AND player.meta_key = 'player'
)
JOIN $wpdb->postmeta AS sport ON(
$wpdb->posts.ID = sport.post_id
AND sport.meta_value = '$sport'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY post_date DESC
";

 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>

<?php $count = 0; ?>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

<?php $count++; ?>
<?php if ($count < 4) { ?>


<div style="clear:both"></div><div class="widgetwrap"><div class="titlewrap300"><h2>Featured <?php echo $sport; ?> Athlete</h2></div>
<div class="widgetbody">

<?php global $post; $feature_photo = get_post_meta($post->ID, feature_photo, true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'home120', array('class' => 'sectionthumbnail')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="sectionthumbnail" style="width:120px" /></a><?php } 
	else 
			{ global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
$attachment = wp_get_attachment_url($attachment_id); if ($attachment) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment; ?>" class="sectionthumbnail" style="width:120px" /></a><?php } } ?>


        <?php $sportplayed = get_post_meta($post->ID, sport, true); if ($sportplayed) { ?><p style="font-weight:bold">Sport: <?php echo $sportplayed; ?></p><?php } ?>
        <?php $position = get_post_meta($post->ID, position, true); if ($position) { ?><p style="font-weight:bold">Position: <?php echo $position; ?> <?php edit_post_link('(Edit)', '', ''); ?></p><?php } ?>
        <?php $grade = get_post_meta($post->ID, playergrade, true); if ($grade) { ?><p style="font-weight:bold">Grade Level: <?php echo $grade; ?></p><?php } ?>
        <?php $jersey = get_post_meta($post->ID, jersey, true); if ($jersey) { ?><p style="font-weight:bold">Jersey Number: <?php echo $jersey; ?></p><?php } ?>
	<a href="<?php the_permalink() ?>"><p style="font-weight:bold;margin-bottom:10px" href="<?php the_permalink() ?>" rel="bookmark" title="Read full story about <?php echo get_post_meta($post->ID, player, true); ?>"><?php echo get_post_meta($post->ID, player, true); ?></p></a>
	<div style="clear:both;"></div>	
        <?php the_content_limit(130, "Read more &raquo;"); ?>

    </div>
    <div class="widgetfooter"></div></div>

<?php } ?><!--end count-->

  <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>

<!--team standings-->

<?php
 $querystr = "
SELECT * FROM $wpdb->posts
JOIN $wpdb->postmeta AS conferencewins ON(
$wpdb->posts.ID = conferencewins.post_id
AND conferencewins.meta_key = 'conferencewins'
)
JOIN $wpdb->postmeta AS conferencelosses ON(
$wpdb->posts.ID = conferencelosses.post_id
AND conferencelosses.meta_key = 'conferencelosses'
)
JOIN $wpdb->postmeta AS sport ON(
$wpdb->posts.ID = sport.post_id
AND sport.meta_value = '$sport'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY CAST(conferencewins.meta_value AS UNSIGNED INTEGER ) DESC, CAST(conferencelosses.meta_value AS UNSIGNED INTEGER ) ASC
";
 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>
<?php $count = 0; $footerkey = 0; ?>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

<?php $conference = get_post_meta($post->ID, conference, true); if ($conference == "true") { ?>

        <?php $count++; if ($count == 1) { ?>
             <div style="clear:both"></div><div class="widgetwrap"><div class="titlewrap300"><h2><?php echo $sport; ?> Conference Standings</h2></div><div class="widgetbody">
             <table border-width=0 style="font-size:12px;font-weight:normal;line-height:14px">
             <tr style="background:#aaaaaa;border-collapse:collapse">
             <td width=160 style="font-weight:bold;text-indent:5px">Team</td><td width=70 style="font-weight:bold;text-align:center">Conference</td><td width=70 style="font-weight:bold;text-align:center">Overall</td>
             </tr>
         <?php $footerkey = 5; ?>
         <?php } ?>




<?php if ($alt) { $alt = ""; } else { $alt = "altclass"; } ?>


<tr class="rosterrow<?php echo $alt;?>">
<td style="text-indent:5px"><?php $school = get_post_meta($post->ID, school, true); echo $school; ?> <?php edit_post_link('(Edit Standings)', '', ''); ?></td>
	
<td style="text-align:center"><?php echo get_post_meta($post->ID, conferencewins, true); ?>-<?php echo get_post_meta($post->ID, conferencelosses, true); ?></td>

<td style="text-align:center"><?php echo get_post_meta($post->ID, totalwins, true); ?>-<?php echo get_post_meta($post->ID, totallosses, true); ?></td>

</tr>
<?php } ?><!--end of conference check-->
  
   <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>

<?php if ($footerkey == 5) { ?>

</table>
    </div> 
    <div class="widgetfooter"></div></div>

   

<?php } ?>



<!--end of conference team standings-->


<!--start of playoff team standings-->

<?php
 $querystr = "
SELECT * FROM $wpdb->posts
JOIN $wpdb->postmeta AS totalwins ON(
$wpdb->posts.ID = totalwins.post_id
AND totalwins.meta_key = 'totalwins'
)
JOIN $wpdb->postmeta AS totallosses ON(
$wpdb->posts.ID = totallosses.post_id
AND totallosses.meta_key = 'totallosses'
)
JOIN $wpdb->postmeta AS sport ON(
$wpdb->posts.ID = sport.post_id
AND sport.meta_value = '$sport'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY CAST(totalwins.meta_value AS UNSIGNED INTEGER ) DESC, CAST(totallosses.meta_value AS UNSIGNED INTEGER ) ASC
";
 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>

<?php $count = 0; $footerkey = 0; ?>
 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

<?php $section = get_post_meta($post->ID, section, true); if ($section == "true") { ?>

        <?php $count++; if ($count == 1) { ?>
             <div style="clear:both"></div><div class="widgetwrap"><div class="titlewrap300"><h2><?php echo $sport; ?> Playoff Standings</h2></div><div class="widgetbody">
             <table border-width=0 style="font-size:12px;font-weight:normal;line-height:14px">
             <tr style="background:#aaaaaa;border-collapse:collapse">
             <td width=220 style="font-weight:bold;text-indent:5px">Team</td><td width=80 style="font-weight:bold;text-align:center">Overall</td>
             </tr>
         <?php $footerkey = 5; ?>
         <?php } ?>



<?php if ($alt) { $alt = ""; } else { $alt = "altclass"; } ?>


<tr class="rosterrow<?php echo $alt;?>">
<td style="text-indent:5px"><?php $school = get_post_meta($post->ID, school, true); echo $school; ?> <?php edit_post_link('(Edit Standings)', '', ''); ?></td>

<td style="text-align:center"><?php echo get_post_meta($post->ID, totalwins, true); ?>-<?php echo get_post_meta($post->ID, totallosses, true); ?>

</tr>
<?php } ?><!--end of conference check-->
  
   <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>

<?php if ($footerkey == 5) { ?>

</table>
    </div>
    <div class="widgetfooter"></div></div>
    

<?php } ?>

<!--end of playoff team standings-->



<!--start of staterankings-->

<?php
 $querystr = "
SELECT * FROM $wpdb->posts
JOIN $wpdb->postmeta AS staterank ON(
$wpdb->posts.ID = staterank.post_id
AND staterank.meta_key = 'staterank'
AND staterank.meta_value != ''
)
JOIN $wpdb->postmeta AS sport ON(
$wpdb->posts.ID = sport.post_id
AND sport.meta_value = '$sport'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY CAST(staterank.meta_value AS UNSIGNED INTEGER ) ASC
";
 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>

<?php $count = 0; $footerkey = 0; ?>
 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>
        <?php $count++; if ($count == 1) { ?>
             <div style="clear:both"></div><div class="titlewrap300"><h2><?php echo $sport; ?> State Rankings</h2></div><div class="widgetbody">
             <table border-width=0 style="font-size:12px;font-weight:normal;line-height:14px">
             <tr style="background:#aaaaaa;border-collapse:collapse">
             <td width=220 style="font-weight:bold;text-indent:5px">Team</td><td width=80 style="font-weight:bold;text-align:center">State Rank</td>
             </tr>
         <?php $footerkey = 5; ?>
         <?php } ?>


<?php if ($alt) { $alt = ""; } else { $alt = "altclass"; } ?>


<tr class="rosterrow<?php echo $alt;?>">
<td style="text-indent:5px"><?php $school = get_post_meta($post->ID, school, true); echo $school; ?> <?php edit_post_link('(Edit Standings)', '', ''); ?></td>

<td style="text-align:center"><?php echo get_post_meta($post->ID, staterank, true); ?>

</tr>

  
   <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>

<?php if ($footerkey == 5) { ?>

</table>
    </div>
    <div class="widgetfooter"></div></div>
    

<?php } ?>

<!--end of staterank-->



</div>

<!-- end sidebar -->

</div>