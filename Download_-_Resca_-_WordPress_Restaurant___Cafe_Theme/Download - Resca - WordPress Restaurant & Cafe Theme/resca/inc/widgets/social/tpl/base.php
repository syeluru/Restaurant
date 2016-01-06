<?php
$title          = $link_face = $link_twitter = $link_google = $link_dribble = $link_pinterest = $link_youtube = $link_digg = $link_linkedin = '';
$title          = $instance['title'];
$link_face      = $instance['link_face'];
$link_twitter   = $instance['link_twitter'];
$link_google    = $instance['link_google'];
$link_dribble   = $instance['link_dribble'];
$link_linkedin  = $instance['link_linkedin'];
$link_pinterest = $instance['link_pinterest'];
$link_digg      = $instance['link_digg'];
$link_youtube   = $instance['link_youtube'];

?>
<div class="thim-social">
	<?php
	if ( $title ) {
		echo ent2ncr( $before_title . esc_attr( $title ) . $after_title );
	}
	?>
	<ul class="social_link">
		<?php
		if ( $link_face != '' ) {
			echo '<li><a class="face hasTooltip" href="' . $link_face . '" target="' . $instance['link_target'] . '"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( $link_twitter != '' ) {
			echo '<li><a class="twitter hasTooltip" href="' . $link_twitter . '" target="' . $instance['link_target'] . '" ><i class="fa fa-twitter"></i></a></li>';
		}
		if ( $link_google != '' ) {
			echo '<li><a class="google hasTooltip" href="' . $link_google . '" target="' . $instance['link_target'] . '" ><i class="fa fa-google-plus"></i></a></li>';
		}
		if ( $link_dribble != '' ) {
			echo '<li><a class="dribble hasTooltip" href="' . $link_dribble . '" target="' . $instance['link_target'] . '" ><i class="fa fa-dribbble"></i></a></li>';
		}
		if ( $link_linkedin != '' ) {
			echo '<li><a class="linkedin hasTooltip" href="' . $link_linkedin . '" target="' . $instance['link_target'] . '" ><i class="fa fa-linkedin"></i></a></li>';
		}

		if ( $link_pinterest != '' ) {
			echo '<li><a class="pinterest hasTooltip" href="' . $link_pinterest . '" target="' . $instance['link_target'] . '" ><i class="fa fa-pinterest"></i></a></li>';
		}
		if ( $link_digg != '' ) {
			echo '<li><a class="digg hasTooltip" href="' . $link_digg . '" target="' . $instance['link_target'] . '" ><i class="fa fa-digg"></i></a></li>';
		}
		if ( $link_youtube != '' ) {
			echo '<li><a class="youtube hasTooltip" href="' . $link_youtube . '" target="' . $instance['link_target'] . '" ><i class="fa fa-youtube"></i></a></li>';
		}
		?>
	</ul>
</div>