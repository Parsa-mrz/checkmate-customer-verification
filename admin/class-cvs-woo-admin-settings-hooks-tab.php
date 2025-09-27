<?php
/**
 * Admin Settings Tab: Hooks Reference Table
 *
 * This file defines the `cvs_Admin_Settings_Hooks_Tab` class, which adds a custom
 * admin settings tab that displays a list of action and filter hooks available
 * in the Verify Woo plugin. It uses the WordPress Settings API and `WP_List_Table`
 * to render a dynamic and searchable reference table for developers.
 *
 * @package   cvs
 * @subpackage Admin/Settings
 * @since     1.0.0
 * @author    Developer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Class cvs_Admin_Settings_Hooks_Tab
 *
 * Renders the "Hooks" tab in the Verify Woo admin settings screen.
 * Uses the WordPress Settings API to register and save settings,
 * and displays a reference table of all available action/filter hooks.
 *
 * @since 1.0.0
 */
class Cvs_Woo_Admin_Settings_Hooks_Tab {

	/**
	 * The name of the option group for the hooks settings.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	const OPTION_GROUP = 'cvs_hooks_settings';

	/**
	 * Register settings, sections, and fields using WordPress Settings API.
	 *
	 * Hooks into WordPress admin to:
	 * - Register the setting group `cvs_settings_hooks_group`.
	 * - Create a settings section called `cvs_hooks_section`.
	 * - Add a settings field that renders the hook reference table.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function register_settings() {
		register_setting(
			'cvs_settings_hooks_group',
			self::OPTION_GROUP,
			array( $this, 'sanitize_settings' )
		);

		add_settings_section(
			'cvs_hooks_section',
			__( 'Hook', 'checkmate-customer-verification-for-woocommerce' ),
			function () {
				echo '<p>' . esc_html__( 'Configure the login settings below.', 'checkmate-customer-verification-for-woocommerce' ) . '</p>';
			},
			'cvs_settings_page_hooks'
		);

		add_settings_field(
			'activation',
			'',
			array( $this, 'render_field' ),
			'cvs_settings_page_hooks',
			'cvs_hooks_section'
		);
	}

	/**
	 * Sanitize the submitted plugin settings before saving to the database.
	 *
	 * Currently only sanitizes the "activation" toggle.
	 * Converts it to a boolean `true` or `false` (stored as 1 or 0).
	 * Displays an admin success notice if saving succeeds.
	 *
	 * @since 1.0.0
	 *
	 * @param array $input The raw submitted input from the settings form.
	 *
	 * @return array $sanitized The cleaned version of the input to store.
	 */
	public function sanitize_settings( $input ) {
		$sanitized               = array();
		$sanitized['activation'] = ! empty( $input['activation'] ) ? true : false;

		Cvs_Woo_Admin_Notice::add_success( __( 'Settings Saved', 'checkmate-customer-verification-for-woocommerce' ) );

		return $sanitized;
	}

	/**
	 * Render the "Activate Login Page" field in the admin UI.
	 *
	 * Outputs a `WP_List_Table` instance with all available hooks (filters + actions),
	 * rendered in a dev-friendly admin table. Pulled from `cvs_Admin_Settings_Hooks_Table`.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function render_field() {
		$table = new Cvs_Woo_Admin_Settings_Hooks_Table();
		$table->prepare_items();
		$table->display();
	}
}
