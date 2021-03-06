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
add_filter( 'wpd_pricing_table_placement_array', 'wpd_tinctures_priceoutput' );

/**
 * Action Hooks
 *
 * This is the file responsible for adding the tinctures data to menu
 * item pricing tables.
 *
 * @since    1.0.0
 */

/** Tinctures Price Output */
function add_wpd_tinctures_price_data() {
	if ( in_array( get_post_type(), array( 'tinctures' ) ) ) { ?>
		<?php if ( ! get_post_meta( get_the_ID(), '_priceeach', true ) ) { } else { ?>
			<tr class="priceeach"><td><span><?php esc_attr_e( 'Price', 'wpd-tinctures' ); ?></span></td><td><?php echo wpd_currency_code(); ?><?php echo get_post_meta( get_the_ID(), '_priceeach', true ); ?></td></tr>
		<?php } ?>
		<?php if ( ! get_post_meta( get_the_ID(), '_priceperpack', true ) ) { } else { ?>
			<tr class="priceeach"><td><span><?php esc_attr_e( get_post_meta( get_the_ID(), '_unitsperpack', true ) ); ?> <?php esc_attr_e( 'per pack', 'wpd-tinctures' ); ?></span></td><td><?php echo wpd_currency_code(); ?><?php echo get_post_meta( get_the_ID(), '_priceperpack', true ); ?></td></tr>
		<?php } ?>
	<?php }
}
add_action( 'wpd_pricingoutput_bottom', 'add_wpd_tinctures_price_data', 10 );

/** Tinctures Details Output */
function wpd_tinctures_details_data() {
	if ( in_array( get_post_type(), array( 'tinctures' ) ) ) { ?>
		<?php if ( ! get_post_meta( get_the_ID(), '_thccbdservings', true ) ) { } else { ?>
			<tr><td><span><?php esc_attr_e( 'Servings', 'wpd-tinctures' ); ?></span></td><td><?php echo get_post_meta( get_the_id(), '_thccbdservings', true ); ?></td></tr>
		<?php } ?>
		<?php if ( ! get_post_meta( get_the_ID(), '_thcmg', true ) ) { } else { ?>
			<tr><td><span><?php esc_attr_e( 'THC mg per serving', 'wpd-tinctures' ); ?></span></td><td><?php echo get_post_meta( get_the_id(), '_thcmg', true ); ?></td></tr>
		<?php } ?>
		<?php if ( ! get_post_meta( get_the_ID(), '_cbdmg', true ) ) { } else { ?>
			<tr><td><span><?php esc_attr_e( 'CBD mg per serving', 'wpd-tinctures' ); ?></span></td><td><?php echo get_post_meta( get_the_id(), '_cbdmg', true ); ?></td></tr>
		<?php } ?>
		<?php if ( ! get_post_meta( get_the_ID(), '_mlserving', true ) ) { } else { ?>
			<tr><td><span><?php esc_attr_e( 'mL per serving', 'wpd-tinctures' ); ?></span></td><td><?php echo get_post_meta( get_the_id(), '_mlserving', true ); ?></td></tr>
		<?php } ?>
		<?php if ( ! get_post_meta( get_the_ID(), '_netweight', true ) ) { } else { ?>
			<tr><td><span><?php esc_attr_e( 'Net weight', 'wpd-tinctures' ); ?></span></td><td><?php echo get_post_meta( get_the_id(), '_netweight', true ); ?> oz</td></tr>
		<?php } ?>
		<?php if ( ! is_plugin_active( 'wpd-ecommerce/wpd-ecommerce.php' ) ) { ?>
			<?php if ( ! get_the_term_list( get_the_ID(), 'wpd_tinctures_category', true ) ) { } else { ?>
				<tr><td><span><?php esc_attr_e( 'Categories', 'wpd-tinctures' ); ?></span></td><td><?php echo get_the_term_list( get_the_id(), 'wpd_tinctures_category', '', ', ' ); ?></td></tr>
			<?php } ?>
		<?php } ?>
	<?php } // if in_array
}
add_action( 'wpd_dataoutput_bottom', 'wpd_tinctures_details_data' );

/** Tinctures Ingredients Output */
function wpd_tinctures_ingredients_data() {
	global $post;
	if ( in_array( get_post_type(), array( 'tinctures' ) ) ) { ?>
		<?php if ( ! get_the_term_list( get_the_ID(), 'ingredients', true ) ) { } else { ?>
		<tr><td><span><?php esc_attr_e( 'Ingredients', 'wpd-tinctures' ); ?></span></td><td><?php echo get_the_term_list( $post->ID, 'ingredients', '', ', ' ); ?></td></tr>
		<?php } ?>
	<?php }
}
add_action( 'wpd_dataoutput_bottom', 'wpd_tinctures_ingredients_data' );

/** Tinctures Allergens Output */
function wpd_tinctures_allergens_data() {
	global $post;
	if ( in_array( get_post_type(), array( 'tinctures' ) ) ) { ?>
		<?php if ( ! get_the_term_list( get_the_ID(), 'allergens', true ) ) { } else { ?>
		<tr><td><span><?php esc_attr_e( 'Allergens', 'wpd-tinctures' ); ?></span></td><td><?php echo get_the_term_list( $post->ID, 'allergens', '', ', ' ); ?></td></tr>
		<?php } ?>
	<?php }
}
add_action( 'wpd_dataoutput_bottom', 'wpd_tinctures_allergens_data' );

/** Tinctures Vendors Output */
function wpd_tinctures_vendor_data() {
	global $post;
	if ( in_array( get_post_type(), array( 'tinctures' ) ) ) {
		if ( ! is_plugin_active( 'wpd-ecommerce/wpd-ecommerce.php' ) ) { ?>
			<?php if ( ! get_the_term_list( get_the_ID(), 'vendor', true ) ) { } else { ?>
			<tr><td><span><?php esc_attr_e( 'Vendors', 'wpd-tinctures' ); ?></span></td><td><?php echo get_the_term_list( $post->ID, 'vendor', '', ', ' ); ?></td></tr>
			<?php } ?>
		<?php } ?>
	<?php }
}
add_action( 'wpd_dataoutput_bottom', 'wpd_tinctures_vendor_data' );
