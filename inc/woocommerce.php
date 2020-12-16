<?php
function shop_theme_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
}

add_action('after_setup_theme', 'shop_theme_woocommerce_setup');

function shop_theme_woocommerce_scripts() {
	wp_enqueue_style('shop_theme-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION);

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style('shop_theme-woocommerce-style', $inline_font);
}

add_action('wp_enqueue_scripts', 'shop_theme_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

function shop_theme_woocommerce_active_body_class($classes) {
	$classes[] = 'woocommerce-active';

	return $classes;
}

add_filter('body_class', 'shop_theme_woocommerce_active_body_class');

function shop_theme_woocommerce_related_products_args($args) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args($defaults, $args);

	return $args;
}

add_filter('woocommerce_output_related_products_args', 'shop_theme_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('shop_theme_woocommerce_wrapper_before')) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function shop_theme_woocommerce_wrapper_before() {
?>
		<main id="primary" class="site-main">
		<?php
	}
}
add_action('woocommerce_before_main_content', 'shop_theme_woocommerce_wrapper_before');

if (!function_exists('shop_theme_woocommerce_wrapper_after')) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function shop_theme_woocommerce_wrapper_after() {
		?>
		</main><!-- #main -->
	<?php
	}
}
add_action('woocommerce_after_main_content', 'shop_theme_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
 * <?php
 * if ( function_exists( 'shop_theme_woocommerce_header_cart' ) ) {
 * shop_theme_woocommerce_header_cart();
 * }
 * ?>
 */

if (!function_exists('shop_theme_woocommerce_cart_link_fragment')) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 *
	 * @return array Fragments to refresh via AJAX.
	 */
	function shop_theme_woocommerce_cart_link_fragment($fragments) {
		ob_start();
		shop_theme_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'shop_theme_woocommerce_cart_link_fragment');

if (!function_exists('shop_theme_woocommerce_cart_link')) {
	function shop_theme_woocommerce_cart_link() {
	?>
		<a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'shop_theme'); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n('%d آیتم', '%d آیتم', WC()->cart->get_cart_contents_count(), 'shop_theme'),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<!-- <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span>
			<span class="count"><?php echo esc_html($item_count_text); ?></span> -->
			<i class="fas fa-shopping-cart icon-size-md circle_padding_white"></i>
		</a>
	<?php
	}
}

if (!function_exists('shop_theme_woocommerce_header_cart')) {
	function shop_theme_woocommerce_header_cart() {
		if (is_cart()) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
	?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr($class); ?>">
				<?php shop_theme_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget('WC_Widget_Cart', $instance);
				?>
			</li>
		</ul>
	<?php
	}
}


// Custom

// Product Search
// function shop_theme_woo_product_search() {

// 	$args = array(
// 		'number'     => '',
// 		'orderby'    => 'name',
// 		'order'      => 'ASC',
// 		'hide_empty' => true
// 	);
// 	$product_categories = get_terms('product_cat', $args);
// 	$categories_show = '<option value="">همه دسته بندی ها</option>';
// 	$check = '';
// 	if (is_search()) {
// 		if (isset($_GET['term']) && $_GET['term'] != '') {
// 			$check = isset($_GET['term']) ? sanitize_text_field(wp_unslash($_GET['term'])) : '';
// 		}
// 	}
// 	$checked = '';
// 	$allcat = esc_html__('همه دسته بندی ها', 'text-domain');
// 	$categories_show .= '<optgroup class="sm-advance-search" label="' . $allcat . '">';
// 	foreach ($product_categories as $category) {
// 		if (isset($category->slug)) {
// 			if (trim($category->slug) == trim($check)) {
// 				$checked = 'selected="selected"';
// 			}
// 			$categories_show  .= '<option ' . $checked . ' value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
// 			$checked = '';
// 		}
// 	}
// 	$categories_show .= '</optgroup>';
// 	$form = '<div class="cv-woo-product-search-wrapper"><form role="search" method="get" class="woocommerce-product-search" id="searchform"  action="' . esc_url(home_url('/')) . '">
// 					<div class = "search-wrap d-flex">
// 						 <div class="sm_search_wrap">
// 							<select class="cv-select-products false" name="term">' . $categories_show . '
// 							</select>
// 						 </div>
// 						 <div class="sm_search_form">
// 							 <input class="search-field" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__('Search products', 'easy-mart') . '" autocomplete="off"/>
// 							 <button type="submit" id="searchsubmit">
// 							 <i class="fa fa-search"></i></button>
// 							 <input type="hidden" name="post_type" value="product" />
// 							 <input type="hidden" name="taxonomy" value="product_cat" />
// 						 </div>
// 						 <div class="search-content"></div>
// 					</div>

