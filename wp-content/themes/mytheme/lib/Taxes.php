<?php 
class Taxes 
{
	public function __construct() {
		
	}

	public function getAllTaxes(): array {
		return get_taxonomies( array( 'public' => true, '_builtin' => false ) );
	}

	public function getTaxe(int $id, string $name): array {
		return wp_get_post_terms( $id, $name );
	}

	public function getTerms(string $name): array {
		return get_terms($name, array( 'hide_empty' => false ));
	}

	public function registerTaxes() {
		register_taxonomy(
			'Color',
			'mytheme_product',
			array(
			  'hierarchical'      => true,
			  'labels'            => array(
			     'name'          => _x( 'Edit values', 'taxonomy general name' ),
			     'singular_name' => _x( 'Color', 'taxonomy singular name' ),
			     'all_items'     => __( 'All' ),
			     'edit_item'     => __( 'Edit' ),
			     'update_item'   => __( 'Update' ),
			     'add_new_item'  => __( 'Add item' ),
			     'menu_name'     => __( 'Color' ),
			  ),
			  'show_ui'           => true,
			  'show_admin_column' => true,
			  'query_var'         => true,
			  'rewrite'           => array( 'slug' => 'ram' ),
			)
		);

		register_taxonomy(
			'Android',
			'mytheme_product',
			array(
			  'hierarchical'      => true,
			  'labels'            => array(
			     'name'          => _x( 'Edit values', 'taxonomy general name' ),
			     'singular_name' => _x( 'Android', 'taxonomy singular name' ),
			     'all_items'     => __( 'All' ),
			     'edit_item'     => __( 'Edit' ),
			     'update_item'   => __( 'Update' ),
			     'add_new_item'  => __( 'Add item' ),
			     'menu_name'     => __( 'Android' ),
			  ),
			  'show_ui'           => true,
			  'show_admin_column' => true,
			  'query_var'         => true,
			  'rewrite'           => array( 'slug' => 'ram' ),
			)
		);	

		register_taxonomy(
			'RAM',
			'mytheme_product',
			array(
			  'hierarchical'      => true,
			  'labels'            => array(
			     'name'          => _x( 'Edit values', 'taxonomy general name' ),
			     'singular_name' => _x( 'RAM', 'taxonomy singular name' ),
			     'all_items'     => __( 'All' ),
			     'edit_item'     => __( 'Edit' ),
			     'update_item'   => __( 'Update' ),
			     'add_new_item'  => __( 'Add item' ),
			     'menu_name'     => __( 'RAM' ),
			  ),
			  'show_ui'           => true,
			  'show_admin_column' => true,
			  'query_var'         => true,
			  'rewrite'           => array( 'slug' => 'ram' ),
			)
		);		
	}
}