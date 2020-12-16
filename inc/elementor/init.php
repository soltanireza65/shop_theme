<?php

// namespace PyPracts;

use Elementor\Plugin;

class Widget_Loader {

    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    const MINIMUM_PHP_VERSION = '7.0';

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        // add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets'], 99);
        $this->init();
    }

    public function init() {
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }
        add_action('elementor/theme/register_locations', [$this, 'init_locations']);
        add_action('elementor/elements/categories_registered', [$this, 'init_categories']);
        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);

        // add_action('elementor/frontend/after_enqueue_styles', [$this, 'widget_styles']);
        // add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);
    }
    public function admin_notice_missing_main_plugin() {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension'),
            '<strong>' . esc_html__('Elementor Test Extension', 'elementor-test-extension') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-test-extension') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }

    public function admin_notice_minimum_elementor_version() {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension'),
            '<strong>' . esc_html__('Elementor Test Extension', 'elementor-test-extension') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-test-extension') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }

    public function admin_notice_minimum_php_version() {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension'),
            '<strong>' . esc_html__('Elementor Test Extension', 'elementor-test-extension') . '</strong>',
            '<strong>' . esc_html__('PHP', 'elementor-test-extension') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }

    public function widget_styles() {

        // wp_enqueue_style('shop_theme-bootstrap', get_theme_file_uri('/assets/css/bootstrap.min.css'), array(), null);
        // wp_register_style('widget-1', plugins_url('css/widget-1.css', __FILE__));

    }
    public function widget_scripts() {

        // wp_register_script('some-library', plugins_url('js/libs/some-library.js', __FILE__));
        // wp_register_script('widget-1', plugins_url('js/widget-1.js', __FILE__));
        // wp_register_script('widget-2', plugins_url('js/widget-2.js', __FILE__), ['jquery', 'some-library']);

    }

    public function init_categories($elements_manager) {
        $elements_manager->add_category(
            'pypracts',
            [
                'title' => 'ابزارک های <b style="color: #00bfd6;">قالب شاپ پای پرکتز</b>',
                'icon' => 'eicon-archive-title',
            ]
        );
    }
    public function init_widgets() {
        require_once __DIR__ . '/widgets/simple_carousel.php';
        Plugin::instance()->widgets_manager->register_widget_type(new CarouselWidget());
        require_once __DIR__ . '/widgets/product_carousel_titled.php';
        Plugin::instance()->widgets_manager->register_widget_type(new ProductCarouselTitlesWidget());

        if (class_exists('WooCommerce')) {
//            require_once __DIR__ . '/widgets/products.php';
//            Plugin::instance()->widgets_manager->register_widget_type(new Products_Widget());
//            require_once __DIR__ . '/widgets/product_carousel.php';
//            Plugin::instance()->widgets_manager->register_widget_type(new Products_Carousel_Widget());
//            require_once __DIR__ . '/widgets/products_slider.php';
//            Plugin::instance()->widgets_manager->register_widget_type(new Products_Slider_Widget());
//            require_once __DIR__ . '/widgets/category_products_slider.php';
//            Plugin::instance()->widgets_manager->register_widget_type(new Category_Products_Slider_Widget());
        }
    }

    public function init_locations($elementor_theme_manager) {

        $elementor_theme_manager->register_all_core_location();

    }

}

Widget_Loader::instance();