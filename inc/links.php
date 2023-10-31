<?php

//check if fucntion not exists then its make this name of function

if (!function_exists('mh_plugin_script')) {
    function mh_plugin_script() {
        wp_enqueue_style('mh-css', MH_PLUGIN_DIR . 'assets/css/style.css');
        
        wp_enqueue_script('mh-ajax', MH_PLUGIN_DIR . 'assets/js/ajax.js', array('jquery'), '1.0.0', true);

        // make ajax object here

        wp_localize_script( 'mh-ajax', 'mh_ajax_url',
		array( 
			'ajax_url' => admin_url( 'admin-ajax.php' )
		));
    }
    add_action('wp_enqueue_scripts', 'mh_plugin_script');
}

// add bootstrap cdn

function cdn_bootstrap_5() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js', array('jQuery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'cdn_bootstrap_5');
?>