<?php
$title      = $instance['title'];
$domain_ext = $instance['domain_ext'];
$rid        = $instance['rid'];
?>
<div class="pixcode pixcode--otreservations otreservations">
	<div class="sc-heading article_heading">
		<?php if ( isset( $instance['subtitle'] ) ) {
			echo '<p class="heading__secondary">' . $instance['subtitle'] . '</p>';
		} ?>
		<h2 class="heading__primary"><?php echo ent2ncr($title) ?></h2>
	</div>
	<?php if ( isset( $instance['desc'] ) ) {
		echo '<p class="otreservations-description">' . $instance['desc'] . '</p>';
	} ?>
	<?php if ( !empty( $rid ) && intval( $rid ) ) : ?>
		<form method="get" class="otw-widget-form" action="http://www.opentable.<?php echo ent2ncr($domain_ext); ?>/restaurant-search.aspx" target="_blank">
			<div class="otw-wrapper row">
				<div class="otw-date-li col-sm-3">
					<!--					<label for="date-otreservations">--><?php //echo( !empty( $labels ) ? __( 'Date', 'thim' ) : '<i class="icon-calendar"></i>' ) ?><!--</label>-->
					<input id="date-otreservations" name="startDate" class="otw-reservation-date" type="text" value="" autocomplete="off" placeholder="<?php _e( 'Date', 'thim' ) ?>">
				</div>
				<div class="otw-time-wrap col-sm-3">
					<!--					<label for="time-otreservations">--><?php //echo( !empty( $labels ) ? __( 'Time', 'thim' ) : '<i class="icon-clock-o"></i>' ) ?><!--</label>-->
					<select id="time-otreservations" name="ResTime" class="otw-reservation-time selectpicker">
<!--						<option value="">--><?php //_e( 'Time', 'thim' ); ?><!--</option>-->
						<?php
						//Time Loop
						$inc   = 30 * 60;
						$start = ( strtotime( '8AM' ) ); // 6  AM
						$end   = ( strtotime( '10:00PM' ) ); // 10 PM
						for ( $i = $start; $i <= $end; $i += $inc ) {
							// to the standart format
							$time      = date( 'g:i a', $i );
							$timeValue = date( 'g:ia', $i );
							$default   = "7:00pm";
							echo "<option value=\"$timeValue\" " . ( ( $timeValue == $default ) ? ' selected="selected" ' : "" ) . ">$time</option>" . PHP_EOL;
						}

						?>
					</select>

				</div>
				<div class="otw-party-size-wrap col-sm-3">
					<!--					<label for="party-otreservations">--><?php //echo( !empty( $labels ) ? __( 'Party Size', 'thim' ) : '<i class="icon-user"></i>' ) ?><!--</label>-->
					<select id="party-otreservations" name="partySize" class="otw-party-size-select selectpicker">
<!--						<option value="">--><?php //_e( 'Guest Number', 'thim' ); ?><!--</option>-->
						<option value="1"><?php _e( '1 Person', 'thim' ); ?></option>
						<option value="2" selected="selected"><?php _e( '2 People', 'thim' ); ?></option>
						<option value="3"><?php _e( '3 People', 'thim' ); ?></option>
						<option value="4"><?php _e( '4 People', 'thim' ); ?></option>
						<option value="5"><?php _e( '5 People', 'thim' ); ?></option>
						<option value="6"><?php _e( '6 People', 'thim' ); ?></option>
						<option value="7"><?php _e( '7 People', 'thim' ); ?></option>
						<option value="8"><?php _e( '8 People', 'thim' ); ?></option>
						<option value="9"><?php _e( '9 People', 'thim' ); ?></option>
						<option value="10"><?php _e( '10 People', 'thim' ); ?></option>
					</select>
				</div>

				<div class="otw-button-wrap col-sm-3">
					<input type="submit" class="otreservations-submit" value="<?php _e( 'BOOK A TABLE', 'thim' ); ?>" />
				</div>
				<input type="hidden" name="RestaurantID" class="RestaurantID" value="<?php echo ent2ncr($rid); ?>">
				<input type="hidden" name="rid" class="rid" value="<?php echo ent2ncr($rid); ?>">
				<input type="hidden" name="GeoID" class="GeoID" value="15">
				<input type="hidden" name="txtDateFormat" class="txtDateFormat" value="<?php echo !empty( $date_format ) ? $date_format : "MM/DD/YYYY"; ?>">
				<input type="hidden" name="RestaurantReferralID" class="RestaurantReferralID" value="<?php echo ent2ncr($rid); ?>">

			</div>
		</form>
		<span class="otreservations-subtitle"><?php _e( 'Powered by OpenTable', 'thim' ) ?></span>
	<?php else : ?>
		<span class="otreservations-error"><?php _e( 'You need to provide us with a valid numeric OpenTable restaurant ID.', 'thim' ) ?></span>
	<?php endif; ?>
</div>