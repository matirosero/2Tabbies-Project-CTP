<?php
/*
Plugin Name: MRo Project Custom Post Type
Plugin URI: https://2tabbies.com/
Description: Projects custom post type, includes gallery field.
Version: 1.0
Author: Mat Rosero
Author URI: https://2tabbies.com/
License: GPLv2
*/

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/

function mro_register_project() {

	$labels = array(
		'name'                => __( 'Projects', 'mro-project-ctp' ),
		'singular_name'       => __( 'Project', 'mro-project-ctp' ),
		'add_new'             => _x( 'Add New Project', 'mro-project-ctp', 'mro-project-ctp' ),
		'add_new_item'        => __( 'Add New Project', 'mro-project-ctp' ),
		'edit_item'           => __( 'Edit Project', 'mro-project-ctp' ),
		'new_item'            => __( 'New Project', 'mro-project-ctp' ),
		'view_item'           => __( 'View Project', 'mro-project-ctp' ),
		'search_items'        => __( 'Search Projects', 'mro-project-ctp' ),
		'not_found'           => __( 'No Projects found', 'mro-project-ctp' ),
		'not_found_in_trash'  => __( 'No Projects found in Trash', 'mro-project-ctp' ),
		'parent_item_colon'   => __( 'Parent Project:', 'mro-project-ctp' ),
		'menu_name'           => __( 'Projects', 'mro-project-ctp' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'Post type for showcased projects',
		'taxonomies'          => array('project-categories'),
		'public'              => true,
		// 'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-portfolio',
		// 'show_in_nav_menus'   => true,
		// 'publicly_queryable'  => true,
		// 'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'author', 'thumbnail',
			'excerpt','custom-fields', 'revisions', 'page-attributes'
			)
	);

	register_post_type( 'project', $args );
}
add_action( 'init', 'mro_register_project' );

/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function mro_register_project_categories() {

	$labels = array(
		'name'					=> _x( 'Creative Fields', 'Taxonomy plural name', 'mro-project-ctp' ),
		'singular_name'			=> _x( 'Creative Field', 'Taxonomy singular name', 'mro-project-ctp' ),
		'search_items'			=> __( 'Search Fields', 'mro-project-ctp' ),
		'popular_items'			=> __( 'Popular Fields', 'mro-project-ctp' ),
		'all_items'				=> __( 'All Fields', 'mro-project-ctp' ),
		'parent_item'			=> __( 'Parent Field', 'mro-project-ctp' ),
		'parent_item_colon'		=> __( 'Parent Field', 'mro-project-ctp' ),
		'edit_item'				=> __( 'Edit Field', 'mro-project-ctp' ),
		'update_item'			=> __( 'Update Field', 'mro-project-ctp' ),
		'add_new_item'			=> __( 'Add New Field', 'mro-project-ctp' ),
		'new_item_name'			=> __( 'New Field Name', 'mro-project-ctp' ),
		'add_or_remove_items'	=> __( 'Add or remove Fields', 'mro-project-ctp' ),
		'choose_from_most_used'	=> __( 'Choose from most used text-domain', 'mro' ),
		'menu_name'				=> __( 'Creative Fields', 'mro' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,//not default
		'hierarchical'      => false,
		'show_tagcloud'     => false,//not default
		'show_ui'           => true,
		'query_var'         => true,
		"rewrite" 			=> array(
			'slug' 			=> 'fields', // Controls the base slug that will display before each term
			'with_front' 	=> false),
		'query_var'         => true,
		// 'capabilities'      => array(),
	);

	register_taxonomy( 'project-categories', array( 'project' ), $args );
}

add_action( 'init', 'mro_register_project_categories' );