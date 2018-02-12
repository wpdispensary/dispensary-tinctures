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
 * Tinctures Shortcode Fuction
 */
function wpdispensary_tinctures_shortcode( $atts ) {

	/* Attributes */
	extract( shortcode_atts(
		array(
			'posts'   => '100',
			'class'   => '',
			'name'    => 'show',
			'info'    => 'show',
			'title'   => 'Tinctures',
			'image'   => 'show',
			'imgsize' => 'dispensary-image',
			'viewall' => '',
		),
		$atts
	) );

	/**
	 * Code to create shortcode for Dispensary Tinctures
	 */
	$wpdquery = new WP_Query(
		array(
			'post_type'      => 'tinctures',
			'posts_per_page' => $posts,
		)
	);

	if ( 'show' === $viewall ) {
		$tinctureslink = get_bloginfo( 'home' ) . '/tinctures/';
		$viewtinctures = '<span class="wp-dispensary-view-all"><a href="' . apply_filters( 'wpd_tinctures_shortcode_view_all', $tinctureslink ) .'">(view all)</a></span>';
	} else {
		$viewtinctures = '';
	}

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">'. $title .'' . $viewtinctures .'</h2>';

	while ( $wpdquery->have_posts() ) : $wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		$wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); // Array of All Options.
		if ( ! isset( $wp_dispensary_options['wpd_hide_details'] ) ) {
			$wpd_hide_details = '';
		} else {
			$wpd_hide_details = $wp_dispensary_options['wpd_hide_details'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_hide_pricing'] ) ) {
			$wpd_hide_pricing = '';
		} else {
			$wpd_hide_pricing = $wp_dispensary_options['wpd_hide_pricing'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_content_placement'] ) ) {
			$wpd_content_placement = '';
		} else {
			$wpd_content_placement = $wp_dispensary_options['wpd_content_placement'];
		}
		if ( null === $wp_dispensary_options['wpd_currency'] ) {
			$wpd_currency = 'USD';
		} else {
			$wpd_currency = $wp_dispensary_options['wpd_currency'];
		}
		if ( null === $wp_dispensary_options['wpd_cost_phrase'] ) {
			$wpd_cost_phrase = 'Price';
		} else {
			$wpd_cost_phrase = $wp_dispensary_options['wpd_cost_phrase']; // costphrase.
		}

		$currency_symbols = array(
			'AED' => '&#1583;.&#1573;', // ?
			'AFN' => '&#65;&#102;',
			'ALL' => '&#76;&#101;&#107;',
			'AMD' => '',
			'ANG' => '&#402;',
			'AOA' => '&#75;&#122;', // ?
			'ARS' => '&#36;',
			'AUD' => '&#36;',
			'AWG' => '&#402;',
			'AZN' => '&#1084;&#1072;&#1085;',
			'BAM' => '&#75;&#77;',
			'BBD' => '&#36;',
			'BDT' => '&#2547;', // ?
			'BGN' => '&#1083;&#1074;',
			'BHD' => '.&#1583;.&#1576;', // ?
			'BIF' => '&#70;&#66;&#117;', // ?
			'BMD' => '&#36;',
			'BND' => '&#36;',
			'BOB' => '&#36;&#98;',
			'BRL' => '&#82;&#36;',
			'BSD' => '&#36;',
			'BTN' => '&#78;&#117;&#46;', // ?
			'BWP' => '&#80;',
			'BYR' => '&#112;&#46;',
			'BZD' => '&#66;&#90;&#36;',
			'CAD' => '&#36;',
			'CDF' => '&#70;&#67;',
			'CHF' => '&#67;&#72;&#70;',
			'CLF' => '', // ?
			'CLP' => '&#36;',
			'CNY' => '&#165;',
			'COP' => '&#36;',
			'CRC' => '&#8353;',
			'CUP' => '&#8396;',
			'CVE' => '&#36;', // ?
			'CZK' => '&#75;&#269;',
			'DJF' => '&#70;&#100;&#106;', // ?
			'DKK' => '&#107;&#114;',
			'DOP' => '&#82;&#68;&#36;',
			'DZD' => '&#1583;&#1580;', // ?
			'EGP' => '&#163;',
			'ETB' => '&#66;&#114;',
			'EUR' => '&#8364;',
			'FJD' => '&#36;',
			'FKP' => '&#163;',
			'GBP' => '&#163;',
			'GEL' => '&#4314;', // ?
			'GHS' => '&#162;',
			'GIP' => '&#163;',
			'GMD' => '&#68;', // ?
			'GNF' => '&#70;&#71;', // ?
			'GTQ' => '&#81;',
			'GYD' => '&#36;',
			'HKD' => '&#36;',
			'HNL' => '&#76;',
			'HRK' => '&#107;&#110;',
			'HTG' => '&#71;', // ?
			'HUF' => '&#70;&#116;',
			'IDR' => '&#82;&#112;',
			'ILS' => '&#8362;',
			'INR' => '&#8377;',
			'IQD' => '&#1593;.&#1583;', // ?
			'IRR' => '&#65020;',
			'ISK' => '&#107;&#114;',
			'JEP' => '&#163;',
			'JMD' => '&#74;&#36;',
			'JOD' => '&#74;&#68;', // ?
			'JPY' => '&#165;',
			'KES' => '&#75;&#83;&#104;', // ?
			'KGS' => '&#1083;&#1074;',
			'KHR' => '&#6107;',
			'KMF' => '&#67;&#70;', // ?
			'KPW' => '&#8361;',
			'KRW' => '&#8361;',
			'KWD' => '&#1583;.&#1603;', // ?
			'KYD' => '&#36;',
			'KZT' => '&#1083;&#1074;',
			'LAK' => '&#8365;',
			'LBP' => '&#163;',
			'LKR' => '&#8360;',
			'LRD' => '&#36;',
			'LSL' => '&#76;', // ?
			'LTL' => '&#76;&#116;',
			'LVL' => '&#76;&#115;',
			'LYD' => '&#1604;.&#1583;', // ?
			'MAD' => '&#1583;.&#1605;.', // ?
			'MDL' => '&#76;',
			'MGA' => '&#65;&#114;', // ?
			'MKD' => '&#1076;&#1077;&#1085;',
			'MMK' => '&#75;',
			'MNT' => '&#8366;',
			'MOP' => '&#77;&#79;&#80;&#36;', // ?
			'MRO' => '&#85;&#77;', // ?
			'MUR' => '&#8360;', // ?
			'MVR' => '.&#1923;', // ?
			'MWK' => '&#77;&#75;',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'MZN' => '&#77;&#84;',
			'NAD' => '&#36;',
			'NGN' => '&#8358;',
			'NIO' => '&#67;&#36;',
			'NOK' => '&#107;&#114;',
			'NPR' => '&#8360;',
			'NZD' => '&#36;',
			'OMR' => '&#65020;',
			'PAB' => '&#66;&#47;&#46;',
			'PEN' => '&#83;&#47;&#46;',
			'PGK' => '&#75;', // ?
			'PHP' => '&#8369;',
			'PKR' => '&#8360;',
			'PLN' => '&#122;&#322;',
			'PYG' => '&#71;&#115;',
			'QAR' => '&#65020;',
			'RON' => '&#108;&#101;&#105;',
			'RSD' => '&#1044;&#1080;&#1085;&#46;',
			'RUB' => '&#1088;&#1091;&#1073;',
			'RWF' => '&#1585;.&#1587;',
			'SAR' => '&#65020;',
			'SBD' => '&#36;',
			'SCR' => '&#8360;',
			'SDG' => '&#163;', // ?
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'SHP' => '&#163;',
			'SLL' => '&#76;&#101;', // ?
			'SOS' => '&#83;',
			'SRD' => '&#36;',
			'STD' => '&#68;&#98;', // ?
			'SVC' => '&#36;',
			'SYP' => '&#163;',
			'SZL' => '&#76;', // ?
			'THB' => '&#3647;',
			'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
			'TMT' => '&#109;',
			'TND' => '&#1583;.&#1578;',
			'TOP' => '&#84;&#36;',
			'TRY' => '&#8356;', // New Turkey Lira (old symbol used).
			'TTD' => '&#36;',
			'TWD' => '&#78;&#84;&#36;',
			'TZS' => '',
			'UAH' => '&#8372;',
			'UGX' => '&#85;&#83;&#104;',
			'USD' => '&#36;',
			'UYU' => '&#36;&#85;',
			'UZS' => '&#1083;&#1074;',
			'VEF' => '&#66;&#115;',
			'VND' => '&#8363;',
			'VUV' => '&#86;&#84;',
			'WST' => '&#87;&#83;&#36;',
			'XAF' => '&#70;&#67;&#70;&#65;',
			'XCD' => '&#36;',
			'XDR' => '',
			'XOF' => '',
			'XPF' => '&#70;',
			'YER' => '&#65020;',
			'ZAR' => '&#82;',
			'ZMK' => '&#90;&#75;', // ?
			'ZWL' => '&#90;&#36;',
		);

		if( get_post_type() == 'tinctures' ) {
			if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
				$pricingeach = '<strong>'. $wpd_cost_phrase .':</strong> $' . get_post_meta( get_the_id(), '_priceeach', true ) . ' each';
			}
			if ( get_post_meta( get_the_ID(), '_priceperpack', true ) ) {
				$pricingperpack = ' &middot; ' . get_post_meta( get_the_id(), '_unitsperpack', true ) . ' for $' . get_post_meta( get_the_id(), '_priceperpack', true ) . '';
			}
		}

		/** Check shortcode options input by user */

		if ( $name == "show" ) {
			$showname = '<p><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if( get_post_type() == 'tinctures' ) {
			if ( $info == "show" ) {
				$showinfo = '<span class="wpd-productinfo">' . $pricingeach . '' . $pricingperpack . '</span>';
			} else {
				$showinfo = '';
			}
		}

		if ( 'show' === $image ) {
			if ( null === $thumbnail_url && 'full' === $imagesize ) {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/wpd-large.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="Menu - Tinctures" /></a>';
			} elseif ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Tinctures" /></a>';
			} else {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="Menu - Tinctures" /></a>';
			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_tinctures' );
			$wpd_shortcode_top_tinctures = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-tinctures ' . $class .'">'. $wpd_shortcode_top_tinctures .''. $wpd_shortcode_inside_top .''. $showimage;

		ob_start();
			do_action( 'wpd_shortcode_bottom_tinctures' );
			$wpd_shortcode_bottom_tinctures = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname .''. $showinfo .''. $wpd_shortcode_inside_bottom .''. $wpd_shortcode_bottom_tinctures .'</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-tinctures', 'wpdispensary_tinctures_shortcode' );
