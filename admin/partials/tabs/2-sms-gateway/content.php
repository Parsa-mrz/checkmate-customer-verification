<?php
/**
 * Provide a admin area view for sms gateway tab
 *
 * This file is used to markup the admin-facing aspects of sms gateway tab.
 *
 * @link       https://parsamirzaie.com
 * @since      1.0.0
 *
 * @package    cvs
 * @subpackage cvs/admin/partials/tabs/sms-gateway
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form class="modern-toggle-form" action="options.php" method="POST">
	<?php
		settings_fields( 'cvs_settings_sms_gateway_group' );
		do_settings_sections( 'cvs_settings_page_sms_gateway' );
		submit_button(
			__( 'Save Settings', 'checkmate-customer-verification-for-woocommerce' ),
			'primary cta-btn',
			'submit',
		);
		?>
</form>
