<?php

/**
 * H-Code Child Theme Functions File
 *
 * @author  reflect.media GmbH
 *
 */

if ( ! function_exists( 'hcode_child_style' ) ) :
    function hcode_child_style() {
        wp_enqueue_style( 'hcode-parent-style', get_template_directory_uri(). '/style.css', 
          // array( 
          //     'hcode-animate-style'
          //   , 'hcode-bootstrap'
          //   , 'hcode-mCustomScrollbar-style'
          //   , 'hcode-text-effect-style'
          //   , 'hcode-et-line-icons-style'
          //   , 'hcode-font-awesome-style'
          //   , 'hcode-owl-carousel-style'
          //   , 'hcode-menu-hamburger-style'
          //   , 'hcode-owl-transitions-style'
          //   , 'hcode-magnific-popup-style'
          // ), 
          '1.0' );
    } endif;
add_action( 'wp_enqueue_scripts', 'hcode_child_style' );

/**
 * ACF Options Pages
 *
*/

  if( function_exists( 'acf_add_options_page' ) ) {
    
    acf_add_options_page(array(
      'page_title'  => 'HR Theme Settings',
      'menu_title'  => 'HR Theme Settings',
      'menu_slug'   => 'hr-theme-settings',
      'capability'  => 'edit_posts',
      'redirect'    => false
    ));

    // acf_add_options_sub_page(array(
    //   'page_title'  => 'Theme Options',
    //   'menu_title'  => 'Options',
    //   'parent_slug' => 'hr-theme-settings',
    // ));

    acf_add_options_sub_page(array(
      'page_title'  => 'Theme Homepage Settings',
      'menu_title'  => 'Homepage',
      'parent_slug' => 'hr-theme-settings',
    ));
    
    acf_add_options_sub_page(array(
      'page_title'  => 'Theme Scripts and Stylesheets',
      'menu_title'  => 'Scripts/Styles',
      'parent_slug' => 'hr-theme-settings',
    ));
    
  }

/**
 * Load child theme js
 *
*/
  
  function reflect_child_main() {

      wp_register_script( 'reflect-main', get_stylesheet_directory_uri().'/js/child-main.js', array( 'jquery', 'underscore', 'reflect-waypoints' ), "1.8.2", true);
      wp_enqueue_script( 'reflect-main' );

  }
  add_action( 'wp_enqueue_scripts', 'reflect_child_main', 23);


  function hr_add_scripts() {
      wp_register_script( 'reflect-modernizr', get_stylesheet_directory_uri().'/js/modernizr.min.js' );
      wp_enqueue_script( 'reflect-modernizr' );

      wp_register_script( 'reflect-waypoints', get_stylesheet_directory_uri().'/js/waypoints.min.js', array( 'jquery' ), "1.8.2", true);
      wp_enqueue_script( 'reflect-waypoints' );

      wp_register_script( 'reflect-modal', get_stylesheet_directory_uri() . '/js/modals.js', array( 'jquery' ), "1.8.2", true);
      wp_enqueue_script( 'reflect-modal' );

      // wp_register_script( 'adobe-shapes-polyfill', get_stylesheet_directory_uri().'/js/shapes-polyfill.min.js' );
      // wp_enqueue_script( 'adobe-shapes-polyfill' );

      // wp_register_script( 'reflect-hyphenopoly', get_stylesheet_directory_uri().'/js/Hyphenopoly_Loader.js' );
      // wp_enqueue_script( 'reflect-hyphenopoly' );
  }
  add_action( 'wp_enqueue_scripts', 'hr_add_scripts', 35);

/**
 * Modal
 *
**
 * Wrap the_content for ajax popups
 *
 * @return string
 *
 */
  add_action( 'the_content', 'reflect_wrap_content' );
  function reflect_wrap_content($content)
  {
      return '<div id="modal-ready">' . $content . '</div>';
  }

  /**
   * Modal wrapper html
   *
  */
  add_action( 'wp_footer', 'reflect_modal_wrapper' );
  function reflect_modal_wrapper()
  {
      $HTML = '';
      $HTML .= '<div class="modal-wrapper">';
      $HTML .= '<div class="modal">';
      $HTML .= '<div class="close-modal">&times;</div>';
      $HTML .= '<div id="modal-content"></div>';
      $HTML .= '</div>';
      $HTML .= '</div>';

      echo $HTML;
  }

