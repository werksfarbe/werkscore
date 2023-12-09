jQuery(document).ready(function($) {
	var $window = $(window),
		$body = $(werkscoreSettings.bodySelector),
		$panel = $(werkscoreSettings.panelSelector);

	// Funktion zum Ändern der Farbe
	function changeColorBasedOnScroll() {
		var scroll = $window.scrollTop() + ($window.height() / 3);

		$panel.each(function() {
			var $this = $(this);

			if ($this.position().top <= scroll && $this.position().top + $this.height() > scroll) {
				$body.removeClass(function(index, css) {
					return (css.match(/(^|\s)color-\S+/g) || []).join(' ');
				});

				$body.addClass('color-' + $this.data('colorchangto'));
			}
		});
	}

	// Event-Listener für das Scrollen
	$(window).scroll(changeColorBasedOnScroll);

	// Farbe beim Laden der Seite setzen
	changeColorBasedOnScroll();
});
