<?php
/**
 * H-Code Theme Extra Function.
 *
 * @package H-Code
 */
?>
<?php
if ( ! function_exists( 'hcode_set_header' ) ) {
    function hcode_set_header( $id ){
        if( get_post_type( $id ) == 'portfolio' && is_singular('portfolio') ){
            $enable_ajax = get_post_meta($id,'hcode_enable_ajax_popup_single',true);
        }else{
            $enable_ajax = '';
        }
        
        if($enable_ajax == 'yes'){
            remove_all_actions('wp_head');
        }
    }
}

if ( ! function_exists( 'hcode_set_footer' ) ) {
    function hcode_set_footer( $id ){
        if(get_post_type( $id ) == 'portfolio' && is_singular('portfolio')){
            $enable_ajax = get_post_meta($id,'hcode_enable_ajax_popup_single',true);
        }else{
            $enable_ajax = '';
        }

        if($enable_ajax == 'yes'){
            remove_all_actions('wp_footer');
            add_action('wp_footer','hcode_hook_for_ajax_page');
        }
    }
}

if ( ! function_exists( 'hcode_add_ajax_page_div_header' ) ) {
    function hcode_add_ajax_page_div_header( $id ){
        if( get_post_type( $id ) == 'portfolio' && is_singular('portfolio') ){
            $enable_ajax = get_post_meta($id,'hcode_enable_ajax_popup_single',true);
        }else{
            $enable_ajax = '';
        }
        
        if($enable_ajax == 'yes'){
            echo '<div class="bg-white">';
        }
    }
}

if ( ! function_exists( 'hcode_add_ajax_page_div_footer' ) ) {
    function hcode_add_ajax_page_div_footer( $id ){
        if(get_post_type( $id ) == 'portfolio' && is_singular('portfolio')){
            $enable_ajax = get_post_meta($id,'hcode_enable_ajax_popup_single',true);
        }else{
            $enable_ajax = '';
        }

        if($enable_ajax == 'yes'){
            echo '</div>';
        }
    }
}

if ( ! function_exists( 'hcode_post_meta' ) ) {
    function hcode_post_meta( $option ){
        global $post;
        $value = get_post_meta( $post->ID, $option.'_single', true);
        return $value;
    }
}

if ( ! function_exists( 'hcode_option' ) ) {
    function hcode_option( $option ){
        global $hcode_theme_settings, $post;
        $hcode_single = false;
        if(is_singular()){
            $value = get_post_meta( $post->ID, $option.'_single', true);
            $hcode_single = true;
        }

        if($hcode_single == true){
            if (is_string($value) && (strlen($value) > 0 || is_array($value)) && ($value != 'default' && $value != 'Select Sidebar')  ) {
                return $value;
            }
        }
        if(isset($hcode_theme_settings[$option]) && $hcode_theme_settings[$option] != ''){
            $option_value = $hcode_theme_settings[$option];
            return $option_value;
        }
        return false;
    }
}

if ( ! function_exists( 'hcode_option_post' ) ) {
    function hcode_option_post( $option ){
        global $hcode_theme_settings, $post;
        $option_post = '';
        $hcode_single = false;

        if(is_singular()){
            $value = get_post_meta( $post->ID, $option.'_single', true);
            $hcode_single = true;
        }

        if($hcode_single == true){
            if (is_string($value) && (strlen($value) > 0 || is_array($value)) && ($value != 'default' && $value != 'Select Sidebar')  ) {
                return $value;
            }
        }
        $option_post = $option.'_post';
        if(isset($hcode_theme_settings[$option_post]) && $hcode_theme_settings[$option_post] != ''){
            $option_value = $hcode_theme_settings[$option_post];
            return $option_value;
        }
        return false;
    }
}

if ( ! function_exists( 'hcode_option_portfolio' ) ) {
    function hcode_option_portfolio( $option ){
        global $hcode_theme_settings, $post;
        $option_post = '';
        $hcode_single = false;

        if(is_singular()){
            $value = get_post_meta( $post->ID, $option.'_single', true);
            $hcode_single = true;
        }

        if($hcode_single == true){
            if (is_string($value) && (strlen($value) > 0 || is_array($value)) && ($value != 'default' && $value != 'Select Sidebar')  ) {
                return $value;
            }
        }
        $option_post = $option.'_portfolio';
        if(isset($hcode_theme_settings[$option_post]) && $hcode_theme_settings[$option_post] != ''){
            $option_value = $hcode_theme_settings[$option_post];
            return $option_value;
        }
        return false;
    }
}
/* For Image Alt Text */
if ( ! function_exists( 'hcode_option_image_alt' ) ) {
    function hcode_option_image_alt( $attach_id ){
        global $hcode_theme_settings, $post;
        $option = 'enable_image_alt';
        if(isset($hcode_theme_settings[$option]) && $hcode_theme_settings[$option] != ''){
            $option_value = $hcode_theme_settings[$option];
            $img_meta = wp_get_attachment_metadata( $attach_id );
            $attachment = get_post( $attach_id );

            if( !empty( $attachment->ID ) ) {
                $img_info = array(
                    'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
                );
                if($option_value == '1'){
                    return $img_info;
                }
            }
        }
        return;
    }
}

