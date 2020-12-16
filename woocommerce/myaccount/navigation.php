<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_account_navigation');
$current_user = wp_get_current_user();
?>

<div class="my_account_parrent d-flex bg-white radius p-3">
	<nav class="woocommerce-MyAccount-navigation">

		<div class="card bg-light app_card radius my-2 p-0">
			<img height="150" class="card-img-top" src="<?php echo get_theme_file_uri('assets/images/store-header.png') ?>" alt="Card image cap">
			<!-- <?php echo get_avatar($current_user->user_email, 150); ?> -->
			<div class="card-body text-center p-0">
				<?php if (!empty($current_user->display_name)) { ?>
					<h1 class="store-name"><?php echo esc_html($current_user->display_name); ?></h1>
				<?php } ?>

				<p class="card-text text-secondary">
					<?php
					$founds = '[get-account-funds]';
					if ($founds == do_shortcode($founds)) {
						echo __('عضویت از ', 'negarshop') . human_time_diff(strtotime($current_user->user_registered), current_time('timestamp')) . __(" پیش", 'negarshop');
					} else {
						echo do_shortcode($founds);
					}
					?>
				</p>
				<a href="<?php echo wp_logout_url(wc_get_page_permalink('myaccount')); ?>" class="logout text-dark d-block bg-light py-2"><i class="fas fa-sign-in-alt fa-2x align-middle"></i><?php _e(' خروج از حساب', 'negarshop'); ?></a>
			</div>

		</div>

		<ul class="text-right text-secondary list-unstyled">
			<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
				<li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?> font-weight-bold py-2 px-3 mb-2  radius MyAccount-navigation-link">
					<a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>">
						<?php
						switch ($endpoint) {
							case "dashboard":
								echo '<i class="fas fa-user"></i>';
								break;
							case "orders":
								echo '<i class="fas fa-shopping-cart"></i>';
								break;
							case "downloads":
								echo '<i class="fas fa-download"></i>';
								break;
							case "edit-address":
								echo '<i class="fas fa-map-marked-alt"></i>';
								break;
							case "cb_favs":
								echo '<i class="fas fa-heart"></i>';
								break;
							case "edit-account":
								echo '<i class="fas fa-id-card"></i>';
								break;
							case "customer-logout":
								echo '<i class="fas fa-power-off"></i>';
								break;
							case "rma-requests":
								echo '<i class="fas fa-undo"></i>';
								break;
							case "following":
								echo '<i class="fas fa-users"></i>';
								break;
							case "support-tickets":
								echo '<i class="fas fa-envelope-open"></i>';
								break;
							case "wc-smart-coupons":
								echo '<i class="fas fa-ticket-alt"></i>';
								break;
							case "negar-favs":
								echo '<i class="fas fa-heart"></i>';
								break;
							case "affiliates":
								echo '<i class="fas fa-money-check"></i>';
								break;
							case "account-funds":
								echo '<i class="fas fa-credit-card"></i>';
								$label = __('کیف پول', 'negarshop');
								break;
							default:
								break;
						}
						?>
						<?php echo esc_html($label); ?>
					</a>
				</li>
			<?php endforeach; ?>

			<?php
			$store_user = null;
			if (function_exists('dokan')) {
				$store_user = dokan()->vendor->get($current_user->ID);
				$seller_pages = get_option('dokan_pages');
				$is_vendor = (!empty($store_user) and ($store_user->data->roles[0] == "administrator" or $store_user->data->roles[0] == "seller")) ? true : false;
				if ($is_vendor and !empty($seller_pages)) {
			?>

					<li class=" font-weight-bold py-2 px-3 mb-2  radius MyAccount-navigation-link">
						<a href="<?php echo get_the_permalink($seller_pages['dashboard']); ?>">
							<i class="fas fa-store"></i> پنل فروشندگان</a>
					</li>
			<?php
				}
			}
			?>

		</ul>
	</nav>

	<?php do_action('woocommerce_after_account_navigation'); ?>