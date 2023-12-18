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
						<!-- Grid-Optionen deaktivieren -->
						<div class="card">
							<div class="card-body">
								<div class="option">
									<input type="checkbox" id="disable_grid_options" name="blocklink_option[disable_grid_options]" value='1' <?php checked(1, $options['disable_grid_options'], true); ?>/>
									<label for="disable_grid_options">Grid-Optionen deaktivieren</label>
									<span class="" type="button" data-bs-toggle="collapse" data-bs-target="#disable_grid_options-info" aria-expanded="false" aria-controls="disable_grid_options-info">ℹ️</span>
						
									<div class="collapse" id="disable_grid_options-info">
										<div class="card card-body">
											<p>Deaktivieren Sie spezifische Grid-Einstellungen, die im Frontend angewendet werden.</p>
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
						<!-- Section-Color-Changer -->
						<div class="card">
							<div class="card-body">
								<div class="option">
								<?php
									// In Ihrer Admin-Seite
									$options = get_option('blocklink_option');
									$colors = $options['custom_colors'] ?? []; // Stellen Sie sicher, dass dieser Schlüssel existiert und ein Array ist.
									
									// PHP-Array in JSON konvertieren, um es in JavaScript zu verwenden
									echo "<script>var savedColors = " . json_encode($colors) . ";</script>";
								?>

									<input type="checkbox" id="section_color_change" name="blocklink_option[section_color_change]" value='1' <?php checked(1, $options['section_color_change'], true); ?>/>
									<label for="section_color_change">Section-Farbwechsel aktivieren</label>
									<span class="" type="button" data-bs-toggle="collapse" data-bs-target="#section_color_change-info" aria-expanded="false" aria-controls="section_color_change-info">ℹ️</span>
									<!-- HTML für die dynamischen Farbfelder -->
									<div id="color-fields-container"></div>
									<button type="button" id="add-color-button" class="button button-secondary">Farbe hinzufügen</button>
									<!-- Felder siehe JavaScript -->
									<div class="collapse" id="section_color_change-info">
										<div class="card card-body">
											<p>Farbwechsler</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Parallax Flipbox-Option -->
						<div class="card">
							<div class="card-body">
								<div class="option">
									<input type="checkbox" id="parallax_flipbox" name="blocklink_option[parallax_flipbox]" value='1' <?php checked(1, $options['parallax_flipbox'], true); ?>/>
									<label for="parallax_flipbox">Parallax Flipbox aktivieren</label>
									<span class="" type="button" data-bs-toggle="collapse" data-bs-target="#parallax_flipbox-info" aria-expanded="false" aria-controls="parallax_flipbox-info">ℹ️</span>
								</div>
						
								<div class="option">
									<label for="parallax_distance">Parallax-Abstand:</label>
									<input type="text" id="parallax_distance" name="blocklink_option[parallax_distance]" value="<?php echo esc_attr($options['parallax_distance'] ?? '70px'); ?>"/>
								</div>
						
								<div class="option">
									<label for="parallax_scale">Skalierung:</label>
									<input type="text" id="parallax_scale" name="blocklink_option[parallax_scale]" value="<?php echo esc_attr($options['parallax_scale'] ?? '0.8'); ?>"/>
								</div>
								<div class="option">
									<label for="parallax_speed">Flip-Speed:</label>
									<input type="text" id="parallax_speed" name="blocklink_option[parallax_speed]" value="<?php echo esc_attr($options['parallax_speed'] ?? '0.8s'); ?>"/>
								</div>
								<div class="collapse" id="parallax_flipbox-info">
									<div class="card card-body">
										<p>Rasterlayout</p>
										<p>
											{"data":{"vwrapper:1":{"conditions":[],"css":{"default":{"background-color":"#0d780d"}},"el_class":"paca-container"},"vwrapper:2":{"alignment":"center","valign":"middle","conditions":[],"css":{"default":{"background-color":"linear-gradient(135deg,#e95095,#7049ba)"}},"el_class":"front side"},"vwrapper:3":{"conditions":[],"css":{"default":{"background-color":"_content_link"}},"el_class":"back side"},"vwrapper:4":{"conditions":[],"el_class":"content"},"vwrapper:5":{"conditions":[],"el_class":"content"},"post_title:1":{"link":"%7B%22type%22%3A%22post%22%7D"},"text:1":{"text":"Front","link":"%7B%22url%22%3A%22%22%7D"},"post_title:2":{"link":"%7B%22type%22%3A%22post%22%7D"},"text:2":{"text":"Back","link":"%7B%22url%22%3A%22%22%7D"},"vwrapper:6":{"conditions":[],"el_class":"paca-wrapper"}},"default":{"options":{"fixed":0,"ratio":"1x1","ratio_width":"21","ratio_height":"9","overflow":0,"color_bg":"","color_text":"","bg_img_source":"none","bg_img":"","bg_img_wrapper_start":"","bg_file_size":"large","bg_img_size":"cover","bg_img_position":"center center","bg_img_repeat":"no-repeat","bg_img_wrapper_end":"","border_radius":0,"box_shadow":0,"box_shadow_hover":0,"el_class":""},"layout":{"hidden":[],"middle_center":["vwrapper:6"],"vwrapper:1":["vwrapper:2","vwrapper:3"],"vwrapper:2":["vwrapper:4"],"vwrapper:3":["vwrapper:5"],"vwrapper:4":["post_title:1","text:1"],"vwrapper:5":["post_title:2","text:2"],"vwrapper:6":["vwrapper:1"]}}}
										</p>
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
