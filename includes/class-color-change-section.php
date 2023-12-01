<?php
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
add_filter('vc_shortcode_output', 'werkscore_add_data_attribute_to_vc_row_if_enabled', 10, 3);


// Frontend CSS
function werkscore_enqueue_section_color_change_style() {
	// Abrufen der Plugin-Einstellungen
	$options = get_option('blocklink_option');

	// Überprüfen, ob die "Section-Farbwechsel aktivieren"-Option aktiviert ist
	if (!empty($options['section_color_change']) && $options['section_color_change'] == 1) {

		wp_enqueue_style('werkscore-section-color-change', plugin_dir_url(dirname(__FILE__)) . 'public/styles/sectioncolorto.css');
	}
}
add_action('wp_enqueue_scripts', 'werkscore_enqueue_section_color_change_style');