/* For Image Title */
if ( ! function_exists( 'hcode_option_image_title' ) ) {
    function hcode_option_image_title( $attach_id ){
        global $hcode_theme_settings, $post;
        $option = 'enable_image_title';
        if(isset($hcode_theme_settings[$option]) && $hcode_theme_settings[$option] != ''){
            $option_value = $hcode_theme_settings[$option];
            $img_meta = wp_get_attachment_metadata( $attach_id );
            $attachment = get_post( $attach_id );
            $img_info = array(
                'title' => $attachment->post_title
            );
            if($option_value == '1'){
                return $img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* For Image Caption */
if ( ! function_exists( 'hcode_option_image_caption' ) ) {
    function hcode_option_image_caption( $attach_id ){
        global $hcode_theme_settings, $post;
        $option = 'enable_lightbox_caption';
        if(isset($hcode_theme_settings[$option]) && $hcode_theme_settings[$option] != ''){
            $option_value = $hcode_theme_settings[$option];
            $img_meta = wp_get_attachment_metadata( $attach_id );
            $attachment = get_post( $attach_id );
            $img_info = array(
                'caption' => $attachment->post_excerpt,
            );
            if($option_value == '1'){
                return $img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* For Lightbox Image Title */
if ( ! function_exists( 'hcode_option_lightbox_image_title' ) ) {
    function hcode_option_lightbox_image_title( $attach_id ){
        global $hcode_theme_settings, $post;
        $option = 'enable_lightbox_title';
        if(isset($hcode_theme_settings[$option]) && $hcode_theme_settings[$option] != ''){
            $option_value = $hcode_theme_settings[$option];
            $img_meta = wp_get_attachment_metadata( $attach_id );
            $attachment = get_post( $attach_id );
            $img_info = array(
                'title' => $attachment->post_title
            );
            if($option_value == '1'){
                return $img_info;
            }else{
                return;
            }
        }
        return;
    }
}

if ( ! function_exists( 'hcode_option_url' ) ) {
    function hcode_option_url($option) {
        $image = hcode_option($option);
        if (is_array($image) && isset($image['url']) && !empty($image['url'])) {
            return $image['url'];
        }
        return false;
    }
}

if( ! function_exists( 'hcode_script_add_data' ) ) :

function hcode_script_add_data( $handle, $key, $value ) {
    global $wp_scripts;
    return $wp_scripts->add_data( $handle, $key, $value );
}

endif; // ! function_exists( 'hcode_script_add_data' )

if( ! function_exists( 'add_async' ) ) :

function add_async( $tag, $handle ) {
    if( $handle == 'h-code' ) {
        return preg_replace( "/(><\/[a-zA-Z][^0-9](.*)>)$/", " async $1 ", $tag );
    } else {
        return $tag;
    }
}
endif;
add_action( 'script_loader_tag',  'add_async' , 10, 2 );


add_action( 'wp_before_admin_bar_render', 'hcode_remove_customizer_adminbar' ); 

if ( ! function_exists( 'hcode_remove_customizer_adminbar' ) ) {
    function hcode_remove_customizer_adminbar()
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('customize');
    }
}

/**
 * Force All Page To Under Construction If "enable-under-construction" is enable
 */
if ( ! function_exists( 'hcode_get_address' ) ) {
    function hcode_get_address() {
        // return the full address
        return hcode_get_protocol().'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    } // end function hcode_get_address
}

if ( ! function_exists( 'hcode_get_protocol' ) ) {
    function hcode_get_protocol() {
        // Set the base protocol to http
        $protocol = 'http';
        // check for https
        if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {
            $protocol .= "s";
        }
        
        return $protocol;
    } // end function hcode_get_protocol
}
        
add_action('init', 'hcode_force_under_construction', 1);
if ( ! function_exists( 'hcode_force_under_construction' ) ) {
    function hcode_force_under_construction() {

        if (hcode_option('enable_under_construction') == 1 && !current_user_can('level_10') && hcode_option('under_construction_page') != '' ) { 
                
            // this is what the user asked for (strip out home portion, case insensitive)
            $userrequest = str_ireplace(home_url(),'',hcode_get_address());
            $userrequest = rtrim($userrequest,'/');

            $do_redirect = '';
            if( get_option('permalink_structure') ){
                $frontpage_id = get_option( 'page_on_front' );
                $post = get_post($frontpage_id); 
                $slug = $post->post_name;
                if( $slug == hcode_option( 'under_construction_page' ) ) {
                    $do_redirect = '/';
                }else{
                    $do_redirect = '/'.hcode_option('under_construction_page');
                }
            }else{
                $getpost = get_page_by_path(hcode_option('under_construction_page'));
                if ($getpost) {
                    $do_redirect = '/?page_id='.$getpost->ID;
                }
            }

            if ( strpos($userrequest, '/wp-login') !== 0 && strpos($userrequest, '/wp-admin') !== 0 ) {
                // Make sure it gets all the proper decoding and rtrim action
                $userrequest = str_replace('*','(.*)',$userrequest);
                $pattern = '/^' . str_replace( '/', '\/', rtrim( $userrequest, '/' ) ) . '/';
                $do_redirect = str_replace('*','$1',$do_redirect);
                $output = preg_replace($pattern, $do_redirect, $userrequest);
                if ($output !== $userrequest) {
                    // pattern matched, perform redirect
                    $do_redirect = $output;
                }
            }else{
                // simple comparison redirect
                $do_redirect = $userrequest;
            }

            if ($do_redirect !== '' && trim($do_redirect,'/') !== trim($userrequest,'/')) {
                // check if destination needs the domain prepended

                if (strpos($do_redirect,'/') === 0){
                    $do_redirect = home_url().$do_redirect;
                }

                wp_redirect( $do_redirect );
                exit();
                
            }
        }
    } // end funcion redirect
}

/**
 * To Add Under Construction Notice To Adminbar For All Logged User
 */
if ( ! function_exists( 'hcode_admin_bar_under_construction_notice' ) ) {
    function hcode_admin_bar_under_construction_notice() {
        global $wp_admin_bar;
        
        if (hcode_option('enable_under_construction') == 1) {
            $wp_admin_bar->add_menu( array(
                'id' => 'admin-bar-under-construction-notice',
                'parent' => 'top-secondary',
                'href' => home_url().'/wp-admin/themes.php?page=hcode_theme_settings',
                'title' => '<span style="color: #FF0000;">Under Construction</span>'
            ) );
        }
    }
}
add_action( 'admin_bar_menu', 'hcode_admin_bar_under_construction_notice' );

if ( ! function_exists( 'hcode_slider_pagination' ) ) {
    function hcode_slider_pagination( $pagination , $slider_id = ''){
        $output  = '';

        ob_start();

        if($pagination){
            $pagination_count = substr_count($pagination, '[hcode_slide_content ');
            for ($count=0; $count <= $pagination_count-1; $count++){
                echo '<li data-target="#'.$slider_id.'" data-slide-to="'.$count.'"></li>';
            }
        }

        $result = ob_get_contents();
        ob_end_clean();
        $output .= $result;

        return $output;
    }
}
/* For content bootstrap slider pagination */
if ( ! function_exists( 'hcode_bootstrap_content_slider_pagination' ) ) {
    function hcode_bootstrap_content_slider_pagination( $pagination , $slider_id = ''){
        $output  = '';

        ob_start();

        if($pagination){
            $pagination_count = substr_count($pagination, '[hcode_special_slide_content ');
            for ($count=0; $count <= $pagination_count-1; $count++){
                echo '<li data-target="#'.$slider_id.'" data-slide-to="'.$count.'"></li>';
            }
        }

        $result = ob_get_contents();
        ob_end_clean();
        $output .= $result;

        return $output;
    }
}

if ( ! function_exists( 'hcode_owl_pagination_color_classes' ) ) {
    function hcode_owl_pagination_color_classes( $pagination ){
        $class_list = '';

        switch($pagination)
        {
            case 0:
                $class_list .= ' dark-pagination';
                break;

            case 1:
                $class_list .= ' light-pagination';
                break;

            default:
                $class_list .= ' dark-pagination';
                break;
        }
        return $class_list;
    }
}

if ( ! function_exists( 'hcode_owl_pagination_slider_classes' ) ) {
    function hcode_owl_pagination_slider_classes( $pagination_color ){
        $class_list = '';

        switch($pagination_color)
        {
            case 0:
                $class_list .= ' dot-pagination';
                break;

            case 1:
                $class_list .= ' square-pagination';
                break;

                    case 2:
                        $class_list .= ' round-pagination';
                        break;

            default:
                $class_list .= ' dot-pagination';
                break;
        }

        return $class_list;
    }
}

if ( ! function_exists( 'hcode_owl_navigation_slider_classes' ) ) {
    function hcode_owl_navigation_slider_classes ($navigation){
        $class_list = '';

        switch($navigation)
        {
            case 0:
                $class_list .= ' dark-navigation';
                break;

            case 1:
                $class_list .= ' light-navigation';
                break;

            default:
                $class_list .= ' dark-navigation';
                break;
        }

        return $class_list;
    }
}

if ( ! function_exists( 'hcode_breadcrumb_li_display' ) ) {
    function hcode_breadcrumb_li_display() {

        if( class_exists( 'WooCommerce' ) && ( is_product_category() || is_tax('product_brand') || is_shop() ) ) {// check woocommerce category, brand, shop page

            ob_start();
                do_action('hcode_woocommerce_breadcrumb');
            return ob_get_clean();

        } elseif (class_exists('breadcrumb_navigation_xt')) {

            $hcode_breadcrumb = new breadcrumb_navigation_xt;
            $hcode_breadcrumb->opt['static_frontpage'] = false;
            $hcode_breadcrumb->opt['url_blog'] = '';
            $hcode_breadcrumb->opt['title_blog'] = __('Home','H-Code');
            $hcode_breadcrumb->opt['title_home'] = __('Home','H-Code');
            $hcode_breadcrumb->opt['separator'] = '';
            $hcode_breadcrumb->opt['tag_page_prefix'] = '';
            $hcode_breadcrumb->opt['singleblogpost_category_display'] = false;

            return $hcode_breadcrumb->display();
        }
    }    
}

/* page title option for archive pages*/
if ( ! function_exists( 'hcode_get_title_part_for_archive' ) ) {
    function hcode_get_title_part_for_archive(){

        global $wp_query;

        $top_header_class = $page_title = '';

        $hcode_options          = get_option( 'hcode_theme_setting' );

        $hcode_enable_header    = hcode_option('hcode_enable_header');
        $hcode_header_layout    = hcode_option('hcode_header_layout');
        $header_logo_position   = hcode_option( 'hcode_header_logo_position' );
        $hcode_enable_mini_header = hcode_option( 'hcode_enable_mini_header' );
        $hcode_enable_mini_header_mobile = hcode_option( 'hcode_enable_mini_header_mobile' );

        if( class_exists( 'WooCommerce' ) && ( is_product_category() || is_tax('product_brand') || is_tax('product_tag') || is_shop() ) ) {// check woocommerce category, brand, shop page

            $enable_title               = hcode_option('hcode_enable_wc_category_title_wrapper');
            $page_title_premade_style   = hcode_option('hcode_wc_category_page_title_premade_style');
            $page_title_image           = hcode_option('hcode_wc_category_title_background');
            $hcode_title_parallax_effect= hcode_option('hcode_wc_category_title_parallax_effect');
            $page_subtitle              = hcode_option('hcode_wc_category_header_subtitle');
            $page_title_show_breadcrumb = hcode_option('hcode_wc_category_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option('hcode_wc_category_page_title_show_separator');
            $hcode_header_layout        = hcode_option('hcode_header_layout_woocommerce');
            $hcode_enable_header        = hcode_option('hcode_enable_header_woocommerce');
            if( hcode_option( 'hcode_header_logo_position_woocommerce' ) ) {
                $header_logo_position       = hcode_option( 'hcode_header_logo_position_woocommerce' );
            }
            
            $enable_title = $enable_title != '' ? $enable_title : '1';
            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-wc-style';
            $page_title_show_breadcrumb = $page_title_show_breadcrumb != '' ? $page_title_show_breadcrumb : '1';
   
        } elseif(is_singular('portfolio')){// check single page for portfolio

            $enable_title               = hcode_option_portfolio('hcode_enable_title_wrapper');
            $page_title_premade_style   = hcode_option_portfolio('hcode_page_title_premade_style');
            $page_title_image           = hcode_option_portfolio('hcode_title_background');
            $hcode_title_parallax_effect= hcode_option_portfolio('hcode_title_parallax_effect');
            $page_subtitle              = hcode_option_portfolio('hcode_header_subtitle');
            $page_title_show_breadcrumb = hcode_option_portfolio('hcode_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option_portfolio('hcode_page_title_show_separator');
                 
            $enable_title = $enable_title != '' ? $enable_title : '1';
            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-small-gray';
            $page_title_show_breadcrumb = $page_title_show_breadcrumb != '' ? $page_title_show_breadcrumb : '1';

            if( class_exists( 'WooCommerce' ) && (is_product() || is_product_category() || is_product_tag()) || is_404()){
                $enable_header = '2';
            }else{
                $enable_header = hcode_option('hcode_enable_header');
            }
            if($enable_header == '1' || $enable_header == '2'){
                $hcode_enable_header = hcode_option('hcode_enable_header');
                $hcode_header_layout = hcode_option('hcode_header_layout');
      

                if($enable_header == '2'){
                    $hcode_options = get_option( 'hcode_theme_setting' );
                    $hcode_enable_header = (isset($hcode_options['hcode_enable_header'])) ? $hcode_options['hcode_enable_header'] : '';
                }
            }
            
        } elseif(is_tax('portfolio-category') || is_tax('portfolio-tags') || is_post_type_archive('portfolio')){// check category, tag page for portfolio

            $enable_title               = hcode_option('hcode_enable_category_title_wrapper');
            $page_title_premade_style   = hcode_option('hcode_category_page_title_premade_style');
            $page_title_image           = hcode_option('hcode_category_title_background');
            $hcode_title_parallax_effect= hcode_option('hcode_category_title_parallax_effect');
            $page_subtitle              = hcode_option('hcode_category_header_subtitle');
            $page_title_show_breadcrumb = hcode_option('hcode_category_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option('hcode_category_page_title_show_separator');
                 
            $enable_title = $enable_title != '' ? $enable_title : '1';
            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-small-gray';
            $page_title_show_breadcrumb = $page_title_show_breadcrumb != '' ? $page_title_show_breadcrumb : '1';

        } elseif(is_search() || is_category() || is_archive()){// check archive, category, search, author page

            $enable_title               = hcode_option('hcode_enable_archive_title_wrapper');
            $page_title_premade_style   = hcode_option('hcode_archive_page_title_premade_style');
            $page_title_image           = hcode_option('hcode_archive_title_background');
            $hcode_title_parallax_effect= hcode_option('hcode_archive_title_parallax_effect');
            $page_subtitle              = hcode_option('hcode_archive_header_subtitle');
            $page_title_show_breadcrumb = hcode_option('hcode_archive_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option('hcode_archive_page_title_show_separator');
            $hcode_header_layout        = hcode_option('hcode_header_layout_general');
            $hcode_enable_header        = hcode_option('hcode_enable_header_general');
            if( hcode_option( 'hcode_header_logo_position_general' ) ) {
                $header_logo_position       = hcode_option( 'hcode_header_logo_position_general' );
            }

            $enable_title = $enable_title != '' ? $enable_title : '1';
            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-small-gray';
            $page_title_show_breadcrumb = $page_title_show_breadcrumb != '' ? $page_title_show_breadcrumb : '1';
  
        } elseif( is_home() ) {// default blog page

            $enable_title               = hcode_option('hcode_enable_blog_title_wrapper');
            $page_title_premade_style   = hcode_option('hcode_blog_page_title_premade_style');
            $page_title_image           = hcode_option('hcode_blog_title_background');
            $hcode_title_parallax_effect= hcode_option('hcode_blog_title_parallax_effect');
            $page_subtitle              = hcode_option('hcode_blog_header_subtitle');
            $page_title_show_breadcrumb = hcode_option('hcode_blog_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option('hcode_blog_page_title_show_separator');
                 
            $enable_title = $enable_title != '' ? $enable_title : '1';
            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-small-gray';
            $page_title_show_breadcrumb = $page_title_show_breadcrumb != '' ? $page_title_show_breadcrumb : '1';
 
        } else {

            $enable_title               = hcode_option('hcode_enable_title_wrapper');

            if( $enable_title == '1' ){
                $hcode_options = get_option( 'hcode_theme_setting' );
                $enable_title = ( isset($hcode_options['hcode_enable_title_wrapper']) ) ? $hcode_options['hcode_enable_title_wrapper'] : '';
            }

            $page_title_premade_style   = hcode_option('hcode_page_title_premade_style');
            $page_title_image           = hcode_option('hcode_title_background');
            $hcode_title_parallax_effect= hcode_option('hcode_title_parallax_effect');
            $page_subtitle              = hcode_option('hcode_header_subtitle');
            $page_title_show_breadcrumb = hcode_option('hcode_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option('hcode_page_title_show_separator');

            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-small-gray';

            if( class_exists( 'WooCommerce' ) && (is_product() || is_product_category() || is_product_tag()) || is_404()){
                $enable_header = '2';
            }else{
                $enable_header = hcode_option('hcode_enable_header');
            }
            if($enable_header == '1' || $enable_header == '2'){
                $hcode_enable_header = hcode_option('hcode_enable_header');
                $hcode_header_layout = hcode_option('hcode_header_layout');

                if($enable_header == '2'){
                    $hcode_options = get_option( 'hcode_theme_setting' );
                    $hcode_enable_header = (isset($hcode_options['hcode_enable_header'])) ? $hcode_options['hcode_enable_header'] : '';
                }
            }
        }
 
        if($hcode_enable_header == 1 && $hcode_header_layout != 'headertype9') {
                    
            if( hcode_check_enable_mini_header() ) {
                if( $header_logo_position == 'top' && $hcode_header_layout != 'headertype9' && $hcode_header_layout != 'headertype10' && $hcode_header_layout != 'headertype11' ) {
                    $top_header_class .= 'content-top-margin-extra-big';
                } else {
                    $top_header_class .= 'content-top-margin-big';
                }
            } else if( $hcode_header_layout != 'headertype8' ) {
                if( $header_logo_position == 'top' && $hcode_header_layout != 'headertype9' && $hcode_header_layout != 'headertype10' && $hcode_header_layout != 'headertype11' ) {
                    $top_header_class .= 'content-top-margin-midium-big';
                } else {
                    $top_header_class .= 'content-top-margin';
                }
            }
        }
        else if($hcode_enable_header == 1 && hcode_check_enable_mini_header() && $hcode_header_layout == 'headertype9')
        {
            $top_header_class .= 'content-mini-header-margin';
        }

        if( $hcode_enable_mini_header == 1 && $hcode_enable_mini_header_mobile == 1 )
        {
            $top_header_class .= ' mobile-mini-header-visible';
        }

        if($enable_title == 0 || is_404()) {
            return;
        }
        
        if( class_exists( 'WooCommerce' ) && is_shop() ):
            $page_title .= woocommerce_page_title( false );
        elseif(is_post_type_archive('portfolio')):
            $page_title .= (isset($hcode_options['hcode_portfolio_cat_title'])) ? $hcode_options['hcode_portfolio_cat_title'] : '';
        elseif(is_search()):
            $page_title .= __('Search For ','H-Code').'"'.get_search_query().'"';
        elseif(is_author()):
            $page_title .= get_the_author();
        elseif(is_archive()):
            if ( is_day() ) :
                $page_title .= get_the_date() ;

            elseif ( is_month() ) :
                $page_title .=get_the_date( _x( 'F Y', 'monthly archives date format', 'H-Code' ) ) ;

            elseif ( is_year() ) :
                $page_title .= get_the_date( _x( 'Y', 'yearly archives date format', 'H-Code' ) );

            endif;
            $page_title .= single_cat_title( '', false );
        elseif(is_home()):
            $page_title .= (isset($hcode_options['hcode_blog_page_title'])) ? $hcode_options['hcode_blog_page_title'] : '';
        else: 
            $page_title .= get_the_title();
        endif;

        if(is_array($page_title_image)) {
            $page_title_image =  $page_title_image['url'];
        }

        $output = '';

        switch ($page_title_premade_style) {
            case 'title-white':

                $output .= '<section class="'.$top_header_class.' page-title-section page-title border-bottom-light border-top-light bg-white">';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                $output .= '<div class="col-lg-8 col-md-7 col-sm-12 slideInUp wow fadeInUp" data-wow-duration="300ms">';
                                    if($page_title){
                                        $output .= '<h1 class="black-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        $output .= '<span class="xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line margin-three bg-black no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                $output .= '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                $output .= '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase sm-no-margin-top wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    $output .= '<ul class="breadcrumb-gray-text">';
                                        $output .= hcode_breadcrumb_li_display();
                                    $output .= '</ul>';
                                $output .= '</div>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';
                break;

            case 'title-gray':
                
                $output .= '<section class="'.$top_header_class.' page-title-section page-title bg-gray">';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                $output .= '<div class="col-lg-8 col-md-7 col-sm-12 slideInUp wow fadeInUp" data-wow-duration="300ms">';
                                    if($page_title){
                                        $output .= '<h1 class="black-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        $output .= '<span class="xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line margin-three bg-black no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                $output .= '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                $output .= '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase sm-no-margin-top wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    $output .= '<ul class="breadcrumb-gray-text">';
                                        $output .= hcode_breadcrumb_li_display();
                                    $output .= '</ul>';
                                $output .= '</div>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';
                break;

            case 'title-dark-gray':
                
                $output .= '<section class="'.$top_header_class.' page-title-section page-title bg-dark-gray">';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                $output .= '<div class="col-lg-8 col-md-7 col-sm-12 slideInUp wow fadeInUp" data-wow-duration="300ms">';
                                    if($page_title){
                                        $output .= '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        $output .= '<span class="white-text xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line margin-three bg-white no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                $output .= '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                $output .= '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase sm-no-margin-top wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    $output .= '<ul class="breadcrumb-white-text">';
                                        $output .= hcode_breadcrumb_li_display();
                                    $output .= '</ul>';
                                $output .= '</div>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';
                break;

            case 'title-black':

                $output .= '<section class="'.$top_header_class.' page-title-section page-title bg-black">';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                $output .= '<div class="col-lg-8 col-md-7 col-sm-12 slideInUp wow fadeInUp" data-wow-duration="300ms">';
                                    if($page_title){
                                        $output .= '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        $output .= '<span class="white-text xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line margin-three bg-white no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                $output .= '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                $output .= '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase sm-no-margin-top wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    $output .= '<ul class="breadcrumb-white-text">';
                                        $output .= hcode_breadcrumb_li_display();
                                    $output .= '</ul>';
                                $output .= '</div>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';

                break;
            case 'title-with-image':
                
                $image_url = $page_title_image ;
                if( esc_url( $image_url ) ) {
                    $output .= '<section class="'.$top_header_class.' page-title-section page-title '.$hcode_title_parallax_effect.' parallax-fix" style="background: url('.$image_url.'); background-position: 50% 0%;">';
                } else {
                    $output .= '<section class="'.$top_header_class.' page-title-section page-title '.$hcode_title_parallax_effect.' parallax-fix">';
                }
                    $output .= '<div class="opacity-medium bg-black"></div>';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                $output .= '<div class="col-lg-8 col-md-7 col-sm-12 slideInUp wow fadeInUp" data-wow-duration="300ms">';
                                    if($page_title){
                                        $output .= '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        $output .= '<span class="white-text xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line margin-three bg-white no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                $output .= '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                $output .= '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase sm-no-margin-top wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    $output .= '<ul class="breadcrumb-white-text">';
                                        $output .= hcode_breadcrumb_li_display();
                                    $output .= '</ul>';
                                $output .= '</div>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';

                break;
            case 'title-large':

                $image_url = $page_title_image ;

                if( esc_url( $image_url ) ) {
                    $output .= '<section class="page-title '.$hcode_title_parallax_effect.' parallax-fix page-title-large" style="background: url('.$image_url.'); background-position: 50% 0%;">';
                } else {
                    $output .= '<section class="page-title '.$hcode_title_parallax_effect.' parallax-fix page-title-large">';
                }
                    $output .= '<div class="opacity-medium bg-black"></div>';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            $output .= '<div class="col-md-12 col-sm-12 text-center animated fadeInUp">';
                                if($page_title != '' || $page_subtitle != ''){
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line bg-yellow no-margin-top margin-four"></div>';
                                    }
                                    if($page_title){
                                        $output .= '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        $output .= '<span class="white-text">'.$page_subtitle.'</span>';
                                    }
                                }
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';
                break;
            case 'title-large-without-overlay':

                $image_url = $page_title_image ;

                if( esc_url( $image_url ) ) {
                    $output .= '<section class="page-title '.$hcode_title_parallax_effect.' parallax-fix page-title-large" style="background: url('.$image_url.'); background-position: 50% 0%;">';
                } else {
                    $output .= '<section class="page-title '.$hcode_title_parallax_effect.' parallax-fix page-title-large">';
                }
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            $output .= '<div class="col-md-12 col-sm-12 text-center animated fadeInUp">';
                                if($page_title != '' || $page_subtitle != ''){
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line bg-yellow no-margin-top margin-four"></div>';
                                    }
                                    if($page_title){
                                        $output .= '<h1 class="black-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        $output .= '<span class="text-uppercase gray-text">'.$page_subtitle.'</span>';
                                    }
                                }
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';
                break;
            case 'title-small-white':

                $output .= '<section class="'.$top_header_class.' page-title-section page-title page-title-small border-bottom-light border-top-light bg-white">';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            if($page_title != ''){
                                $output .= '<div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">';
                                    
                                    if($page_title){
                                        $output .= '<h1 class="black-text">'.$page_title.'</h1>';
                                    }
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line margin-three bg-black no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                $output .= '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                $output .= '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    $output .= '<ul class="breadcrumb-gray-text">';
                                        $output .= hcode_breadcrumb_li_display();
                                    $output .= '</ul>';
                                $output .= '</div>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';
                break;
            case 'title-small-gray':

                $output .= '<section class="'.$top_header_class.' page-title-section page-title page-title-small bg-gray">';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            if($page_title != ''){
                                $output .= '<div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">';
                                    
                                    if($page_title){
                                        $output .= '<h1 class="black-text">'.$page_title.'</h1>';
                                    }
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line margin-three bg-black no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                $output .= '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                $output .= '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    $output .= '<ul class="breadcrumb-gray-text">';
                                        $output .= hcode_breadcrumb_li_display();
                                    $output .= '</ul>';
                                $output .= '</div>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';

                break;
            case 'title-small-dark-gray':

                $output .= '<section class="'.$top_header_class.' page-title-section page-title page-title-small bg-dark-gray border-bottom-light border-top-light">';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            if($page_title != ''){
                                $output .= '<div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">';
                                    
                                    if($page_title){
                                        $output .= '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line margin-three bg-white no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                $output .= '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                $output .= '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    $output .= '<ul class="breadcrumb-white-text">';
                                        $output .= hcode_breadcrumb_li_display();
                                    $output .= '</ul>';
                                $output .= '</div>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';

                break;
            case 'title-small-black':

                $output .= '<section class="'.$top_header_class.' page-title-section page-title page-title-small bg-black border-bottom-light border-top-light">';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            if($page_title != ''){
                                $output .= '<div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">';
                                    
                                    if($page_title){
                                        $output .= '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line margin-three bg-white no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                $output .= '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                $output .= '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    $output .= '<ul class="breadcrumb-white-text">';
                                        $output .= hcode_breadcrumb_li_display();
                                    $output .= '</ul>';
                                $output .= '</div>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';

                break;
            case 'title-center-align':

                $output .= '<section class="'.$top_header_class.' page-title-section page-title bg-black border-bottom-light border-top-light">';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                $output .= '<div class="col-md-12 col-sm-12 animated text-center fadeInUp">';
                                    
                                    if($page_title){
                                        $output .= '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        $output .= '<span class="white-text xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        $output .= '<div class="separator-line margin-three bg-white sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                $output .= '</div>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</section>';

                break;
            case 'title-wc-style':
                if( class_exists( 'WooCommerce' ) ) {
                    if( is_shop() ) {
                        
                        $description = $page_subtitle;

                        $output .= '<section class="page-title parallax3 parallax-fix page-title-large page-title-shop">
                            <div class="opacity-light bg-dark-gray"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 wow fadeIn">';
                                        if ( ! empty( $description ) ) : 
                                            $output .= '<span class="text-uppercase white-text">'.$description.'</span>';
                                        endif;
                                        $output .= '<h1 class="white-text">' . $page_title . '</h1>';
                        $output .= '</div>';
                                    if( $page_title_show_breadcrumb ):
                                        $output .= '<div class="col-md-12 col-sm-12 breadcrumb text-uppercase margin-three no-margin-bottom wow fadeIn">';
                                            $output .= '<ul class="woocommerce-breadcrumb-main breadcrumb-white-text">';
                                                $output .= hcode_breadcrumb_li_display();
                                            $output .= '</ul>
                                        </div>';
                                    endif;
                        $output .= '</div>
                            </div>
                                </section>';
                    } else {
                        
                        // get the query object
                        $product_category       = $wp_query->get_queried_object();

                        // get the thumbnail id user the term_id
                        $thumbnail_id           = get_woocommerce_term_meta( $product_category->term_id, 'thumbnail_id', true );

                        // get the image URL
                        $image_url              = $page_title_image ;
                        $product_category_image = wp_get_attachment_url( $thumbnail_id );
                        $product_category_image = !empty( $product_category_image ) ? $product_category_image : $image_url;
                        
                        // get the subline / description
                        $description            = get_queried_object()->description;
                        $description            = !empty( $description ) && !is_shop() ? $description : $page_subtitle;

                        
                        if( esc_url( $product_category_image ) ) {
                            $output .= '<section class="page-title parallax3 parallax-fix page-title-large page-title-shop" style="background: url('.esc_url( $product_category_image ).'); background-position: 50% 0%;">';
                        } else {
                            $output .= '<section class="page-title parallax3 parallax-fix page-title-large page-title-shop">';
                        }

                            $output .= '<div class="opacity-light bg-dark-gray"></div>';
                            $output .= '<div class="container">';
                                $output .= '<div class="row">';
                                    $output .= '<div class="col-md-12 col-sm-12 wow fadeIn">';
                                        if ( ! empty( $description ) ) {
                                            $output .= '<span class="text-uppercase white-text">'.$description.'</span>';
                                        }
                                        if( $page_title ) {
                                            $output .= '<h1 class="white-text">'.$page_title.'</h1>';
                                        }
                                    $output .= '</div>';
                                    if( $page_title_show_breadcrumb ):
                                        $output .= '<div class="col-md-12 col-sm-12 breadcrumb text-uppercase margin-three no-margin-bottom wow fadeIn">';
                                            $output .= '<ul class="woocommerce-breadcrumb-main breadcrumb-white-text">';
                                                $output .= hcode_breadcrumb_li_display();
                                            $output .= '</ul>
                                        </div>';
                                    endif;
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</section>';
                    }
                }

                break;
        }
        echo $output;
    }
}

if ( ! function_exists( 'hcode_categories_postcount_filter' ) ) {
    function hcode_categories_postcount_filter ($variable) {
       $variable = str_replace('(', '<span class="light-gray-text">/ ', $variable);
       $variable = str_replace(')', '</span>', $variable);
       return $variable;
    }
}
add_filter('wp_list_categories','hcode_categories_postcount_filter');

add_filter('wp_list_categories', 'hcode_add_new_class_list_categories');
if ( ! function_exists( 'hcode_add_new_class_list_categories' ) ) {
    function hcode_add_new_class_list_categories($list) {
        $list = str_replace('cat-item ', 'cat-item widget-category-list light-gray-text ', $list); 
        return $list;
    }
}

add_filter('get_archives_link', 'hcode_archive_count_no_brackets');
if ( ! function_exists( 'hcode_archive_count_no_brackets' ) ) {
    function hcode_archive_count_no_brackets($links) {
        $links = str_replace('(', '<span class="light-gray-text">/ ', $links);
        $links = str_replace(')', '</span>', $links);
        return $links;
    }
}
add_filter('get_archives_link', 'hcode_add_new_class_list_archives');
if ( ! function_exists( 'hcode_add_new_class_list_archives' ) ) {
    function hcode_add_new_class_list_archives($list) {
        $list = str_replace('<li>', '<li class="widget-category-list"> ', $list); 
        return $list;
    }
}

if ( ! function_exists( 'hcode_wp_tag_cloud_filter' ) ) {
    function hcode_wp_tag_cloud_filter($return, $args)
    {
      return '<div class="tags_cloud tags">'.$return.'</div>';
    }
}
add_filter('wp_tag_cloud','hcode_wp_tag_cloud_filter', 10, 2);
/*  comment form customization   */

if ( ! function_exists( 'hcode_theme_comment' ) ) {
    function hcode_theme_comment($comment, $args, $depth) {
        
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);

        if ( 'div' == $args['style'] ) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
            
    ?>
        <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? 'blog-comment' : 'blog-comment parent' ) ?> id="comment-<?php comment_ID() ?>">
        <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <?php endif; ?>
            
        <div class="comment-author vcard comment-avtar">
        
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] );   ?>
        </div>
        <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'H-Code' ); ?></em>
            <br />
        <?php endif; ?>
        <div class="comment-right comment-text overflow-hidden position-relative">
                <div class="blog-date no-padding-top">
                    <div class="comment-meta commentmetadata">  
                            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                            <?php printf( esc_html__( '%s, ', 'H-Code' ), get_comment_author_link() ); ?>
                            </a>
                            
                            <?php
                            /* translators: 1: date, 2: time */
                            printf( esc_html__('%1$s','H-Code'), get_comment_date(),  get_comment_time() ); 
                            ?>
                            
                            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div>
                </div>
                <?php comment_text(); ?>
        </div>
        <?php if ( 'div' != $args['style'] ) : ?>
        </div>
        <?php endif; ?>
    <?php
    }
}

// filter to replace class on reply link
add_filter('comment_reply_link', 'hcode_replace_reply_link_class');
if ( ! function_exists( 'hcode_replace_reply_link_class' ) ) {
    function hcode_replace_reply_link_class($class){
        $class = str_replace("class='comment-reply-link", "class='comment-reply-link comment-reply inner-link bg-black", $class);
        return $class;
    }
}

add_filter('the_category', 'hcode_the_category');
if ( ! function_exists( 'hcode_the_category' ) ) {
    function hcode_the_category($cat_list)
    {
        return str_ireplace('<a', '<a class="white-text"', $cat_list);
    }
}

if ( ! function_exists( 'hcode_get_attachment_id_from_url' ) ) {
    function hcode_get_attachment_id_from_url($attachment_url,$attachment_size) {
        global $wpdb;
        $image = array('null');
        $attachment = false;
        if ( '' == $attachment_url )
                return;

        $upload_dir_paths = wp_upload_dir();

        if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
            $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $attachment_url )); 
            $image = !empty( $attachment[0] ) ? wp_get_attachment_image_src($attachment[0], $attachment_size) : '';
        }
        return $image;
    }
}

/* Post Navigation */
if ( ! function_exists( 'hcode_single_post_navigation' ) ) :
    function hcode_single_post_navigation() {
        // Don't print empty markup if there's nowhere to navigate.
        if( is_singular('post') ){
            $link = $cat_name = $next_image = $prev_image = '';
            // no image
            $hcode_options = get_option( 'hcode_theme_setting' );
            $hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
            
            if( isset( $hcode_no_image['url'] ) ) {
                $image_thumb = hcode_get_attachment_id_from_url($hcode_no_image['url'], 'hcode-navigation-img');
            } else {
                $image_thumb = array();
            }
            
            $cat = get_the_category(); 
            $link = get_category_link($cat[0]->cat_ID);
            $current_cat_id = $cat[0]->cat_ID;

            $args = array( 
                'category' => $current_cat_id,
                'posts_per_page'   => -1,
            );
            $posts = get_posts( $args );

            // get IDs of posts retrieved from get_posts
            $ids = array();
            foreach ( $posts as $thepost ) {
                $ids[] = $thepost->ID;
            }
        
            $thisindex = array_search( get_the_ID(), $ids );

            if(($thisindex - 1) < 0)
            {
                $previd = '';
            }else{
                $previd = $ids[ $thisindex - 1 ];
            }
            if( ($thisindex + 1 ) > count($ids)-1)
            {
                $nextid = '';
            }else{
                $nextid = $ids[ $thisindex + 1 ];
            }

            if ( $previd &&  has_post_thumbnail( $previd ) ) {
                $prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previd ), 'hcode-navigation-img' );
                if($prevthumb[0]):
                    $prev_image = $prevthumb[0];
                else:
                    if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                        $prev_image = $image_thumb[0];
                    }else{
                        $prev_image = HCODE_THEME_ASSETS_URI . '/images/no-image-133x83.jpg';
                    }
                endif;
            }else{
                if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                    $prev_image = $image_thumb[0];
                }else{
                    $prev_image = HCODE_THEME_ASSETS_URI . '/images/no-image-133x83.jpg';
                }
            }

            if ( $nextid && has_post_thumbnail( $nextid ) ) {
                $nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $nextid ), 'hcode-navigation-img' );
                if($nextthumb[0]):
                    $next_image = $nextthumb[0];
                else:
                    if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                        $next_image = $image_thumb[0];
                    }else{
                        $next_image = HCODE_THEME_ASSETS_URI . '/images/no-image-133x83.jpg';
                    }
                endif;
            }else{
                if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                    $next_image = $image_thumb[0];
                }else{
                    $next_image = HCODE_THEME_ASSETS_URI . '/images/no-image-133x83.jpg';
                }
            }
            ?>
            <?php
            $related_post_style = hcode_option( 'enable_navigation_style' );    
            
            if( $related_post_style == 'normal' ){ 
            ?>
                <div class="next-previous-project-style2" role="navigation">
                    <!-- next-previous post -->
                    <div class="previous-link">
                        <?php if ( ! empty( $previd) ) {?>
                            
                            <?php echo '<a rel="prev" href="'.get_permalink($previd).'"><i class="fa fa-angle-left"></i>&nbsp;<span>'.__("Previous Post", "H-Code").'</span></a>'; ?>
                            
                        <?php } ?>
                    </div>
                    <div class="back-to-category">
                        <a href="<?php echo $link;?>" class="border-right text-uppercase back-project">
                            <i class="fa fa-th-large"></i>
                        </a>
                    </div>
                    <div class="next-link">
                        <?php if ( ! empty( $nextid ) ) { ?>
                            <?php
                                echo '<a rel="next" href="'.get_permalink($nextid).'"><span>'.__("Next Post", "H-Code").'</span>&nbsp;<i class="fa fa-angle-right"></i></a>';
                            ?>
                        <?php } ?>
                    </div>
                    <!-- end next-previous post -->
                </div>
            <?php }
            elseif($related_post_style == 'modern'){ ?>
                <div class="next-previous-project xs-display-none">
                    <?php if ( ! empty( $nextid ) ) { ?>
                        <div class="next-project">
                        <?php
                            echo '<a rel="next" href="'.get_permalink($nextid).'"><img alt="'.__("Next Project", "H-Code").'" class="next-project-img" src="'.HCODE_THEME_ASSETS_URI.'/images/next-project.png" width="33" height="83"><span>'.esc_html__( 'Next Post','H-Code').'</span><!-- next project image --><img alt="'.__("Next Project", "H-Code").'" src="'.$next_image.'"></a>';
                        ?>
                        </div>
                    <?php } if ( ! empty( $previd) ) {?>
                        <div class="previous-project">
                        <?php echo '<a rel="prev" href="'.get_permalink($previd).'"><img alt="'.__("Previous Project", "H-Code").'" src="'.$prev_image.'"><img alt="'.__("Previous Project", "H-Code").'" class="previous-project-img" src="'.HCODE_THEME_ASSETS_URI.'/images/previous-project.png" width="33" height="83"><span>'.esc_html__( 'Previous Post','H-Code').'</span></a>'; ?>
                        </div>
                    <?php } ?>
                </div>
            <?php }
        }else{ return; }
    }
endif;

/* Portfolio Navigation */
if ( ! function_exists( 'hcode_single_portfolio_navigation' ) ) :

    function hcode_single_portfolio_navigation() {
        // Don't print empty markup if there's nowhere to navigate.
        $hcode_options = get_option( 'hcode_theme_setting' );
        $hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';

        if( isset( $hcode_no_image['url'] ) ) {
            $image_thumb = hcode_get_attachment_id_from_url($hcode_no_image['url'], 'hcode-navigation-img');
        } else {
            $image_thumb = array();
        }

        $link = $cat_name = $next_image = $prev_image = '';

        $terms = get_the_terms( get_the_ID() , 'portfolio-category' );
        
        if( empty($terms) ) {
            return;
        }

        $args = array( 
            'post_type' => 'portfolio',
            'posts_per_page'   => -1,
            'tax_query' => array(
                    array(
                    'taxonomy' => 'portfolio-category',
                    'terms' => array($terms[0]->term_id),
                    'field' => 'term_id',
                    'operator' => 'IN',
                ),
            ),
            'meta_query' => array(
                array(
                    'key'       => 'hcode_link_type_single',
                    'value'     => 'ajax-popup',
                    'compare'   => '!=',
                )
            )
        );
        $posts = get_posts( $args );
        
        $ids = array();
        foreach ( $posts as $thepost ) {
            $ids[] = $thepost->ID;
        }
        //print_r($ids);
        // get and echo previous and next post in the same category
        $thisindex = array_search( get_the_ID(), $ids );
        if(($thisindex - 1) < 0)
        {
            $previd = '';
        }else{
            $previd = $ids[ $thisindex - 1 ];
        }
        if( ($thisindex + 1 ) > count($ids)-1)
        {
            $nextid = '';
        }else{
            $nextid = $ids[ $thisindex + 1 ];
        }

        if( $terms ){
            $link = get_term_link($terms[0]->slug,'portfolio-category');
            $cat_name = get_term_link($terms[0]->name,'portfolio-category');
        }
        if ( $previd &&  has_post_thumbnail( $previd ) ) {
            $prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previd ), 'hcode-navigation-img' );
            if($prevthumb[0]):
                $prev_image = $prevthumb[0];
            else:
                if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                    $prev_image = $image_thumb[0];
                }else{
                    $prev_image = HCODE_THEME_ASSETS_URI . '/images/no-image-133x83.jpg';
                }
            endif;
        }else{
            if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                $prev_image = $image_thumb[0];
            }else{
                $prev_image = HCODE_THEME_ASSETS_URI . '/images/no-image-133x83.jpg';
            }
        }

        if ( $nextid && has_post_thumbnail( $nextid ) ) {
            $nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $nextid ), 'hcode-navigation-img' );
            if($nextthumb[0]):
                $next_image = $nextthumb[0];
            else:
                if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                    $next_image = $image_thumb[0];
                }else{
                    $next_image = HCODE_THEME_ASSETS_URI . '/images/no-image-133x83.jpg';
                }
            endif;
        }else{
            if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                $next_image = $image_thumb[0];
            }else{
                $next_image = HCODE_THEME_ASSETS_URI . '/images/no-image-133x83.jpg';
            }
        }
        ?>
        <?php
        $related_portfolio_style = hcode_option( 'enable_navigation_portfolio_style' );
        if( $related_portfolio_style == 'normal' ){ ?>
            <div class="next-previous-project-style2" role="navigation">
                <!-- next-previous post -->
                <div class="previous-link">
                    <?php if ( ! empty( $previd) ) {?>
                        
                        <?php echo '<a rel="prev" href="'.get_permalink($previd).'"><i class="fa fa-angle-left"></i>&nbsp;<span>'.__("Previous Project", "H-Code").'</span></a>'; ?>
                        
                    <?php } ?>
                </div>
                <div class="back-to-category">
                    <a href="<?php echo $link;?>" class="border-right text-uppercase back-project">
                        <i class="fa fa-th-large"></i>
                    </a>
                </div>
                <div class="next-link">
                    <?php if ( ! empty( $nextid ) ) { ?>
                        <?php
                            echo '<a rel="next" href="'.get_permalink($nextid).'"><span>'.__("Next Project", "H-Code").'</span>&nbsp;<i class="fa fa-angle-right"></i></a>';
                        ?>
                    <?php } ?>
                </div>
                <!-- end next-previous post -->
            </div>
        <?php }
        elseif($related_portfolio_style == 'modern'){ ?>
            <div class="next-previous-project xs-display-none">
                <?php if ( ! empty( $nextid ) ) { ?>
                    <div class="next-project">
                    <?php
                        echo '<a rel="next" href="'.get_permalink($nextid).'"><img alt="'.__("Next Project", "H-Code").'" class="next-project-img" src="'.HCODE_THEME_ASSETS_URI.'/images/next-project.png" width="33" height="83"><span>'.esc_html__( 'Next Project','H-Code').'</span><!-- next project image --><img alt="Next Project" src="'.$next_image.'"></a>';
                    ?>
                    </div>
                <?php } if ( ! empty( $previd) ) {?>
                    <div class="previous-project">
                    <?php echo '<a rel="prev" href="'.get_permalink($previd).'"><img alt="'.__("Previous Project", "H-Code").'" src="'.$prev_image.'"><img alt="Previous Project" class="previous-project-img" src="'.HCODE_THEME_ASSETS_URI.'/images/previous-project.png" width="33" height="83"><span>'.esc_html__( 'Previous Project','H-Code').'</span></a>'; ?>
                    </div>
                <?php } ?>
            </div>
            <?php }?>
        <?php
    }
