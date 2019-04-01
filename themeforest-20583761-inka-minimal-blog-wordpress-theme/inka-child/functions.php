<?php

function deo_enqueue_styles() {
  wp_enqueue_style( 'deo-parent-styles', get_template_directory_uri() . '/style.css', array( 'bootstrap', 'deo-font-icons' ) );
}
add_action( 'wp_enqueue_scripts', 'deo_enqueue_styles' );

function deo_language_setup() {
  load_child_theme_textdomain( 'inka', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'deo_language_setup' );