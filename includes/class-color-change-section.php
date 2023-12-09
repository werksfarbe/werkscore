<?php
// Data Attribut an der Section
function werkscore_add_data_attribute_to_vc_row_if_enabled($output, $obj, $atts) {
	// Abrufen der Plugin-Einstellungen
	$options = get_option('blocklink_option');

	// Überprüfen, ob die Section-Farbwechsel-Option aktiviert ist
	if (!empty($options['section_color_change']) && $options['section_color_change'] == 1) {
		// Überprüfen, ob es sich um den vc_row-Shortcode handelt
		if ($obj->settings('base') === 'vc_row') {
			// Überprüfen, ob das benutzerdefinierte Attribut gesetzt ist
			if (!empty($atts['color_name'])) {
				// Hinzufügen des data-Attributs
				$color_name = esc_attr($atts['color_name']);
				$output = preg_replace('/<section/', '<section data-colorchangto="' . $color_name . '"', $output, 1);
			}
		}
	}
	return $output;
}
add_filter('vc_shortcode_output', 'werkscore_add_data_attribute_to_vc_row_if_enabled', 20, 3);

function werkscore_enqueue_section_color_change_script() {
	// Abrufen der Plugin-Einstellungen
	$options = get_option('blocklink_option');

	// Überprüfen, ob die "Section-Farbwechsel aktivieren"-Option aktiviert ist
	if (!empty($options['section_color_change']) && $options['section_color_change'] == 1) {
		$plugin_url = plugin_dir_url(__FILE__);
		wp_enqueue_script('werkscore-section-color-change', $plugin_url . '../public/scripts/sectioncolorto.js', array('jquery'), null, true);

		// Übergeben der Admin-Einstellungen an das Script
		wp_localize_script('werkscore-section-color-change', 'werkscoreSettings', array(
			'bodySelector' => $options['body_selector'] ?? '.l-canvas',
			'panelSelector' => $options['panel_selector'] ?? '.panel'
		));
	}
}
add_action('wp_enqueue_scripts', 'werkscore_enqueue_section_color_change_script');



function werkscore_generate_custom_color_classes() {
	// Abrufen der Plugin-Einstellungen
	$options = get_option('blocklink_option');

	// Überprüfen, ob die "Section-Farbwechsel aktivieren"-Option aktiviert ist
	if (isset($options['section_color_change']) && $options['section_color_change'] == 1) {
		// Überprüfen, ob es benutzerdefinierte Farben gibt
		if (isset($options['custom_colors']) && is_array($options['custom_colors'])) {
			echo '<style>';
			// Hinzufügen des grundlegenden CSS-Befehls
			echo '.l-canvas { transition: background-color 1s ease; }';
			foreach ($options['custom_colors'] as $color) {
				// Generieren der CSS-Klasse für jede Farbe
				echo '.color-' . sanitize_title($color['name']) . ' { background-color: ' . esc_attr($color['value']) . '; }';
			}
			echo '</style>';
		}
	}
}
add_action('wp_head', 'werkscore_generate_custom_color_classes');
