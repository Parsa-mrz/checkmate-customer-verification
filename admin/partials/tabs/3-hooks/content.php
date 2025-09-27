<?php
/**
 * Provide a admin area view for hooks tab
 *
 * This file is used to markup the admin-facing aspects hooks tab.
 *
 * @link       https://parsamirzaie.com
 * @since      1.0.0
 *
 * @package    cvs
 * @subpackage cvs/admin/partials/tabs/hooks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form class="modern-toggle-form" action="options.php" method="POST">
	<?php
		settings_fields( 'cvs_settings_hooks_group' );
		do_settings_sections( 'cvs_settings_page_hooks' );
	?>
</form>
