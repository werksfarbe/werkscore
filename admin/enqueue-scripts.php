<?php
// enqueue-scripts.php

function werkscore_enqueue_admin_styles_and_scripts() {
	// Pfad zu Ihrem Plugin-Verzeichnis
	$plugin_url = plugin_dir_url(__FILE__);

	// Einreihen des Admin-Stylesheets
	wp_enqueue_style('werkscore-admin-style', $plugin_url . 'css/admin-style.css');

	// Einreihen des Admin-JavaScript
	wp_enqueue_script('werkscore-admin-script', $plugin_url . 'js/admin-script.js', array('jquery'), null, true);
}

add_action('admin_enqueue_scripts', 'werkscore_enqueue_admin_styles_and_scripts');
