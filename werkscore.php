<?php
/*
Plugin Name: WerksCore Addon
Plugin URI: 
Description: Basis für ImprezaCore Addons.
Version: 0.6.1
Author: 
Author URI: /
License: -
Text Domain: werkscore-plugin
*/

// Sicherstellen, dass das Plugin nicht direkt aufgerufen wird
 if (!defined('WPINC')) {
	 die;
 }

require_once plugin_dir_path( __FILE__ ) . 'admin/class-admin-page.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-blocklink.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-typehelper.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-iosfix.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-parallax-flipbox.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-color-change-section.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-remove-gridoptions.php';

require_once plugin_dir_path( __FILE__ ) . 'includes/class-wfsuperadmin-role.php';
register_activation_hook(__FILE__, array('WFSuperAdminRole', 'create_role'));
