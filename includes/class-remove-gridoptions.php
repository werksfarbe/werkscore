<?php
function remove_us_portfolio_settings_meta_box( $config ) {
	// Abrufen der Plugin-Einstellungen
	$options = get_option('blocklink_option');

	// Überprüfen, ob die Grid-Optionen deaktivieren-Option aktiviert ist
	if (isset($options['disable_grid_options']) && $options['disable_grid_options'] == 1) {
		$config = array_filter($config, function($metabox) {
			return $metabox['id'] !== 'us_portfolio_settings';
		});
	}

	return $config;
}
add_filter( 'us_config_meta-boxes', 'remove_us_portfolio_settings_meta_box' );
