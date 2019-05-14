<?php
/**
 * Adding the functions that are used throughout
 * various areas of the plugin
 *
 * @link       https://www.wpdispensary.com
 * @since      1.5.0
 *
 * @package    WPD_Tinctures
 * @subpackage WPD_Tinctures/admin
 */

/**
 * Tinctures Prices - Simple
 * 
 * @see get_wpd_tinctures_prices_simple()
 * @since 1.5
 * @return string
 */
function wpd_tinctures_prices_simple( $id = NULL, $phrase = NULL ) {
    // Filters the displayed flowers prices.
    echo apply_filters( 'wpd_tinctures_prices_simple', get_wpd_tinctures_prices_simple( $id, $phrase ) );
}

/**
 * Tinctures Prices - Get Simple
 * 
 * @since 1.5
 */
function get_wpd_tinctures_prices_simple( $product_id, $phrase = NULL ) {

    global $post;

	// Get currency code.
	$currency_code = wpd_currency_code();

	// Get prices.
	$price_each     = get_post_meta( $product_id, '_priceeach', true );
	$price_per_pack = get_post_meta( $product_id, '_priceperpack', true );
	$pricingsep     = '-';

	// Check if phrase is set in function.
	if ( TRUE == $phrase ) {
		$pricing_phrase = '<strong>' . get_wpd_pricing_phrase( TRUE ) . ':</strong> ';
	} else {
		$pricing_phrase = '';
	}

	/**
	 * Price output - if only one price has been added
	 */
	if ( '' != $price_each && '' != $price_per_pack ) {

		$pricing = $currency_code . $price_each . $pricingsep . $price_per_pack;
		$phrase_final = "<span class='wpd-productinfo pricing'>" . $pricing_phrase . $pricing . "</span>";

	} elseif ( '' === $price_each && '' != $price_per_pack ) {

		$pricing = $currency_code . $price_per_pack;
		$phrase_final = "<span class='wpd-productinfo pricing'>" . $pricing_phrase . $pricing . "</span>";

	} elseif ( '' != $price_each && '' === $price_per_pack ) {

		$pricing = $currency_code . $price_each;
		$phrase_final = "<span class='wpd-productinfo pricing'>" . $pricing_phrase . $pricing . "</span>";

	} else {
		$phrase_final = '';
	}

	/**
	 * Return Pricing Prices.
	 */
	return $phrase_final;

}

/**
 * Add tinctures categories to WPD eCommerce single item display
 * 
 * @since 1.6
 */
function wpd_tinctures_item_types() {

	// Set the product ID.
	$product_id = get_the_ID();

	// Display Tinctures Category.
	echo "<span class='wpd-ecommerce category tinctures'>" . get_the_term_list( $product_id, 'wpd_tinctures_category', '', ' ' ) . "</span>";
}
add_action( 'wpd_ecommerce_item_types_inside_after', 'wpd_tinctures_item_types' );

/**
 * Add tinctures to WP Dispensary menu types
 * 
 * @since 1.7
 */
function wpd_tinctures_menu_types( $menu_types ) {

	// Add tinctures.
	$menu_types['wpd-tinctures'] = __( 'Tinctures', 'wpd-tinctures' );

	return $menu_types;
}
add_filter( 'wpd_menu_types', 'wpd_tinctures_menu_types' );

/**
 * Add tinctures prices to get_wpd_all_prices_simple filter
 * 
 * @since 1.7
 */
function get_wpd_tinctures_prices_simple_filter( $str ) {

	// Add tinctures prices.
	if ( 'tinctures' == get_post_type( get_the_ID() ) ) {
		$str .= get_wpd_tinctures_prices_simple( $id = NULL, $phrase = NULL );
	}

	return $str;
}
add_filter( 'get_wpd_all_prices_simple', 'get_wpd_tinctures_prices_simple_filter' );

/**
 * Add tinctures to the wpd_compound_details_screens filter
 * 
 * @since 1.9
 */
function wpd_tinctures_compound_details_screens( $screens ) {
	$screens[] = 'tinctures';
	return $screens;
}
add_filter( 'wpd_compound_details_screens', 'wpd_tinctures_compound_details_screens' );

/**
 * Add tinctures to the wpd_data_output_compounds_table filter
 * 
 * @since 1.9
 */
function wpd_tinctures_data_output_compounds_table( $compounds_table ) {
	$compounds_table[] = 'tinctures';
	return $compounds_table;
}
add_filter( 'wpd_data_output_compounds_table', 'wpd_tinctures_data_output_compounds_table' );
