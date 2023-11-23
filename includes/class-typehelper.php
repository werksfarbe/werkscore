<?php
add_action('wp_enqueue_scripts', 'enqueue_typehelper_styles');
function enqueue_typehelper_styles() {
	$options = get_option('blocklink_option');
	if ( isset($options['typehelper']) && $options['typehelper'] == 1 ) {
		wp_enqueue_style('typehelper-styles', plugin_dir_url(dirname(__FILE__)) . 'public/styles/typehelper.css');
	}
}
