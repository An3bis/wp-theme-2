<?php 
class Taxes 
{
	public function __construct() {
		
	}

	public function getAllTaxes(): array {
		return get_taxonomies( array( 'public' => true, '_builtin' => false ) );
	}

	public function getTaxe(string $name): object {
		return get_terms( array( 'taxonomy' => $name, 'hide_empty' => false ) );
	}
}