endif;

/* For Adding Class Into Single Post Pagination*/
if ( ! function_exists( 'hcode_posts_link_next_class' ) ) {
    function hcode_posts_link_next_class($format){
         $format = str_replace('href=', 'class="next" href=', $format);
         return $format;
    }
}
add_filter('next_post_link', 'hcode_posts_link_next_class');

if ( ! function_exists( 'hcode_posts_link_prev_class' ) ) {
    function hcode_posts_link_prev_class($format) {
         $format = str_replace('href=', 'class="previous" href=', $format);
         return $format;
    }
}
add_filter('previous_post_link', 'hcode_posts_link_prev_class');

/* Single blog page related post */
/* Post Navigation */
if ( ! function_exists( 'hcode_single_post_related_posts' ) ) :

    function hcode_single_post_related_posts( $post_type = 'post', $number_posts = '3') {

        global $post;
        $args = $output = $title = '';
        $hcode_options = get_option( 'hcode_theme_setting' ); 
    
        $hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
        
        if( isset( $hcode_no_image['url'] ) ) {
            $image_thumb = hcode_get_attachment_id_from_url($hcode_no_image['url'], 'hcode-related-post');
        } else {
            $image_thumb = array();
        }

        $title = (isset($hcode_options['hcode_related_post_title'])) ? $hcode_options['hcode_related_post_title'] : '';
        $enable_excerpt = (isset($hcode_options['hcode_enable_related_posts_excerpt'])) ? $hcode_options['hcode_enable_related_posts_excerpt'] : '';
        $enable_content = (isset($hcode_options['hcode_enable_related_posts_content'])) ? $hcode_options['hcode_enable_related_posts_content'] : '';
        $enable_title   = (isset($hcode_options['hcode_enable_related_posts_title'])) ? $hcode_options['hcode_enable_related_posts_title'] : '';
        $enable_author  = (isset($hcode_options['hcode_enable_related_posts_author'])) ? $hcode_options['hcode_enable_related_posts_author'] : '';
        $enable_date    = (isset($hcode_options['hcode_enable_related_posts_date'])) ? $hcode_options['hcode_enable_related_posts_date'] : '';
        $date_format    = (isset($hcode_options['hcode_related_posts_date_format'])) ? $hcode_options['hcode_related_posts_date_format'] : '';
        $enable_like    = (isset($hcode_options['hcode_enable_related_posts_like'])) ? $hcode_options['hcode_enable_related_posts_like'] : '';
        $enable_comments= (isset($hcode_options['hcode_enable_related_posts_comments'])) ? $hcode_options['hcode_enable_related_posts_comments'] : '';
        $excerpt_length = (isset($hcode_options['hcode_related_post_excerpt_length'])) ? $hcode_options['hcode_related_post_excerpt_length'] : '';

        $recent_post = new WP_Query();

        if( $number_posts == 0 ) {
            return $recent_post;
        }

        $args = array(
            'category__in'          => wp_get_post_categories( get_the_ID() ),
            'ignore_sticky_posts'   => 0,
            'posts_per_page'        => $number_posts,
            'post__not_in'          => array( get_the_ID() ),
        );

        $recent_post = new WP_Query( $args );
        if ( $recent_post->have_posts() ) {
            $enable_comment = hcode_option('hcode_enable_post_comment');
            if( $enable_comment == 'default' ):
                $hcode_enable_portfolio_comment = (isset($hcode_options['hcode_enable_post_comment'])) ? $hcode_options['hcode_enable_post_comment'] : '';
            else:
                $hcode_enable_portfolio_comment = $enable_comment;
            endif;
            $style_setting = '';
            if($hcode_enable_portfolio_comment == 1):
                $style_setting = 'border-top xs-no-padding-bottom xs-padding-five-top';
            else:
                $style_setting = 'xs-no-margin xs-no-padding';
            endif;
            
            $output .= '<section class="no-padding clear-both"><div class="container"><div class="row">';
            $output .= '<div class="wpb_column hcode-column-container col-md-12 no-padding"><div class="hcode-divider '.$style_setting.' margin-five-top padding-five-bottom"></div></div>';
            $output .= '<div class="col-md-12 col-sm-12 center-col text-center margin-eight no-margin-top xs-padding-ten-top">';
                $output .= '<h3 class="blog-single-full-width-h3">'.$title.'</h3>';
            $output .= '</div>';
            $output .= '<div class="blog-grid-listing padding-ten-bottom col-md-12 col-sm-12 col-xs-12 no-padding">';
            $i=1;
            while ( $recent_post->have_posts() ) {
                // Added in v1.8
                $hcode_post_classes = '';
                ob_start();
                    post_class();
                    $hcode_post_classes .= ob_get_contents();
                ob_end_clean();
                $wow_duration = ($i * 300).'ms';
                $output .= '<div '.$hcode_post_classes.'>';
                    $output .= '<div class="col-md-4 col-sm-4 col-xs-12 blog-listing no-margin-bottom xs-margin-bottom-ten wow fadeInUp animated" data-wow-duration="'.$wow_duration.'" style="visibility: visible; animation-duration: 300ms; animation-name: fadeInUp;">';
                    $recent_post->the_post();

                        $img_alt_post = hcode_option_image_alt(get_post_thumbnail_id());
                        $img_title_post = hcode_option_image_title(get_post_thumbnail_id());
                        $image_alt_post = ( isset($img_alt_post['alt']) && !empty($img_alt_post['alt']) ) ? $img_alt_post['alt'] : '' ; 
                        $image_title_post = ( isset($img_title_post['title']) && !empty($img_title_post['title']) ) ? $img_title_post['title'] : '';

                        $img_attr_post = array(
                                            'title' => $image_title_post,
                                            'alt' => $image_alt_post,
                                        );
                        $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
                        //$post_author = get_post_field( 'post_author', get_the_ID() );
                        //$author = get_the_author_meta( 'user_nicename', $post_author);
                        $author = '<span class="author vcard"><a class="url fn n" href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></span> ';
                        $author = ($author) ? esc_html__('Posted by ','H-Code').$author : '';
                        $blog_quote = hcode_post_meta('hcode_quote');
                        $blog_image = hcode_post_meta('hcode_image');
                        $blog_gallery = hcode_post_meta('hcode_gallery');
                        $blog_video = hcode_post_meta('hcode_video_type');
                        if(!empty($blog_image)){
                            $output .= '<div class="blog-image"><a href="'.get_permalink().'">';
                                    if ( has_post_thumbnail() ) {
                                            $output .= get_the_post_thumbnail(get_the_ID() ,'hcode-related-post',$img_attr_post );
                                    }
                                    else {
                                        if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                                            $output .= '<img src="'.esc_url( $image_thumb[0] ).'" width="374" height="234" alt="'.__( 'No Image', 'H-Code' ).'" />';
                                        }else{
                                            $output .= '<img src="' . HCODE_THEME_ASSETS_URI . '/images/no-image-374x234.jpg" width="374" height="234"  alt="'.__( 'No Image', 'H-Code' ).'" />';
                                        }
                                    }
                            $output .= '</a></div>';
                        }
                        else{
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                            $url = $thumb['0'];
                            $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                            if ( has_post_thumbnail() ) {
                                $output .= get_the_post_thumbnail( get_the_ID(), 'hcode-related-post',$img_attr_post );
                            }
                            else {
                                    if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                                        $output .= '<img src="'.esc_url( $image_thumb[0] ).'" width="374" height="234"  alt="'.__( 'No Image', 'H-Code' ).'"/>';
                                    }else{
                                        $output .= '<img src="' . HCODE_THEME_ASSETS_URI . '/images/no-image-374x234.jpg" width="374" height="234"  alt="'.__( 'No Image', 'H-Code' ).'" />';
                                    }
                            }
                            $output .='</a></div>';
                        }
                        $output .='<div class="blog-details no-padding">';
                            if( $enable_author == 1 || $enable_date == 1 ) :
                                $output .='<div class="blog-date">';
                                    if( $enable_author == 1 ) :
                                        $output .= $author;
                                    endif;
                                    if( $enable_date == 1 ) :
                                        $output .= ( $enable_author == 1 ? ' | ' : '' ).'<span class="published">'.get_the_date( $date_format, get_the_ID()).'</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $date_format ).'</time>';
                                    endif;
                                $output .='</div>';
                            endif;

                            if( $enable_title == 1 ) :
                                $output .='<div class="blog-title entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
                            endif;

                            if( $enable_excerpt == 1 ):
                                $output .='<div class="blog-short-description entry-content">'.hcode_get_the_excerpt_theme($excerpt_length).'</div>';
                            elseif( $enable_content == 1 ):
                                $output .='<div class="blog-short-description entry-content">'.hcode_get_the_post_content().'</div>';
                            endif;
                            $output .='<div class="separator-line bg-black no-margin-lr"></div>';
                        $output .='</div>';
                        $output .= '<div>';
                            
                            if( $enable_like == 1 ):
                                $output .= get_simple_likes_button( get_the_ID() );
                            endif;

                            if( $enable_comments == 1 && ( comments_open() || get_comments_number() ) ) {
                                ob_start();
                                    comments_popup_link( __( '<i class="fa fa-comment-o"></i>Leave a comment', 'H-Code' ), __( '<i class="fa fa-comment-o"></i>1 Comment', 'H-Code' ), __( '<i class="fa fa-comment-o"></i>% Comment(s)', 'H-Code' ), 'comment' );
                                    $output .= ob_get_contents();  
                                ob_end_clean();
                            }
                        $output .= '</div>';
                    $output .=  '</div>';
                $output .=  '</div>';
                $i++;
            }
            wp_reset_postdata();
            $output .=  '</div>';
            $output .= '</div></div></section>';
        echo $output;
        }
    }
