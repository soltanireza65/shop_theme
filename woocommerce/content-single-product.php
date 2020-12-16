<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );
//woocommerce_output_all_notices();
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.

	return;
}
?>
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

        <section>
            <div class="container bg-white rounded my-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end bg-light fa-2x text-secondary rounded mt-2">
                            <a href="#" class=" pl-3 wooscp-btn wooscp-btn-<?php echo get_the_ID() ?>"
                               data-id="<?php echo get_the_ID() ?>">
                                <i class="fas fa-random fa-2x"></i>
                            </a>
                            <a href="?add_to_wishlist=<?php echo get_the_ID() ?>" rel="nofollow"
                               data-product-id="<?php echo get_the_ID() ?>"
                               data-product-type="variable" data-original-product-id="<?php echo get_the_ID() ?>"
                               class="add_to_wishlist single_add_to_wishlist ml-2" data-title="Add to wishlist">
                                <i class="yith-wcwl-icon fa fa-heart fa-2x"></i>
                            </a>
                        </div>

						<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
                    </div>
                    <div class="col-md-8">
                        <div class="col-md-12 text-right">
                            <h6 class="text-right mb-0 mt-4">
                        </div>

                        <div class="col-md-6 d-inline-block text-right float-right product_meta_wraper">
							<?php woocommerce_template_single_title(); ?>
							<?php
							//							shop_theme_show_tags()
							?>
							<?php woocommerce_template_single_meta(); ?>
							<?php woocommerce_template_single_rating(); ?>

                            <h6 class="text-danger mt-4">ویژگی های محصول</h6>
							<?php
							shop_theme_woo_attribute();
							?>
                        </div>
						<?php do_shortcode( '[woo_ps_sms]' ) ?>
                        <div class="col-md-6 d-inline-block">
                            <div class="px-3 py-4 bg-light rounded mt-2">
                                <div class="d-flex justify-content-between text-secondary font-weight-bold">
                                    <p class="">فروشنده:</p>
                                    <a href="<?php echo site_url(); ?>/store/<?php the_author(); ?>">
										<?php the_author(); ?>
                                    </a>
                                </div>
                                <hr class="m-0"/>

                                <div class="d-flex justify-content-between mt-2 text-secondary font-weight-bold">
                                    <p>شناسه محصول</p>
									<?php echo $product->get_sku(); ?>
                                </div>
                                <hr class="m-0"/>
								<?php woocommerce_template_single_price(); ?>
                                <div class="d-flex justify-content-end mt-3">
									<?php woocommerce_template_single_add_to_cart(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="text-right bg-white p-3 w-100">
                        <h6 class="text-danger">معرفی کوتاه</h6>
						<?php woocommerce_template_single_excerpt(); ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="tabs">
            <div class="container">
                <div class="row">
					<?php woocommerce_output_product_data_tabs(); ?>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
					<?php woocommerce_upsell_display(); ?>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row related_products radius">
					<?php woocommerce_output_related_products(); ?>
                </div>
            </div>
        </section>

    </div>

<?php do_action( 'woocommerce_after_single_product' ); ?>