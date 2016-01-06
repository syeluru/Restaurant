<?php
global $post;
$rand = time() . '-1-' . rand( 0, 100 );
echo '<ul class="nav-menu-tabs" role="tablist">';
$j     = $k = 1;
$w_tab = '';
$w_tab = 100 / count( $instance['tab'] );
if ( $w_tab ) {
	$w_tab = ' style="width:' . $w_tab . '%"';
}
foreach ( $instance['tab'] as $i => $tab ) {
	if ( $j == '1' ) {
		$active = "class='active'";
	} else {
		$active = '';
	}
	$sub_title = $icon = '';
	if ( $tab['title_options']['sub-title'] ) {
		$sub_title = '<span class="sub-title">' . $tab['title_options']['sub-title'] . '</span>';
	}
	if ( $tab['title_options']['icon_image'] ) {
		$images_url = wp_get_attachment_image_src( $tab['title_options']['icon_image'], 'full' );
		$icon       = '<img src="' . $images_url['0'] . '">';
	}
	echo '<li role="presentation" ' . $active . $w_tab . '><a href="#thimm-widget-tab-' . $j . $rand . '" data-toggle="tab">' . $icon . '<span>' . $tab['title'] . $sub_title . '</span></a></li>';
	$j ++;
}
echo '</ul>';

echo '<div class="tab-content">';
foreach ( $instance['tab'] as $i => $tab ) {
	if ( $k == '1' ) {
		$content_active = " active";
	} else {
		$content_active = '';
	}
	echo ' <div role="tabpanel" class="tab-pane' . $content_active . '" id="thimm-widget-tab-' . $k . $rand . '">';

	if ( isset( $tab['id'] ) ) {
		$post_id = $tab['id'];
	}

	$menu_items = get_post_meta( $post_id, '_erm_menu_items', true );
	if ( !empty( $menu_items ) ) {
		$menu_items = preg_split( '/,/', $menu_items );
		if ( isset( $tab['columns'] ) && $tab['columns'] == '2' ) {
			$class_column = ' menu_content_two_column';
		}
		echo '<div class="restaurant-menu">';
		echo '<ul class="erm_menu_content layout-default' . $class_column . '">';
		foreach ( $menu_items as $item_id ) {
			$visible = get_post_meta( $item_id, '_erm_visible', true );
			if ( $visible != 1 ) {
				continue;
			}
			$post = get_post( $item_id );
			$type = get_post_meta( $item_id, '_erm_type', true );

			if ( $type == 'section' ) {
				echo '<li class="erm_section">';
				echo '<h2 class="erm_section_title">' . $post->post_title . '</h2>';
				echo '<div class="erm_section_desc">' . apply_filters( 'the_content', $post->post_content ) . '</div>';
				echo '</li>';
			} else {
				if ( $type == 'product' ) {
					$has_thumbnail = has_post_thumbnail( $item_id );
					$prices        = get_post_meta( $item_id, '_erm_prices', true );
					echo '<li class="erm_product' . ( $has_thumbnail ? ' with_image' : ' no_image' ) . '">';
					echo '<div class="item-erm-section">';
					echo '<div class="item-left">';
					if ( $has_thumbnail ) {
						$image_id   = get_post_thumbnail_id( $item_id );
						$src_thumb  = erm_get_image_src( $image_id, 'thumbnail' );
						$src_full   = erm_get_image_src( $image_id, 'full' );
						$alt        = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
						$post_image = get_post( $image_id );
						$caption    = $post_image->post_excerpt;
						$desc       = $post_image->post_content;
						echo '<a class="image-popup" target="_blank" href="' . $src_full . '" data-caption="' . esc_attr( $caption ) . '" data-desc="' . esc_attr( $desc ) . '"><img class="erm_product_image" alt="' . esc_attr( $alt ) . '" src="' . $src_thumb . '"></a>';
					}
					echo '<h3 class="erm_product_title"><span>' . $post->post_title . '</span></h3>';
					echo '<div class="erm_product_desc">' . apply_filters( 'the_content', $post->post_content ) . '</div>';
					echo '</div>';
					if ( !empty( $prices ) ) {
						echo '<div class="erm_product_price">';
						echo '<ul>';
						foreach ( $prices as $price ) {
							echo '<li>';
							//echo '<span class="name">' . $price['name'] . '</span></li>';
							echo '<span class="name">' . __( 'Price', 'thim' ) . '</span>';
							if ( $price['value'] ) {
								echo '<span class="price">' . apply_filters( 'erm_filter_price', $price['value'] ) . '</span>';
							}
							echo '</li>';
						}
						echo '</ul>';
						echo '</div>';
					}
					echo '</div>';
					echo '</li>';
				}
			}
		}
		wp_reset_query();
		echo '</ul>';
		echo '</div>';
	}
	echo '</div>';
	$k ++;
}
echo '</div>';
?>
