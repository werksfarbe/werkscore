<?php
if (!defined('ABSPATH')) {
	exit; // Beenden, wenn direkt aufgerufen
}

class WFSuperAdminRole {
	public static function create_role() {
		$admin_role = get_role('administrator');
		if ($admin_role && !get_role('wfsuperadmin')) {
			add_role('wfsuperadmin', 'WFSuperAdmin', $admin_role->capabilities);
		}
	}

	public static function filter_editable_roles($roles) {
		// Wenn der Benutzer nicht die richtige E-Mail-Domain hat, entfernen wir die wfsuperadmin-Rolle aus den bearbeitbaren Rollen
		$user = wp_get_current_user();
		if (!self::user_has_valid_domain($user->user_email)) {
			unset($roles['wfsuperadmin']);
		}
		return $roles;
	}

	public static function filter_user_capabilities($allcaps, $caps, $args, $user) {
		// Überprüfen, ob der Benutzer versucht, die wfsuperadmin-Rolle zu ändern
		if (isset($allcaps['manage_options']) && !self::user_has_valid_domain($user->user_email)) {
			unset($allcaps['manage_options']);
		}
		return $allcaps;
	}

	private static function user_has_valid_domain($email) {
		// Überprüfen, ob die E-Mail-Adresse die Domain werksfarbe.com hat
		return strpos($email, '@werksfarbe.com') !== false;
	}
}
?>