/**
 * Dequeue unused parent theme scripts
 *
*/

  // function remove_#() {
  //     wp_deregister_script( '#' );
  //     wp_dequeue_script( '#' );
  // }
  // add_action( 'wp_enqueue_scripts', 'remove_#', #);

  function reflect_remove_easypiechart() {
      wp_deregister_script( 'hcode-easypiechart' );
      wp_dequeue_script( 'hcode-easypiechart' );
  }
  add_action( 'wp_enqueue_scripts', 'reflect_remove_easypiechart', 20);

  function reflect_remove_hcode_modernizr() {
      wp_deregister_script( 'hcode-modernizr' );
      wp_dequeue_script( 'hcode-modernizr' );
  }
  add_action( 'wp_enqueue_scripts', 'reflect_remove_hcode_modernizr', 11);

  function reflect_remove_velocity() {
      wp_deregister_script( 'hcode-velocity' );
      wp_dequeue_script( 'hcode-velocity' );
  }
  add_action( 'wp_enqueue_scripts', 'reflect_remove_velocity', 36);

  function reflect_remove_velocity_animation() {
      wp_deregister_script( 'hcode-velocity-animation' );
      wp_dequeue_script( 'hcode-velocity-animation' );
  }
  add_action( 'wp_enqueue_scripts', 'reflect_remove_velocity_animation', 37);

  function reflect_remove_waypoints() {
      wp_deregister_script( 'waypoints' );
      wp_dequeue_script( 'waypoints' );
  }
  add_action( 'wp_enqueue_scripts', 'reflect_remove_waypoints', 44);

  function reflect_remove_hcode_scripts() {

    $load_infinite_scroll = true;
    $load_countdown_timer = true;
    $load_et_line_icons = true;
    $load_font_awesome = true;
    
    wp_deregister_script( 'hcode-tools' );
    wp_dequeue_script( 'hcode-tools' );
    
    if( !get_field( 'hcode-text-effect', 'option' ) ):      
      wp_deregister_script( 'hcode-text-effect' );
      wp_dequeue_script( 'hcode-text-effect' );
    endif;

    if( !get_field( 'hcode-counter', 'option' ) ):
      wp_deregister_script( 'hcode-counter' );
      wp_dequeue_script( 'hcode-counter' );
      $load_countdown_timer = false;
    endif;

    if( !get_field( 'prettyphoto', 'option' ) ):
      wp_deregister_script( 'prettyphoto' );
      wp_dequeue_script( 'prettyphoto' );
    endif;

    if( !get_field( 'hcode-infinite-scroll', 'option' ) ):
      wp_deregister_script( 'infinite-scroll' );
      wp_dequeue_script( 'infinite-scroll' );
      $load_infinite_scroll = false;
    endif;

    if( !get_field( 'hcode-fitvids', 'option' ) ):
      wp_deregister_script( 'hcode-fitvids' );
      wp_dequeue_script( 'hcode-fitvids' );
    endif;

    if( !get_field( 'hcode-wow', 'option' ) ):
      wp_deregister_script( 'hcode-wow' );
      wp_dequeue_script( 'hcode-wow' );
    endif;

    if( !get_field( 'hcode-mcustomscrollbar', 'option' ) ):
      wp_deregister_script( 'hcode-mcustomscrollbar' );
      wp_dequeue_script( 'hcode-mcustomscrollbar' );
    endif;

    if( !get_field( 'hcode-isotope', 'option' ) ):
      wp_deregister_script( 'hcode-isotope' );
      wp_dequeue_script( 'hcode-isotope' );
    endif;

    if( !get_field( 'hcode-skrollr', 'option' ) ):
      wp_deregister_script( 'hcode-skrollr' );
      wp_dequeue_script( 'hcode-skrollr' );
    endif;

    if( !get_field( 'hcodepage-scroll', 'option' ) ):
      wp_deregister_script( 'hcodepage-scroll' );
      wp_dequeue_script( 'hcodepage-scroll' );
    endif;

    if( !get_field( 'hcode-et-line-icons-style', 'option' ) ):
      $load_et_line_icons = false;
    endif;

    if( !get_field( 'hcode-font-awesome-style', 'option' ) ):
      $load_font_awesome = false;
    endif;

    wp_localize_script( 'reflect-main', 'php_vars', array( 

        'infiniteScroll'  => $load_infinite_scroll,
        'countdownTimer'  => $load_countdown_timer,
        'etLineIcons'     => $load_et_line_icons,
        'fontAwesome'     => $load_font_awesome
      ) 
    );

    // if( !get_field( 'script', 'option' ) ):
    //   wp_deregister_script( 'script' );
    //   wp_dequeue_script( 'script' );
    // endif;
  }
  add_action( 'wp_print_scripts', 'reflect_remove_hcode_scripts' );

