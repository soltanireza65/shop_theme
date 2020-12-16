<?php

function shop_theme_customize_register($wp_customize) {

	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'shop_theme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'shop_theme_customize_partial_blogdescription',
			)
		);
	}

	// Social Section
	$wp_customize->add_section('shop_theme_social', [
		'title' 				=> __('شبکه های اجتماعی', 'shop_theme'),
		'description' 				=> sprintf(__('آدرس شبکه های اجتماعی', 'shop_theme')),
		'priority' 				=> 130,

	]);

	// Instagram  
	$wp_customize->add_setting('instagram_url', [
		'default' 				=> _x('https://www.instagram.com', 'shop_theme'),
		'type' 					=> 'theme_mod',
	]);


	$wp_customize->add_control('instagram_url', [
		'label' 				=> _x('آدرس اینستاگرام', 'shop_theme'),
		'section' 				=> 'shop_theme_social',
		'type' => 'url',
		'input_attrs' => array(
			'placeholder' => __('https://www.example.com'),
		),
		'priority' 				=> 20,
	]);


	// Twitter
	$wp_customize->add_setting('twitter_url', [
		'default' 				=> _x('https://www.twitter.com', 'shop_theme'),
		'type' 					=> 'theme_mod',
	]);

	$wp_customize->add_control('twitter_url', [
		'label' 				=> _x('آدرس تویتر', 'shop_theme'),
		'section' 				=> 'shop_theme_social',
		'type' => 'url',
		'input_attrs' => array(
			'placeholder' => __('https://www.example.com'),
		),

		'priority' 				=> 20,
	]);


	// Telegram
	$wp_customize->add_setting('telegram_url', [
		'default' 				=> _x('https://www.telegram.com', 'shop_theme'),
		'type' 					=> 'theme_mod',
	]);

	$wp_customize->add_control('telegram_url', [
		'label' 				=> _x('آدرس تلگرام', 'shop_theme'),
		'section' 				=> 'shop_theme_social',
		'type' => 'url',
		'input_attrs' => array(
			'placeholder' => __('https://www.example.com'),
		),

		'priority' 				=> 20,
	]);


	// google Plus
	$wp_customize->add_setting('google_plus_url', [
		'default' 				=> _x('https://www.google.com', 'shop_theme'),
		'type' 					=> 'theme_mod',
	]);

	$wp_customize->add_control('google_plus_url', [
		'label' 				=> _x('آدرس گوگل پلاس', 'shop_theme'),
		'section' 				=> 'shop_theme_social',
		'type' => 'url',
		'input_attrs' => array(
			'placeholder' => __('https://www.example.com'),
		),

		'priority' 				=> 20,
	]);

	$wp_customize->add_section('shop_theme_address', [
		'title' 				=> __('آدرس فروشگاه', 'shop_theme'),
		'description' 				=> sprintf(__('آدرس فروشگاه', 'shop_theme')),
		'priority' 				=> 130,
	]);

	// Location
	$wp_customize->add_setting('location', [
		'default' 				=> _x('خیابان فلان، کجتمع بیسار، واحد فلانی', 'shop_theme'),
		'type' 					=> 'theme_mod',
	]);

	$wp_customize->add_control('location', [
		'label' 				=> _x('آدرس فروشگاه فیزیکی', 'shop_theme'),
		'section' 				=> 'shop_theme_address',
		'priority' 				=> 20,
	]);


	// Phone
	$wp_customize->add_setting('phone', [
		'default' 				=> _x('041-12345678', 'shop_theme'),
		'type' 					=> 'theme_mod',
	]);

	$wp_customize->add_control('phone', [
		'label' 				=> _x('تلفن فروشگاه', 'shop_theme'),
		'section' 				=> 'shop_theme_address',
		'priority' 				=> 20,
	]);


	// Email
	$wp_customize->add_setting('email', [
		'default' 				=> _x('mail@info.com', 'shop_theme'),
		'type' 					=> 'theme_mod',
	]);

	$wp_customize->add_control('email', [
		'label' 				=> _x('آدرس ایمیل فروشگاه', 'shop_theme'),
		'section' 				=> 'shop_theme_address',
		'priority' 				=> 20,
	]);
}
add_action('customize_register', 'shop_theme_customize_register');


function shop_theme_customize_partial_blogname() {
	bloginfo('name');
}


function shop_theme_customize_partial_blogdescription() {
	bloginfo('description');
}


function shop_theme_customize_preview_js() {
	wp_enqueue_script('shop_theme-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'shop_theme_customize_preview_js');
