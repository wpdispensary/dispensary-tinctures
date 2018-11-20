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
function get_wpd_tinctures_prices_simple( $id = NULL, $phrase = NULL ) {

    global $post;

	// Get currency code.
	$currency_code = wpd_currency_code();

	// Get prices.
	$price_each     = get_post_meta( get_the_ID(), '_priceeach', true );
	$price_per_pack = get_post_meta( get_the_ID(), '_priceperpack', true );
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

}