/**
 * Dequeue unused plugin scripts
 *
*/

  function reflect_remove_plugin_scripts() {

      // wp_deregister_script( '' );
      // wp_deregister_script( '' );
      // wp_deregister_script( '' );
      // wp_deregister_script( '' );
      // wp_deregister_script( '' );
      // wp_deregister_script( '' );
      wp_deregister_script( 'vc_grid-js-imagesloaded' );

      // wp_dequeue_script( '' );
      // wp_dequeue_script( '' );
      // wp_dequeue_script( '' );
      // wp_dequeue_script( '' );
      // wp_dequeue_script( '' );
      // wp_dequeue_script( '' );
      wp_dequeue_script( 'vc_grid-js-imagesloaded' );
  }
  add_action( 'wp_print_scripts', 'reflect_remove_plugin_scripts' );

/**
 * Remove unused stylesheets
 *
*/

  function reflect_remove_hcode_stylesheets() {

    wp_dequeue_style( 'animate-css' );
    // wp_dequeue_style( 'hcode-fonts' );
    // wp_dequeue_style( 'hcode-fonts' );
    wp_dequeue_style( 'hcode-fonts' );
    wp_dequeue_style( 'hcode-animate-style' );
    wp_dequeue_style( 'hcode-extralayers-style' );
    wp_dequeue_style( 'hcode-menu-hamburger-style' ); 
    // wp_dequeue_style( 'hcode-magnific-popup-style' );

    wp_deregister_style( 'animate-css' );
    // wp_deregister_style( 'hcode-fonts' );
    // wp_deregister_style( 'hcode-fonts' );
    wp_deregister_style( 'hcode-fonts' );
    wp_deregister_style( 'hcode-animate-style' );
    wp_deregister_style( 'hcode-extralayers-style' );
    wp_deregister_style( 'hcode-menu-hamburger-style' );
    // wp_deregister_style( 'hcode-magnific-popup-style' );

    if( !get_field( 'hcode-text-effect', 'option' ) ):
      wp_deregister_style( 'hcode-text-effect-style' );
      wp_dequeue_style( 'hcode-text-effect-style' );
    endif;

    if( !get_field( 'prettyphoto', 'option' ) ):
      wp_dequeue_style( 'prettyphoto' );
      wp_deregister_style( 'prettyphoto' );
    endif;

    if( !get_field( 'hcode-et-line-icons-style', 'option' ) ):
      wp_dequeue_style( 'hcode-et-line-icons-style' );
      wp_deregister_style( 'hcode-et-line-icons-style' );
    endif;

    if( !get_field( 'hcode-font-awesome-style', 'option' ) ):
      wp_dequeue_style( 'hcode-font-awesome-style' );
      wp_deregister_style( 'hcode-font-awesome-style' );
    endif;

    if( !get_field( 'hcode-mcustomscrollbar', 'option' ) ):
      wp_dequeue_style( 'hcode-mCustomScrollbar-style' );
      wp_deregister_style( 'hcode-mCustomScrollbar-style' );
    endif;

    // hcode main stylesheet

    // if( !get_field( 'hcode-parent-style', 'option' ) ):
      wp_dequeue_style( 'hcode-parent-style' );
      wp_deregister_style( 'hcode-parent-style' );
      wp_dequeue_style( 'hcode-responsive-style' );
      wp_deregister_style( 'hcode-responsive-style' );
      
    // endif;

  }
  add_action( 'wp_print_styles', 'reflect_remove_hcode_stylesheets' );

