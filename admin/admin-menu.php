<?php
// admin-menu.php

class WerkscorePluginAdminMenu {

	public function __construct() {
		add_action('admin_menu', array($this, 'add_plugin_page'));
	}

	public function add_plugin_page() {
		add_menu_page(
			'Werkscore Einstellungen', // Page title
			'Werkscore', // Menu title
			'manage_options', // Capability
			'werkscore-plugin', // Menu slug
			array($this, 'create_admin_page') // Function
		);
	}

	public function create_admin_page() {
		// Holen der Plugin-Einstellungen
		$options = get_option('blocklink_option');
		
		// Einbinden der Template-Datei
		include plugin_dir_path(__FILE__) . 'templates/admin-page-template.php';
	}
}

