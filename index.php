<?php

/*
Plugin Name: Tucson Extra Features
Plugin URI: http://www.madeinebor.com
Description: Adds Custom Post Types & Custom Widgets to your WordPress install, specifically for the Tucson WordPress theme by TommusRhodus.
Version: 1.0
Author: TommusRhodus
Author URI: http://www.madeinebor.com
*/	

require_once( plugin_dir_path( __FILE__ ) . 'mega-menu.php' );
require_once( plugin_dir_path( __FILE__ ) . 'widgets.php' );
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes.php' );

function ebor_skills_taxonomy(){
	$labels = array(
		'name'              => _x( 'Skills', 'taxonomy general name' ),
		'singular_name'     => _x( 'Skill', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Skills' ),
		'all_items'         => __( 'All Skills' ),
		'parent_item'       => __( 'Parent Skill' ),
		'parent_item_colon' => __( 'Parent Skill:' ),
		'edit_item'         => __( 'Edit Skill' ),
		'update_item'       => __( 'Update Skill' ),
		'add_new_item'      => __( 'Add New Skill' ),
		'new_item_name'     => __( 'New Skill Name' ),
		'menu_name'         => __( 'Skill' ),
	);
	$args = array(
		'labels' => $labels
	);
	register_taxonomy( 'skills', 'dslc_projects', $args );
}
add_action('init','ebor_skills_taxonomy');