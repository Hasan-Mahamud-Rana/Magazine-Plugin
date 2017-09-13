<?php
/*
Plugin Name: Nordjyske magazine slider
Plugin URI: https://wordpress.org/plugins/
Description: This plugin is for Nordjyske, to manage magazine automatically from epages.dk.
Author: Hasan Mahamud Rana
Version: 1.0
Author URI: https://www.facebook.com/rana.imagine
*/

#define('WP_DEBUG', TRUE);

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
	exit;
}

$dir = plugin_dir_path(__FILE__);
require( $dir . 'nordjyske_api.php');

function get_magazine_details() {
	$customerid = '';
	$folder = 7827;
	$offset = 0;
	$limit = 8;

  $url = API_HOST . '/nordjyskemain/publications.php?customer=' . $customerid . '&folder=' . $folder . '&offset=' . $offset . '&limit=' . $limit . '';
  $body = null;

  $response = fetch_nordjyske_api_data($url, $body);
  return $response->papers;
}

function slider_code() {
	$magazines = get_magazine_details();
	$magazines = array_reverse($magazines, true);
	echo '<div class="magazineSlide">';

	foreach($magazines as $magazine){
	 	$title = $magazine->title;
	 	//echo 'Title: '. $title . '<br/>';

	 	$date = $magazine->date;
	 	//echo 'Date: '. $date . '<br/>';

	 	$expires = $magazine->expires;
	 	//echo 'Expires: '. $expires . '<br/>';

	 	$catalog = $magazine->catalog;
	 	//echo 'Catalog: '. $catalog . '<br/>';

	 	$foldername = $magazine->foldername;
	 	//echo 'Foldername: '. $foldername . '<br/>';

	 	$folder = $magazine->folder;
	 	//echo 'Folder: '. $folder . '<br/>';

	 	$pages = $magazine->pages;
	 	//echo 'Pages: '. $pages . '<br/>';

	 	$sectionstarts = $magazine->sectionstarts;
	 	//echo 'Section starts: '. $sectionstarts . '<br/>';

	 	$sectioncount = $magazine->sectioncount;
	 	//echo 'Section count: '. $sectioncount . '<br/>';

	 	$thumb = $magazine->thumb;
	 	//echo 'Thumb: '. $thumb . '<br/>';

	 	$thumb_medium = $magazine->thumb_medium;
	 	//echo 'Thumb medium: '. $thumb_medium . '<br/><br/><br/>';

	 	echo '<a class="medium-12 large-12 mSingleSlide" href="http://www.e-pages.dk/madogvenner/' . $catalog . '/demo/" rel="bookmark" title="' . $title . '" style="height:200px; background-image: url(http://' . $thumb_medium . '); background-repeat: no-repeat; background-position: center center; background-size: contain; text-decoration: none; margin: 0 10px;" target="_blank">&nbsp;</a>';
	}

echo '</div>';
}

function nordjyske_magazine_slider_styles() {
	wp_register_style( 'nordjyske-magazine-slider-style', (plugin_dir_url( __FILE__ ) .'css/nordjyske-magazine-slider.css'));
	wp_enqueue_style( 'nordjyske-magazine-slider-style' );
}
add_action( 'wp_enqueue_scripts', 'nordjyske_magazine_slider_styles' );

function nordjyske_magazine_slider_files() {
	wp_register_script( 'nordjyske-magazine-slider-script', (plugin_dir_url( __FILE__ ) .'js/jquery.slideinit.js'), false, '1.0', true);
  wp_enqueue_script( 'nordjyske-magazine-slider-script' );
}
add_action( 'init', 'nordjyske_magazine_slider_files' );

function nordjyske_shortcode() {
	ob_start();
	slider_code();

 	return ob_get_clean();
}
add_shortcode( 'nordjyske_magazine_slider', 'nordjyske_shortcode' );
?>