<?php 
class Products 
{
	public function getProducts(): object {
	    return new WP_Query( array(
			'post_type'   		=> 'mytheme_product',
			'posts_per_page'	=> -1
		));
	}
}