endif;

/* Single Portfolio Related Items */
if ( ! function_exists( 'hcode_single_portfolio_related_posts' ) ) :

    function hcode_single_portfolio_related_posts( $post_type = 'portfolio', $number_posts = '3') {
        global $post;
        $args = $output = '';
        $related_post_terms = array();    
        $hcode_options = get_option( 'hcode_theme_setting' ); 
        
        $hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';

        if( isset( $hcode_no_image['url'] ) ) {
            $image_thumb = hcode_get_attachment_id_from_url($hcode_no_image['url'], 'hcode-related-post');
        } else {
            $image_thumb = array();
        }

        $title = (isset($hcode_options['hcode_related_title'])) ? $hcode_options['hcode_related_title'] : '';

        $recent_post = new WP_Query();

        if( $number_posts == 0 ) {
            return $recent_post;
        }
        $terms = get_the_terms( get_the_ID() , 'portfolio-category' );
        if( $terms ):
            foreach ($terms as $key => $value) {
                $related_post_terms[] = $value->term_id;
            }
        endif;
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => $number_posts,        
            'post__not_in' => array( get_the_ID() ),
            'tax_query' => array(
                array(
                'taxonomy' => 'portfolio-category',
                'terms' => $related_post_terms,
                'field' => 'term_id',
                ),
            ),
            'meta_query' => array(
                array(
                    'key'       => 'hcode_link_type_single',
                    'value'     => 'ajax-popup',
                    'compare'   => '!=',
                )
            )
        );

        $recent_post = new WP_Query( $args );
        if ( $recent_post->have_posts() ) {
            $hcode_options = get_option( 'hcode_theme_setting' );
            $enable_comment = hcode_option('hcode_enable_portfolio_comment');
            if( $enable_comment == 'default' ):
                $hcode_enable_portfolio_comment = (isset($hcode_options['hcode_enable_portfolio_comment'])) ? $hcode_options['hcode_enable_portfolio_comment'] : '';
            else:
                $hcode_enable_portfolio_comment = $enable_comment;
            endif;

            $output .= '<div class="wpb_column hcode-column-container col-md-12 no-padding"><div class="hcode-divider border-top sm-padding-five-top xs-padding-five-top padding-five-bottom"></div></div><section class="clear-both no-padding-top"><div class="container"><div class="row">';
            $output .= '<div class="col-md-12 col-sm-12 text-center">';
                $output .= '<h3 class="section-title">'.$title.'</h3>';
            $output .= '</div>';
            $output .='<div class="work-3col gutter work-with-title ipad-3col">';
                $output .='<div class="col-md-12 grid-gallery overflow-hidden content-section">';
                    $output .='<div class="tab-content">';
                        $output .='<ul class="grid masonry-items">';
                    while ( $recent_post->have_posts() ) : $recent_post->the_post();
                    // Added in v1.8
                    $hcode_post_classes = '';
                    $hcode_post_class_list = array();
                    $hcode_post_class_list[] = 'portfolio-id-'.get_the_ID().'';
                    ob_start();
                        post_class( $hcode_post_class_list );
                        $hcode_post_classes .= ob_get_contents();
                    ob_end_clean();
                    /* Image Alt, Title, Caption */
                    $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
                    $img_title = hcode_option_image_title(get_post_thumbnail_id());
                    $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
                    $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

                        $output .='<li '.$hcode_post_classes.'>';
                            $output .='<figure>';
                                $portfolio_image = hcode_post_meta('hcode_image');
                                $portfolio_gallery = hcode_post_meta('hcode_gallery');
                                $portfolio_link = hcode_post_meta('hcode_link_type');
                                $portfolio_video = hcode_post_meta('hcode_video');
                                $portfolio_subtitle = hcode_post_meta('hcode_subtitle');

                                if(!empty($portfolio_image)){
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'hcode-related-post' );
                                    $url = $thumb['0'];
                                    if($url):
                                        $output .= '<div class="gallery-img">';
                                            $output .= '<a href="'.get_permalink().'">';
                                                $output .= '<img src="' . $url . '" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'/>';
                                            $output .= '</a>';
                                        $output .= '</div>';
                                    else : 
                                        $output .= '<div class="gallery-img">';
                                            $output .= '<a href="'.get_permalink().'">';
                                            if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                                                $output .= '<img src="'.esc_url( $image_thumb[0] ).'" width="374" height="234" alt="'.__( 'No Image', 'H-Code' ).'" />';
                                            }else{
                                                $output .= '<img src="' . HCODE_THEME_ASSETS_URI . '/images/no-image-374x234.jpg" width="374" height="234" alt="'.__( 'No Image', 'H-Code' ).'" />';
                                            }
                                            $output .= '</a>';
                                        $output .= '</div>';
                                    endif; 
                                }else{
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'hcode-related-post' );
                                    $url = $thumb['0'];
                                    $output .= '<div class="gallery-img">';
                                        $output .= '<a href="'.get_permalink().'">';
                                            if ( $url ) {
                                                $output .= '<img src="' . $url . '" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'/>';
                                            }
                                            else {
                                                if( isset( $image_thumb[0] ) && esc_url( $image_thumb[0] ) ){
                                                    $output .= '<img src="'.esc_url( $image_thumb[0] ).'" width="374" height="234" alt="'.__( 'No Image', 'H-Code' ).'" />';
                                                }else{
                                                    $output .= '<img src="' . HCODE_THEME_ASSETS_URI . '/images/no-image-374x234.jpg" width="374" height="234" alt="'.__( 'No Image', 'H-Code' ).'" />';
                                                }                                                
                                            }
                                        $output .= '</a>';
                                    $output .= '</div>';
                                }
                                $output .= '<figcaption>';
                                    $output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                    $output .= '<p>'.$portfolio_subtitle.'</p>';
                                $output .= '</figcaption>';
                            $output .='</figure>';
                        $output .='</li>';
                    endwhile;
                    wp_reset_postdata();
                        $output .='</ul>';
                    $output .='</div>';
                $output .='</div>';
            $output .='</div>';
            $output .= '</div></div></section>';
        echo $output;
        }
    }
