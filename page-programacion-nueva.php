<?php

wp_enqueue_style('page-programacion', get_stylesheet_directory_uri() . '/css/programacion.css');
locate_template('includes/wp_booster/td_single_template_vars.php', true);

get_header();

global $loop_module_id, $loop_sidebar_position, $post, $td_sidebar_position;

$schedule_data = query_programacion_by_days();
$day_name_map = [
    'none',
    'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'
];
$today = date('N');

?>

<script>
    var schedule_data = <?php echo wp_json_encode($schedule_data); ?>;
</script>

<div class="td-main-content-wrap td-container-wrap page-programacion">
<div class="tdc-row stretch_row_content_no_space td-stretch-content">
<div class="vc_row wpb_row td-pb-row">
<div class="vc_column wpb_column vc_column_container tdc-column td-pb-span12">

<div class="futura-programacion-nueva">

<?php
foreach ($schedule_data as $day => $data) {
?>
    <div class="programacion-day-container <? if ($day == $today) { echo 'current'; } ?>" data-day="<? echo $day; ?>">
        <div class="day"> <? echo $day_name_map[$day]; ?> </div>
        <div class="day-shows">
        <? foreach ($data as $show_data) { ?>
            <div class="show-entry" data-show-id="<? echo $show_data->ID; ?>" data-time-start="<? echo $show_data->horario_inicio; ?>" data-time-finish="<? echo $show_data->horario_finalizacion; ?>">
                <div class="show-time">
                    <span class="show-time-start">  <? echo $show_data->horario_inicio;       ?> </span>
                    <!-- <span class="show-time-finish"> <? echo $show_data->horario_finalizacion; ?> </span> -->
                </div>

                <a class="show-title" target="_blank" href="<? echo $show_data->guid; ?>">
                    <? echo $show_data->post_title; ?>
                </a>

            </div>
        <? } ?>
        </div>
    </div>

<?php
}
?>

</div>

</div>
</div>
</div>
</div> <!-- /.td-main-content-wrap -->

<script>
function futura_schedule_set_current_day(day) {
    document.querySelectorAll(`[data-day]:not([data-day="${day}"])`)
        .forEach((e) => {
            e.classList.remove('current');
        });

    document.querySelectorAll(`[data-day="${day}"]`)
        .forEach((e) => {
            e.classList.add('current');
        });
}

function futura_schedule_set_current_show_by_id(show_id, day=null) {
    let parent = document.querySelector(`[data-day="${day}"]`) || document;

    document.querySelectorAll(`[data-show-id]:not([data-show-id="${show_id}"])`)
        .forEach((e) => {
            e.classList.remove('current');
        });

    parent.querySelectorAll(`[data-show-id="${show_id}"]`)
        .forEach((e) => {
            e.classList.add('current');
        });
}

function futura_schedule_get_current_playing_show() {
    let now = moment();
    let current_day = now.day();

    let show = Object.values(schedule_data[current_day] || {})
        .find((show) => {
            let show_start = moment(show.programacion.horario_inicio, 'HH:mm:ss');
            let show_end = moment(show.programacion.horario_finalizacion, 'HH:mm:ss');
            return now.isBetween(show_start, show_end);
        });
    return show;
}

function futura_schedule_update_current_playing_show() {
    let show = futura_schedule_get_current_playing_show();
    let current_day = moment().day();
    let show_id = show?.ID;

    futura_schedule_set_current_day(current_day);
    futura_schedule_set_current_show_by_id(show_id, current_day);
}

futura_schedule_update_current_playing_show();
setInterval(futura_schedule_update_current_playing_show, 60 * 1000);
</script>

<?php

get_footer();
