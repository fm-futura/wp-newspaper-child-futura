<?php

function query_destacados() {
    wp_reset_postdata();
    $args = array(
        'post_type' => 'post', // if the post type is post
        'posts_per_page' => 2,
        'post_status' => 'publish',
        'cat' => get_cat_ID('destacados'),
        'tax_query' => array(
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array(
                    'post-format-gallery',
                    'post-format-video',
                ),
                'operator' => 'NOT IN'
            )
        )
    );

    return new WP_Query($args);
}
function query_principal() {
    wp_reset_postdata();
    $excluidos = get_category_by_slug('excluir-home');
    $excludeCategory = array( $excluidos->term_id , get_cat_ID('destacados') );

    $args = array(
        'post_type' => 'post', // if the post type is post
        'posts_per_page' => 18,
        'post_status' => 'publish',
        'category__not_in' => $excludeCategory,
        'tax_query' => array(
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array(
                    'post-format-gallery',
                    'post-format-video',
                ),
                'operator' => 'NOT IN'
            )
        )
    );

    return new WP_Query($args);
}
function query_by_cat($cat) {
    wp_reset_postdata();

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 2,
        'post_status' => 'publish',
        'cat' => $cat,
    );

    return new WP_Query($args);
}
function query_videos() {
    wp_reset_postdata();

    // Traer los posts formateados como video
    // y en la categoria destacados (18)
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post_status' => 'publish',
        'cat' => '18',
        'tax_query' => array(
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array(
                    'post-format-video'
                ),
                'operator' => 'IN'
            )
        )
    );

    return new WP_Query($args);
}
function query_galeria() {
    wp_reset_postdata();

    // Traer los posts formateados como galeria
    $args = array(
        'post_type' => 'galeria',
        'posts_per_page' => 12,
        'post_status' => 'publish'
    );

    return new WP_Query($args);
}

function query_programacion() {
    wp_reset_postdata();
    $args = array(
        'post_type' => 'programas',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_key' => 'horario_inicio'
    );

    return new WP_Query($args);
}
