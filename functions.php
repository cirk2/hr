<?php

/**
 * H-Code Child Theme Function File
 */

if ( ! function_exists( 'hcode_child_style' ) ) :
    function hcode_child_style() {
        wp_enqueue_style( 'hcode-parent-style', get_template_directory_uri(). '/style.css', array( 'hcode-animate-style', 'hcode-bootstrap', 'hcode-et-line-icons-style', 'hcode-font-awesome-style',  'hcode-owl-carousel-style', 'hcode-owl-transitions-style', 'hcode-menu-hamburger-style',  ), '1.0' );

        // wp_enqueue_style( 'material-icons', get_stylesheet_directory_uri(). '/vc_material.min.css' );
        // removed: 'hcode-mCustomScrollbar-style',  'hcode-text-effect-style', 'hcode-magnific-popup-style',
    }
endif;
add_action( 'wp_enqueue_scripts', 'hcode_child_style' );

// add js to child theme

function hr_add_scripts() {
    // wp_enqueue_style('qtip', get_stylesheet_directory_uri().'/css/jquery.qtip.min.css', null, false, false);
    // wp_enqueue_script('qtip', get_stylesheet_directory_uri().'/js/jquery.qtip.min.js', array('jquery'), false, true);

    wp_register_script('main', get_stylesheet_directory_uri().'/js/main.js');
    wp_enqueue_script('main');

    wp_register_script('modernizr', get_stylesheet_directory_uri().'/js/modernizr.min.js');
    wp_enqueue_script('modernizr');

    // wp_register_script('qtip', get_stylesheet_directory_uri().'/js/jquery.qtip.min.js', __FILE__, array('jquery'),'1.1', true);

}
add_action( 'wp_enqueue_scripts', 'hr_add_scripts', 101);


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

//
// remove wp emojis
// wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2


function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

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

// function custom_modal_js() {
//     // wp_deregister_script('wp-post-modal');
//     wp_dequeue_script( 'wp-post-modal');
//     wp_register_script('reflect-post-modal', get_stylesheet_directory_uri() . '/js/wp-post-modal-public.js', array('jquery'), "1.8.2", true);
//     wp_enqueue_script('reflect-post-modal');
// }
// add_action('wp_enqueue_scripts', 'custom_modal_js', 5);

// remove main.js
// function admin_remove_hcodemain() {

//     // wp_dequeue_script( 'hcodemain-js');
//     wp_deregister_script( 'hcodemain-js');
//     wp_deregister_script( 'hcode-smooth-scroll-js');
//     wp_deregister_script( 'hcode-wow-js');
//     wp_deregister_script( 'hcode-viewport-js');
//     wp_deregister_script( 'hcode-skrollr-js');
//     wp_deregister_script( 'hcode-jquery-easing-js');
//     wp_deregister_script( 'bootstrap-hover-dropdown-js');
//     wp_deregister_script( 'hcode-bootstrap-js');
//     wp_deregister_script( 'hcode-appear-scroll-js');
//     wp_deregister_script( 'hcode-popup-gallery-js');
//     wp_deregister_script( 'hcode-magnific-popup-js');
//     wp_deregister_script( 'hcode-parallax-js');
//     wp_deregister_script( 'hcode-easypiechart-js');
//     wp_deregister_script( 'hcode-text-effect-js');
//     wp_deregister_script( 'hcode-tools-js');
//     wp_deregister_script( 'hcode-counter-js');
//     wp_deregister_script( 'hcode-fitvids-js');
//     wp_deregister_script( 'hcode-mcustomscrollbar-js');
//     wp_deregister_script( 'hcode-hamburger-menu-js');
//     wp_deregister_script( 'hcode-imagesloaded-js');
//     wp_deregister_script( 'hcode-select2-jquery');
//     wp_deregister_script( 'infinite-scroll-js');
//     wp_deregister_script( 'hcode-velocity-js');
//     wp_deregister_script( 'hcode-velocity-animation-js');
//     wp_deregister_script( 'hcodepage-scroll-js');
//     wp_deregister_script( 'hcode-isotope-js');
//     wp_deregister_script( 'hcode-owl-carousel-js');
//     wp_deregister_script( 'hcode-ie-placeholder-js');
//     wp_deregister_script( 'hcode-classie-js');
//     wp_deregister_script( 'hcode-custom-megamenu-jquery');
//     // wp_deregister_script( 'redux-js');
//     // wp_deregister_script( 'redux');

//     // wp_deregister_script( '');

// }
// add_action( 'admin_enqueue_scripts', 'admin_remove_hcodemain', 102);

?>