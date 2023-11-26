<?php
// enqueue-scripts.php

function werkscore_enqueue_admin_styles_and_scripts() {
	// Pfad zu Ihrem Plugin-Verzeichnis
	$plugin_url = plugin_dir_url(__FILE__);

	// Bootstrap für Aadmin
	wp_enqueue_style('bootstrap-admin', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2', 'all');

	// Einreihen des Admin-Stylesheets
	wp_enqueue_style('werkscore-admin-style', $plugin_url . 'css/admin-style.css');

	// Einreihen des Admin-JavaScript
	wp_enqueue_script('werkscore-admin-script', $plugin_url . 'js/admin-script.js', array('jquery'), null, true);

	// Bootstrap JS
	wp_enqueue_script(
		'bootstrap-admin-js',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
		array(), // Keine Abhängigkeiten
		'5.3.2',  // Version
		true      // Im Footer laden
	);


}

add_action('admin_enqueue_scripts', 'werkscore_enqueue_admin_styles_and_scripts');
