<?php
// Sicherstellen, dass das Plugin nicht direkt aufgerufen wird
 if (!defined('WPINC')) {
	 die;
 }

function werkscore_enqueue_parallax_styles() {
	$options = get_option('blocklink_option');

	if (!empty($options['parallax_flipbox']) && $options['parallax_flipbox'] == 1) {
		wp_enqueue_style('parallax-flipbox-style', plugin_dir_url(__FILE__) . '../public/styles/parallax-flipbox.css');

		$parallax_distance = !empty($options['parallax_distance']) ? $options['parallax_distance'] : '70px';
		$parallax_scale = !empty($options['parallax_scale']) ? $options['parallax_scale'] : '0.8';
		$parallax_speed = !empty($options['parallax_speed']) ? $options['parallax_speed'] : '0.5s';

		$custom_css = "
			:root {
				--paca-translatez: {$parallax_distance};
				--paca-scale: {$parallax_scale};
				--paca-speed: {$parallax_speed};
			}";
		wp_add_inline_style('parallax-flipbox-style', $custom_css);
	}
}

add_action('wp_enqueue_scripts', 'werkscore_enqueue_parallax_styles');
