<?php

/**
 * H-Code Child Theme Function File
 */

if ( ! function_exists( 'hcode_child_style' ) ) :
    function hcode_child_style() {
        wp_enqueue_style( 'hcode-parent-style', get_template_directory_uri(). '/style.css', array( 'hcode-animate-style', 'hcode-bootstrap', 'hcode-et-line-icons-style', 'hcode-font-awesome-style', 'hcode-magnific-popup-style', 'hcode-owl-carousel-style', 'hcode-owl-transitions-style', 'hcode-text-effect-style', 'hcode-menu-hamburger-style', 'hcode-mCustomScrollbar-style' ), '1.0' );
        // wp_enqueue_style( 'material-icons', get_stylesheet_directory_uri(). '/vc_material.min.css' );
    }
endif;
add_action( 'wp_enqueue_scripts', 'hcode_child_style' );

// add js to child theme

function hr_add_scripts() {
    wp_enqueue_style('qtip', get_stylesheet_directory_uri().'/css/jquery.qtip.min.css', null, false, false);
    wp_enqueue_script('qtip', get_stylesheet_directory_uri().'/js/jquery.qtip.min.js', array('jquery'), false, true);
    wp_register_script('main', get_stylesheet_directory_uri().'/js/main.js', __FILE__, array('jquery'),'1.1', true);
    wp_enqueue_script('main');
    // wp_register_script('qtip', get_stylesheet_directory_uri().'/js/jquery.qtip.min.js', __FILE__, array('jquery'),'1.1', true);

}
add_action( 'wp_enqueue_scripts', 'hr_add_scripts' );


// add css/js to acf admin header

function my_acf_admin_head() {
    ?>
    <style type="text/css">

        .acf_postbox .field textarea {
            min-height: 0;
        }

    </style>

    <script type="text/javascript">
    (function($){

        /* ... */

    })(jQuery);
    </script>
    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');


// enqueue/dequeue scripts

function remove_velocity() {
    wp_deregister_script('hcode-velocity');
    wp_dequeue_script('hcode-velocity');
}
add_action('wp_enqueue_scripts', 'remove_velocity', 36);

function remove_velocity_animation() {
    wp_deregister_script('hcode-velocity-animation');
    wp_dequeue_script('hcode-velocity-animation');
}
add_action('wp_enqueue_scripts', 'remove_velocity_animation', 37);

function custom_hamburger_js() {
    wp_deregister_script('hcode-hamburger-menu');
    wp_dequeue_script( 'hcode-hamburger-menu');
    wp_register_script('reflect-hamburger-menu', get_stylesheet_directory_uri() . '/js/hamburger-menu.js', array('jquery'), "1.8.2", true);
    wp_enqueue_script('reflect-hamburger-menu');
}
add_action('wp_enqueue_scripts', 'custom_hamburger_js', 34);

function custom_modal_js() {
    // wp_deregister_script('wp-post-modal');
    wp_dequeue_script( 'wp-post-modal');
    wp_register_script('reflect-post-modal', get_stylesheet_directory_uri() . '/js/wp-post-modal-public.js', array('jquery'), "1.8.2", true);
    wp_enqueue_script('reflect-post-modal');
}
add_action('wp_enqueue_scripts', 'custom_modal_js', 5);

// remove main.js
function admin_remove_hcodemain() {

    // wp_dequeue_script( 'hcodemain-js');
    wp_deregister_script( 'hcodemain-js');
    wp_deregister_script( 'hcode-smooth-scroll-js');
    wp_deregister_script( 'hcode-wow-js');
    wp_deregister_script( 'hcode-viewport-js');
    wp_deregister_script( 'hcode-skrollr-js');
    wp_deregister_script( 'hcode-jquery-easing-js');
    wp_deregister_script( 'bootstrap-hover-dropdown-js');
    wp_deregister_script( 'hcode-bootstrap-js');
    wp_deregister_script( 'hcode-appear-scroll-js');
    wp_deregister_script( 'hcode-popup-gallery-js');
    wp_deregister_script( 'hcode-magnific-popup-js');
    wp_deregister_script( 'hcode-parallax-js');
    wp_deregister_script( 'hcode-easypiechart-js');
    wp_deregister_script( 'hcode-text-effect-js');
    wp_deregister_script( 'hcode-tools-js');
    wp_deregister_script( 'hcode-counter-js');
    wp_deregister_script( 'hcode-fitvids-js');
    wp_deregister_script( 'hcode-mcustomscrollbar-js');
    wp_deregister_script( 'hcode-hamburger-menu-js');
    wp_deregister_script( 'hcode-imagesloaded-js');
    wp_deregister_script( 'hcode-select2-jquery');
    wp_deregister_script( 'infinite-scroll-js');
    wp_deregister_script( 'hcode-velocity-js');
    wp_deregister_script( 'hcode-velocity-animation-js');
    wp_deregister_script( 'hcodepage-scroll-js');
    wp_deregister_script( 'hcode-isotope-js');
    wp_deregister_script( 'hcode-owl-carousel-js');
    wp_deregister_script( 'hcode-ie-placeholder-js');
    wp_deregister_script( 'hcode-classie-js');
    wp_deregister_script( 'hcode-custom-megamenu-jquery');
    // wp_deregister_script( 'redux-js');
    // wp_deregister_script( 'redux');

    // wp_deregister_script( '');

}
add_action( 'admin_enqueue_scripts', 'admin_remove_hcodemain', 102);

?>