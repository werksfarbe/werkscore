<?php
if (!defined('ABSPATH')) {
	exit; // Beenden, wenn direkt aufgerufen
}

class werkscoreUpdater {

	public static function check_for_plugin_update() {
		$plugin_data = get_plugin_data(__FILE__);
		$plugin_version = $plugin_data['Version'];
		$github_api_url = 'https://api.github.com/repos/werksfarbe/werkscore/releases/latest';
		
		$response = wp_remote_get($github_api_url, array('timeout' => 20));
		
		if (is_wp_error($response)) {
			// Fehlerbehandlung bei der Anfrage
			error_log('GitHub API Anfrage fehlgeschlagen: ' . $response->get_error_message());
			return;
		}
		
		$response_code = wp_remote_retrieve_response_code($response);
		if ($response_code != 200) {
			// Fehlerbehandlung bei ungültigem HTTP-Statuscode
			error_log('Ungültiger HTTP-Statuscode: ' . $response_code);
			return;
		}
		
		$release_data = json_decode(wp_remote_retrieve_body($response));
		
		if (!isset($release_data->tag_name) || !isset($release_data->zipball_url)) {
			// Fehlerbehandlung bei ungültigen Daten
			error_log('Ungültige Daten von der GitHub API empfangen');
			return;
		}
		
		if (version_compare($plugin_version, $release_data->tag_name, '<')) {
			$zip_url = $release_data->zipball_url;
			self::update_plugin($zip_url);
		}
	}

	private static function update_plugin($zip_url) {
		include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

		// Temporären Download-Pfad festlegen
		$download_file = download_url($zip_url, 300);

		if (is_wp_error($download_file)) {
			// Fehlerbehandlung beim Herunterladen der Datei
			error_log('Fehler beim Herunterladen der Update-Datei: ' . $download_file->get_error_message());
			return;
		}

		// Überprüfung der heruntergeladenen Datei
		global $wp_filesystem;
		WP_Filesystem();
		if (!$wp_filesystem || !$wp_filesystem->is_file($download_file)) {
			// Fehlerbehandlung bei ungültiger Datei
			error_log('Heruntergeladene Datei ist ungültig');
			return;
		}

		$upgrader = new Plugin_Upgrader();
		$result = $upgrader->install($download_file);

		// Heruntergeladene Datei löschen
		unlink($download_file);

		if (is_wp_error($result)) {
			// Fehlerbehandlung beim Installationsprozess
			error_log('Fehler bei der Plugin-Installation: ' . $result->get_error_message());
		}
	}
}
?>