endif;

if ( ! function_exists( 'hcode_posts_customize' ) ) {
    function hcode_posts_customize($query) {
        $hcode_options = get_option( 'hcode_theme_setting' );
        if( !is_admin() && $query->is_main_query()):
            if( class_exists( 'WooCommerce' ) && ( is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || $query->is_post_type_archive('product') ) ){
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = ''; }
                $hcode_item_per_page = (isset($hcode_options['hcode_category_product_per_page'])) ? $hcode_options['hcode_category_product_per_page'] : '';
                $query->set('posts_per_page', $hcode_item_per_page);
                $query->set('paged', $paged);
            } elseif(is_tax('portfolio-category') || is_post_type_archive('portfolio')) {
                $hcode_item_per_page = (isset($hcode_options['hcode_portfolio_cat_item_per_page'])) ? $hcode_options['hcode_portfolio_cat_item_per_page'] : '';
                $query->set('posts_per_page', $hcode_item_per_page);
            } elseif ((is_category() || is_archive() || is_author() || is_tag())) {
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; }
                $hcode_item_per_page = (isset($hcode_options['hcode_general_item_per_page'])) ? $hcode_options['hcode_general_item_per_page'] : '';
                $query->set('posts_per_page', $hcode_item_per_page);
                $query->set('paged', $paged);
            } elseif(is_search()) {
                $search_content = array();
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; }
                $hcode_item_per_page = (isset($hcode_options['hcode_general_item_per_page'])) ? $hcode_options['hcode_general_item_per_page'] : '';
                $query->set('posts_per_page', $hcode_item_per_page);
                $query->set('paged', $paged);
                $search_content = (isset($hcode_options['hcode_general_search_content_settings'])) ? $hcode_options['hcode_general_search_content_settings'] : '';

                (in_array("only-page", $search_content)) ? $search_content[] = 'page': '';
                (in_array("only-post", $search_content)) ? $search_content[] = 'post': '';
                (in_array("only-product", $search_content)) ? $search_content[] = 'product': '';
                (in_array("only-portfolio", $search_content)) ? $search_content[] = 'portfolio': '';
                
                if( !empty($search_content)){
                    $query->set('post_type', array('post', 'page', 'rebsorte', 'partnerwinzer'));
                }
            }elseif( is_home() ){
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
                $hcode_item_per_page = (isset($hcode_options['hcode_blog_page_item_per_page'])) ? $hcode_options['hcode_blog_page_item_per_page'] : '';
                $query->set('posts_per_page', $hcode_item_per_page);
                $query->set('paged', $paged);
            }

        endif;
    }
}
add_action('pre_get_posts', 'hcode_posts_customize');

