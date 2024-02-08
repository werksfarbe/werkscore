<?php
// Stellen Sie sicher, dass dieses Template nur im Kontext der Admin-Seite geladen wird.
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

function werkscore_extend_vc_row_if_option_enabled() {
	// Abrufen der Plugin-Einstellungen
	$options = get_option('blocklink_option');

	// Überprüfen, ob die Section-Farbwechsel-Option aktiviert ist
	if (isset($options['section_color_change']) && $options['section_color_change'] == 1) {
		// Hinzufügen des benutzerdefinierten Feldes, wenn die Option aktiviert ist
		if (function_exists('vc_add_param')) {
			vc_add_param('vc_row', array(
				'type' => 'textfield',
				'heading' => 'Farbname',
				'param_name' => 'color_name',
				'description' => 'Geben Sie einen Farbnamen für den Farbwechsel ein.'
			));
		}
	}
}
add_action('vc_before_init', 'werkscore_extend_vc_row_if_option_enabled');


