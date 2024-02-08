<?php
// Stellen Sie sicher, dass dieses Template nur im Kontext der Admin-Seite geladen wird.
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

function werkscore_enqueue_admin_styles_and_scripts($hook) {
	// Überprüfen, ob wir uns auf der spezifischen Plugin-Seite befinden
	if ($hook != 'toplevel_page_werkscore-plugin') {
		return;
	}

	// Pfad zu Ihrem Plugin-Verzeichnis
	$plugin_url = plugin_dir_url(__FILE__);

	// Bootstrap CSS nur auf der Plugin-Seite laden
	wp_enqueue_style('bootstrap-admin', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2', 'all');

	// Bootstrap JS nur auf der Plugin-Seite laden
	wp_enqueue_script(
		'bootstrap-admin-js',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
		array(), // Keine Abhängigkeiten
		'5.3.2',  // Version
		true      // Im Footer laden
	);

	// Ihre eigenen Admin-Styles und -Scripts
	wp_enqueue_style('werkscore-admin-style', $plugin_url . 'css/admin-style.css');
	wp_enqueue_script('werkscore-admin-script', $plugin_url . 'js/admin-script.js', array('jquery'), null, true);
}

add_action('admin_enqueue_scripts', 'werkscore_enqueue_admin_styles_and_scripts');
