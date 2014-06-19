<div style="clear:both"></div>
	<div id="leaderboardfooter">

	<?php if (get_theme_mod('leaderad-type-footer')=="Static Image") {

		 $leaderurl=get_theme_mod('leader-url-footer'); $leaderimage=get_theme_mod('leader-image-footer');
		 if ($leaderurl) echo '<a target="_blank" href="'.$leaderurl.'">'; if ($leaderimage) echo '<img src="'.$leaderimage.'" class="leaderimage" />'; if ($leaderurl) echo '</a>';

	 } else if (get_theme_mod('leaderad-type-footer')=="Ad Tag") {

		//SWW Mod to target ads for Top 100 & MDCE sections
		$openxcode = get_theme_mod('openx-code-footer');
		$sww_uri = strtolower($_SERVER["REQUEST_URI"]);

		if (strpos($sww_uri,'/top-100/') !== false)  {
			$searchstr = "div-gpt-ad-1375819015494";
			$replacestr = "div-gpt-ad-1375819230878";
			$openxcode = str_ireplace($searchstr, $replacestr, $openxcode);

			$searchstr = "BIM_ROS";
			$replacestr = "BIM_T100";
			$openxcode = str_ireplace($searchstr, $replacestr, $openxcode);
		}


		if (strpos($sww_uri,'/mdce/') !== false || (strpos($sww_uri,'/category/marine-dealer-conference/') !== false)) {
			$searchstr = "div-gpt-ad-1375819015494";
			$replacestr = "div-gpt-ad-1375818952736";
			$openxcode = str_ireplace($searchstr, $replacestr, $openxcode);

			$searchstr = "BIM_ROS";
			$replacestr = "BIM_MDCE";
			$openxcode = str_ireplace($searchstr, $replacestr, $openxcode);
		}

		echo $openxcode;

		//SWW Mod - commented original code below
		//echo get_theme_mod('openx-code-footer');

	 } ?>


	</div>

