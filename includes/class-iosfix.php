<?php
// Sicherstellen, dass das Plugin nicht direkt aufgerufen wird
 if (!defined('WPINC')) {
	 die;
 }

add_action('wp_enqueue_scripts', 'enqueue_parallax_flipbox_styles');
function enqueue_parallax_flipbox_styles() {
	$options = get_option('blocklink_option');
	if (isset($options['parallax_flipbox']) && $options['parallax_flipbox'] == 1) {
		wp_enqueue_style('ioshelper-styles', plugin_dir_url(dirname(__FILE__)) . 'public/styles/ios-fullheightfix.css');
	}
}
