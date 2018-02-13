<?php

/**
 * The metabox functionality of the plugin.
 *
 * @link       https://www.wpdispensary.com/
 * @since      1.0.0
 *
 * @package    WPD_Tinctures
 * @subpackage WPD_Tinctures/admin
 */

/**
 * Prices metabox for the Tinctures menu type
 *
 * Adds a price metabox
 *
 * @since    1.0.0
 */
function wpd_tinctures_pricing_metaboxes() {

	$screens = array( 'tinctures' );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpd_tinctures_prices',
			__( 'Product Pricing', 'wp-dispensary' ),
			'wpd_tinctures_prices',
			$screen,
			'normal',
			'default'
		);
	}

}

add_action( 'add_meta_boxes', 'wpd_tinctures_pricing_metaboxes' );

/**
 * Single Prices
 */
function wpd_tinctures_prices() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="tincturespricesmeta_noncename" id="tincturespricesmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the prices data if its already been entered */
	$priceeach    = get_post_meta( $post->ID, '_priceeach', true );
	$priceperpack = get_post_meta( $post->ID, '_priceperpack', true );
	$unitsperpack = get_post_meta( $post->ID, '_unitsperpack', true );

	/** Echo out the fields */
	echo '<p>Price per unit:</p>';
	echo '<input type="text" name="_priceeach" value="' . esc_html( $priceeach ) . '" class="widefat" />';

	/** Echo out the fields */
	echo '<p>Price per pack:</p>';
	echo '<input type="text" name="_priceperpack" value="' . esc_html( $priceperpack ) . '" class="widefat" />';

	/** Echo out the fields */
	echo '<p>Units per pack:</p>';
	echo '<input type="number" name="_unitsperpack" value="' . esc_html( $unitsperpack ) . '" class="widefat" />';

}

/**
 * Save the Metabox Data
 */
function wpd_tinctures_prices_save_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if ( ! wp_verify_nonce( $_POST['tincturespricesmeta_noncename'], plugin_basename( __FILE__ ) ) ) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$prices_meta['_priceeach']    = $_POST['_priceeach'];
	$prices_meta['_priceperpack'] = $_POST['_priceperpack'];
	$prices_meta['_unitsperpack'] = $_POST['_unitsperpack'];

	/** Add values of $prices_meta as custom fields */

	foreach ( $prices_meta as $key => $value ) { /** Cycle through the $prices_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); /** If $value is an array, make it a CSV (unlikely) */
		if ( get_post_meta( $post->ID, $key, false ) ) { /** If the custom field already has a value */
			update_post_meta( $post->ID, $key, $value );
		} else { /** If the custom field doesn't have a value */
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}

add_action( 'save_post', 'wpd_tinctures_prices_save_meta', 1, 2 ); /** Save the custom fields */