if ( ! function_exists( 'hcode_get_the_excerpt_theme' ) ) {
    function hcode_get_the_excerpt_theme($length)
    {
        return hcode_Excerpt::hcode_get_by_length($length);
    }
}

if ( ! function_exists( 'hcode_get_the_post_content' ) ) {
    function hcode_get_the_post_content()
    {
        return apply_filters( 'the_content', get_the_content() );
    }
}

if ( ! function_exists( 'hcode_widgets' ) ) {
    function hcode_widgets() {
        $custom_sidebars = hcode_option('sidebar_creation');
        if (is_array($custom_sidebars)) {
            foreach ($custom_sidebars as $sidebar) {

                if (empty($sidebar)) {
                    continue;
                }

                register_sidebar ( array (
                    'name' => $sidebar,
                    'id' => sanitize_title ( $sidebar ),
                    'before_widget' => '<div id="%1$s" class="custom-widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title'  => '<h5 class="sidebar-title">',
                    'after_title'   => '</h5>',
                ) );
            }
        }
    }
}
add_action( 'widgets_init', 'hcode_widgets' );

/* For contact Form 7 select default */
if ( ! function_exists( 'hcode_wpcf7_form_elements' ) ) {
    function hcode_wpcf7_form_elements($html) {
        $text = __("Select Position", "H-Code");
        $html = str_replace('---', '' . $text . '', $html);
        return $html;
    }
}
add_filter('wpcf7_form_elements', 'hcode_wpcf7_form_elements');

/* For Wordpress4.4 move comment textarea bottom */
if ( ! function_exists( 'hcode_move_comment_field_to_bottom' ) ) {
    function hcode_move_comment_field_to_bottom( $fields ) {
        $comment_field = $fields['comment'];
        unset( $fields['comment'] );
        $fields['comment'] = $comment_field;
        return $fields;
    }
}
add_filter( 'comment_form_fields', 'hcode_move_comment_field_to_bottom' );

if ( ! function_exists( 'hcode_get_sidebar' ) ) {
    function hcode_get_sidebar($sidebar_name="0"){
        if($sidebar_name != "0"){
            dynamic_sidebar($sidebar_name);
        }else{
            dynamic_sidebar('hcode-sidebar-1');
        }
    }
}

/* Hook For ajax page */
if ( ! function_exists( 'hcode_hook_for_ajax_page' ) ) {
    function hcode_hook_for_ajax_page() {
        
        $output="<script>
        ( function( $ ) {
        'use strict';
            $(document).ready(function () {
                $('.owl-pagination > .owl-page').click(function (e) {
                    if ($(e.target).is('.mfp-close'))
                        return;
                    return false;
                });
                $('.owl-buttons > .owl-prev').click(function (e) {
                    if ($(e.target).is('.mfp-close'))
                        return;
                    return false;
                });
                $('.owl-buttons > .owl-next').click(function (e) {
                    if ($(e.target).is('.mfp-close'))
                        return;
                    return false;
                });

                $('.masonry-items').imagesLoaded(function () {
                    $('.masonry-items').isotope({
                        itemSelector: 'li',
                        layoutMode: 'masonry'
                    });
                });
                SetResizeContent();
            });

            function SetResizeContent() {
                var minheight = $(window).height();
                $('.full-screen').css('min-height', minheight);
            }
        })( jQuery );
        </script>";

        echo $output;
    }
}

/* If Font Icon Not Available add from here */
if( !function_exists('hcode_get_font_awesome_icon')) {
  function hcode_get_font_awesome_icon() {
    $fa_icons = array('fa-500px','fa-adjust','fa-adn','fa-align-center','fa-align-justify','fa-align-left','fa-align-right','fa-amazon','fa-ambulance','fa-american-sign-language-interpreting','fa-anchor','fa-android','fa-angellist','fa-angle-double-down','fa-angle-double-left','fa-angle-double-right','fa-angle-double-up','fa-angle-down','fa-angle-left','fa-angle-right','fa-angle-up','fa-apple','fa-archive','fa-area-chart','fa-arrow-circle-down','fa-arrow-circle-left','fa-arrow-circle-o-down','fa-arrow-circle-o-left','fa-arrow-circle-o-right','fa-arrow-circle-o-up','fa-arrow-circle-right','fa-arrow-circle-up','fa-arrow-down','fa-arrow-left','fa-arrow-right','fa-arrow-up','fa-arrows','fa-arrows-alt','fa-arrows-h','fa-arrows-v','fa-asl-interpreting','fa-assistive-listening-systems','fa-asterisk','fa-at','fa-audio-description','fa-automobile','fa-backward','fa-balance-scale','fa-ban','fa-bank','fa-bar-chart','fa-bar-chart-o','fa-barcode','fa-bars','fa-battery-0','fa-battery-1','fa-battery-2','fa-battery-3','fa-battery-4','fa-battery-empty','fa-battery-full','fa-battery-quarter','fa-battery-three-quarters','fa-bed','fa-beer','fa-behance','fa-behance-square','fa-bell','fa-bell-o','fa-bell-slash','fa-bell-slash-o','fa-bicycle','fa-binoculars','fa-birthday-cake','fa-bitbucket','fa-bitbucket-square','fa-bitcoin','fa-black-tie','fa-blind','fa-bluetooth','fa-bluetooth-b','fa-bold','fa-bolt','fa-bomb','fa-book','fa-bookmark','fa-bookmark-o','fa-braille','fa-briefcase','fa-btc','fa-bug','fa-building','fa-building-o','fa-bullhorn','fa-bullseye','fa-bus','fa-buysellads','fa-cab','fa-calculator','fa-calendar','fa-calendar-check-o','fa-calendar-minus-o','fa-calendar-o','fa-calendar-plus-o','fa-calendar-times-o','fa-camera','fa-camera-retro','fa-car','fa-caret-down','fa-caret-left','fa-caret-right','fa-caret-square-o-down','fa-caret-square-o-left','fa-caret-square-o-right','fa-caret-square-o-up','fa-caret-up','fa-cart-arrow-down','fa-cart-plus','fa-cc','fa-cc-amex','fa-cc-diners-club','fa-cc-discover','fa-cc-jcb','fa-cc-mastercard','fa-cc-paypal','fa-cc-stripe','fa-cc-visa','fa-certificate','fa-chain','fa-chain-broken','fa-check','fa-check-circle','fa-check-circle-o','fa-check-square','fa-check-square-o','fa-chevron-circle-down','fa-chevron-circle-left','fa-chevron-circle-right','fa-chevron-circle-up','fa-chevron-down','fa-chevron-left','fa-chevron-right','fa-chevron-up','fa-child','fa-chrome','fa-circle','fa-circle-o','fa-circle-o-notch','fa-circle-thin','fa-clipboard','fa-clock-o','fa-clone','fa-close','fa-cloud','fa-cloud-download','fa-cloud-upload','fa-cny','fa-code','fa-code-fork','fa-codepen','fa-codiepie','fa-coffee','fa-cog','fa-cogs','fa-columns','fa-comment','fa-comment-o','fa-commenting','fa-commenting-o','fa-comments','fa-comments-o','fa-compass','fa-compress','fa-connectdevelop','fa-contao','fa-copy','fa-copyright','fa-creative-commons','fa-credit-card','fa-credit-card-alt','fa-crop','fa-crosshairs','fa-css3','fa-cube','fa-cubes','fa-cut','fa-cutlery','fa-dashboard','fa-dashcube','fa-database','fa-deaf','fa-deafness','fa-dedent','fa-delicious','fa-desktop','fa-deviantart','fa-diamond','fa-digg','fa-dollar','fa-dot-circle-o','fa-download','fa-dribbble','fa-dropbox','fa-drupal','fa-edge','fa-edit','fa-eject','fa-ellipsis-h','fa-ellipsis-v','fa-empire','fa-envelope','fa-envelope-o','fa-envelope-square','fa-envira','fa-eraser','fa-eur','fa-euro','fa-exchange','fa-exclamation','fa-exclamation-circle','fa-exclamation-triangle','fa-expand','fa-expeditedssl','fa-external-link','fa-external-link-square','fa-eye','fa-eye-slash','fa-eyedropper','fa-fa','fa-facebook','fa-facebook-f','fa-facebook-official','fa-facebook-square','fa-fast-backward','fa-fast-forward','fa-fax','fa-feed','fa-female','fa-fighter-jet','fa-file','fa-file-archive-o','fa-file-audio-o','fa-file-code-o','fa-file-excel-o','fa-file-image-o','fa-file-movie-o','fa-file-o','fa-file-pdf-o','fa-file-photo-o','fa-file-picture-o','fa-file-powerpoint-o','fa-file-sound-o','fa-file-text','fa-file-text-o','fa-file-video-o','fa-file-word-o','fa-file-zip-o','fa-files-o','fa-film','fa-filter','fa-fire','fa-fire-extinguisher','fa-firefox','fa-first-order','fa-flag','fa-flag-checkered','fa-flag-o','fa-flash','fa-flask','fa-flickr','fa-floppy-o','fa-folder','fa-folder-o','fa-folder-open','fa-folder-open-o','fa-font','fa-font-awesome','fa-fonticons','fa-fort-awesome','fa-forumbee','fa-forward','fa-foursquare','fa-frown-o','fa-futbol-o','fa-gamepad','fa-gavel','fa-gbp','fa-ge','fa-gear','fa-gears','fa-genderless','fa-get-pocket','fa-gg','fa-gg-circle','fa-gift','fa-git','fa-git-square','fa-github','fa-github-alt','fa-github-square','fa-gitlab','fa-gittip','fa-glass','fa-glide','fa-glide-g','fa-globe','fa-google','fa-google-plus','fa-google-plus-circle','fa-google-plus-official','fa-google-plus-square','fa-google-wallet','fa-graduation-cap','fa-gratipay','fa-group','fa-h-square','fa-hacker-news','fa-hand-grab-o','fa-hand-lizard-o','fa-hand-o-down','fa-hand-o-left','fa-hand-o-right','fa-hand-o-up','fa-hand-paper-o','fa-hand-peace-o','fa-hand-pointer-o','fa-hand-rock-o','fa-hand-scissors-o','fa-hand-spock-o','fa-hand-stop-o','fa-hard-of-hearing','fa-hashtag','fa-hdd-o','fa-header','fa-headphones','fa-heart','fa-heart-o','fa-heartbeat','fa-history','fa-home','fa-hospital-o','fa-hotel','fa-hourglass','fa-hourglass-1','fa-hourglass-2','fa-hourglass-3','fa-hourglass-end','fa-hourglass-half','fa-hourglass-o','fa-hourglass-start','fa-houzz','fa-html5','fa-i-cursor','fa-ils','fa-image','fa-inbox','fa-indent','fa-industry','fa-info','fa-info-circle','fa-inr','fa-instagram','fa-institution','fa-internet-explorer','fa-intersex','fa-ioxhost','fa-italic','fa-joomla','fa-jpy','fa-jsfiddle','fa-key','fa-keyboard-o','fa-krw','fa-language','fa-laptop','fa-lastfm','fa-lastfm-square','fa-leaf','fa-leanpub','fa-legal','fa-lemon-o','fa-level-down','fa-level-up','fa-life-bouy','fa-life-buoy','fa-life-ring','fa-life-saver','fa-lightbulb-o','fa-line-chart','fa-link','fa-linkedin','fa-linkedin-square','fa-linux','fa-list','fa-list-alt','fa-list-ol','fa-list-ul','fa-location-arrow','fa-lock','fa-long-arrow-down','fa-long-arrow-left','fa-long-arrow-right','fa-long-arrow-up','fa-low-vision','fa-magic','fa-magnet','fa-mail-forward','fa-mail-reply','fa-mail-reply-all','fa-male','fa-map','fa-map-marker','fa-map-o','fa-map-pin','fa-map-signs','fa-mars','fa-mars-double','fa-mars-stroke','fa-mars-stroke-h','fa-mars-stroke-v','fa-maxcdn','fa-meanpath','fa-medium','fa-medkit','fa-meh-o','fa-mercury','fa-microphone','fa-microphone-slash','fa-minus','fa-minus-circle','fa-minus-square','fa-minus-square-o','fa-mixcloud','fa-mobile','fa-mobile-phone','fa-modx','fa-money','fa-moon-o','fa-mortar-board','fa-motorcycle','fa-mouse-pointer','fa-music','fa-navicon','fa-neuter','fa-newspaper-o','fa-object-group','fa-object-ungroup','fa-odnoklassniki','fa-odnoklassniki-square','fa-opencart','fa-openid','fa-opera','fa-optin-monster','fa-outdent','fa-pagelines','fa-paint-brush','fa-paper-plane','fa-paper-plane-o','fa-paperclip','fa-paragraph','fa-paste','fa-pause','fa-pause-circle','fa-pause-circle-o','fa-paw','fa-paypal','fa-pencil','fa-pencil-square','fa-pencil-square-o','fa-percent','fa-phone','fa-phone-square','fa-photo','fa-picture-o','fa-pie-chart','fa-pied-piper','fa-pied-piper-alt','fa-pied-piper-pp','fa-pinterest','fa-pinterest-p','fa-pinterest-square','fa-plane','fa-play','fa-play-circle','fa-play-circle-o','fa-plug','fa-plus','fa-plus-circle','fa-plus-square','fa-plus-square-o','fa-power-off','fa-print','fa-product-hunt','fa-puzzle-piece','fa-qq','fa-qrcode','fa-question','fa-question-circle','fa-question-circle-o','fa-quote-left','fa-quote-right','fa-ra','fa-random','fa-rebel','fa-recycle','fa-reddit','fa-reddit-alien','fa-reddit-square','fa-refresh','fa-registered','fa-remove','fa-renren','fa-reorder','fa-repeat','fa-reply','fa-reply-all','fa-resistance','fa-retweet','fa-rmb','fa-road','fa-rocket','fa-rotate-left','fa-rotate-right','fa-rouble','fa-rss','fa-rss-square','fa-rub','fa-ruble','fa-rupee','fa-safari','fa-save','fa-scissors','fa-scribd','fa-search','fa-search-minus','fa-search-plus','fa-sellsy','fa-send','fa-send-o','fa-server','fa-share','fa-share-alt','fa-share-alt-square','fa-share-square','fa-share-square-o','fa-shekel','fa-sheqel','fa-shield','fa-ship','fa-shirtsinbulk','fa-shopping-bag','fa-shopping-basket','fa-shopping-cart','fa-sign-in','fa-sign-language','fa-sign-out','fa-signal','fa-signing','fa-simplybuilt','fa-sitemap','fa-skyatlas','fa-skype','fa-slack','fa-sliders','fa-slideshare','fa-smile-o','fa-snapchat','fa-snapchat-ghost','fa-snapchat-square','fa-soccer-ball-o','fa-sort','fa-sort-alpha-asc','fa-sort-alpha-desc','fa-sort-amount-asc','fa-sort-amount-desc','fa-sort-asc','fa-sort-desc','fa-sort-down','fa-sort-numeric-asc','fa-sort-numeric-desc','fa-sort-up','fa-soundcloud','fa-space-shuttle','fa-spinner','fa-spoon','fa-spotify','fa-square','fa-square-o','fa-stack-exchange','fa-stack-overflow','fa-star','fa-star-half','fa-star-half-empty','fa-star-half-full','fa-star-half-o','fa-star-o','fa-steam','fa-steam-square','fa-step-backward','fa-step-forward','fa-stethoscope','fa-sticky-note','fa-sticky-note-o','fa-stop','fa-stop-circle','fa-stop-circle-o','fa-street-view','fa-strikethrough','fa-stumbleupon','fa-stumbleupon-circle','fa-subscript','fa-subway','fa-suitcase','fa-sun-o','fa-superscript','fa-support','fa-table','fa-tablet','fa-tachometer','fa-tag','fa-tags','fa-tasks','fa-taxi','fa-television','fa-tencent-weibo','fa-terminal','fa-text-height','fa-text-width','fa-th','fa-th-large','fa-th-list','fa-themeisle','fa-thumb-tack','fa-thumbs-down','fa-thumbs-o-down','fa-thumbs-o-up','fa-thumbs-up','fa-ticket','fa-times','fa-times-circle','fa-times-circle-o','fa-tint','fa-toggle-down','fa-toggle-left','fa-toggle-off','fa-toggle-on','fa-toggle-right','fa-toggle-up','fa-trademark','fa-train','fa-transgender','fa-transgender-alt','fa-trash','fa-trash-o','fa-tree','fa-trello','fa-tripadvisor','fa-trophy','fa-truck','fa-try','fa-tty','fa-tumblr','fa-tumblr-square','fa-turkish-lira','fa-tv','fa-twitch','fa-twitter','fa-twitter-square','fa-umbrella','fa-underline','fa-undo','fa-universal-access','fa-university','fa-unlink','fa-unlock','fa-unlock-alt','fa-unsorted','fa-upload','fa-usb','fa-usd','fa-user','fa-user-md','fa-user-plus','fa-user-secret','fa-user-times','fa-users','fa-venus','fa-venus-double','fa-venus-mars','fa-viacoin','fa-viadeo','fa-viadeo-square','fa-video-camera','fa-vimeo','fa-vimeo-square','fa-vine','fa-vk','fa-volume-control-phone','fa-volume-down','fa-volume-off','fa-volume-up','fa-warning','fa-wechat','fa-weibo','fa-weixin','fa-whatsapp','fa-wheelchair','fa-wheelchair-alt','fa-wifi','fa-wikipedia-w','fa-windows','fa-won','fa-wordpress','fa-wpbeginner','fa-wpforms','fa-wrench','fa-xing','fa-xing-square','fa-y-combinator','fa-y-combinator-square','fa-yahoo','fa-yc','fa-yc-square','fa-yelp','fa-yen','fa-yoast','fa-youtube','fa-youtube-play','fa-youtube-square');
    return $fa_icons;
  }
}

