<?php
abstract class futura_td_module extends td_module{
    var $audiohome = FALSE;

    /**
     * @param $post WP_Post
     * @param array $module_atts
     * @param bool $audiohome
     */
    function __construct($post, $module_atts = array(), $audiohome=FALSE) {

        $this->audiohome = $audiohome;
        parent::__construct($post, $module_atts);

    }


    /**
     * This method is used by modules to get content that has to be excerpted (cut)
     * IT RETURNS THE EXCERPT FROM THE POST IF IT'S ENTERED IN THE EXCERPT CUSTOM POST FIELD BY THE USER
     * @param string $cut_at - if provided the method will just cat at that point
     * @return string
     */
    function get_excerpt($cut_at = '') {

        //If the user supplied the excerpt in the post excerpt custom field, we just return that
        if ($this->post->post_excerpt != '') {
            return $this->post->post_excerpt;
        }

// XXX FIXME: FUTURA
        return futura_get_post_excerpt($this->post, $cut_at, TRUE, FALSE);
    }


    function get_audiohome_player() {
        if ($this->audiohome) {
            return futura_get_audiohome_player($this->post->ID);
        }
        return '';
    }
}
