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

		// Settings section hinzufügen (wird im Template gehandhabt)
	}

	public function sanitize($input) {
		$new_input = array();
		foreach ($input as $key => $value) {
			if ($key == 'parallax_distance' || $key == 'parallax_scale' || $key == 'parallax_speed') {
				$new_input[$key] = sanitize_text_field($value);
			} elseif (strpos($key, 'color_name_') === 0 || strpos($key, 'color_value_') === 0) {
				$new_input[$key] = sanitize_text_field($value);
			} elseif ($key == 'body_selector' || $key == 'panel_selector') {
				// Bereinigen der neuen Felder "Body-Selector" und "Panel-Selector"
				$new_input[$key] = sanitize_text_field($value);
			} else {
				$new_input[$key] = absint($value);
			}
		}

		$new_input['custom_colors'] = $this->group_custom_colors($new_input);

		return $new_input;
	}

	private function group_custom_colors($input) {
		$colors = array();
		foreach ($input as $key => $value) {
			if (strpos($key, 'color_name_') === 0) {
				$index = str_replace('color_name_', '', $key);
				$color_value_key = 'color_value_' . $index;
				$colors[] = array(
					'name' => $value,
					'value' => $input[$color_value_key] ?? ''
				);
			}
		}
		return $colors;
	}
}

