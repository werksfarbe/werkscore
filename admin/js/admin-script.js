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
