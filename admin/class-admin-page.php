<?php
class WerkscorePluginAdminPage  {

	public function __construct() {
		add_action('admin_menu', array($this, 'add_plugin_page'));
		add_action('admin_init', array($this, 'page_init'));
	}

	public function add_plugin_page() {
		add_menu_page(
			'Werkscore Plugin Einstellungen', // Page title
			'Werkscore Plugin', // Menu title
			'manage_options', // Capability
			'werkscore-plugin', // Menu slug
			array($this, 'create_admin_page') // Function
		);
	}

	public function create_admin_page() {
		?>
		<div class="wrap">
			<h1>Werkscore Plugin Einstellungen</h1>
			<form method="post" action="options.php">
				<?php
				settings_fields('werkscore_option_group');
				do_settings_sections('werkscore-plugin');
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	public function page_init() {
		register_setting(
			'werkscore_option_group', // Option group
			'blocklink_option', // Option name
			array($this, 'sanitize') // Sanitize
		);

		add_settings_section(
			'setting_section_id', // ID
			'Einstellungen', // Title
			array($this, 'print_section_info'), // Callback
			'werkscore-plugin' // Page
		);  

		add_settings_field(
			'blocklink', // ID
			'Blocklink aktivieren', // Title 
			array($this, 'blocklink_callback'), // Callback
			'werkscore-plugin', // Page
			'setting_section_id' // Section           
		);

		// Hinzufügen der neuen Checkbox für Typehelper
		add_settings_field(
			'typehelper', // ID
			'Typehelper-Klassen aktivieren', // Title
			array($this, 'typehelper_callback'), // Callback
			'werkscore-plugin', // Page
			'setting_section_id' // Section           
		); 
	}

	public function sanitize($input) {
		$new_input = array();
		if(isset($input['blocklink']))
			$new_input['blocklink'] = absint($input['blocklink']);
		if(isset($input['typehelper']))
			$new_input['typehelper'] = absint($input['typehelper']);

		return $new_input;
	}

	public function print_section_info() {
		print 'Aktivieren oder deaktivieren Sie den Blocklink und Typehelper:';
	}

	public function blocklink_callback() {
		$options = get_option('blocklink_option');
		?>
		<input type="checkbox" id="blocklink" name="blocklink_option[blocklink]" value='1' <?php checked(1, $options['blocklink'], true); ?>/>
		<?php
	}

	// Callback-Funktion für die Typehelper-Checkbox
	public function typehelper_callback() {
		$options = get_option('blocklink_option');
		$typehelper_checked = isset($options['typehelper']) && $options['typehelper'] == 1 ? 'checked' : '';
		?>
		<input type="checkbox" id="typehelper" name="blocklink_option[typehelper]" value='1' <?php echo $typehelper_checked; ?>/>
		<?php
	}
}

if (is_admin()) {
	$werkscore_plugin_admin_page = new WerkscorePluginAdminPage();
	// Hinzufügen der Funktion zum Einbinden der CSS-Datei
	add_action('wp_enqueue_scripts', 'enqueue_typehelper_styles');
}

?>
