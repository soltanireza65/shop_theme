<?php if (!defined('ABSPATH')) {
    exit;
} ?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'shop_theme'); ?></a>
        <div class="app_top_bar bg-dark ">
            <div class="container-lg d-flex justify-content-between align-items-center">
                <div class="text-white">
                    <p><?php echo get_theme_mod('location', 'خیابان فلان، کجتمع بیسار، واحد فلان') ?></p>
                </div>
                <div class="text-white d-flex">
                    <p class="ml-3 "><a class="text-white" href="mailto:<?php echo get_theme_mod('email', 'mail@info.com') ?>"><?php echo get_theme_mod('email', 'mail@info.com') ?></a></p>
                    <p><a class="text-white" href="tel:<?php echo get_theme_mod('phone', '04112345678') ?>"><?php echo get_theme_mod('phone', '04112345678') ?></a></p>
                </div>

                <div class="app_top_icons">
                    <a class="app_social_icon_link" href="<?php echo get_theme_mod('instagram_url', 'https://www.instagram.com/') ?>">
                        <i class="app_social_icon fab fa-instagram icon-size-sm icon-bg ml-1"></i>
                    </a>
                    <a class="app_social_icon_link" href="<?php echo get_theme_mod('google_plus_url', 'https://www.google.com/') ?>">
                        <i class="app_social_icon fab fa-google-plus-g icon-size-sm icon-bg ml-1"></i>
                    </a>
                    <a class="app_social_icon_link" href="<?php echo get_theme_mod('telegram_url', 'https://www.telegram.com/') ?>">
                        <i class="app_social_icon fab fa-telegram-plane icon-size-sm icon-bg ml-1"></i>
                    </a>
                    <a class="app_social_icon_link" href="<?php echo get_theme_mod('twitter_url', 'https://www.twitter.com/') ?>">
                        <i class="app_social_icon fab fa-twitter icon-size-sm icon-bg"></i>
                    </a>
                </div>

                <?php
                // $user = wp_get_current_user();
                // $roles = (array) $user->roles;
                // var_dump($roles);


                // $user = wp_get_current_user();
                // if (in_array('seller', (array) $user->roles)) {
                //     //The user has the "author" role
                // }
                ?>

            </div>

        </div>
        <header id="masthead" class="app_top_header site-header d-flex container justify-content-between">
            <div class="site-branding">
                <?php the_custom_logo(); ?>
            </div>
            <div class="header_search_form_wraper">
                <?php shop_theme_woo_product_search(); ?>
            </div>
            <div class="d-flex position-relative">
                <div class="d-flex align-items-center p-0 px-1 text-secondary">


                    <?php
                    if (function_exists('shop_theme_woocommerce_header_cart')) {
                        shop_theme_woocommerce_header_cart();
                    }
                    ?>

                    <div class="user_links_dropdown mr-4 ">
                        <a class="dropbtn"><i class="fas fa-user circle_padding_white"></i></a>
                        <div class=" text-center overflow-hidden bg-white user_links_dropdown-content text-right border-0 radius app_auth_urls" aria-labelledby="dropdownMenuButton">

                            <?php if (is_user_logged_in()) : ?>
                                <a class="dropdown-item" href="<?php echo get_site_url() ?>/shop_proj/my-account/">حساب کاربری</a>
                                <?php
                                $user = wp_get_current_user();
                                if (in_array('seller', (array) $user->roles)) {
                                ?>
                                    <a class="dropdown-item" href="<?php echo get_site_url() ?>/shop_proj/dashboard">پنل فروشندگان</a>

                                <?php
                                }
                                ?>
                                <?php wp_loginout(); ?>
                            <?php else : ?>
                                <a class="text-center dropdown-item" href="<?php echo get_site_url() ?>/shop_proj/my-account/">ورود/ ثبت نام</a>
                                <!-- <a class="dropdown-item" href="<?php echo get_site_url() ?>/shop_proj/my-account/?register">ثبت نام</a>
                                <a class="dropdown-item" href="<?php echo get_site_url() ?>/shop_proj/my-account/?register">ثبت نام</a> -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <header class="bg-light d-flex">
            <nav id="site-navigation" class="site-navigation container" role="navigation">
                <?php
                wp_nav_menu(
                    array('theme_location' => 'menu-1')
                );
                ?>
            </nav>

        </header>