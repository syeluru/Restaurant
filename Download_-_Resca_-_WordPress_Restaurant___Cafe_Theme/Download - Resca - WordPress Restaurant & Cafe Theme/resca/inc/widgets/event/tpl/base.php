<?php
$number     = 2;
$number     = $instance['number'];
$date       = time();
$args_event = array(
	'post_type'      => 'post',
	'posts_per_page' => $number,
	'meta_query'     => array(
		'relation' => 'AND',
		array(
			'key'   => 'thim_use_event',
			'value' => '1',
		),
		array(
			'key'     => 'thim_start_date',
			'compare' => '<=',
			'value'   => $date,
		),
		array(
			'key'     => 'thim_end_date',
			'compare' => '>=',
			'value'   => $date,
		)
	)

);
$the_query  = new WP_Query( $args_event );
if ( $the_query->have_posts() ): ?>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post();
		$thim_desc     = get_post_meta( get_the_ID(), 'thim_desc', true );
		$thim_end_date = get_post_meta( get_the_ID(), 'thim_end_date', true );
		?>
		<div class="item-event">
			<?php
			if ( has_post_thumbnail() ) {
				echo '<div class="event-thumbnail">' . feature_images( 600, 300 ) . '</div>';
			} ?>
			<div class="content-item">
				<?php the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
				<?php the_excerpt(); ?>
				<?php if ( $thim_desc ) {
					echo '<p><strong>' . $thim_desc . '</strong></p>';
				} ?>
				<a class="view-detail" href="<?php echo esc_url( get_permalink() ) ?>"><?php _e( 'view detail', 'thim' ) ?></a>
			</div>
			<div class="content-right">
				<div id="coming-soon-counter-<?php echo get_the_ID(); ?>"></div>
				<script type="text/javascript">
					<?php echo 'jQuery(function($) {
									 $("#coming-soon-counter-'.get_the_ID().'").mbComingsoon({ expiryDate:  new Date(' . date( "Y",  $thim_end_date ) . ', ' . ( date( "m", $thim_end_date ) - 1 ) . ', ' . date( "d", $thim_end_date ) . ', ' . date( "G", $thim_end_date ) . ',' . date( "i", $thim_end_date ) . ', ' . date( "s", $thim_end_date ) . '), speed:100 });
									setTimeout(function () {
										$(window).resize();
									}, 200);
								});
							 '
					 ?>
				</script>
			</div>

		</div>
	<?php endwhile;
	wp_reset_query();
	?>
<?php endif; ?>

<?php
// Restore global post data stomped by the_post(). ?>