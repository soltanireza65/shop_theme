<?php
// require_once get_template_directory() . '/inc/elementor/helpers/utlis.php';

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit;
}


function shop_theme_product_cat_list() {
	$term_id              = 'product_cat';
	$categories           = get_terms($term_id);
	// $cat_array['all'] = 'All Categories';

	if (!empty($categories)) {
		foreach ($categories as $cat) {
			$cat_info 	 = get_term($cat, $term_id);
			$cat_array[$cat_info->slug] = $cat_info->name;
		}
	}

	return $cat_array;
}

class ProductCarouselTitlesWidget extends Widget_Base {

	public function get_name() {
		return 'carousel_titled';
	}

	public function get_title() {
		return 'اسلایدر با عنوان';
	}

	public function get_icon() {
		return 'eicon-carousel';
	}

	public function get_categories() {
		return ['pypracts'];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => 'کوئری',
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'title',
			[
				'label'       => 'عنوان',
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'عنوان اسلایدر',
			]
		);

		$this->add_control(
			'categories',
			[
				'label'    => __('دسته بندی (ها)', 'plugin-domain'),
				'type'     => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options'  => shop_theme_product_cat_list(),
				// 'default'  => ['all']

			]
		);

		$this->add_control(
			'on_sale',
			[
				'label' => __('حراجی', 'plugin-domain'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('بله', 'your-plugin'),
				'label_off' => __('خیر', 'your-plugin'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// $title = '';
		// if ($settings['title']) {
		//   $title = $settings['title'];
		// }


		if ($settings['categories']) {


			$args = [
				'posts_per_page' => 15,
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'ignore_sticky_posts'   => 1,
				'tax_query'      => [
					[
						'taxonomy' => 'product_cat',
						'field'    => 'slug',
						// 'field'    => 'term_id',
						'terms'    => $settings['categories'],
					],
				],
			];

			// $q = new WP_Query([
			// 	'posts_per_page' => 15,
			// 	'post_type'      => 'product',
			// 	'post_status'    => 'publish',
			// 	'ignore_sticky_posts'   => 1,
			// 	'tax_query'      => [
			// 		[
			// 			'taxonomy' => 'product_cat',
			// 			'field'    => 'slug',
			// 			// 'field'    => 'term_id',
			// 			'terms'    => $settings['categories'],
			// 		],
			// 	],
			// ]);

			if ($settings['on_sale']) {
				$args = [
					'posts_per_page' => 15,
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'ignore_sticky_posts'   => 1,
					'meta_query'        => WC()->query->get_meta_query(),
					'post__in'          => array_merge(array(0), wc_get_product_ids_on_sale()),
					'tax_query'      => [
						[
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							// 'field'    => 'term_id',
							'terms'    => $settings['categories'],
						],
					],
				];
			}

			$q = new WP_Query($args);

			// var_dump($settings['categories']);
			// var_dump($q);
?>
			<?php $uid = rand(897987, 9879877); ?>

			<section class="">
				<div class="bg-white rounded overflow-hidden">
					<h4 class="text-right pt-3 mr-4">
						<?php
						if (!empty($settings['title'])) {
							echo $settings['title'];
						} else {
							echo 'عنوان وارد کنید';
						}
						?>
					</h4>
					<hr />

					<!--                    <div id="-->
					<?php //echo 'product-carousel-' . $uid 
					?>
					<!--" class="product-carousel row mx-auto">-->
					<div id="product-carousel" class="product-carousel row mx-auto">
						<!-- Additional required wrapper -->
						<div class="swiper-wrapper">
							<?php
							while ($q->have_posts()) : $q->the_post();
								global $product;
							?>
								<div class="swiper-slide">

									<?php
									wc_get_template_part('content', 'product');
									?>

								</div>
							<?php
							endwhile;
							?>
						</div>
					</div>
				</div>
			</section>

		<?php

		}


		?>
<?php

	}
}
