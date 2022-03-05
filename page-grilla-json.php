<?php
$query = query_programacion();
$result = [];

while ($query->have_posts()) {
    $query->the_post();
    $pod = pods('programas', get_the_ID());
    $programa = array(
        'id' => $pod->field('id'),
        'slug' => $pod->field('slug'),
        'link' => $pod->field('link.url'),
        'title' => $pod->field('title.rendered'),
        'dia' => $pod->field('dia'),
        'horario_inicio' => $pod->field('horario_inicio'),
        'horario_finalizacion' => $pod->field('horario_finalizacion'),
        'website' => $pod->field('website'),
    );
    $result[] = $programa;
}
header("Access-Control-Allow-Origin: *");
wp_send_json($result);
