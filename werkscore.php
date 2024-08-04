<?php
/*
Plugin Name: WerksCore Addon
Plugin URI: 
Description: Basis für ImprezaCore Addons.
Version: 0.6.12
GitHub Plugin URI: https://github.com/werksfarbe/werkscore
GitHub Branch: main
License: -
Text Domain: werkscore-plugin
*/

// Sicherstellen, dass das Plugin nicht direkt aufgerufen wird
 if (!defined('WPINC')) {
	 die;
 }
 require_once plugin_dir_path(__FILE__) . 'includes/class-plugin-updater.php';

require_once plugin_dir_path( __FILE__ ) . 'admin/class-admin-page.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-blocklink.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-typehelper.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-iosfix.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-parallax-flipbox.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-color-change-section.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-remove-gridoptions.php';

require_once plugin_dir_path( __FILE__ ) . 'includes/class-wfsuperadmin-role.php';
// Aktion bei der Plugin-Aktivierung
register_activation_hook(__FILE__, array('WFSuperAdminRole', 'create_role'));
// Aktion bei der Benutzerrolle-Änderung
add_filter('editable_roles', array('WFSuperAdminRole', 'filter_editable_roles'));
add_filter('user_has_cap', array('WFSuperAdminRole', 'filter_user_capabilities'), 10, 4);
// GitHub-Update-Funktionalität einbinden
add_action('admin_init', array('werkscoreUpdater', 'check_for_plugin_update'));