// Remove Empty P tag

if( ! function_exists( 'hcode_remove_wpautop' ) ) {
  function hcode_remove_wpautop( $content, $force_br = true ) {
    if ( $force_br ) {
      $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }
    return do_shortcode( shortcode_unautop( $content ) );
  }
}

// Post Meta
if ( ! function_exists( 'hcode_single_post_meta' ) ) :

    function hcode_single_post_meta() {

        $hcode_single_enable_author     = hcode_option('hcode_single_enable_author');
        $hcode_single_enable_date       = hcode_option('hcode_single_enable_date');
        $hcode_single_date_format       = hcode_option('hcode_single_date_format');
        $hcode_single_enable_category   = hcode_option('hcode_single_enable_category');

        $posted_by = array();
        if ( ( 'post' == get_post_type() && $hcode_single_enable_author ) || 'portfolio' == get_post_type() ) {
            if ( is_singular() || is_multi_author() ) {
                $posted_by[] = sprintf( '%1$s <span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span>',
                    esc_html__( 'Posted by ', 'H-Code' ),
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    get_the_author()
                );
            }
        }
        if ( in_array( get_post_type(), array( 'post', 'attachment', 'portfolio' ) ) && $hcode_single_enable_date ) {
            $time_string = '%2$s';

            $time_string = sprintf( $time_string,
                esc_attr( get_the_date( 'c' ) ),
                get_the_date( $hcode_single_date_format ),
                esc_attr( get_the_modified_date( 'c' ) ),
                get_the_modified_date( $hcode_single_date_format )
            );

            $posted_by[] = sprintf( '<span class="published">%1$s</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_single_date_format ).'</time>',
                $time_string
            );
        }
        if ( 'post' == get_post_type() && $hcode_single_enable_category ) {
            
            $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'H-Code' ) );
            if ( $categories_list && hcode_categorized_blog() ) {
                $posted_by[] = sprintf( '%1$s',
                    $categories_list
                );
            }
        }

        if( !empty( $posted_by ) ) {
            echo implode(' | ', $posted_by);
        }


    }
endif;

// single portfolio meta

if ( ! function_exists( 'hcode_single_portfolio_meta' ) ) :

    function hcode_single_portfolio_meta() {
    $output = '';
    ob_start();
    $hcode_enable_meta_author_portfolio = hcode_option('hcode_enable_meta_author_portfolio');
    $hcode_enable_meta_date_portfolio = hcode_option('hcode_enable_meta_date_portfolio');
    $hcode_portfolio_date_format = hcode_option('hcode_portfolio_date_format');
    $hcode_enable_meta_category_portfolio = hcode_option('hcode_enable_meta_category_portfolio');
        if ( 'portfolio' == get_post_type() ) {
            if ( (is_singular() || is_multi_author()) && $hcode_enable_meta_author_portfolio == 1 ) {
                printf( '%1$s <span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span>',
                    _x( 'Created by', 'Used before post author name.', 'H-Code' ),
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    get_the_author()
                );
            }
        }
        if ( in_array( get_post_type(), array( 'portfolio' ) ) ) {
            $time_string = '%2$s';

            $time_string = sprintf( $time_string,
                esc_attr( get_the_date( 'c' ) ),
                get_the_date( $hcode_portfolio_date_format ),
                esc_attr( get_the_modified_date( 'c' ) ),
                get_the_modified_date( $hcode_portfolio_date_format )
            );
            if( $hcode_enable_meta_date_portfolio == 1){
                if($hcode_enable_meta_author_portfolio == 1){
                    printf( ' | <span class="published">%1$s</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_portfolio_date_format ).'</time>',
                        $time_string
                    );
                }else{
                    printf( ' <span class="published">%1$s</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_portfolio_date_format ).'</time>',
                        $time_string
                    );
                }
            }
        }

        if ( 'portfolio' == get_post_type() ) {
            $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
            $item = 1;
            $cat_slug = '';
            if(!empty($cat)):
                foreach ($cat as $key => $c) {
                    if( count($cat) == $item){
                        $cat_slug .= '<a href="' . get_term_link( $c ) . '" title="' . sprintf( esc_html__( 'View all post filed under %s', 'H-Code' ), $c->name ) . '" rel="category tag">' . $c->name . '</a>';
                    }else{
                        $cat_slug .= '<a href="' . get_term_link( $c ) . '" title="' . sprintf( esc_html__( 'View all post filed under %s', 'H-Code' ), $c->name ) . '" rel="category tag">' . $c->name . '</a>, ';
                    }
                    $item++;
                }
            endif;
            if($cat_slug && $hcode_enable_meta_category_portfolio == 1){
                if( $hcode_enable_meta_author_portfolio == 1 || $hcode_enable_meta_date_portfolio == 1 ){
                    echo ' | '.$cat_slug;
                }else{
                    echo $cat_slug;
                }
            }
        }
    $output = ob_get_contents();  
    ob_end_clean(); 
    return $output;
    }
endif;

// Blog Full Width Header Meta

if ( ! function_exists( 'hcode_full_width_single_post_meta' ) ) :

function hcode_full_width_single_post_meta() {

    $hcode_single_enable_author     = hcode_option('hcode_single_enable_author');
    $hcode_single_enable_date       = hcode_option('hcode_single_enable_date');
    $hcode_single_date_format       = hcode_option('hcode_single_date_format');
    $hcode_single_enable_category   = hcode_option('hcode_single_enable_category');

    if ( 'post' == get_post_type() && $hcode_single_enable_author ) {
        if ( is_singular() || is_multi_author() ) {
            printf( '<div class="posted-by text-uppercase full-width-header-post-meta">%1$s <span class="author vcard"><a class="url fn n white-text" href="%2$s">%3$s</a></span></div>',
                esc_html__( 'Posted by ', 'H-Code' ),
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_the_author()
            );
        }
    }
    printf('<div class="full-blog-date text-uppercase full-width-header-post-meta">');
        if( $hcode_single_enable_date ) {
            if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
                $time_string = '%2$s';

                $time_string = sprintf( $time_string,
                    esc_attr( get_the_date( 'c' ) ),
                    get_the_date($hcode_single_date_format)
                );

                printf( ' <span class="published">%s</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_single_date_format ).'</time>',
                    $time_string
                );
            }
        }
        
        if( $hcode_single_enable_date && $hcode_single_enable_category ) {
            echo ' | ';
        }

        if( $hcode_single_enable_category ) {
            if ( 'post' == get_post_type() ) {
                
                $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'H-Code' ) );
                if ( $categories_list && hcode_categorized_blog() ) {
                    printf( '%1$s',
                        $categories_list
                    );
                }
            }
        }
    printf('</div>');  
    if ( is_attachment() && wp_attachment_is_image() ) {
        // Retrieve attachment metadata.
        $metadata = wp_get_attachment_metadata();

        printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
            _x( 'Full size', 'Used before full size attachment link.', 'H-Code' ),
            esc_url( wp_get_attachment_url() ),
            $metadata['width'],
            $metadata['height']
        );
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link( esc_html__( 'Leave a comment', 'H-Code' ), esc_html__( '1 Comment', 'H-Code' ), esc_html__( '% Comments', 'H-Code' ) );
        echo '</span>';
    }
}
endif;

if ( ! function_exists( 'hcode_categorized_blog' ) ) :
    function hcode_categorized_blog() {
        if ( false === ( $all_the_cool_cats = get_transient( 'hcode_categories' ) ) ) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories( array(
                'fields'     => 'ids',
                'hide_empty' => 1,

                // We only need to know if there is more than one category.
                'number'     => 2,
            ) );

            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count( $all_the_cool_cats );

            set_transient( 'hcode_categories', $all_the_cool_cats );
        }

        if ( $all_the_cool_cats > 1 ) {
            // This blog has more than 1 category so hcode_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so hcode_categorized_blog should return false.
            return false;
        }
    }
endif;

if ( ! function_exists( 'hcode_category_transient_flusher' ) ) :
    function hcode_category_transient_flusher() {
        delete_transient( 'hcode_categories' );
    }
endif;
add_action( 'edit_category', 'hcode_category_transient_flusher' );
add_action( 'save_post',     'hcode_category_transient_flusher' );

// Get the Post Tags

if ( ! function_exists( 'hcode_single_post_meta_tag' ) ) :

    function hcode_single_post_meta_tag() {
    if ( 'post' == get_post_type() ) {

            $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'H-Code' ) );
            if ( $tags_list ) {
                printf( '%1$s %2$s',
                    _x( '<h5 class="widget-title margin-one no-margin-top">Tags</h5>', 'Used before tag names.', 'H-Code' ),
                    $tags_list
                );
            }
        }
    }
endif;

// To Get Portfolio Tags

if ( ! function_exists( 'hcode_single_portfolio_meta_tag' ) ) :

    function hcode_single_portfolio_meta_tag() {
    if ( 'portfolio' == get_post_type() ) {

            global $post;
            $portfolio_tag_list = get_the_term_list($post->ID, 'portfolio-tags', '<h5 class="widget-title margin-one no-margin-top">Tags</h5>', ', ', '');
            if($portfolio_tag_list):
                echo '<div class="blog-date float-left width-100 no-padding-top margin-eight no-margin-bottom">';
                echo get_the_term_list($post->ID, 'portfolio-tags', '<h5 class="widget-title margin-one no-margin-top">Tags</h5>', ', ', '');
                echo '</div>';
            endif;
        }
    }
