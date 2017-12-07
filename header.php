<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "Title".
 *
 * @package H-Code
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <?php
    if( isset( $_SERVER['HTTP_USER_AGENT'] ) &&
        ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false )
    ) {
        echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
    }
    ?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php // Start favicon. ?>
    <link rel="shortcut icon" href="<?php if (hcode_option('default_favicon')) { echo hcode_option_url('default_favicon'); } else { echo HCODE_THEME_IMAGES.'/favicon.png'; }?>">
    <link rel="apple-touch-icon" href="<?php if (hcode_option('apple_iPhone_favicon')) { echo hcode_option_url('apple_iPhone_favicon'); } else { echo HCODE_THEME_IMAGES.'/apple-touch-icon-57x57.png'; }?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php if (hcode_option('apple_iPad_favicon')) { echo hcode_option_url('apple_iPad_favicon'); } else { echo HCODE_THEME_IMAGES.'/apple-touch-icon-72x72.png'; }?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php if (hcode_option('apple_iPhone_retina_favicon')) { echo hcode_option_url('apple_iPhone_retina_favicon'); } else { echo HCODE_THEME_IMAGES.'/apple-touch-icon-114x114.png'; }?>">
    <link rel="apple-touch-icon" sizes="149x149" href="<?php if (hcode_option('apple_iPad_retina_favicon')) { echo hcode_option_url('apple_iPad_retina_favicon'); } else { echo HCODE_THEME_IMAGES.'/apple-touch-icon-114x114.png'; }?>">
    <?php // End favicon. ?>
    
    <?php
        // Set Header for Ajax Popup.
        hcode_set_header( get_the_ID() );
        wp_head();
    ?>
    <?php if( hcode_option('general_css_code') ): ?>
        <style>
            <?php echo hcode_option('general_css_code'); ?>
        </style>
    <?php endif; ?>

    <?php
        if( hcode_option('tracking_code') ):
            echo hcode_option('tracking_code');
        endif;
    ?>
    <?php
        if( hcode_option('space_before_head') ):
            echo hcode_option('space_before_head');
        endif;
    ?>
</head>
<body <?php body_class(); ?> >

    <div id="loading-page">
      <style>
        #loading-page {
          width: 100%; height: 100%;
          position: fixed; top: 0; left: 0;
          transition: opacity 1s;
          background: rgba(37, 37, 37, 0.9);
          z-index: 1199;
          -webkit-backdrop-filter: blur(8px);
          backdrop-filter: blur(8px);
        }
        #loading-page #wineLoader {
          position: absolute; top: 50%; left: 50%;
          bottom: auto; right: auto;
          -webkit-transform: translateX(-50%) translateY(-50%);
          -ms-transform: translateX(-50%) translateY(-50%);
          transform: translateX(-50%) translateY(-50%);
        }
        body.images-loaded #loading-page {
           opacity: 0; 
        }
      </style>
      <svg id="wineLoader" xmlns="http://www.w3.org/2000/svg" width="86" height="160" viewBox="0 0 100 200" fill="none" opacity="0.66">
        <path id="glassShape" transform="translate(-0.5,-0.5)" opacity="0.66" stroke="#B5F0E8" stroke-opacity=".7" stroke-width="5" d="M8.13 20h84.3c.98 29.1-3.73 48.87-14.15 59.28C70.35 87.22 59.9 91.13 49.5 91c-10.07-.13-20.1-4.03-27.78-11.72C11.3 68.88 6.77 49.1 8.12 20zm42.52 75.5v81h-.5v-81h.5zM16.5 178.9h68v.1h-68v-.1z"/>
        <path id="wineFill" fill="#e3001a" fill-rule="nonzero" d="M50 51c11.67-6.6 23.33-6.6 35 0 0 19.32-15.67 35-35 35S15 70.3 15 51c11.67 6.57 23.33 6.57 35 0z">
          <animate attributeName="d" calcMode="spline" values="M15 50 Q32.5 40 50 50 Q67.5 60 85 50 A35 35 0 0 1 15 50;M15 50 Q32.5 60 50 50 Q67.5 40 85 50 A35 35 0 0 1 15 50;M15 50 Q32.5 40 50 50 Q67.5 60 85 50 A35 35 0 0 1 15 50" keyTimes="0;0.5;1" dur="2" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" begin="0s" repeatCount="indefinite"/>
        </path>
      </svg>
    </div>
<?php
    // Add Div For Ajax Popup
    hcode_add_ajax_page_div_header( get_the_ID() );
?>
<?php
    if( class_exists( 'WooCommerce' ) && (is_product() || is_product_category() || is_product_tag() || is_tax( 'product_brand' )) ){
        get_template_part('templates/menu-woocommerce');
        get_template_part('templates/title');
    }elseif(is_search() || is_category() || is_archive()){
        get_template_part('templates/menu-archive');
        get_template_part('templates/title');
    }elseif(is_home()){
        get_template_part('templates/menu');
    }else{
        get_template_part('templates/menu');
        get_template_part('templates/title');
    }

?>
