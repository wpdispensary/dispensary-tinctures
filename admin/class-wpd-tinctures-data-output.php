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
 * Function to add "Tinctures" to data output
 */
function wpd_tinctures_priceoutput( $array ) {
    $array[] = 'tinctures';
    return $array;
}
add_filter( 'wpd_original_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_content_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_dataoutput_before_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_dataoutput_title_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_dataoutput_top_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_dataoutput_bottom_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_dataoutput_end_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_dataoutput_after_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_pricingoutput_before_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_pricingoutput_title_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_pricingoutput_top_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_pricingoutput_bottom_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_pricingoutput_end_array', 'wpd_tinctures_priceoutput' );
add_filter( 'wpd_pricingoutput_after_array', 'wpd_tinctures_priceoutput' );

/**
 * Action Hooks
 *
 * This is the file responsible for adding the tinctures data to menu
 * item pricing tables.
 *
 * @since    1.0.0
 */

/** Tinctures Price Output */
add_action( 'wpd_pricingoutput_bottom', 'add_wpd_tinctures_price_data', 10 );
function add_wpd_tinctures_price_data() { ?>
<?php
if ( in_array( get_post_type(), array( 'tinctures' ) ) ) { ?>
	<?php if ( ! get_post_meta( get_the_ID(), '_priceeach', true ) ) { } else { ?>
		<tr class="priceeach"><td><span>Price Each:</span></td><td>$<?php echo get_post_meta( get_the_ID(), '_priceeach', true ); ?></td></tr>
	<?php } ?>
	<?php if ( ! get_post_meta( get_the_ID(), '_priceperpack', true ) ) { } else { ?>
		<tr class="priceeach"><td><span><?php echo get_post_meta( get_the_ID(), '_unitsperpack', true ); ?> per pack:</span></td><td>$<?php echo get_post_meta( get_the_ID(), '_priceperpack', true ); ?></td></tr>
	<?php } ?>
<?php }

} // function

/** Tinctures Categories Output */
add_action( 'wpd_dataoutput_bottom', 'wpd_tinctures_categories' );
function wpd_tinctures_categories() { ?>
	<?php if ( in_array( get_post_type(), array( 'tinctures' ) ) ) { ?>
		<tr><td><span>Categories:</span></td><td><?php echo get_the_term_list( $post->ID, 'wpd_tinctures_category', '', ', ' ); ?></td></tr>
	<?php } ?>
<?php }