endif;

if ( ! function_exists( 'hcode_login_logo' ) ) :
// To Change Admin Panel Logo.
    function hcode_login_logo() { 
        $admin_logo = hcode_option('hcode_header_logo');
        if( $admin_logo['url'] ):
        ?>
        <style type="text/css">
            .login h1 a {
                background-image: url(<?php echo $admin_logo['url'];?>  ) !important;
                background-size: contain !important;
                height: 48px !important;
                width: 100% !important;
            }
        </style>
        <?php 
        endif;
    }
endif;
add_action( 'login_enqueue_scripts', 'hcode_login_logo' );

// To Change Admin Panel Logo Url.
if ( ! function_exists( 'hcode_login_logo_url' ) ) :
    function hcode_login_logo_url() {
        return home_url();
    }
endif;
add_filter( 'login_headerurl', 'hcode_login_logo_url' );

// To Change Admin Panel Logo Title.
if ( ! function_exists( 'hcode_login_logo_url_title' ) ) :
    function hcode_login_logo_url_title() {
        $text = get_bloginfo('name').' | '.get_bloginfo('description');
        return $text;
    }
endif;
add_filter( 'login_headertitle', 'hcode_login_logo_url_title' );

// To remove deprecated notice for old functions
add_filter('deprecated_constructor_trigger_error', '__return_false');

// For Title Tag
if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function hcode_theme_slug_render_title() {
    ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
    }
    add_action( 'wp_head', 'hcode_theme_slug_render_title' );
}

if ( ! function_exists( 'hcode_registered_sidebars_array' ) ) :
function hcode_registered_sidebars_array() {
    global $wp_registered_sidebars;
    if( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ){ 
        $sidebar_array = array();
        $sidebar_array['default'] = 'Default';
        foreach( $wp_registered_sidebars as $sidebar ){
            $sidebar_array[$sidebar['id']] = $sidebar['name'];
        }
    }
    return $sidebar_array;
}
endif;

// Check if Hcode-addons Plugin active or not.
if(!class_exists('Hcode_Addons_Post_Type')){
    if ( ! function_exists( 'get_simple_likes_button' ) ) :
        function get_simple_likes_button( $id ) {
            return;
        }
    endif;
}

// Remove VC redirection
if(class_exists('Vc_Manager')){
    remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect');
    remove_action( 'admin_init', 'vc_page_welcome_redirect');
}

// Post excerpt
// add_filter('the_content', 'hcode_trim_excerpts');
// if ( ! function_exists( 'hcode_trim_excerpts' ) ) {
//     function hcode_trim_excerpts($content = false) {
//         global $post;
//         if(!is_singular()){
//             $content = $post->post_excerpt;
//             // If an excerpt is set in the Optional Excerpt box
//             if($content) :
//                 $content = apply_filters('the_excerpt', $content);

//             // If no excerpt is set
//             else :
//                 $content = $post->post_content;
//             endif;
//         }
//         $content = str_replace("|br|", "<br>", $content );
//         // Make sure to return the content
//         return $content;
//     }
// }

// Customize wp password form
if ( ! function_exists( 'hcode_password_form' ) ) {
    function hcode_password_form() {
        global $post;
        $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
        $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
        ' . esc_html__( "This content is password protected. To view it please enter your password below:", "H-Code" ) . '
                <div class="form-row form-row-wide col-sm-12 no-padding padding-three-top">
                    <input type="password" class="input-text" placeholder="'.__( "Password", "H-Code" ).'" name="post_password" id="' . $label . '" value="" maxlength="20" />
                </div>
                <div class="form-row">
                    <input type="submit" class="highlight-button btn-small button btn" name="Submit" value="' . esc_attr__( "Enter", "H-Code" ) . '" />
                </div>
            </form>';
        return $output;
    }
}
add_filter( 'the_password_form', 'hcode_password_form' );

if ( ! function_exists( 'hcode_enqueue_fonts_url' ) ) :

function hcode_enqueue_fonts_url() {
    $hcode_fonts_url = '';
    $hcode_fonts     = array();
    $hcode_subsets   = 'latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese';
    global $hcode_theme_settings;
    if( $hcode_theme_settings['main_font']['font-family']){
        $hcode_fonts[] = $hcode_theme_settings['main_font']['font-family'].':100,300,400,500,600,700,800,900';
    }else{
        $hcode_fonts[] = 'Open Sans:300,400,600,700,800';
    }
    if( $hcode_theme_settings['alt_font']['font-family']){
        $hcode_fonts[] = $hcode_theme_settings['alt_font']['font-family'].':100,300,400,500,600,700,800,900';
    }else{
        $hcode_fonts[] = 'Oswald:300,400,700';
    }

    if ( $hcode_fonts ) {
        $hcode_fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $hcode_fonts ) ),
            'subset' => urlencode( $hcode_subsets ),
        ), '//fonts.googleapis.com/css' );
    }
    return $hcode_fonts_url;
}
endif;

if ( ! function_exists( 'hcode_font_scripts' ) ) :
    function hcode_font_scripts() {
        wp_enqueue_style( 'hcode-fonts', hcode_enqueue_fonts_url(), array(), null );
    }
endif;
add_action( 'wp_enqueue_scripts', 'hcode_font_scripts' );


if ( ! function_exists( 'hcode_check_enable_mini_header' ) ) :
    function hcode_check_enable_mini_header() {

        $hcode_enable_mini_header           = hcode_option( 'hcode_enable_mini_header' );
        $hcode_enable_mini_header_sidebar   = hcode_option( 'hcode_enable_mini_header_sidebar' );

        if( $hcode_enable_mini_header == 1 && !empty( $hcode_enable_mini_header_sidebar )
            && is_active_sidebar( $hcode_enable_mini_header_sidebar ) ) {

            return true;
        }

        return false;
    }
endif;

if ( ! function_exists( 'hcode_extract_shortcode_contents' ) ) :
    /**
     * Extract text contents from all shortcodes for usage in excerpts
     *
     * @return string The shortcode contents
     **/
    function hcode_extract_shortcode_contents( $m ) {
        global $shortcode_tags;

        // Setup the array of all registered shortcodes
        $shortcodes = array_keys( $shortcode_tags );
        $no_space_shortcodes = array( 'dropcap' );
        $omitted_shortcodes  = array( 'slide' );

        // Extract contents from all shortcodes recursively
        if ( in_array( $m[2], $shortcodes ) && ! in_array( $m[2], $omitted_shortcodes ) ) {
            $pattern = get_shortcode_regex();
            // Add space the excerpt by shortcode, except for those who should stick together, like dropcap
            $space = ' ' ;
            if ( in_array( $m[2], $no_space_shortcodes ) ) {
                $space = '' ;
            }
            $content = preg_replace_callback( "/$pattern/s", 'hcode_extract_shortcode_contents', rtrim( $m[5] ) . $space );
            return $content;
        }

        // allow [[foo]] syntax for escaping a tag
        if ( $m[1] == '[' && $m[6] == ']' ) {
            return substr( $m[0], 1, -1 );
        }

       return $m[1] . $m[6];
    }
endif;

if ( ! function_exists( 'hcode_add_default_cursor' ) ) :
    function hcode_add_default_cursor() {
        
        $hcode_custom_css = '';
        $hcode_options = get_option( 'hcode_theme_setting' );

        $hcode_show_default_cursor_image =  (isset($hcode_options['hcode_show_default_cursor_image']) && !empty($hcode_options['hcode_show_default_cursor_image'])) ? $hcode_options['hcode_show_default_cursor_image'] : '';

        if( $hcode_show_default_cursor_image != 1 ) {
            $hcode_custom_css .= "figure:hover img, .popup-gallery img, .lightbox-gallery img, .image-popup-no-margins img, .image-popup-vertical-fit img, .zoom-gallery img { cursor: pointer !important }";
            $hcode_custom_css .= ".mfp-zoom-out-cur, .mfp-zoom-out-cur .mfp-image-holder .mfp-close, .mfp-image-holder, .mfp-iframe-holder, .mfp-close-btn-in, .mfp-content, .mfp-container, .mfp-auto-cursor .mfp-content { cursor: pointer !important }";
        } else {
            /* For Open Cursor */
            $hcode_default_open_cursor_image = (isset($hcode_options['hcode_default_open_cursor_image']) && !empty($hcode_options['hcode_default_open_cursor_image'])) ? $hcode_options['hcode_default_open_cursor_image'] : '';
            if( isset( $hcode_default_open_cursor_image['url'] ) && !empty( $hcode_default_open_cursor_image['url'] ) ){
                $hcode_custom_css .= "figure:hover img,.popup-gallery img, .lightbox-gallery img, .image-popup-no-margins img, .image-popup-vertical-fit img, .zoom-gallery img { cursor: url('".esc_url($hcode_default_open_cursor_image['url'])."'), pointer !important }";
            }

            /* For Close Cursor */
            $hcode_default_close_cursor_image = (isset($hcode_options['hcode_default_close_cursor_image']) && !empty($hcode_options['hcode_default_close_cursor_image'])) ? $hcode_options['hcode_default_close_cursor_image'] : '';
            if( isset( $hcode_default_close_cursor_image['url'] ) && !empty( $hcode_default_close_cursor_image['url'] ) ){
                $hcode_custom_css .= ".mfp-zoom-out-cur, .mfp-zoom-out-cur .mfp-image-holder .mfp-close, .mfp-image-holder, .mfp-iframe-holder, .mfp-close-btn-in, .mfp-content, .mfp-container { cursor: url('".esc_url($hcode_default_close_cursor_image['url'])."'), pointer !important }";
            }
        }

        wp_add_inline_style( 'hcode-magnific-popup-style', $hcode_custom_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'hcode_add_default_cursor' );

add_filter( 'body_class', 'hcode_add_body_class' );
if ( ! function_exists( 'hcode_add_body_class' ) ) :
    function hcode_add_body_class( $classes ) {

        $hcode_options = get_option( 'hcode_theme_setting' );

        $hcode_popup_on_click_close =  (isset($hcode_options['hcode_popup_on_click_close']) && !empty($hcode_options['hcode_popup_on_click_close'])) ? $hcode_options['hcode_popup_on_click_close'] : '';
        if( $hcode_popup_on_click_close != 1 ) {
            $classes[] = 'hcode-custom-popup-close';
        }           

        return $classes;
    }
endif;

if ( ! function_exists( 'hcode_get_header_layout' ) ) :
    function hcode_get_header_layout( $type = 'title' ) {

        if( $type == 'preview' ) {

            return array(
                            "headertype1" => get_template_directory_uri()."/assets/images/header1.jpg",
                            "headertype2" => get_template_directory_uri()."/assets/images/header2.jpg",
                            "headertype3" => get_template_directory_uri()."/assets/images/header3.jpg",
                            "headertype4" => get_template_directory_uri()."/assets/images/header4.jpg",
                            "headertype5" => get_template_directory_uri()."/assets/images/header5.jpg",
                            "headertype6" => get_template_directory_uri()."/assets/images/header6.jpg",
                            "headertype7" => get_template_directory_uri()."/assets/images/header7.jpg",
                            "headertype8" => get_template_directory_uri()."/assets/images/header6.jpg",
                            "headertype9" => get_template_directory_uri()."/assets/images/header9.jpg",
                            "headertype10"=> get_template_directory_uri()."/assets/images/header10.jpg",
                            "headertype11"=> get_template_directory_uri()."/assets/images/header11.jpg",
                        );
        } else if( $type == 'meta_fields' ) {

            return array(  
                            'default'     => esc_html__('Default', 'H-Code'),
                            'headertype1' => esc_html__('Light Header', 'H-Code'),
                            'headertype2' => esc_html__('Dark Header', 'H-Code'),
                            'headertype3' => esc_html__('Dark Transparent Header', 'H-Code'),
                            'headertype4' => esc_html__('Light Transparent Header', 'H-Code'),
                            'headertype5' => esc_html__('Static Sticky Header', 'H-Code'),
                            'headertype6' => esc_html__('White Sticky Header', 'H-Code'),
                            'headertype7' => esc_html__('Gray Header', 'H-Code'),
                            'headertype8' => esc_html__('Non Sticky Header', 'H-Code'),
                            'headertype9' => esc_html__('Hamburger Header 1', 'H-Code'),
                            'headertype10'=> esc_html__('Hamburger Header 2', 'H-Code'),
                            'headertype11'=> esc_html__('Hamburger Header 3', 'H-Code'),
                        );
        } else {

            return array(  
                            'imgtitle1'   => esc_html__('Light Header', 'H-Code'),
                            'imgtitle2'   => esc_html__('Dark Header', 'H-Code'),
                            'imgtitle3'   => esc_html__('Dark Transparent Header', 'H-Code'),
                            'imgtitle4'   => esc_html__('Light Transparent Header', 'H-Code'),
                            'imgtitle5'   => esc_html__('Static Sticky Header', 'H-Code'),
                            'imgtitle6'   => esc_html__('White Sticky Header', 'H-Code'),
                            'imgtitle7'   => esc_html__('Gray Header', 'H-Code'),
                            'imgtitle8'   => esc_html__('Non Sticky Header', 'H-Code'),
                            'imgtitle9'   => esc_html__('Hamburger Header 1', 'H-Code'),
                            'imgtitle10'  => esc_html__('Hamburger Header 2', 'H-Code'),
                            'imgtitle11'  => esc_html__('Hamburger Header 3', 'H-Code'),
                        );
        }
    }
endif;
