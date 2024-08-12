<?php
/**
 * Plugin Name: Werkscore Plugin
 * Description: Ein benutzerdefiniertes Plugin für Werkscore-Funktionalitäten.
 * Version: 1.0
 * Author: Ihr Name
 */

// Stellen Sie sicher, dass dieses Template nur im Kontext der Admin-Seite geladen wird.
 if (!defined('ABSPATH')) {
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
// Check Contact Form 7
function check_contact_form_7_status() {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    $plugin_file = 'contact-form-7/wp-contact-form-7.php';

    if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_file)) {
        return 'not_installed';
    } elseif (!is_plugin_active($plugin_file)) {
        return 'not_activated';
    } else {
        return 'active';
    }
}
