<?php 

function ebor_tooltip( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'title' => 'Default Tooltop',
		'link' => '#'
	), $atts));	
	
	return '<a href="#" data-original-title="'. $title .'" rel="tooltip">' . $content . '</a>';
}
add_shortcode('tooltip', 'ebor_tooltip');

//Button [button link='google.com' size='large' color='blue' target='blank']Link Text[/button]
function seabird_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '',
		'size' => '',
		'type' => 'primary',
		'target' => ''
	), $atts));
	if($size == 'large') $size = 'btn-large';
	if($target == 'blank') $target = 'target="_blank"';
    return '<a href="' . esc_url($link) . '" '.$target.' class="btn '.$size.' btn-'.$type.'">' . $content . '</a>';
}
add_shortcode('button', 'seabird_button');