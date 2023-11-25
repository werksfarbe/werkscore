<?php
// Stellen Sie sicher, dass dieses Template nur im Kontext der Admin-Seite geladen wird.
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// Annahme: $options ist bereits definiert und enthält die Plugin-Optionen.
?>

<div class="wrap">
	<h1>Werkscore Einstellungen</h1>
	<form method="post" action="options.php">
		<?php
		settings_fields('werkscore_option_group');
		do_settings_sections('werkscore-plugin');
		submit_button();
		?>

		<!-- Blocklink-Option -->
		<div class="option">
			<input type="checkbox" id="blocklink" name="blocklink_option[blocklink]" value='1' <?php checked(1, $options['blocklink'], true); ?>/>
			<label for="blocklink">Blocklink aktivieren</label>
			<div class="collapse-info" id="blocklink-info">
				<p>Setze in dein Rasterlayout einen Textbereich der auf das Post verlinkt. Gib dem Element die Klasse "blocklink". Dieser wird automataisch über die gesamte Fläche gelegt.</p>
				<p>Danach noch als Text in dem Textelement {{the_title}} eintragen damit der Text nicht leer ist</p>
			</div>

		</div>

		<!-- Typehelper-Option -->
		<div class="option">
			<input type="checkbox" id="typehelper" name="blocklink_option[typehelper]" value='1' <?php checked(1, $options['typehelper'], true); ?>/>
			<label for="typehelper">Typehelper-Klassen aktivieren</label>
			<div class="collapse-info" id="blocklink-info">
				<p>Jetzt kannst du folgende Klasse für deine Typo nutzen:</p>
				<ul>
					<li>like-h1</li>
					<li>like-h2</li>
					<li>like-h3</li>
					<li>like-h4</li>
					<li>like-h5</li>
					<li>like-h6</li>
					<li>like-p</li>
				</ul>
			</div>
		</div>

		<!-- iOS Fullscreen Fix-Option -->
		<div class="option">
			<input type="checkbox" id="ios_fullscreen_fix" name="blocklink_option[ios_fullscreen_fix]" value='1' <?php checked(1, $options['ios_fullscreen_fix'], true); ?>/>
			<label for="ios_fullscreen_fix">Fullscreen iOS-Fix aktivieren</label>
			<div class="collapse-info" id="iosfullscreenfix-info">
				<p>Es gibt nun keinen Jumper mehr auf iOS mit Fullscreen Sections</p>
			</div>
		</div>
		<?php submit_button(); ?>
	</form>
</div>
