<?php if ($sort == "conference") { ?>
<div style="clear:both"></div><h2><?php echo $sportname; ?> Conference Standings</h2>
<div class="video">
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
AND sport.meta_value = '$sportname'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY CAST(conferencewins.meta_value AS UNSIGNED INTEGER ) DESC, CAST(conferencelosses.meta_value AS UNSIGNED INTEGER ) ASC
";
 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>

<table border-width=0 style="font-size:12px;font-weight:normal;line-height:14px">
<tr style="background:#aaaaaa;border-collapse:collapse">
<td width=160 style="font-weight:bold;text-indent:5px">Team</td><td width=70 style="font-weight:bold;text-align:center">Conference</td><td width=70 style="font-weight:bold;text-align:center">Overall</td>
</tr>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

<?php $conference = get_post_meta($post->ID, conference, true); if ($conference == "true") { ?>

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

</table>
    </div>
    
    



<?php } else if ($sort == "playoff") { ?>
<div style="clear:both"></div><h2><?php echo $sportname; ?> Playoff Standings</h2>
<div class="video">
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
AND sport.meta_value = '$sportname'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY CAST(totalwins.meta_value AS UNSIGNED INTEGER ) DESC, CAST(totallosses.meta_value AS UNSIGNED INTEGER ) ASC
";
 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>

<table border-width=0 style="font-size:12px;font-weight:normal;line-height:14px">
<tr style="background:#aaaaaa;border-collapse:collapse">
<td width=220 style="font-weight:bold;text-indent:5px">Team</td><td width=80 style="font-weight:bold;text-align:center">Overall</td>
</tr>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

<?php $section = get_post_meta($post->ID, section, true); if ($section == "true") { ?>

<?php if ($alt) { $alt = ""; } else { $alt = "altclass"; } ?>


<tr class="rosterrow<?php echo $alt;?>">
<td style="text-indent:5px"><?php $school = get_post_meta($post->ID, school, true); echo $school; ?> <?php edit_post_link('(Edit Standings)', '', ''); ?></td>

<td style="text-align:center"><?php echo get_post_meta($post->ID, totalwins, true); ?>-<?php echo get_post_meta($post->ID, totallosses, true); ?></td>

</tr>
<?php } ?><!--end of conference check-->
  
   <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>
</table>
    </div>
   

<?php } else if ($sort == "staterank") { ?>

<div style="clear:both"></div><h2><?php echo $sportname; ?> State Rankings</h2>
<div class="video">
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
AND sport.meta_value = '$sportname'
)
AND $wpdb->posts.post_status = 'publish'
ORDER BY CAST(staterank.meta_value AS UNSIGNED INTEGER ) ASC
";
 $pageposts = $wpdb->get_results($querystr, OBJECT);
?>

<table border-width=0 style="font-size:12px;font-weight:normal;line-height:14px">
<tr style="background:#aaaaaa;border-collapse:collapse">
<td width=200 style="font-weight:bold;text-indent:5px">Team</td><td width=50 style="font-weight:bold;text-align:center">Overall</td><td width=50 style="font-weight:bold;text-align:center">Rank</td>
</tr>

 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

<?php if ($alt) { $alt = ""; } else { $alt = "altclass"; } ?>


<tr class="rosterrow<?php echo $alt;?>">
<td style="text-indent:5px"><?php $school = get_post_meta($post->ID, school, true); echo $school; ?> <?php edit_post_link('(Edit Standings)', '', ''); ?></td>

<td style="text-align:center"><?php echo get_post_meta($post->ID, totalwins, true); ?>-<?php echo get_post_meta($post->ID, totallosses, true); ?></td>

<td style="text-align:center"><?php echo get_post_meta($post->ID, staterank, true); ?></td>

</tr>

  
   <?php endforeach; ?>  
  <?php else : ?>
 <?php endif; ?>
</table>
    </div>
    

<?php } ?>