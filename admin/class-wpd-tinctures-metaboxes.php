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
			__( 'Product Pricing', 'wpd-tinctures' ),
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
	echo '<div class="tincturesbox">';
	echo '<p>' . __( 'Price per unit', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_priceeach" value="' . esc_html( $priceeach ) . '" class="widefat" />';
	echo '</div>';

	/** Echo out the fields */
	echo '<div class="tincturesbox">';
	echo '<p>' . __( 'Price per pack', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_priceperpack" value="' . esc_html( $priceperpack ) . '" class="widefat" />';
	echo '</div>';

	/** Echo out the fields */
	echo '<div class="tincturesbox">';
	echo '<p>' . __( 'Units per pack', 'wpd-tinctures' ) . '</p>';
	echo '<input type="number" name="_unitsperpack" value="' . esc_html( $unitsperpack ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpd_tinctures_prices_save_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if ( ! isset( $_POST['tincturespricesmeta_noncename' ] ) || ! wp_verify_nonce( $_POST['tincturespricesmeta_noncename'], plugin_basename( __FILE__ ) ) ) {
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


/**
 * Details metabox for the Tinctures menu type
 *
 * Adds a details metabox
 *
 * @since    1.0.0
 */
function wpd_tinctures_details_metaboxes() {

	$screens = array( 'tinctures' );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpd_tinctures_details',
			__( 'Tincture Details', 'wpd-tinctures' ),
			'wpd_tinctures_details',
			$screen,
			'normal',
			'default'
		);
	}

}

add_action( 'add_meta_boxes', 'wpd_tinctures_details_metaboxes' );

/**
 * Tincture Details
 */
function wpd_tinctures_details() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="tincturesdetailsmeta_noncename" id="tincturesdetailsmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the details data if its already been entered */
	$thcmg          = get_post_meta( $post->ID, '_thcmg', true );
	$cbdmg          = get_post_meta( $post->ID, '_cbdmg', true );
	$mlserving      = get_post_meta( $post->ID, '_mlserving', true );
	$thccbdservings = get_post_meta( $post->ID, '_thccbdservings', true );
	$netweight      = get_post_meta( $post->ID, '_netweight', true );

	/** Echo out the fields */
	echo '<div class="tincturesdetailsbox">';
	echo '<p>' . __( 'Servings', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_thccbdservings" value="' . esc_html( $thccbdservings ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="tincturesdetailsbox">';
	echo '<p>' . __( 'THC mg per serving', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_thcmg" value="' . esc_html( $thcmg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="tincturesdetailsbox">';
	echo '<p>' . __( 'CBD mg per serving', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_cbdmg" value="' . esc_html( $cbdmg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="tincturesdetailsbox">';
	echo '<p>' . __( 'mL per serving', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_mlserving" value="' . esc_html( $mlserving ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="tincturesdetailsbox">';
	echo '<p>' . __( 'Net weight (ounces)', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_netweight" value="' . esc_html( $netweight ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpd_tinctures_details_save_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if ( ! isset( $_POST['tincturesdetailsmeta_noncename' ] ) || ! wp_verify_nonce( $_POST['tincturesdetailsmeta_noncename'], plugin_basename( __FILE__ ) ) ) {
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

	$details_meta['_thcmg']          = $_POST['_thcmg'];
	$details_meta['_cbdmg']          = $_POST['_cbdmg'];
	$details_meta['_mlserving']      = $_POST['_mlserving'];
	$details_meta['_thccbdservings'] = $_POST['_thccbdservings'];
	$details_meta['_netweight']      = $_POST['_netweight'];

	/** Add values of $details_meta as custom fields */

	foreach ( $details_meta as $key => $value ) { /** Cycle through the $details_meta array! */
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

add_action( 'save_post', 'wpd_tinctures_details_save_meta', 1, 2 ); /** Save the custom fields */
