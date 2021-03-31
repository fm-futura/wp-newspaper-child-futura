<?php
$query = query_programacion_by_days();

header("Access-Control-Allow-Origin: *");
wp_send_json($query);
