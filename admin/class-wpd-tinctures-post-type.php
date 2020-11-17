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
if ( ! function_exists( 'wp_dispensary_tinctures' ) ) {

/** Register Custom Post Type */
function wp_dispensary_tinctures() {

	// Get permalink base for Tinctures.
	$wpd_tinctures_slug = get_option( 'wpd_tinctures_slug' );

	// If custom base is empty, set default.
	if ( '' == $wpd_tinctures_slug ) {
		$wpd_tinctures_slug = 'tinctures';
	}

	// Capitalize first letter of new slug.
	$wpd_tinctures_slug_cap = ucfirst( $wpd_tinctures_slug );

	/**
	 * Defining variables
	 */
	$rewrite = array(
		'slug'       => $wpd_tinctures_slug,
		'with_front' => true,
		'pages'      => true,
		'feeds'      => true,
	);

	$labels = array(
		'name'                  => sprintf( esc_html__( '%s', 'Post Type General Name', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'singular_name'         => sprintf( esc_html__( '%s', 'Post Type Singular Name', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'menu_name'             => sprintf( esc_html__( '%s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'name_admin_bar'        => sprintf( esc_html__( '%s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'archives'              => sprintf( esc_html__( '%s Archives', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'parent_item_colon'     => sprintf( esc_html__( 'Parent %s:', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'all_items'             => sprintf( esc_html__( 'All %s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'add_new_item'          => sprintf( esc_html__( 'Add New %s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'add_new'               => esc_html__( 'Add New', 'wpd-tinctures' ),
		'new_item'              => sprintf( esc_html__( 'New %s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'edit_item'             => sprintf( esc_html__( 'Edit %s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'update_item'           => sprintf( esc_html__( 'Update %s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'view_item'             => sprintf( esc_html__( 'View %s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'search_items'          => sprintf( esc_html__( 'Search %s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'not_found'             => esc_html__( 'Not found', 'wpd-tinctures' ),
		'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'wpd-tinctures' ),
		'featured_image'        => esc_html__( 'Featured Image', 'wpd-tinctures' ),
		'set_featured_image'    => esc_html__( 'Set featured image', 'wpd-tinctures' ),
		'remove_featured_image' => esc_html__( 'Remove featured image', 'wpd-tinctures' ),
		'use_featured_image'    => esc_html__( 'Use as featured image', 'wpd-tinctures' ),
		'insert_into_item'      => sprintf( esc_html__( 'Insert into %s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'uploaded_to_this_item' => sprintf( esc_html__( 'Uploaded to this %s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'items_list'            => sprintf( esc_html__( '%s list', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'items_list_navigation' => sprintf( esc_html__( '%s list navigation', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'filter_items_list'     => sprintf( esc_html__( 'Filter %s list', 'wpd-tinctures' ), $wpd_tinctures_slug ),
	);
	$args = array(
		'label'               => sprintf( esc_html__( '%s', 'wpd-tinctures' ), $wpd_tinctures_slug_cap ),
		'description'         => sprintf( esc_html__( 'Display the %s from your menu', 'wpd-tinctures' ), $wpd_tinctures_slug ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'          => array(),
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
add_action( 'init', 'wp_dispensary_tinctures', 0 );

}

/**
 * Function to add admin screen thumbnails to "Tinctures" menu type
 *
 * @since    1.2.0
 */
function wpd_tinctures_admin_screen_thumbnails( $array ) {
    $array[] = 'tinctures';
    return $array;
}
add_filter( 'wpd_admin_screen_thumbnails', 'wpd_tinctures_admin_screen_thumbnails' );

/**
 * Update messages for Tinctures.
 * 
 * @since 1.5
 */
function wpd_tinctures_updated_messages( $messages ) {
	if ( 'tinctures' === get_post_type() ) {

		// Get permalink base for Tinctures.
		$wpd_tinctures_slug = get_option( 'wpd_tinctures_slug' );

		// If custom base is empty, set default.
		if ( '' == $wpd_tinctures_slug ) {
			$wpd_tinctures_slug = 'tincture';
		}

		// Capitalize first letter of new slug.
		$wpd_tinctures_slug_cap = ucfirst( $wpd_tinctures_slug );

		$messages['post'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => sprintf( __( '%s updated. <a href="%s">View %s</a>' ), $wpd_tinctures_slug_cap, esc_url( get_permalink( $post_ID ) ), $wpd_tinctures_slug ),
			2 => esc_html__( 'Custom field updated.', 'wpd-tinctures' ),
			3 => esc_html__( 'Custom field deleted.', 'wpd-tinctures' ),
			4 => sprintf( __( '%s updated.' ), $wpd_tinctures_slug_cap ),
			5 => isset( $_GET['revision'] ) ? sprintf( __( '%s restored to revision from %s' ), $wpd_tinctures_slug_cap, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __( '%s published. <a href="%s">View %s</a>' ), $wpd_tinctures_slug_cap, esc_url( get_permalink( $post_ID ) ), $wpd_tinctures_slug ),
			7 => sprintf( __( '%s saved.' ), $wpd_tinctures_slug_cap ),
			8 => sprintf( __( '%s submitted. <a target="_blank" href="%s">Preview %s</a>' ), $wpd_tinctures_slug_cap, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ), $wpd_tinctures_slug ),
			9 => sprintf( __( '%s scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview %s</a>' ),
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ), $wpd_tinctures_slug ),
			10 => sprintf( __( '%s draft updated. <a target="_blank" href="%s">Preview %s</a>' ), $wpd_tinctures_slug_cap, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ), $wpd_tinctures_slug ),
		);
	}

	return $messages;
}
add_filter( 'post_updated_messages', 'wpd_tinctures_updated_messages' );
