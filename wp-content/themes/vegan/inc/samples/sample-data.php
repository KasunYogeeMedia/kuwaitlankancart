<?php

$path_dir = get_template_directory() . '/inc/samples/data/';
$path_uri = get_template_directory_uri() . '/inc/samples/data/';

if ( is_dir($path_dir) ) {
	$demo_datas = array(
		'home'               => array(
			'data_dir'      => $path_dir . 'home',
			'thumbnail_url' => $path_uri . 'home/screenshot.jpg',
			'title'         => esc_html__( 'Home 1', 'vegan' ),
			'demo_url'      => 'http://demoapusthemes.com/vegan/',
		),
		'home-2'               => array(
			'data_dir'      => $path_dir . 'home-2',
			'thumbnail_url' => $path_uri . 'home-2/screenshot.jpg',
			'title'         => esc_html__( 'Home 2', 'vegan' ),
			'demo_url'      => 'http://demoapusthemes.com/vegan/home-2/',
		),
		'home-3'               => array(
			'data_dir'      => $path_dir . 'home-3',
			'thumbnail_url' => $path_uri . 'home-3/screenshot.jpg',
			'title'         => esc_html__( 'Home 3', 'vegan' ),
			'demo_url'      => 'http://demoapusthemes.com/vegan/home-3/',
		),
		'home-4'               => array(
			'data_dir'      => $path_dir . 'home-4',
			'thumbnail_url' => $path_uri . 'home-4/screenshot.jpg',
			'title'         => esc_html__( 'Home 4', 'vegan' ),
			'demo_url'      => 'http://demoapusthemes.com/vegan/home-4/',
		),
		'home-5'               => array(
			'data_dir'      => $path_dir . 'home-5',
			'thumbnail_url' => $path_uri . 'home-5/screenshot.jpg',
			'title'         => esc_html__( 'Home 5', 'vegan' ),
			'demo_url'      => 'http://demoapusthemes.com/vegan/home-5/',
		),
		'home-6'               => array(
			'data_dir'      => $path_dir . 'home-6',
			'thumbnail_url' => $path_uri . 'home-6/screenshot.jpg',
			'title'         => esc_html__( 'Home 6', 'vegan' ),
			'demo_url'      => 'http://demoapusthemes.com/vegan/home-6/',
		)
	);
}