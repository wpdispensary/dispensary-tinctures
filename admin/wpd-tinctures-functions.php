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
 * @since 1.5
 */
function wpd_tinctures_prices_simple() {

	// Get currency code.
	$currency_code = wpd_currency_code();

	// Get prices.
	$price_each     = get_post_meta( get_the_ID(), '_priceeach', true );
	$price_per_pack = get_post_meta( get_the_ID(), '_priceperpack', true );

	/**
	 * Price output - if only one price has been added
	 */
	if ( '' === $price_each && '' != $price_per_pack ) {
		$pricing = $currency_code . $price_per_pack;
	} elseif ( '' != $price_each && '' === $price_per_pack ) {
		$pricing = $currency_code . $price_each;
	} else {
		$pricing = '';
	}

	/**
	 * Price output - if no prices have been added
	 */
	if ( '' === $price_each && '' === $price_per_pack ) {
		$pricing = ' ';
	}

	/**
	 * Return Pricing Prices.
	 */
	if ( '' != $price_each && '' != $price_per_pack ) {
		return $currency_code . $price_each . ' - ' . $currency_code . $price_per_pack;
	} elseif ( ' ' === $pricing ) {
		return '';
	} else {
		return $pricing;
	}

}