// 				</form><!-- .woocommerce-product-search --></div><!-- .cv-woo-product-search-wrapper -->';
// 	echo $form;
// }

function shop_theme_woo_product_search() {
	?>
	<form role="search" method="get" class="form-inline woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
		<div class="form-group">
			<div class="input-group mb-3">
				<div class="input-group-prepend top_search_cat_select">
					<?php
					$product_cats = get_terms(array(
						'taxonomy' => 'product_cat',
					));

					if (!empty($product_cats) && !is_wp_error($product_cats)) :
						$selected_product_cat = get_query_var('product_cat');
					?>
						<select name="product_cat" class="cate-dropdown">
							<option value="">دسته بندی ها</option>
							<?php
							foreach ($product_cats as $product_cat) {
							?>
								<option value="<?php echo esc_attr($product_cat->slug) ?>" <?php selected($product_cat->slug, $selected_product_cat) ?>><?php echo esc_html($product_cat->name); ?></option>
							<?php
							}
							?>
						</select>
					<?php endif; ?>
				</div>
				<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="جستجو در دکان" value="<?php echo get_search_query(); ?>" name="s" />
				<div class="input-group-append">
					<button type="submit" value=""><i class="fa fa-search" aria-hidden="true"></i></button>
					<input type="hidden" name="post_type" value="product" />
				</div>
			</div>
		</div>
	</form>
<?php
}







remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);


// Yith Woo After Wishlist Button
function shop_theme_browse_wishlist_button() {
	return '<i class="fas fa-heart color-danger"></i>';
}

add_filter('yith-wcwl-browse-wishlist-label', 'shop_theme_browse_wishlist_button');

// Yith Woo After Wishlist Button
function shop_theme_compare_label() {
	return '';
}

// add_filter('yith_woocompare_compare_added_label', 'shop_theme_compare_label');


function shop_theme_woocommerce_breadcrumbs() {
	return array(
		'delimiter'   => '&#47;',
		'wrap_before' => '<nav class="text-right d-flex align-items-center pb-0 pt-3 px-3 text-secondary woocommerce-breadcrumb" itemprop="breadcrumb"><i class="fas fa-map-marker-alt text-right fa-2x px-2"></i>',
		'wrap_after'  => '</nav>',
		'before'      => '',
		'after'       => '',
		'home'        => _x('Home', 'breadcrumb', 'woocommerce'),
	);
}

add_filter('woocommerce_breadcrumb_defaults', 'shop_theme_woocommerce_breadcrumbs');

if (!function_exists('shop_theme_loop_columns')) {
	function shop_theme_loop_columns() {
		return 3;
	}
}
add_filter('loop_shop_columns', 'shop_theme_loop_columns');

function shop_theme_custom_pagination() {
	global $wp_query;
	if ($wp_query->max_num_pages <= 1) {
		return;
	}
	$big   = 9999999999;
	$pages = paginate_links([
		'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format'    => '?paged=%#%',
		'current'   => max(1, get_query_var('paged')),
		'total'     => $wp_query->max_num_pages,
		'type'      => 'array',
		'prev_next' => true,
		'prev_text' => '',
		'next_text' => '',
	]);
	if (is_array($pages)) {
		$paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
		echo '<div class="pagination-wrap">';
		echo '<ul class="pagination">';
		foreach ($paged as $page) {
			echo '<li>$page</li>';
		}
		echo '</ul>';
		echo '</div>';
	}
}

function shop_theme_related_products_by_same_title($related_posts, $product_id, $args) {
	$product       = wc_get_product($product_id);
	$title         = $product->get_name();
	$related_posts = get_posts(array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'title'          => $title,
		'fields'         => 'ids',
		'posts_per_page' => -1,
		'exclude'        => array($product_id),
	));

	return $related_posts;
}

