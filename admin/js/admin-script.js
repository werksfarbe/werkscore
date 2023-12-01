// Collapse-Element auf der Adminseite
jQuery(document).ready(function($) {
	// Funktion zum Umschalten des Panels basierend auf dem Zustand der Checkbox
	function togglePanel(checkbox) {
		var collapsePanel = checkbox.next('.collapse-info');
		if (checkbox.is(':checked')) {
			collapsePanel.show();
		} else {
			collapsePanel.hide();
		}
	}

	// Initialisieren und Event Handler für alle Checkboxen hinzufügen
	$('input[type="checkbox"]').each(function() {
		var checkbox = $(this);
		togglePanel(checkbox); // Initialisieren beim Laden der Seite

		checkbox.change(function() {
			togglePanel(checkbox); // Umschalten beim Ändern der Checkbox
		});
	});
});
// ---------------- Section Color ---------------------------
// Funktion zum Hinzufügen eines neuen Farbfelds
function addColorField(name = '', value = '', index) {
	var container = document.getElementById('color-fields-container');
	var html = '<div class="color-field-group section_color_change_fieldgroup"><input type="text" name="blocklink_option[color_name_' + index + ']" placeholder="Farbname" value="' + name + '"> <input type="text" name="blocklink_option[color_value_' + index + ']" placeholder="Farbwert oder CSS-Variable" value="' + value + '"> <button type="button" class="remove-color-button button button-secondary">🗑️</button></div>';
	container.insertAdjacentHTML('beforeend', html);
}

// Vorhandene Farben beim Laden der Seite hinzufügen
document.addEventListener('DOMContentLoaded', function() {
	if (savedColors && savedColors.length > 0) {
		savedColors.forEach(function(color, index) {
			addColorField(color.name, color.value, index);
		});
	}
});

document.getElementById('add-color-button').addEventListener('click', function() {
	var index = document.querySelectorAll('.color-field-group').length;
	addColorField('', '', index);
});

document.getElementById('color-fields-container').addEventListener('click', function(e) {
	if (e.target && e.target.classList.contains('remove-color-button')) {
		var colorFieldGroup = e.target.closest('.color-field-group');
		if (colorFieldGroup) {
			colorFieldGroup.remove();
		}
	}
});
