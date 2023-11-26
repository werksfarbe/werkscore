<?php
// settings-definitions.php

class WerkscorePluginSettings {

	private $options;

	public function __construct() {
		add_action('admin_init', array($this, 'page_init'));
		$this->options = get_option('blocklink_option');
	}

	public function page_init() {
		register_setting(
			'werkscore_option_group', // Option group
			'blocklink_option', // Option name
			array($this, 'sanitize') // Sanitize
		);

		// Sie müssen nur die Sektion hinzufügen, da die Felder bereits im Template sind
		add_settings_section(
			'setting_section_id', // ID
			'Übersicht', // Title
			null, // Kein Callback notwendig, da die Beschreibung im Template ist
			'werkscore-plugin' // Page
		);  
	}

	public function sanitize($input) {
		$new_input = array();
		foreach ($input as $key => $value) {
			$new_input[$key] = absint($value);
		}
		return $new_input;
	}
}

// Die Instanz der Klasse wird in der Hauptdatei des Plugins erstellt.
