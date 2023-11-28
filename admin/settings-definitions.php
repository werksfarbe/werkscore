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

		add_settings_section(
			'setting_section_id', // ID
			'Übersicht', // Title
			null, // Kein Callback notwendig, da die Beschreibung im Template ist
			'werkscore-plugin' // Page
		);

		// Entfernen Sie das Hinzufügen von Einstellungsfeldern, da diese im Template eingebunden sind
	}

	public function sanitize($input) {
		$new_input = array();
		foreach ($input as $key => $value) {
			if ($key == 'parallax_distance' || $key == 'parallax_scale') {
				$new_input[$key] = sanitize_text_field($value);
			} else {
				$new_input[$key] = absint($value);
			}
		}
		return $new_input;
	}
}




