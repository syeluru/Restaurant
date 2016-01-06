<?php
/**
 * @package thim
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="share-post">
		<div class="date-meta"><?php echo get_the_date( "d\<\i\>\ M\<\/\i\>\ " ) ?></div>
		<?php do_action( 'social_share' ); ?>
	</div>
	<div class="content-inner">
		<?php
		do_action( 'thim_entry_top', 'full' ); ?>
		<div class="entry-content">
			<header class="entry-header">
				<?php the_title( sprintf( '<h1 class="blog_title">', esc_url( get_permalink() ) ), '</h1>' ); ?>
				<?php thim_entry_meta(); ?>
			</header>
			<!-- .entry-header -->
			<div class="entry-summary">
				<?php
				the_content();
				?>
			</div>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'thim' ),
				'after'  => '</div>',
			) );
			?>
			<!-- .entry-summary -->
		</div>
	</div>
</article><!-- #post-## -->
