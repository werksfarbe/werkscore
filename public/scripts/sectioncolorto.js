jQuery(document).ready(function($) {
	var lastColor = null; // Variable, um die zuletzt angewendete Farbe zu speichern

	$(window).scroll(function() {
		var $window = $(window),
			$body = $(werkscoreSettings.bodySelector || '.l-canvas'),
			$panels = $(werkscoreSettings.panelSelector || '.l-section'),
			scroll = $window.scrollTop() + ($window.height() / 3),
			colorSet = false;

		$panels.each(function() {
			var $this = $(this);
			if ($this.position().top <= scroll && $this.position().top + $this.height() > scroll) {
				var color = $this.data('colorchangto');
				if (color) {
					$body.removeClass(function(index, css) {
						return (css.match(/(^|\s)color-\S+/g) || []).join(' ');
					}).addClass('color-' + color);
					lastColor = color; // Speichern der zuletzt angewendeten Farbe
					colorSet = true;
					return false; // Brechen Sie die Schleife ab
				}
			}
		});

		// Anwenden der zuletzt gespeicherten Farbe, wenn keine andere Farbe gesetzt wurde
		if (!colorSet && lastColor) {
			$body.removeClass(function(index, css) {
				return (css.match(/(^|\s)color-\S+/g) || []).join(' ');
			}).addClass('color-' + lastColor);
		}
	});
});

jQuery(document).ready(function($) {
	// Funktion, um die Farbe der am meisten sichtbaren Section zu ermitteln und anzuwenden
	function applyColorOfMostVisibleSection() {
		var panelSelector = werkscoreSettings.panelSelector || '.l-section';
		var $bodySelector = $(werkscoreSettings.bodySelector || '.l-canvas');
		var maxVisibleArea = 0;
		var colorOfMostVisibleSection = null;

		$(panelSelector).each(function() {
			var $section = $(this);
			var visibleArea = getVisibleArea($section);

			if (visibleArea > maxVisibleArea) {
				maxVisibleArea = visibleArea;
				colorOfMostVisibleSection = $section.data('colorchangto');
			}
		});

		if (colorOfMostVisibleSection) {
			$bodySelector.addClass('color-' + colorOfMostVisibleSection);
		}
	}

	// Funktion, um zu berechnen, wie viel von der Section sichtbar ist
	function getVisibleArea($element) {
		var viewportHeight = $(window).height();
		var scrollTop = $(window).scrollTop();
		var elemTop = $element.offset().top;
		var elemHeight = $element.outerHeight();

		var startVisible = (elemTop < scrollTop) ? scrollTop : elemTop;
		var endVisible = ((elemTop + elemHeight) > (scrollTop + viewportHeight)) ? (scrollTop + viewportHeight) : (elemTop + elemHeight);
		
		return Math.max(0, endVisible - startVisible);
	}

	// Rufen Sie die Funktion beim Laden der Seite auf
	applyColorOfMostVisibleSection();
});
// Fix for alternate color 
document.addEventListener('DOMContentLoaded', function() {
	var css = '.color_alternate[data-colorchangto] { background-color: transparent !important; }';
	var style = document.createElement('style');
	style.type = 'text/css';
	if (style.styleSheet) {
		style.styleSheet.cssText = css;
	} else {
		style.appendChild(document.createTextNode(css));
	}
	document.getElementsByTagName('head')[0].appendChild(style);
});