/**
 * Dequeue parent theme scripts and load modified version
 *
*/

  function reflect_custom_hamburger_js() {
      wp_deregister_script( 'hcode-hamburger-menu' );
      wp_dequeue_script( 'hcode-hamburger-menu' );
      wp_register_script( 'reflect-hamburger-menu', get_stylesheet_directory_uri() . '/js/hamburger-menu.js', array( 'jquery' ), "1.8.2", true);
      wp_enqueue_script( 'reflect-hamburger-menu' );
  }
  add_action( 'wp_enqueue_scripts', 'reflect_custom_hamburger_js', 13);

  function popup_gallery_js() {
      wp_deregister_script( 'hcode-popup-gallery' );
      wp_dequeue_script( 'hcode-popup-gallery' );
      wp_register_script( 'reflect-popup-gallery', get_stylesheet_directory_uri() . '/js/popup-gallery.js', array( 'jquery' ), "1.8.2", true);
      wp_enqueue_script( 'reflect-popup-gallery' );
  }
  add_action( 'wp_enqueue_scripts', 'popup_gallery_js', 23);

  function reflect_custom_hcodemain() {
      wp_deregister_script( 'hcodemain' );
      wp_dequeue_script( 'hcodemain' );
      wp_register_script( 'reflect-hcodemain', get_stylesheet_directory_uri() . '/js/hcodemain.js', array( 'jquery', 'reflect-main' ), "1.8.2", true);
      wp_enqueue_script( 'reflect-hcodemain' );
  }
  add_action( 'wp_enqueue_scripts', 'reflect_custom_hcodemain', 27);
  
/**
 * add css/js to acf admin header
 *
*/ 

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

  add_action( 'acf/input/admin_head', 'my_acf_admin_head' );

// load comment-reply script only if comments are open

  // function theme_queue_js(){
  // if ( (!is_admin()) && is_singular() && comments_open() && get_option( 'thread_comments' ) )
  //   wp_enqueue_script( 'comment-reply' );
  // }
  // add_action( 'wp_print_scripts', 'theme_queue_js' );

  function reflect_comment_reply(){
  if( !get_field( 'hcodepage-scroll', 'option' ) ):
    wp_deregister_script( 'hcodepage-scroll' );
    wp_dequeue_script( 'comment-reply' );
  endif;
  }
  add_action( 'wp_print_scripts', 'reflect_comment_reply' );

/**
 * remove wp emojis
 * wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2
 *
*/
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

/**
 * remove wp generator meta tags
 * https://stackoverflow.com/a/42380747/3171093
 *
*/

  function remove_meta_generators($html) {
      $pattern = '/<meta name(.*)=(.*)"generator"(.*)>/i';
      $html = preg_replace($pattern, '', $html);
      return $html;
  }
  function clean_meta_generators($html) {
      ob_start( 'remove_meta_generators' );
  }
  add_action( 'get_header', 'clean_meta_generators', 100);
  add_action( 'wp_footer', function(){ ob_end_flush(); }, 100);


