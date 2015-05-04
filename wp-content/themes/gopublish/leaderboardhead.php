<?php if ( get_theme_mod( 'display-leader' ) == "Yes" ) { ?>

	<div class="leaderboard">

		<?php if ( get_theme_mod( 'leaderad-type' ) == "Static Image" ) {

			$leaderurl   = get_theme_mod( 'leader-url' );
			$leaderimage = get_theme_mod( 'leader-image' );

			if ( NULL !== $leaderurl ) { ?>
				<a target="_blank" href="<?php echo $leaderurl; ?>">
			<?php }

			if ( NULL !== $leaderimage ) { ?>
				<img src="<?php echo $leaderimage; ?>" class="leaderimage" />
			<?php }

			if ( NULL !== $leaderurl ) { ?>
				</a>
			<?php }

		} else if ( get_theme_mod( 'leaderad-type' ) == "Ad Tag" ) {

			//SWW Mod to target ads for Top 100 & MDCE sections
			$openxcode = get_theme_mod('openx-code');
			$sww_uri   = strtolower($_SERVER["REQUEST_URI"]);

			if ( strpos( $sww_uri,'/top-100/' ) !== false )  {
				$searchstr  = "div-gpt-ad-1398366141837";
				$replacestr = "div-gpt-ad-1398366494877";
				$openxcode  = str_ireplace($searchstr, $replacestr, $openxcode);

				$searchstr  = "BIM_ROS";
				$replacestr = "BIM_T100";
				$openxcode  = str_ireplace($searchstr, $replacestr, $openxcode);
			}

			if (
				strpos( $sww_uri,'/mdce/' ) !== false ||
				strpos( $sww_uri,'/category/marine-dealer-conference/' ) !== false
			) {
				$searchstr  = "div-gpt-ad-1398366141837";
				$replacestr = "div-gpt-ad-1398366605405";
				$openxcode  = str_ireplace($searchstr, $replacestr, $openxcode);

				$searchstr  = "BIM_ROS";
				$replacestr = "BIM_MDCE";
				$openxcode  = str_ireplace($searchstr, $replacestr, $openxcode);
			}

			echo $openxcode;
		} ?>

	</div>

<?php }