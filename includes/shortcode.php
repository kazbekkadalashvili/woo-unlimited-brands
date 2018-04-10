<?php


/**
 * Returns the parsed shortcode.
 *
 * @param array   {
 *     Attributes of the shortcode.
 *
 *     @type string $id ID of...
 * }
 * @param string  Shortcode content.
 *
 * @return string HTML content to display the shortcode.
 */
function woo_ub_single_shortcode( $atts = array()) {
	$atts = shortcode_atts( array(
		'slug' => '',
	), $atts, 'woo-single-brand' );


	// Get the current category ID, e.g. if we're on a category archive page
	$category = get_term_by( 'slug', $atts['slug'], 'brands', OBJECT, 'raw' );
	if (is_object($category)) {
		$cat_id = $category->term_id;
		// Get the image ID for the category
		$image_id = get_term_meta ( $cat_id, 'category-image-id', true );
		// Echo the image
		$image = wp_get_attachment_image ( $image_id, 'large' );
	}
	
	return $image;

	// do shortcode actions here
}
add_shortcode( 'woo-single-brand', 'woo_ub_single_shortcode' );


/**
 * Returns the parsed shortcode.
 *
 * @param array   {
 *     Attributes of the shortcode.
 *
 *     @type string $id ID of...
 * }
 * @param string  Shortcode content.
 *
 * @return string HTML content to display the shortcode.
 */
function woo_ub_slider_shortcode( $atts = array()) {
	$atts = shortcode_atts( array(
		'slidestoshow' => '6',
		'arrows' => true,
		'dots' => false,
		'speed' => 1
	), $atts, 'woo-brands-slider' );

	wp_enqueue_script('main-js');
	wp_localize_script('main-js','brandslider', $atts);
	

	$categorys = get_terms( 'brands', array(
								'hide_empty' => false,
							) );
	ob_start();
	?>
		<div class="customer-logos">
			<?php	
			foreach ((array)$categorys as $category) {
				if (is_object($category)) {
					$cat_id = $category->term_id;
					$image_id = get_term_meta( $cat_id, 'category-image-id', true );
					echo '<div><a href="' . get_term_link( $cat_id ) .'">' . wp_get_attachment_image ( $image_id, 'medium' ) . '</a></div>';
				}

				}
			?>
		</div>
	<?php
	$output = ob_get_clean();
	
	return $output;
}
add_shortcode( 'woo-brands-slider', 'woo_ub_slider_shortcode' );



/**
 * Returns the parsed shortcode.
 *
 * @param array   {
 *     Attributes of the shortcode.
 *
 *     @type string $id ID of...
 * }
 * @param string  Shortcode content.
 *
 * @return string HTML content to display the shortcode.
 */
function woo_ub_square_shortcode( $atts = array()) {
	$atts = shortcode_atts( array(
		'col' => '4',
	), $atts, 'woo-square-brands' );

	$categorys = get_terms( 'brands', array(
								'hide_empty' => false,
							) );
	ob_start();
	?>
	<div class="square">
		<ul class="square-logos group">
		<?php	
		foreach ((array)$categorys as $category) {
			if (is_object($category)) {
				$cat_id = $category->term_id;
				$image_id = get_term_meta( $cat_id, 'category-image-id', true );
				echo '<li class="col col-' . $atts['col'] .'"><a href="' . get_term_link( $cat_id ) . '">' . wp_get_attachment_image ( $image_id, 'medium', array( "class" => "square-element")) . '</a></li>';
			}

			}
		?>
		</ul>
	</div>
	<?php
	$output = ob_get_clean();
	
	return $output;
}
add_shortcode( 'woo-square-brands', 'woo_ub_square_shortcode' );