/**
* * Custom Post Types
  * 
 */ function cptui_register_my_cpts() {

    /**
     * Post Type: Rebsorten.
     */

    $labels = array(
      "name" => __( "Rebsorten", "h-code-child" ),
      "singular_name" => __( "Rebsorte", "h-code-child" ),
      "menu_name" => __( "Rebsorten", "h-code-child" ),
      "all_items" => __( "Alle Rebsorten", "h-code-child" ),
      "add_new" => __( "Neue hinzufügen", "h-code-child" ),
      "add_new_item" => __( "Neue Rebsorte hinzufügen", "h-code-child" ),
      "edit_item" => __( "Rebsorte bearbeiten", "h-code-child" ),
      "new_item" => __( "Neue Rebsorte", "h-code-child" ),
      "view_item" => __( "Rebsorte anzeigen", "h-code-child" ),
      "view_items" => __( "Rebsorten anzeigen", "h-code-child" ),
      "search_items" => __( "Rebsorte suchen", "h-code-child" ),
      "not_found" => __( "Keine Rebsorte gefunden", "h-code-child" ),
      "not_found_in_trash" => __( "Keine Rebsorte im Papierkorb gefunden", "h-code-child" ),
      "parent_item_colon" => __( "Übergeordnete Rebsorte ", "h-code-child" ),
      "featured_image" => __( "Beitragsbild für diese Rebsorte", "h-code-child" ),
      "set_featured_image" => __( "Lege das Beitragsbild für diese Rebsorte fest", "h-code-child" ),
      "remove_featured_image" => __( "Entferne das Beitragsbild für diese Rebsorte", "h-code-child" ),
      "parent_item_colon" => __( "Übergeordnete Rebsorte", "h-code-child" ),
    );

    $args = array(
      "label" => __( "Rebsorten", "h-code-child" ),
      "labels" => $labels,
      "description" => "",
      "public" => true,
      "publicly_queryable" => true,
      "show_ui" => true,
      "show_in_rest" => true,
      "rest_base" => "rebsorte",
      "has_archive" => false,
      "show_in_menu" => true,
      "exclude_from_search" => false,
      "capability_type" => "post",
      "map_meta_cap" => true,
      "hierarchical" => false,
      "rewrite" => array( "slug" => "rebsorte", "with_front" => true ),
      "query_var" => true,
      "menu_icon" => "/wp-content/themes/hr/i/grape-dash.png",
      "supports" => array( "title", "editor", "thumbnail", "excerpt", "custom-fields", "revisions", "reveal-modal", "reveal", "modal", "reveal-modal-options" ),
      "taxonomies" => array( "weinsorte" ),
    );

    register_post_type( "rebsorte", $args );

    /**
     * Post Type: Partnerwinzer.
     */

    $labels = array(
      "name" => __( "Partnerwinzer", "h-code-child" ),
      "singular_name" => __( "Partnerwinzer", "h-code-child" ),
      "menu_name" => __( "Partnerwinzer", "h-code-child" ),
    );

    $args = array(
      "label" => __( "Partnerwinzer", "h-code-child" ),
      "labels" => $labels,
      "description" => "Partnerwinzer",
      "public" => true,
      "publicly_queryable" => true,
      "show_ui" => true,
      "show_in_rest" => false,
      "rest_base" => "",
      "has_archive" => false,
      "show_in_menu" => true,
      "exclude_from_search" => false,
      "capability_type" => "post",
      "map_meta_cap" => true,
      "hierarchical" => false,
      "rewrite" => array( "slug" => "partnerwinzer", "with_front" => true ),
      "query_var" => true,
      "menu_icon" => "dashicons-groups",
      "supports" => array( "title", "editor", "thumbnail" ),
    );

    register_post_type( "partnerwinzer", $args );
  }

  add_action( 'init', 'cptui_register_my_cpts' );


  function cptui_register_my_taxes() {

    /**
     * Taxonomy: Weinsorten.
     */

    $labels = array(
      "name" => __( "Weinsorten", "h-code-child" ),
      "singular_name" => __( "Weinsorte", "h-code-child" ),
    );

    $args = array(
      "label" => __( "Weinsorten", "h-code-child" ),
      "labels" => $labels,
      "public" => true,
      "hierarchical" => true,
      "label" => "Weinsorten",
      "show_ui" => true,
      "show_in_menu" => true,
      "show_in_nav_menus" => true,
      "query_var" => true,
      "rewrite" => array( 'slug' => 'weinsorte', 'with_front' => true, ),
      "show_admin_column" => true,
      "show_in_rest" => false,
      "rest_base" => "",
      "show_in_quick_edit" => false,
    );
    register_taxonomy( "weinsorte", array( "rebsorte" ), $args );
  }

  add_action( 'init', 'cptui_register_my_taxes' );



?>