// add_filter('woocommerce_related_products', 'shop_theme_related_products_by_same_title', 9999, 3);


function shop_theme_related_products_args($args) {
	$args['posts_per_page'] = 4; // 12 related products
	$args['columns']        = 4; // arranged in 2 columns

	return $args;
}

add_filter('woocommerce_output_related_products_args', 'shop_theme_related_products_args', 20);


function shop_theme_remove_single_product_tabs($tabs) {
	unset($tabs['more_seller_product']);

	return $tabs;
}

add_filter('woocommerce_product_tabs', 'shop_theme_remove_single_product_tabs', 11);


function shop_theme_have_coupon_message() {
	return '<i class="fa fa-ticket" aria-hidden="true"></i> Have a coupon? <a href="#" class="showcoupon">Click here to enter your discount code</a>';
}

// add_filter('woocommerce_checkout_coupon_message', 'shop_theme_have_coupon_message');


// Checkout Fields
function shop_theme_remove_checkout_fields($fields) {
	// Billing fields
	//	unset( $fields['billing']['billing_company'] );
	//	unset( $fields['billing']['billing_email'] );
	//	unset( $fields['billing']['billing_country'] );
	// unset($fields['billing']['billing_phone']);
	// unset($fields['billing']['billing_state']);
	// unset($fields['billing']['billing_first_name']);
	// unset($fields['billing']['billing_last_name']);
	// unset($fields['billing']['billing_address_1']);
	// unset($fields['billing']['billing_address_2']);
	// unset($fields['billing']['billing_city']);
	// unset($fields['billing']['billing_postcode']);

	// Shipping fields
	//	unset( $fields['shipping']['shipping_company'] );
	// unset($fields['shipping']['shipping_phone']);
	// unset($fields['shipping']['shipping_state']);
	// unset($fields['shipping']['shipping_first_name']);
	// unset($fields['shipping']['shipping_last_name']);
	// unset($fields['shipping']['shipping_address_1']);
	// unset($fields['shipping']['shipping_address_2']);
	// unset($fields['shipping']['shipping_city']);
	// unset($fields['shipping']['shipping_postcode']);

	// Order fields
	// unset($fields['order']['order_comments']);


	// $fields['billing']['billing_company']['placeholder'] = 'Business Name';
	// $fields['billing']['billing_company']['label'] = 'Business Name';
	// $fields['billing']['billing_first_name']['placeholder'] = 'First Name';
	// $fields['shipping']['shipping_first_name']['placeholder'] = 'First Name';
	// $fields['shipping']['shipping_last_name']['placeholder'] = 'Last Name';
	// $fields['shipping']['shipping_company']['placeholder'] = 'Company Name';
	// $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
	// $fields['billing']['billing_email']['placeholder'] = 'Email Address ';
	// $fields['billing']['billing_phone']['placeholder'] = 'Phone ';

	// $order = array(
	//     "billing_first_name",
	//     "billing_last_name",
	//     "shipping_state",
	//     "billing_city",
	//     "billing_address_1",
	//     "billing_address_2",
	//     "billing_postcode",
	//     // "billing_email",
	//     "billing_phone"
	// );
	// foreach ($order as $field) {
	//     $ordered_fields[$field] = $fields["billing"][$field];
	// }

	// $fields["billing"] = $ordered_fields;

	return $fields;
}

// add_filter('woocommerce_checkout_fields', 'shop_theme_remove_checkout_fields');

function shop_theme_unrequire_wc_fields($fields) {
	//	$fields['billing_phone']['required']   = false;
	$fields['billing_country']['required'] = false;

	return $fields;
}

add_filter('woocommerce_billing_fields', 'shop_theme_unrequire_wc_fields');


