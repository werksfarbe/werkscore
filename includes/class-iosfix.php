<?php
add_action('wp_enqueue_scripts', 'enqueue_ioshelper_styles');
function enqueue_ioshelper_styles() {
	$options = get_option('blocklink_option');
	if (isset($options['ios_fullscreen_fix']) && $options['ios_fullscreen_fix'] == 1) {
		wp_enqueue_style('ioshelper-styles', plugin_dir_url(dirname(__FILE__)) . 'public/styles/ios-fullheightfix.css');
	}
}
