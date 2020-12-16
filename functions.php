<?php

if (!defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}

require_once __DIR__ . '/inc/elementor/init.php';
require_once __DIR__ . '/inc/product-search/product-search.php';


if (!function_exists('shop_theme_setup')) :
	function shop_theme_setup() {
		load_theme_textdomain('shop_theme', get_template_directory() . '/languages');

		add_theme_support('automatic-feed-links');

		add_theme_support('title-tag');

		add_theme_support('post-thumbnails');

		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'shop_theme'),
				'footer-1' => esc_html__('Footer 1', 'shop_theme'),
				'footer-2' => esc_html__('Footer 2', 'shop_theme'),
				'footer-3' => esc_html__('Footer 3', 'shop_theme'),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		add_theme_support(
			'custom-background',
			apply_filters(
				'shop_theme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support('customize-selective-refresh-widgets');

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 30,
				'width'       => 30,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
		require_once get_template_directory() . '/inc/WalkerNav.php';
	}
endif;
add_action('after_setup_theme', 'shop_theme_setup');


function shop_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters('shop_theme_content_width', 640);
}

add_action('after_setup_theme', 'shop_theme_content_width', 0);


function shop_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__('سایدبار', 'shop_theme'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('جایگاه سایدبار', 'shop_theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('سایدبار فروشگاه', 'shop_theme'),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__('جایگاه سایدبار فروشگاه.', 'shop_theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	//	register_sidebar(
	//		array(
	//			'name' => esc_html__('جایگاه فرم جستجو', 'shop_theme'),
	//			'id' => 'ajax-search',
	//			'class' => '',
	//			'before_widget' => '',
	//			'after_widget' => '',
	//			'before_title' => '',
	//			'after_title' => '',
	//		)
	//	);

}
add_action('widgets_init', 'shop_theme_widgets_init');


function shop_theme_scripts() {
	$uri = get_template_directory_uri();

	// Styles
	wp_enqueue_style('shop_theme-fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css');
	wp_enqueue_style('shop_theme-swiper', '//unpkg.com/swiper/swiper-bundle.min.css', array(), null);
	wp_enqueue_style('shop_theme-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), null);
	//	wp_enqueue_script( 'shop_theme-swiper', get_theme_file_uri( 'assets/css/swiper-bundle.min.css' ), array(), null, true );

	//	wp_enqueue_script( 'shop_theme-fonts', get_theme_file_uri('/assets/fonts/iranyekan.css'), array(), null, true );
	wp_enqueue_style('shop_theme-style_pooya_v2', get_theme_file_uri('pooya_v2.css'), array(), _S_VERSION);
	wp_enqueue_style('shop_theme-style', get_stylesheet_uri(), array(), _S_VERSION);

	// Scripts
	wp_enqueue_script('shop_theme-popper', get_theme_file_uri('assets/js/popper.min.js'), array('jquery'), null, true);
	wp_enqueue_script('shop_theme-bootstrap', get_theme_file_uri('assets/js/bootstrap.min.js'), array('jquery'), null, true);
	wp_enqueue_script('shop_theme-swiper', get_theme_file_uri('assets/js/swiper-bundle.min.js'), array('jquery'), null, true);
	wp_enqueue_script('shop_theme-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
	wp_enqueue_script('shop_theme-carousel', get_theme_file_uri('/js/carousel.js'), array('jquery'), null, true);
	if (class_exists("Woocommerce")) {
		wp_register_script('search-main', get_theme_file_uri('assets/js/modules/product-search.js'), array('jquery'), '', true);
		wp_localize_script(
			'search-main',
			'opt',
			array(
				'ajaxUrl'   => admin_url('admin-ajax.php'),
				'noResults' => esc_html__('محصولی یافت نشد.', 'textdomain'),
			)
		);
	}

	wp_enqueue_script('shop_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	wp_enqueue_script('scripts', get_theme_file_uri('js/script.js'), array('jquery'), null, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'shop_theme_scripts');


require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
// require get_template_directory() . '/inc/megamenu-custom-fields.php';
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}



function prevent_wp_login() {
	global $pagenow;
	$action = (isset($_GET['action'])) ? $_GET['action'] : '';
	if ($pagenow == 'wp-login.php' && (!$action || ($action && !in_array($action, array('logout', 'lostpassword', 'rp', 'resetpass'))))) {
		$page = get_bloginfo('url');
		wp_redirect($page);
		exit();
	}
}

add_action('init', 'prevent_wp_login');
