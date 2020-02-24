<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 11);
function theme_enqueue_styles() {
    wp_enqueue_style('td-theme', get_template_directory_uri() . '/style.css', '', TD_THEME_VERSION, 'all' );
    wp_enqueue_style('td-theme-child', get_stylesheet_directory_uri() . '/style.css', array('td-theme'), TD_THEME_VERSION . 'c', 'all' );
    wp_enqueue_style('td-theme-child-main', get_stylesheet_directory_uri() . '/css/main.css', array('td-theme'), TD_THEME_VERSION . 'c', 'all' );

    if (is_user_logged_in()) {
      wp_enqueue_style('td-theme-child-main-admin', get_stylesheet_directory_uri() . '/css/main-admin.css', array('td-theme'), TD_THEME_VERSION . 'c', 'all' );
    }

}

add_action( 'td_wp_booster_loaded', 'load_custom_modules');
function load_custom_modules() {
}


require_once('queries.php');
