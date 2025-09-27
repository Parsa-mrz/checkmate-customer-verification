<?php
/**
 * Hooks Table for Admin Settings
 *
 * This file contains the WP_List_Table implementation that renders
 * a developer-facing table of action and filter hooks provided by Verify Woo.
 *
 * @package    cvs
 * @subpackage Admin
 * @since      1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * Class cvs_Admin_Settings_Hooks_Table
 *
 * Renders a sortable, developer-friendly admin table showing all action and filter
 * hooks available in the Verify Woo plugin.
 *
 * Extends WordPress core's WP_List_Table.
 *
 * @since 1.0.0
 */
class Cvs_Woo_Admin_Settings_Hooks_Table extends WP_List_Table {

	/**
	 * Array of available hooks data.
	 *
	 * @since 1.0.0
	 * @var array
	 */
	private $hook_data;

	/**
	 * Constructor: Define table settings and populate hook data.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		parent::__construct(
			array(
				'singular' => 'hook',
				'plural'   => 'hooks',
				'ajax'     => false,
			)
		);

		$this->set_hook_data();
	}

	/**
	 * Get table columns.
	 *
	 * @since 1.0.0
	 * @return array Associative array of column IDs => column labels.
	 */
	public function get_columns() {
		return array(
			'name'        => '🔗 Hook Name',
			'description' => '📝 Description',
			'parameters'  => '📦 Parameters',
			'type'        => '🛠️ Type',
		);
	}

	/**
	 * Render the 'type' column.
	 *
	 * @since 1.0.0
	 * @param array $item Current row item.
	 * @return string
	 */
	protected function column_type( $item ) {
		return '<span style="text-transform: capitalize;">' . esc_html( $item['type'] ) . '</span>';
	}

	/**
	 * Render the 'name' column.
	 *
	 * @since 1.0.0
	 * @param array $item Current row item.
	 * @return string
	 */
	protected function column_name( $item ) {
		return '<code>' . esc_html( $item['name'] ) . '</code>';
	}

	/**
	 * Render the 'description' column.
	 *
	 * @since 1.0.0
	 * @param array $item Current row item.
	 * @return string
	 */
	protected function column_description( $item ) {
		return esc_html( $item['description'] );
	}

	/**
	 * Render the 'parameters' column.
	 *
	 * @since 1.0.0
	 * @param array $item Current row item.
	 * @return string
	 */
	protected function column_parameters( $item ) {
		return '<code>' . esc_html( $item['parameters'] ) . '</code>';
	}

	/**
	 * Prepare the table items.
	 *
	 * Populates `$this->items` and sets column headers.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function prepare_items() {
		$this->_column_headers = array( $this->get_columns(), array(), array() );
		$this->items           = $this->hook_data;
	}

	/**
	 * Sets the hook data for the table.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function set_hook_data() {
		$this->hook_data = array(
			// 🔧 Action Hooks
			array(
				'type'        => 'action',
				'name'        => 'cvs_send_otp_sms',
				'description' => 'Fires when an OTP code has been generated and is ready to be sent via SMS.',
				'parameters'  => '$phone (string), $otp_code (int)',
			),
			array(
				'type'        => 'action',
				'name'        => 'cvs_before_login_existing_user',
				'description' => 'Fires before an existing user is logged in via OTP verification.',
				'parameters'  => '$user (WP_User)',
			),
			array(
				'type'        => 'action',
				'name'        => 'cvs_after_register_user',
				'description' => 'Fires after a new user is registered via OTP.',
				'parameters'  => '$user_id (int), $phone (string)',
			),
			array(
				'type'        => 'action',
				'name'        => 'cvs_tab_{$slug}_content',
				'description' => 'Renders content for custom Verify Woo admin tabs.',
				'parameters'  => '$slug (string)',
			),

			// 🧪 Filter Hooks
			array(
				'type'        => 'filter',
				'name'        => 'cvs_login_redirect_url',
				'description' => 'Modifies login redirect URL after successful OTP.',
				'parameters'  => '$redirect_url (string)',
			),
			array(
				'type'        => 'filter',
				'name'        => 'cvs_otp_rate_limit_seconds',
				'description' => 'Filters the cooldown time between OTP requests.',
				'parameters'  => '$seconds (int)',
			),
			array(
				'type'        => 'filter',
				'name'        => 'cvs_otp_expiration',
				'description' => 'Changes OTP expiration time in seconds.',
				'parameters'  => '$expiration (int)',
			),
			array(
				'type'        => 'filter',
				'name'        => 'cvs_max_otp_attempts',
				'description' => 'Sets the max attempts for OTP verification.',
				'parameters'  => '$max_attempts (int)',
			),
			array(
				'type'        => 'filter',
				'name'        => 'cvs_username_prefix',
				'description' => 'Modifies the auto-registration username prefix.',
				'parameters'  => '$prefix (string), $clean_phone (string)',
			),
			array(
				'type'        => 'filter',
				'name'        => 'cvs_auto_register_enabled',
				'description' => 'Controls whether auto-registration is allowed.',
				'parameters'  => '$enabled (bool), $phone (string)',
			),
			array(
				'type'        => 'filter',
				'name'        => 'cvs_new_user_role',
				'description' => 'Modifies the role for new users registered via OTP.',
				'parameters'  => '$role (string|array), $phone (string)',
			),
			array(
				'type'        => 'filter',
				'name'        => 'cvs_new_user_data',
				'description' => 'Allows customization of user data during auto-registration.',
				'parameters'  => '$user_data (array), $phone (string)',
			),
			array(
				'type'        => 'filter',
				'name'        => 'cvs_login_form_template_path',
				'description' => 'Filters the path to the custom login form template.',
				'parameters'  => '$custom_template_path (string)',
			),
			array(
				'type'        => 'filter',
				'name'        => 'cvs_admin_settings_tabs',
				'description' => 'Filters the available admin tabs in Verify Woo settings.',
				'parameters'  => '$tabs (array)',
			),
		);
	}
}
