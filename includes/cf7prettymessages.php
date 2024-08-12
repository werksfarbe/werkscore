<?php
function werkscore_enqueue_cf7_prettifyer_css() {
	$options = get_option('blocklink_option');
	
	if (isset($options['cf7_message_prettifyer']) && $options['cf7_message_prettifyer']) {
		wp_enqueue_style('cf7-prettifyer-css', plugin_dir_url(__FILE__) . '../public/styles/cf7prettymessages.css');
	}
}
add_action('wp_enqueue_scripts', 'werkscore_enqueue_cf7_prettifyer_css');
