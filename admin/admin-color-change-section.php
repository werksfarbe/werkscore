<?php
function my_custom_vc_row_html( $atts, $content = null ) {
	// Extrahieren der Attribute
	extract( shortcode_atts( array(
		'changecolor' => '',
	), $atts ) );

	// Erzeugen Sie den HTML-Code für die Section mit dem Data-Attribut
	$html = '<section data-changecolorto="'.esc_attr($changecolor).'">';
	$html .= do_shortcode( $content );
	$html .= '</section>';

	return $html;
}

// Überschreiben des Standard-VC-Row-Shortcodes
vc_map_update( 'vc_row', array( 'html_template' => 'my_custom_vc_row_html' ) );
