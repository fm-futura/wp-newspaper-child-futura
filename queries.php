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

function query_programacion_by_days() {
    $args = array(
        'post_type' => 'programas',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_key' => 'horario_inicio'
    );

    $query = new WP_Query($args);
    $posts = $query->posts;

    // dia -> post
    $result = [
      1 => [],
      2 => [],
      3 => [],
      4 => [],
      5 => [],
      6 => [],
      7 => [],
    ];


    foreach ($posts as $post) {
      $pod = pods('programas', $post->ID);
      $programacion = [
        'dias' => $pod->field('dia'),
        'transmisiones' => $pod->field('transmisiones'),
        'horario_inicio' => $pod->field('horario_inicio'),
        'horario_finalizacion' => $pod->field('horario_finalizacion'),
        'categoria' => $pod->field('categoria'),
        'website' => $pod->field('website'),
      ];
      $post->programacion = $programacion;

      $dias = $programacion['dias'];
      if (!is_array($dias)) {
        $dias = [$dias];
      }

      foreach ($dias as $dia) {
        $result[$dia][] = $post;
      }
    }

    foreach ($result as $dia => $posts) {
        usort($posts, function ($post_a, $post_b) {
            $a = $post_a->programacion['horario_inicio'];
            $b = $post_b->programacion['horario_inicio'];
            if ($a == '00:00:00') { return 1; }
            if ($b == '00:00:00') { return -1; }
            if ($a > $b) {
                return 1;
            } else if ($a < $b) {
                return -1;
            } else {
                return 0;
            }
        });

        $result[$dia] = $posts;
    }

    return $result;
}
