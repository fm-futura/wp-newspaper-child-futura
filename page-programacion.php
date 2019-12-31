<?php

wp_enqueue_style('page-programacion', get_template_directory_uri() . '/css/programacion.css');
locate_template('includes/wp_booster/td_single_template_vars.php', true);

get_header();

global $loop_module_id, $loop_sidebar_position, $post, $td_sidebar_position;

$td_mod_single = new td_module_single($post);


?>
<div class="td-main-content-wrap td-container-wrap">

    <div class="td-container td-post-template-default <?php echo $td_sidebar_position; ?>">
        <div class="td-crumb-container"><?php echo td_page_generator::get_single_breadcrumbs($td_mod_single->title); ?></div>

        <div class="td-pb-row">
        <div class="td-pb-span8 td-main-content" role="main">
            <div class="td-ss-main-content">
            <div class="container-fluid td-post-content">

                <div class="clearfix row-fluid">

                <div id="page-programacion-futura" class="programacion span8 clearfix" role="main">
                    <ul class="semana span12">
                    <li data-dia="1">Lunes</li>
                    <li data-dia="2">Martes</li>
                    <li data-dia="3">Miércoles</li>
                    <li data-dia="4">Jueves</li>
                    <li data-dia="5">Viernes</li>
                    <li data-dia="6">Sábado</li>
                    <li data-dia="7">Domingo</li>
                    </ul>
                    <ul class="semana reduced span12">
                    <li data-dia="1">Lun</li>
                    <li data-dia="2">Mar</li>
                    <li data-dia="3">Mié</li>
                    <li data-dia="4">Jue</li>
                    <li data-dia="5">Vie</li>
                    <li data-dia="6">Sáb</li>
                    <li data-dia="7">Dom</li>
                    </ul>
                    <ul id="listado_programas">
                    <?php
                    $query = query_programacion();
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                        $query->the_post();
                        $pod = pods('programas', get_the_ID());
                        $dias = '';

                        if (is_array($pod->field('dia'))) {
                            foreach ($pod->field('dia') as $dia) {
                            $dias .= $dia.',';
                            }
                        }else{
                            foreach ($pod->field('dia') as $dia) {
                            $dias .= $dia.',';
                            }
                        }

                        ?>
                        <li data-dia="<?php echo $dias; ?>" data-content="<?php if(get_the_content()){echo true;} ?>">
                            <header class="info_container">
                            <div>
                                <h2><?php the_title(); ?></h2>
                                <div class="meta">
                                <span class="transm"><?php echo $pod->field('transmisiones'); ?></span><?php echo $pod->field('horario_inicio') ?> a <?php echo $pod->field('horario_finalizacion') ?> hs / <?php echo $pod->field('categoria') ?>
                                </div>
                            </div>
                            <?php if(get_the_content()){
                                ?>
                            <div class="plus_button">
                                <a class="mdi mdi-plus"></a>
                            </div>
                                <?php
                            } ?>
                            </header>
                            <article class="programa_info" class="true">
                            <?php the_content(); ?>
                            </article>
                        </li>
                        <?php
                        }
                    }
                    ?>
                    </ul>
                    <ul class="programas span12" data-dia="1"></ul>
                    <ul class="programas span12" data-dia="2"></ul>
                    <ul class="programas span12" data-dia="3"></ul>
                    <ul class="programas span12" data-dia="4"></ul>
                    <ul class="programas span12" data-dia="5"></ul>
                    <ul class="programas span12" data-dia="6"></ul>
                    <ul class="programas span12" data-dia="7"></ul>
                </div> <!-- end #main -->
                </div> <!-- end #content -->
            </div>
            </div>
        </div>

        <div class="td-pb-span4 td-main-sidebar" role="complementary">
            <div class="td-ss-main-sidebar">
            <?php get_sidebar(); ?>
            </div>
        </div>
        </div> <!-- /.td-pb-row -->
    </div> <!-- /.td-container -->
</div> <!-- /.td-main-content-wrap -->
<script>
var $=jQuery;
$('ul.programas').hide();
$('#listado_programas > li').each(function () {
    var programa = $(this);
    var dias = $(this).data('dia').split(',');
    $.each(dias, function (index, value) {
      if (!value) {
          return;
      }
      $('.programas[data-dia=' + value + ']').append(programa.clone());
    });
});

$('#page-programacion-futura.programacion .programas > li[data-content=1] header').click(function (e) {
    e.preventDefault();
    if ($(this).closest('li').hasClass('active')) {
        $('#page-programacion-futura.programacion .programas > li').removeClass('active');
    } else {
        $('page-programacion-futuramain.programacion .programas > li').removeClass('active');
        $(this).parent('li').addClass('active');
    }
});
$('#page-programacion-futura.programacion .semana li').click(function () {
    var dia = $(this).data('dia');
    $('ul.programas').hide();
    $('ul.programas[data-dia=' + dia + ']').show();
});
$('ul.programas[data-dia=1]').show();
</script>

<?php

get_footer();
