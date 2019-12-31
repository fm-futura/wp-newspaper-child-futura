<!doctype html >
<!--[if IE 8]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta charset="<?php bloginfo( 'charset' );?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php
    wp_head(); /** we hook up in wp_booster @see td_wp_booster_functions::hook_wp_head */
    ?>
</head>

<body <?php body_class() ?> itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WebPage">

    <?php /* scroll to top */?>
    <div class="td-scroll-up"><i class="td-icon-menu-up"></i></div>

    <?php locate_template('parts/menu-mobile.php', true);?>
    <?php locate_template('parts/search.php', true);?>


    <div id="td-outer-wrap" class="td-theme-wrap">
    <?php //this is closing in the footer.php file ?>

<!-- header futura -->
    <?php

        $player_style = 'position: fixed; left: 0; width: 100%% ;z-index: 100000;';
        $player_style ='';
        if (is_user_logged_in()) {
            $player_style = $player_style . 'top:32px;';
        } else {
            $player_style = $player_style . 'top:0px;';
        }
        $player_class ='td-header-menu-wrap td-header-menu-no-search td-affix';


        echo "<div id=\"wp_futura_player_header\" class=\"{$player_class}\" style=\"{$player_style}\">";
        the_widget('PlayerFutura_Widget',
            array(
                'id' => 'player_futura_top'
            ),
            array(
                'before_widget' => '',
                'after_widget'  => '',
        ));

    ?>

    <div class="futura-social-icons" id="wp_futura_social_icons">
        <span class="td-social-icon-wrap">
            <a target="_blank" href="https://api.whatsapp.com/send?phone=5492216190382&text=&source=&data=" title="WhatsApp">
                <i class="td-icon-font td-icon-whatsapp"></i>
            </a>
        </span>
        <span class="td-social-icon-wrap">
            <a target="_blank" href="https://www.facebook.com/RadioFutura905/" title="Facebook">
                <i class="td-icon-font td-icon-facebook"></i>
            </a>
        </span>
        <span class="td-social-icon-wrap">
            <a target="_blank" href="https://www.instagram.com/radiofuturafm90.5" title="Instagram">
                <i class="td-icon-font td-icon-instagram"></i>
            </a>
        </span>
        <span class="td-social-icon-wrap">
            <a target="_blank" href="https://twitter.com/Futura905" title="Twitter">
                <i class="td-icon-font td-icon-twitter"></i>
            </a>
        </span>
        <span class="td-social-icon-wrap">
            <a target="_blank" href="https://www.youtube.com/channel/UCLtoIsQ5C0P4kdJMwB45nRw" title="Youtube">
                <i class="td-icon-font td-icon-youtube"></i>
            </a>
        </span>
    </div>
</div>
<!-- header futura -->

<style>
  div.td-header-menu-wrap.td-header-menu-no-search.td-affix:not(#wp_futura_player_header):not(#wp_futura_social_icons) {
  <?php
    if (is_user_logged_in()) {
        echo 'top: 0vh !important;';
        echo 'margin-top: 9vh !important;';
    } else {
        echo 'top: 0vh !important;';
        echo 'margin-top: 5vh !important;';
    }
  ?>
  }
@media(max-width: 600px) {
  div.td-header-menu-wrap.td-header-menu-no-search.td-affix:not(#wp_futura_player_header):not(#wp_futura_social_icons) {
  <?php
    if (is_user_logged_in()) {
        echo 'top: 0vh !important;';
        echo 'margin-top: 14vh !important;';
    } else {
        echo 'top: 0vh !important;';
        echo 'margin-top: 10vh !important;';
    }
  ?>
  }
}

#wp_futura_player_header {
  display: flex;
  flex-wrap: wrap;
}

.player__container {
  flex-grow: 1;
  min-width: 80vw;
}

.futura-social-icons {
  height 5vh;
  display: flex;
  flex-grow: 1;
  justify-content: center;
  border-top: 5px solid #282828;
}

.futura-social-icons span {
  display: flex;
  flex-grow: 0;
  flex-shrink: 0;
  align-items: center;
}

.futura-social-icons a {
  color: #f6ec80ff !important;
  margin-right: .75ex;
  margin-left: .75ex;
  line-height: 3vh!important;
}

.futura-social-icons .td-icon-font {
  font-size: 3vh!important;
}

div.td-main-content-wrap {
  /* margin-top: 10vh; */
}

div.td-header-menu-wrap.td-header-menu-no-search {
  background: #282828;
}
</style>

<?php

        /*
         * loads the header template set in Theme Panel -> Header area
         * the template files are located in ../parts/header
         */
        td_api_header_style::_helper_show_header();

        do_action('td_wp_booster_after_header'); //used by unique articles
