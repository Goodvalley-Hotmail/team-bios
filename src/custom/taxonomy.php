<?php
/**
 * Custom Taxonomy functionality.
 *
 * @package     namespace CameraSki\CPT\Custom;
 * @since       1.0.0
 * @author      Carles Goodvalley
 * @link        https://cameraski.com
 * @license     GNU General Public License 2.0+
 */

namespace CameraSki\CPT\Custom;

add_action( 'init', __NAMESPACE__ . '\register_custom_taxonomy' );
/**
 * Register the Taxonomy.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_custom_taxonomy() {

	$menu_label = __( 'Departments', 'teambios' );

	$labels = array(
		'name'                       => _x( 'Departments', 'taxonomy general name', 'teambios' ),
		'singular_name'              => _x( 'Department', 'taxonomy singular name', 'teambios' ),
		'search_items'               => __( 'Search Departments', 'teambios' ),
		'popular_items'              => __( 'Popular Departments', 'teambios' ),
		'all_items'                  => __( 'All Departments', 'teambios' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Department', 'teambios' ),
		'view_item'                  => __( 'View Department', 'teambios' ),
		'update_item'                => __( 'Update Department', 'teambios' ),
		'add_new_item'               => __( 'Add New Department', 'teambios' ),
		'new_item_name'              => __( 'New Department Name', 'teambios' ),
		'separate_items_with_commas' => __( 'Separate departments with commas', 'teambios' ),
		'add_or_remove_items'        => __( 'Add or remove departments', 'teambios' ),
		'choose_from_most_used'      => __( 'Choose from the most used departments', 'teambios' ),
		'not_found'                  => __( 'No departments found.', 'teambios' ),
		'menu_name'                  => $menu_label,
	);

	$args = array(
		'label'             => $menu_label,
		'labels'            => $labels,
		'hierarchical'      => true,
		'show_admin_column' => true,
	);

	register_taxonomy( 'department', array( 'team-bios', 'post' ), $args );

}

add_filter( 'genesis_post_meta', __NAMESPACE__ . '\filter_genesis_footer_post_meta' );
/**
 * Filters the Genesis Footer Entry Post Meta to add the Post Terms for our custom Taxonomy to it.
 *
 * @since   1.0.0
 *
 * @param string $post_meta
 *
 * @return string
 */
function filter_genesis_footer_post_meta( $post_meta ) {

	// We can do this with the built-in Genesis Shortcode (not Tonya's preferred method).
	//$post_meta .= ' [post_terms taxonomy="department" before="' . __( 'Department: ', 'teambios' ) . '"]';

	// We can do this
	$post_meta .= sprintf(
		' [post_terms taxonomy="%s" before="%s"]',
		'department',
		__( 'Department: ', 'teambios' )
	);

	return $post_meta;

}