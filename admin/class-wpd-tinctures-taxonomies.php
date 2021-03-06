<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.wpdispensary.com/
 * @since      1.0.0
 *
 * @package    WPD_Tinctures
 * @subpackage WPD_Tinctures/admin
 */

/**
 * Tinctures Category Taxonomy
 *
 * Adds the Tinctures Category taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_tinctures_category() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'wpd-tinctures' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'wpd-tinctures' ),
		'search_items'      => esc_html__( 'Search Categories', 'wpd-tinctures' ),
		'all_items'         => esc_html__( 'All Categories', 'wpd-tinctures' ),
		'parent_item'       => esc_html__( 'Parent Category', 'wpd-tinctures' ),
		'parent_item_colon' => esc_html__( 'Parent Category:', 'wpd-tinctures' ),
		'edit_item'         => esc_html__( 'Edit Category', 'wpd-tinctures' ),
		'update_item'       => esc_html__( 'Update Category', 'wpd-tinctures' ),
		'add_new_item'      => esc_html__( 'Add New Category', 'wpd-tinctures' ),
		'new_item_name'     => esc_html__( 'New Category Name', 'wpd-tinctures' ),
		'not_found'         => esc_html__( 'No categories found', 'wpd-tinctures' ),
		'menu_name'         => esc_html__( 'Categories', 'wpd-tinctures' ),
	);

	register_taxonomy( 'wpd_tinctures_category', 'tinctures', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'tinctures/category',
			'with_front' => false,
		),
	) );

}
add_action( 'init', 'wp_dispensary_tinctures_category', 0 );

/**
 * Function to add ingredients taxonomy to "Tinctures" menu type
 *
 * @since    1.1.0
 */
function wpd_tinctures_ingredients( $array ) {
    $array[] = 'tinctures';
    return $array;
}
add_filter( 'wpd_ingredients_tax_type', 'wpd_tinctures_ingredients' );

/**
 * Function to add vendor taxonomy to "Tinctures" menu type
 *
 * @since    1.1.0
 */
function wpd_tinctures_vendor( $array ) {
    $array[] = 'tinctures';
    return $array;
}
add_filter( 'wpd_vendor_tax_type', 'wpd_tinctures_vendor' );

/**
 * Function to add allergens taxonomy to "Tinctures" menu type
 *
 * @since    1.4.0
 */
function wpd_tinctures_allergens( $array ) {
    $array[] = 'tinctures';
    return $array;
}
add_filter( 'wpd_allergens_tax_type', 'wpd_tinctures_allergens' );
