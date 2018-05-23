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

add_action( 'init', 'wpdispensary_tincturescategory', 0 );

/**
 * Tinctures category
 */
function wpdispensary_tincturescategory() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'not_found'         => 'No categories found',
		'menu_name'         => __( 'Categories' ),
	);

	register_taxonomy( 'wpd_tinctures_category', 'tinctures', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => false,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'tinctures/category',
			'with_front' => false,
		),
	) );

}

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
