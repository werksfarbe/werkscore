<?php
add_action('wp_enqueue_scripts', 'enqueue_blocklink_styles');

function enqueue_blocklink_styles() {
	$options = get_option('blocklink_option');
	if ($options && isset($options['blocklink']) && $options['blocklink'] == 1) {
		wp_enqueue_style('blocklink_css', plugins_url('../public/styles/blocklink.css', __FILE__));
	}
}
