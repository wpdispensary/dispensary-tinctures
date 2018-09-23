<?php

/**
 * The Class responsible for defining the custom permalink settings.
 *
 * @link       https://www.wpdispensary.com/
 * @since      1.3.0
 *
 * @package    WPD_Tinctures
 * @subpackage WPD_Tinctures/admin
 */
class WPD_Tinctures_Permalink_Settings {
	/**
	 * Initialize class.
	 */
	public function __construct() {
		$this->init();
		$this->settings_save();
	}

	/**
	 * Call register fields.
	 */
	public function init() {
		add_filter( 'admin_init', array( &$this, 'register_fields' ) );
	}

	/**
	 * Add setting to permalinks page.
	 */
	public function register_fields() {
		register_setting( 'permalink', 'wpd_tinctures_slug', 'esc_attr' );
		add_settings_field( 'wpd_tinctures_slug_setting', '<label for="wpd_tinctures_slug">' . __( 'Tinctures Base', 'wpd-tinctures' ) . '</label>', array( &$this, 'fields_html' ), 'permalink', 'optional' );
	}

	/**
	 * HTML for permalink setting.
	 */
	public function fields_html() {
		$value = get_option( 'wpd_tinctures_slug' );
		wp_nonce_field( 'wpd-tinctures-slug', 'wpd_tinctures_slug_nonce' );
		echo '<input type="text" class="regular-text code" id="wpd_tinctures_slug" name="wpd_tinctures_slug" placeholder="tinctures" value="' . esc_attr( $value ) . '" />';
	}

	/**
	 * Save permalink settings.
	 */
	public function settings_save() {
		if ( ! is_admin() ) {
			return;
		}

		// We need to save the options ourselves; settings api does not trigger save for the permalinks page.
		if ( isset( $_POST['permalink_structure'] ) ||
			 isset( $_POST['category_base'] ) &&
			 isset( $_POST['wpd_tinctures_slug'] ) &&
			 wp_verify_nonce( wp_unslash( $_POST['wpd_tinctures_slug_nonce'] ), 'wpd-tinctures' ) ) {
				$wpd_tinctures_slug = sanitize_title( wp_unslash( $_POST['wpd_tinctures_slug'] ) );
				update_option( 'wpd_tinctures_slug', $wpd_tinctures_slug );
		}
	}
}
$wpd_tinctures_permalink_settings = new WPD_Tinctures_Permalink_Settings();
