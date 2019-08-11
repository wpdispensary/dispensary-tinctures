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
	// Get permalink base for Tinctures.
	$wpd_tinctures_slug = get_option( 'wpd_tinctures_slug' );

	// If custom base is empty, set default.
	if ( '' == $wpd_tinctures_slug ) {
		$wpd_tinctures_slug = 'tinctures';
	}

	// Capitalize first letter of new slug.
	$wpd_tinctures_slug_cap = ucfirst( $wpd_tinctures_slug );

	/* Attributes */
	extract( shortcode_atts(
		array(
			'posts'    => '100',
			'class'    => '',
			'name'     => 'show',
			'info'     => 'show',
			'title'    => $wpd_tinctures_slug_cap,
			'image'    => 'show',
			'imgsize'  => 'dispensary-image',
			'orderby'  => '',
			'meta_key' => '',
			'viewall'  => '',
		),
		$atts,
		'wpd_tinctures'
	) );

	// Variables.
	$order    = '';
	$ordernew = '';

	// Order by.
	if ( '' !== $orderby ) {
		$order    = $orderby;
		$ordernew = 'ASC';
	}

	/**
	 * Code to create shortcode for Dispensary Tinctures
	 */
	$wpdquery = new WP_Query(
		array(
			'post_type'      => 'tinctures',
			'posts_per_page' => $posts,
			'orderby'        => $order,
			'order'          => $ordernew,
			'meta_key'       => $meta_key,
		)
	);

	if ( 'show' === $viewall ) {
		$tinctureslink = get_bloginfo( 'url' ) . '/tinctures/';
		$viewtinctures = '<span class="wp-dispensary-view-all"><a href="' . apply_filters( 'wpd_tinctures_shortcode_view_all', $tinctureslink ) .'">(view all)</a></span>';
	} else {
		$viewtinctures = '';
	}

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">' . $title . $viewtinctures . '</h2>';

	while ( $wpdquery->have_posts() ) : $wpdquery->the_post();

		/** Check shortcode options input by user */

		if ( 'show' == $name ) {
			$showname = '<h2 class="wpd-producttitle"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
		} else {
			$showname = '';
		}

		if ( 'tinctures' == get_post_type() ) {
			if ( 'show' == $info ) {
				$showinfo = get_wpd_tinctures_prices_simple( get_the_ID(), TRUE );
			} else {
				$showinfo = '';
			}
		} else {
			// Do nothing.
		}

		if ( '' === $imgsize ) {
			$image_size = 'dispensary-image';
		} else {
			$image_size = $imgsize;
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

		$wpdposts .= '<div class="wpdshortcode wpd-tinctures ' . $class .'">'. $wpd_shortcode_top_tinctures . $wpd_shortcode_inside_top . get_wpd_product_image( get_the_ID(), $image_size );

		ob_start();
			do_action( 'wpd_shortcode_bottom_tinctures' );
			$wpd_shortcode_bottom_tinctures = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $wpd_shortcode_inside_bottom . $wpd_shortcode_bottom_tinctures .'</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';
}
add_shortcode( 'wpd-tinctures', 'wpdispensary_tinctures_shortcode' );
