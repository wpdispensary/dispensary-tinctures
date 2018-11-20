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
			'posts'   => '100',
			'class'   => '',
			'name'    => 'show',
			'info'    => 'show',
			'title'   => $wpd_tinctures_slug_cap,
			'image'   => 'show',
			'imgsize' => 'dispensary-image',
			'viewall' => '',
		),
		$atts,
		'wpd_tinctures'
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
		$tinctureslink = get_bloginfo( 'url' ) . '/tinctures/';
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

		// Access all WP Dispensary Display Settings.
		$wpd_settings = get_option( 'wpdas_display' );

		if ( get_post_type() == 'tinctures' ) {
			// Price.
			$tincturepricing = get_wpd_tinctures_prices_simple( NULL, TRUE );
		}

		/** Check shortcode options input by user */

		if ( $name == "show" ) {
			$showname = '<p><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( get_post_type() == 'tinctures' ) {
			if ( $info == "show" ) {
				$showinfo = $tincturepricing;
			} else {
				$showinfo = '';
			}
		}

		if ( 'show' === $image ) {
			if ( null === $thumbnail_url && 'full' === $imagesize ) {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/wpd-large.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu', 'wp-dispensary' ) . ' - ' . $wpd_tinctures_slug_cap . '" /></a>';
			} elseif ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="' . __( 'Menu', 'wp-dispensary' ) . ' - ' . $wpd_tinctures_slug_cap . '" /></a>';
			} else {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu', 'wp-dispensary' ) . ' - ' . $wpd_tinctures_slug_cap . '" /></a>';
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
