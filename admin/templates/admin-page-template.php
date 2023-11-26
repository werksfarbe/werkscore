<?php
// Stellen Sie sicher, dass dieses Template nur im Kontext der Admin-Seite geladen wird.
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// Annahme: $options ist bereits definiert und enthält die Plugin-Optionen.
?>
<form method="post" action="options.php">
	<div class="container" style="padding-top:2rem">
		<div class="row werkscore-header">
			<div class="col">
				<div class="justify-content-between border d-flex align-items-center" style="border-radius: 0.375rem 0.375rem 0 0; padding: 2rem ">
					<h1>Werkscore Einstellungen</h1>
					<?php submit_button(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="border-end border-start"  style="padding: 2rem;">
						<?php
						settings_fields('werkscore_option_group');
						do_settings_sections('werkscore-plugin');
						
						?>
						<!-- Blocklink-Option -->
						<div class="card">
							<div class="card-body">
								<div class="option">
									<input type="checkbox" id="blocklink" name="blocklink_option[blocklink]" value='1' <?php checked(1, $options['blocklink'], true); ?>/>
									<label for="blocklink">Blocklink aktivieren</label>
									<span class="" type="button" data-bs-toggle="collapse" data-bs-target="#blocklink-info" aria-expanded="false" aria-controls="blocklink-info">ℹ️</span>
						
									<div class="collapse" id="blocklink-info">
										<div class="card card-body">
											<p>Setze in dein Rasterlayout einen Textbereich der auf das Post verlinkt. Gib dem Element die Klasse "blocklink". Dieser wird automataisch über die gesamte Fläche gelegt.</p>
											<p>Danach noch als Text in dem Textelement {{the_title}} eintragen damit der Text nicht leer ist</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Typehelper-Option -->
						<div class="card">
							<div class="card-body">
								<div class="option">
									<input type="checkbox" id="typehelper" name="blocklink_option[typehelper]" value='1' <?php checked(1, $options['typehelper'], true); ?>/>
									<label for="typehelper">Typehelper-Klassen aktivieren</label>
									<span class="" type="button" data-bs-toggle="collapse" data-bs-target="#typehelper-info" aria-expanded="false" aria-controls="typehelper-info">ℹ️</span>
						
									<div class="collapse" id="typehelper-info">
										<div class="card card-body">
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
								</div>
							</div>
						</div>
						<!-- iOS Fullscreen Fix-Option -->
						<div class="card">
							<div class="card-body">
								<div class="option">
									<input type="checkbox" id="ios_fullscreen_fix" name="blocklink_option[ios_fullscreen_fix]" value='1' <?php checked(1, $options['ios_fullscreen_fix'], true); ?>/>
									<label for="ios_fullscreen_fix">Fullscreen iOS-Fix aktivieren</label>
									<span class="" type="button" data-bs-toggle="collapse" data-bs-target="#ios_fullscreen_fix-info" aria-expanded="false" aria-controls="ios_fullscreen_fix-info">ℹ️</span>
						
									<div class="collapse" id="ios_fullscreen_fix-info">
										<div class="card card-body">
											<p>Es gibt nun keinen Jumper mehr auf iOS mit Fullscreen Sections</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					
				</div>
	
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="justify-content-between border d-flex align-items-center" style="border-radius: 0 0 0.375rem 0.375rem ; padding: 2rem ">
					<?php submit_button(); ?>
				</div>
			</div>
		</div>
	</div>
</form>
