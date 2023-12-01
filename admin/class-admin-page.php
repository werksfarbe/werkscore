<?php
/**
 * Plugin Name: Werkscore Plugin
 * Description: Ein benutzerdefiniertes Plugin für Werkscore-Funktionalitäten.
 * Version: 1.0
 * Author: Ihr Name
 */

// Sicherstellen, dass die Datei nicht direkt aufgerufen wird
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Einbinden der separaten Dateien
require_once plugin_dir_path(__FILE__) . 'admin-menu.php';
require_once plugin_dir_path(__FILE__) . 'settings-definitions.php';
require_once plugin_dir_path(__FILE__) . 'enqueue-scripts.php';
require_once plugin_dir_path(__FILE__) . 'admin-color-change-section.php';

// Initialisieren der Klassen
if (is_admin()) {
	$werkscore_plugin_admin_menu = new WerkscorePluginAdminMenu();
	$werkscore_plugin_settings = new WerkscorePluginSettings();
}



/**	
function werkscore_enqueue_admin_styles_and_scripts() {
	wp_enqueue_style('werkscore-admin-style', plugin_dir_url(__FILE__) . 'css/admin-style.css');
	wp_enqueue_script('werkscore-admin-script', plugin_dir_url(__FILE__) . 'js/admin-script.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'werkscore_enqueue_admin_styles_and_scripts');

class WerkscorePluginAdminPage  {

	public function __construct() {
		add_action('admin_menu', array($this, 'add_plugin_page'));
		add_action('admin_init', array($this, 'page_init'));
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
		?>
		<div class="wrap">
			<h1>Werkscore Einstellungen</h1>
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
		// Hinzufügen der neuen Checkbox für iOS Fix
		add_settings_field(
			'ios_fullscreen_fix', // ID
			'Fullscreen iOS-Fix aktivieren', // Title 
			array($this, 'ios_fullscreen_fix_callback'), // Callback
			'werkscore-plugin', // Page
			'setting_section_id' // Section           
		); 

	}

	public function sanitize($input) {
		$new_input = array();
	
		if (isset($input['blocklink'])) {
			$new_input['blocklink'] = absint($input['blocklink']);
		}
	
		if (isset($input['typehelper'])) {
			$new_input['typehelper'] = absint($input['typehelper']);
		}
	
		if (isset($input['ios_fullscreen_fix'])) {
			$new_input['ios_fullscreen_fix'] = absint($input['ios_fullscreen_fix']);
		}
	
		return $new_input;
	}

	public function print_section_info() {
		print 'Aktivieren oder deaktivieren Sie erweiterte Optionen für IMPREZA:';
	}
	// Funktion zum Generieren des Bildpfads
	private function get_image_url( $image_name ) {
		return plugins_url( 'admin/img/' . $image_name, dirname(__FILE__) );
	}
	public function blocklink_callback() {
		$options = get_option('blocklink_option');
		?>
		<input type="checkbox" id="blocklink" name="blocklink_option[blocklink]" value='1' <?php checked(1, $options['blocklink'], true); ?>/>
		<div class="collapse-info" id="blocklink-info">
			<p>Setze in dein Rasterlayout einen Textbereich der auf das Post verlinkt. Gib dem Element die Klasse "blocklink". Dieser wird automataisch über die gesamte Fläche gelegt.</p>
			<p><img src="<?php echo esc_url( $this->get_image_url('blocklink.png') ); ?>" style="max-width: 200px" /></p>
			<p>Danach noch als Text in dem Textelement {{the_title}} eintragen damit der Text nicht leer ist</p>
		</div>
		<?php
	}

	// Callback-Funktion für die Typehelper-Checkbox
	public function typehelper_callback() {
		$options = get_option('blocklink_option');
		$typehelper_checked = isset($options['typehelper']) && $options['typehelper'] == 1 ? 'checked' : '';
		?>
		<input type="checkbox" id="typehelper" name="blocklink_option[typehelper]" value='1' <?php echo $typehelper_checked; ?>/>
		<div class="collapse-info" id="blocklink-info">
			<p>Jetzt kannst du folgende Klasse für deine Typo nutzen:</p>
			<ul>
				<li>like-h1</li>
				<li>like-h2</li>
				<li>like-h3</li>
				<li>like-h4</li>
				<li>like-h5</li>
				<li>like-h6</li>
				<li>like-p</li>
			</ul>
		</div>
		<?php
	}
	public function ios_fullscreen_fix_callback() {
		$options = get_option('blocklink_option');
		$ios_fix_checked = isset($options['ios_fullscreen_fix']) && $options['ios_fullscreen_fix'] == 1 ? 'checked' : '';
		?>
		<input type="checkbox" id="ios_fullscreen_fix" name="blocklink_option[ios_fullscreen_fix]" value='1' <?php echo $ios_fix_checked; ?>/>
		<div class="collapse-info" id="iosfullscreenfix-info">
			<p>Es gibt nun keinen Jumper mehr auf iOS mit Fullscreen Sections</p>
		</div>
		<?php
	}


}

if (is_admin()) {
	$werkscore_plugin_admin_page = new WerkscorePluginAdminPage();
	// Hinzufügen der Funktion zum Einbinden der CSS-Datei
	add_action('wp_enqueue_scripts', 'enqueue_typehelper_styles');
	add_action('wp_enqueue_scripts', 'enqueue_ioshelper_styles');
}
 */
?>
