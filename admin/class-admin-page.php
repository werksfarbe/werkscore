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
