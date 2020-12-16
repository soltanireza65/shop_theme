<?php

// function shop_theme_product_list() {
// 	$args        = wp_parse_args( [
// 		'post_type'   => 'product',
// 		'numberposts' => - 1,
// 		'orderby'     => 'title',
// 		'order'       => 'ASC',
// 	] );
// 	$products    = get_posts( $args );
// 	$items_array = [ '' => 'انتخاب کنید' ];
// 	if ( $products ) {
// 		foreach ( $products as $product ) {
// 			$items_array[ $product->ID ] = $product->post_title;
// 		}
// 	}

// 	return $items_array;
// }

// function shop_theme_product_cat_list() {
// 	$term_id              = 'product_cat';
// 	$categories           = get_terms($term_id);
// 	$category_list['all'] = 'همه';
// 	if (!empty($categories)) {
// 		foreach ($categories as $category) {
// 			$category_info                         = get_term($category, $term_id);
// 			$category_list[$category_info->slug] = $category_info->name;
// 		}
// 	}

// 	return $category_list;
// }
