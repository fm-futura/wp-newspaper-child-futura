<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 11);
function theme_enqueue_styles() {
    wp_enqueue_style('td-theme', get_template_directory_uri() . '/style.css', '', TD_THEME_VERSION, 'all' );
    wp_enqueue_style('td-theme-child', get_stylesheet_directory_uri() . '/style.css', array('td-theme'), TD_THEME_VERSION . 'c', 'all' );
    wp_enqueue_style('td-theme-child-main', get_stylesheet_directory_uri() . '/css/main.css', array('td-theme'), TD_THEME_VERSION . 'c', 'all' );
    wp_enqueue_style('td-theme-child-main-footer', get_stylesheet_directory_uri() . '/css/footer.css', array('td-theme'), TD_THEME_VERSION . 'c', 'all' );

    if (is_user_logged_in()) {
      wp_enqueue_style('td-theme-child-main-admin', get_stylesheet_directory_uri() . '/css/main-admin.css', array('td-theme'), TD_THEME_VERSION . 'c', 'all' );
    }

}

add_action( 'td_wp_booster_loaded', 'load_custom_modules');
function load_custom_modules() {
}


add_action( 'widgets_init', 'register_futura_sidebars' );
function register_futura_sidebars() {
    register_sidebar([
        'id'            => 'portada-1',
        'name'          => 'Widgets en portada 1',
        'description'   => 'Aparece en la portada entre los posts, primera.',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ]);

    register_sidebar([
        'id'            => 'portada-2',
        'name'          => 'Widgets en portada 2',
        'description'   => 'Aparece en la portada entre los posts, segunda.',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ]);

    register_sidebar([
        'id'            => 'portada-3',
        'name'          => 'Widgets en portada 3 (pequeña)',
        'description'   => 'Aparece en la portada entre los posts, tercera, pequeña.',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ]);


    register_sidebar([
        'id'            => 'footer-redes-1',
        'name'          => 'Widgets footer, redes. Primera.',
        'description'   => 'Aparece en el footer, primera',
        'before_widget' => '<div class="futura-footer-widget-column">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ]);

    register_sidebar([
        'id'            => 'footer-redes-2',
        'name'          => 'Widgets footer, redes. Segunda.',
        'description'   => 'Aparece en el footer, segunda',
        'before_widget' => '<div class="futura-footer-widget-column">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ]);

    register_sidebar([
        'id'            => 'footer-redes-3',
        'name'          => 'Widgets footer, redes. Tercera.',
        'description'   => 'Aparece en el footer, tercera',
        'before_widget' => '<div class="futura-footer-widget-column">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ]);

}

require_once('queries.php');
