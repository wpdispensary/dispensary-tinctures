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
 * Tinctures post type creation
 *
 * @since	   1.0.0
 */
if ( ! function_exists( 'wpdispensary_tinctures' ) ) {

/** Register Custom Post Type */
function wpdispensary_tinctures() {

	$labels = array(
		'name'                  => _x( 'Tinctures', 'Post Type General Name', 'wpd-tinctures' ),
		'singular_name'         => _x( 'Tincture', 'Post Type Singular Name', 'wpd-tinctures' ),
		'menu_name'             => __( 'Tinctures', 'wpd-tinctures' ),
		'name_admin_bar'        => __( 'Tinctures', 'wpd-tinctures' ),
		'archives'              => __( 'Tinctures Archives', 'wpd-tinctures' ),
		'parent_item_colon'     => __( 'Parent Tincture:', 'wpd-tinctures' ),
		'all_items'             => __( 'All Tinctures', 'wpd-tinctures' ),
		'add_new_item'          => __( 'Add New Tincture', 'wpd-tinctures' ),
		'add_new'               => __( 'Add New', 'wpd-tinctures' ),
		'new_item'              => __( 'New Tincture', 'wpd-tinctures' ),
		'edit_item'             => __( 'Edit Tincture', 'wpd-tinctures' ),
		'update_item'           => __( 'Update Tincture', 'wpd-tinctures' ),
		'view_item'             => __( 'View Tincture', 'wpd-tinctures' ),
		'search_items'          => __( 'Search Tinctures', 'wpd-tinctures' ),
		'not_found'             => __( 'Not found', 'wpd-tinctures' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wpd-tinctures' ),
		'featured_image'        => __( 'Featured Image', 'wpd-tinctures' ),
		'set_featured_image'    => __( 'Set featured image', 'wpd-tinctures' ),
		'remove_featured_image' => __( 'Remove featured image', 'wpd-tinctures' ),
		'use_featured_image'    => __( 'Use as featured image', 'wpd-tinctures' ),
		'insert_into_item'      => __( 'Insert into Tinctures', 'wpd-tinctures' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Tinctures', 'wpd-tinctures' ),
		'items_list'            => __( 'Tinctures list', 'wpd-tinctures' ),
		'items_list_navigation' => __( 'Tinctures list navigation', 'wpd-tinctures' ),
		'filter_items_list'     => __( 'Filter tinctures list', 'wpd-tinctures' ),
	);
	$args = array(
		'label'               => __( 'Tinctures', 'wpd-tinctures' ),
		'description'         => __( 'Display your dispensary tinctures', 'wpd-tinctures' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'          => array( ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'show_in_rest'        => true,
		'menu_position'       => 10,
		'menu_icon'           => plugin_dir_url( __FILE__ ) . ( '../images/menu-icon.png' ),
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'tinctures', $args );

}
add_action( 'init', 'wpdispensary_tinctures', 0 );

}

function wpd_tinctures_add_admin_menu() {
	add_submenu_page( 'wpd-settings', 'WP Dispensary\'s Tinctures', 'Tinctures', 'manage_options', 'edit.php?post_type=tinctures', NULL );
}
add_action( 'admin_menu', 'wpd_tinctures_add_admin_menu', 11 );
