<?php


if ( ! function_exists( 'woo_ub_taxonomy' ) ) {

	// Register Custom Taxonomy
	function woo_ub_taxonomy() {

		$labels = array(
			'name'                       => _x( 'Brands', 'Taxonomy General Name', 'woo-ub' ),
			'singular_name'              => _x( 'Brand', 'Taxonomy Singular Name', 'woo-ub' ),
			'menu_name'                  => __( 'Brands', 'woo-ub' ),
			'all_items'                  => __( 'All Brands', 'woo-ub' ),
			'parent_item'                => __( 'Parent Brand', 'woo-ub' ),
			'parent_item_colon'          => __( 'Parent Brand:', 'woo-ub' ),
			'new_item_name'              => __( 'New Brand Name', 'woo-ub' ),
			'add_new_item'               => __( 'Add New Brand', 'woo-ub' ),
			'edit_item'                  => __( 'Edit Brand', 'woo-ub' ),
			'update_item'                => __( 'Update Brand', 'woo-ub' ),
			'view_item'                  => __( 'View Brand', 'woo-ub' ),
			'separate_items_with_commas' => __( 'Separate Brands with commas', 'woo-ub' ),
			'add_or_remove_items'        => __( 'Add or remove Brands', 'woo-ub' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'woo-ub' ),
			'popular_items'              => __( 'Popular Brands', 'woo-ub' ),
			'search_items'               => __( 'Search Brands', 'woo-ub' ),
			'not_found'                  => __( 'Not Found', 'woo-ub' ),
			'no_terms'                   => __( 'No Brands', 'woo-ub' ),
			'items_list'                 => __( 'Brands list', 'woo-ub' ),
			'items_list_navigation'      => __( 'Brands list navigation', 'woo-ub' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'update_count_callback'      => 'update_count_callback',
			'show_in_rest'               => true,
		);
		register_taxonomy( 'brands', array( 'product' ), $args );

	}
	add_action( 'init', 'woo_ub_taxonomy', 0 );

}