<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.wpdispensary.com/
 * @since      1.0.0
 *
 * @package    WPD_Tinctures
 * @subpackage WPD_Tinctures/admin
 */

/**
 * Adding featured image URL's to Tinctures Custom Post Type
 */
function wpd_tinctures_featuredimage( $data, $post, $request ) {
	$_data                       = $data->data;
	$thumbnail_id                = get_post_thumbnail_id( $post->ID );
	$thumbnail                   = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data                  = $_data;
	return $data;
}
add_filter( 'rest_prepare_tinctures', 'wpd_tinctures_featuredimage', 10, 3 );

/**
 * Add Category taxonomy for the Tinctures Custom Post Type
 */
function wpd_tinctures_category( $data, $post, $request ) {
	$_data                           = $data->data;
	$_data['wpd_tinctures_category'] = get_the_term_list( $post->ID, 'wpd_tinctures_category', '', ' ', '' );
	$data->data                      = $_data;
	return $data;
}
add_filter( 'rest_prepare_tinctures', 'wpd_tinctures_category', 10, 3 );

/**
 * This adds the wpdispensary_prices metafields to the
 * API callback for tinctures
 *
 * @since    1.1.0
 */

add_action( 'rest_api_init', 'slug_register_wpd_tinctures_prices' );

/**
 * Registering Prices
 */
function slug_register_wpd_tinctures_prices() {
	$productsizes = array( '_priceeach', '_priceperpack', '_unitsperpack' );
	foreach ( $productsizes as $size ) {
		register_rest_field(
			array( 'tinctures' ),
			$size,
			array(
				'get_callback'    => 'slug_get_wpd_tinctures_prices',
				'update_callback' => 'slug_update_wpd_tinctures_prices',
				'schema'          => null,
			)
		);
	} /** /foreach */
}

/**
 * Get Prices
 */
function slug_get_wpd_tinctures_prices( $object, $field_name, $request ) {
	return get_post_meta( $object['id'], $field_name, true );
}

/**
 * Update Prices
 */
function slug_update_wpd_tinctures_prices( $value, $object, $field_name ) {
    return update_post_meta( $object[ 'id' ], $field_name, $value );
}