// function shop_theme_override_checkout_fields($fields)
// {
//     unset($fields['billing']['billing_address_2']);
//     $fields['billing']['billing_company']['placeholder'] = 'Business Name';
//     $fields['billing']['billing_company']['label'] = 'Business Name';
//     $fields['billing']['billing_first_name']['placeholder'] = 'First Name';
//     $fields['shipping']['shipping_first_name']['placeholder'] = 'First Name';
//     $fields['shipping']['shipping_last_name']['placeholder'] = 'Last Name';
//     $fields['shipping']['shipping_company']['placeholder'] = 'Company Name';
//     $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
//     $fields['billing']['billing_email']['placeholder'] = 'Email Address ';
//     $fields['billing']['billing_phone']['placeholder'] = 'Phone ';
//     return $fields;
// }
// add_filter('woocommerce_checkout_fields', 'shop_theme_override_checkout_fields');


// Reorder Checkout Fields

function shop_theme_order_wc_fields($fields) {
	$order = array(
		"billing_first_name",
		"billing_last_name",
		"billing_address_1",
		"billing_address_2",
		"billing_postcode",
		// "billing_email",
		"billing_phone"
	);
	foreach ($order as $field) {
		$ordered_fields[$field] = $fields["billing"][$field];
	}

	$fields["billing"] = $ordered_fields;

	return $fields;
}

// add_filter("woocommerce_checkout_fields", "shop_theme_order_wc_fields");

function shop_theme_woo_attribute() {
	global $product;
	$attributes = $product->get_attributes();
	if (!$attributes) {
		return;
	}
	$display_result = '<ul class="product_attributes_top">';
	foreach ($attributes as $attribute) {
		if ($attribute->get_variation()) {
			continue;
		}
		$name = $attribute->get_name();
		if ($attribute->is_taxonomy()) {
			$terms              = wp_get_post_terms($product->get_id(), $name, 'all');
			$cwtax              = $terms[0]->taxonomy;
			$cw_object_taxonomy = get_taxonomy($cwtax);
			if (isset($cw_object_taxonomy->labels->singular_name)) {
				$tax_label = $cw_object_taxonomy->labels->singular_name;
			} elseif (isset($cw_object_taxonomy->label)) {
				$tax_label = $cw_object_taxonomy->label;
				if (0 === strpos($tax_label, 'Product ')) {
					$tax_label = substr($tax_label, 8);
				}
			}
			$display_result .= $tax_label . ': ';
			$tax_terms      = array();
			foreach ($terms as $term) {
				$single_term = esc_html($term->name);
				array_push($tax_terms, $single_term);
			}
			$display_result .= implode(', ', $tax_terms) . '<br />';
		} else {
			$display_result .= '<li class="attribute_item">' . $name . ': ';
			$display_result .= esc_html(implode(', ', $attribute->get_options())) . '<br />';
		}
	}
	echo $display_result . '</ul>';
}

//add_action('woocommerce_single_product_summary', 'shop_theme_woo_attribute', 25);


//add_action( 'woocommerce_single_product_summary', 'display_author_name', 20 );
function display_author_name() {
	// Get the author ID (the vendor ID)
	$vendor_id = get_post_field('post_author', get_the_id());
	// Get the WP_User object (the vendor) from author ID
	$vendor = new WP_User($vendor_id);

	$store_info = dokan_get_store_info($vendor_id); // Get the store data
	$store_name = $store_info['store_name'];          // Get the store name
	$store_url  = dokan_get_store_url($vendor_id);  // Get the store URL

	$vendor_name = $vendor->display_name;              // Get the vendor name
	$address     = $vendor->billing_address_1;           // Get the vendor address
	$postcode    = $vendor->billing_postcode;          // Get the vendor postcode
	$city        = $vendor->billing_city;              // Get the vendor city
	$state       = $vendor->billing_state;             // Get the vendor state
	$country     = $vendor->billing_country;           // Get the vendor country

	// Display the seller name linked to the store
	printf('<b>Seller Name:</b> <a href="%s">%s</a>', $store_url, $store_name);
}


function shop_theme_show_tags() {
	$current_tags = get_the_terms(get_the_ID(), 'product_tag');
	if ($current_tags && !is_wp_error($current_tags)) {
		echo '<ul class="product_tags">';
		foreach ($current_tags as $tag) {
			$tag_title = $tag->name; // tag name
			$tag_link  = get_term_link($tag); // tag archive link
			echo '<li><a href="' . $tag_link . '">' . $tag_title . '</a></li>';
		}

		echo '</ul>';
	}
}

//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );