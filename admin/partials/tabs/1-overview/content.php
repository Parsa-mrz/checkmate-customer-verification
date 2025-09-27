<?php
/**
 * Provide a admin area view for overview tab
 *
 * This file is used to markup the admin-facing aspects of overview tab.
 *
 * @link       https://parsamirzaie.com
 * @since      1.0.0
 *
 * @package    cvs
 * @subpackage cvs/admin/partials/tabs/overview
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form class="modern-toggle-form" action="options.php" method="POST">
	<?php
		settings_fields( 'cvs_settings_overview_group' );
		do_settings_sections( 'cvs_settings_page_overview' );
		submit_button(
			__( 'Save Settings', 'checkmate-customer-verification-for-woocommerce' ),
			'primary cta-btn',
			'submit',
		);
		?>
</form>
