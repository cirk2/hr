<?php
/**
 * The template for displaying all single posts
 *
 * @package H-Code
 */

get_header(); ?>

<?php
    // Start of the loop.
    while ( have_posts() ) : the_post();
        $layout_settings = $enable_container_fluid = $class_main_section = $section_class = $single_post_layout = '';
        // Get Theme option.
        $hcode_options = get_option( 'hcode_theme_setting' );
        // Set Layout Setting
        $layout_settings = isset($hcode_options['hcode_layout_settings_post']) ? $hcode_options['hcode_layout_settings_post'] :'';

        if( !empty($layout_settings)){
            $layout_settings = hcode_option_post('hcode_layout_settings');
            $enable_container_fluid = hcode_option_post('hcode_enable_container_fluid');
        
            $single_post_layout = hcode_option('hcode_single_layout_settings');
            switch ($layout_settings) {
                case 'hcode_layout_full_screen':
                    if(isset($enable_container_fluid) && $enable_container_fluid == '1') {
                        $class_main_section .= 'container-fluid';
                        $section_class .= 'no-padding';
                    }else{
                        $class_main_section .= 'container';
                        $section_class .= 'no-padding';
                    }
                break;

                case 'hcode_layout_both_sidebar':
                    $section_class .= '';
                    $class_main_section .= 'container col3-layout';
                break;

                case 'hcode_layout_left_sidebar':
                case 'hcode_layout_right_sidebar':
                    $section_class .= 'no-padding-bottom';
                    $class_main_section .= 'container col2-layout';
                break;
                
                default:
                    $section_class .= '';
                    if(isset($enable_container_fluid) && $enable_container_fluid == '1') {
                        $class_main_section .= 'container-fluid';
                    } else {
                        $class_main_section .= 'container';
                    }
                break;
            }

            $section_class .= ' parent-section';
            ?>

            <?php 
            
            $hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
            $hcode_disable_post_title = (isset($hcode_options['hcode_disable_post_title'])) ? $hcode_options['hcode_disable_post_title'] : '';
            $hcode_post_title = hcode_option('hcode_enable_post_title');
            $featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

            $hcode_image_overlay = $bg_img_style = '';

            if( $featured_image ){
                $featured_image = $featured_image;
                $hcode_image_overlay = 'bg-black';
            } elseif( !empty( $hcode_no_image['url'] ) ) {
                $featured_image = $hcode_no_image['url'];
            }

            if( !empty( $featured_image ) ) {
                $bg_img_style = 'style="background: transparent url(\'' . $featured_image . '\') repeat scroll 50% 0%;"';
            }

            if( $single_post_layout == 'hcode_single_layout_full_width' ) { ?>
            <section class="wow fadeIn blog-single-full-width-header fix-background parallax-fix" <?php echo $bg_img_style ?>>
                <div class="opacity-full <?php echo $hcode_image_overlay; ?>"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-8 position-relative full-width-headline text-center center-col">
                            <!-- post title  -->
                            <h2 class="white-text alt-font entry-title">
                                <?php 
                                if( $hcode_disable_post_title == 1 ){
                                    if( $hcode_post_title == 1 || empty($hcode_post_title) ){
                                        echo get_the_title();
                                    }
                                }
                                ?>
                            </h2>
                            <!-- end post title  -->
                            <!-- post date and categories  -->
                            <?php hcode_full_width_single_post_meta(); ?>
                            <!-- end post date and categories  -->
                        </div>

                    </div>
                </div>
            </section>
            <?php } ?>

            <section <?php echo post_class($section_class); ?>>
                <div class="<?php echo $class_main_section; ?>">
                    <div class="row">
                    <?php
                        // If Is Set Get Post Left Sidebar.
                        get_template_part('templates/post-sidebar-left'); 
                        switch ($single_post_layout) {
                            case 'hcode_single_layout_standard':
                                // Standard Post layout.
                                get_template_part('templates/single-post/standard','post');
                            break;

                            case 'hcode_single_layout_full_width':
                                // Full Width Header Image Post layout.
                                get_template_part('templates/single-post/full','post');
                            break;

                            case 'hcode_single_layout_full_width_image_slider':
                                // Full Width With Image Slider Post layout.
                                get_template_part('templates/single-post/full','post-with-slider');
                            break;

                            case 'hcode_single_layout_full_width_lightbox':
                                // Full Width With Lightbox Slider Gallery layout.
                                get_template_part('templates/single-post/full','width-with-lightbox-gallery');
                            break;
                        }
                        // If Is Set Get Post Right Sidebar.
                        get_template_part('templates/post-sidebar-right');

                        // If Is Set Get Post Related Posts.
                        $enable_related_posts = hcode_option('hcode_enable_related_posts');
                        
                        if($enable_related_posts == 1):
                            hcode_single_post_related_posts();
                        endif;
                    ?>
                    </div>
                </div>
            </section>
        <?php
        
        }else{

            $layout_settings = hcode_option('hcode_layout_settings');
            $enable_container_fluid = hcode_option('hcode_enable_container_fluid');
        
            $single_post_layout = hcode_option('hcode_single_layout_settings');

            switch ($layout_settings) {
                case 'hcode_layout_full_screen':
                    if(isset($enable_container_fluid) && $enable_container_fluid == '1') {
                        $class_main_section .= 'container-fluid';
                        $section_class .= 'no-padding';
                    }else{
                        $class_main_section .= 'container';
                        $section_class .= 'no-padding';
                    }
                break;

                case 'hcode_layout_both_sidebar':
                    $section_class .= '';
                    $class_main_section .= 'container col3-layout';
                break;

                case 'hcode_layout_left_sidebar':
                case 'hcode_layout_right_sidebar':
                    $section_class .= 'no-padding-bottom';
                    $class_main_section .= 'container col2-layout';
                break;
                
                default:
                    $section_class .= '';
                    $class_main_section .= 'container';
                break;
            }

            $section_class .= ' parent-section'; 
            
            $hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
            $hcode_disable_post_title = (isset($hcode_options['hcode_disable_post_title'])) ? $hcode_options['hcode_disable_post_title'] : '';
            $hcode_post_title = hcode_option('hcode_enable_post_title');
            $featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

            $hcode_image_overlay = $bg_img_style = '';

            if( $featured_image ){
                $featured_image = $featured_image;
                $hcode_image_overlay = 'bg-black';
            } elseif( !empty( $hcode_no_image['url'] ) ) {
                $featured_image = $hcode_no_image['url'];
            }

            if( !empty( $featured_image ) ) {
                $bg_img_style = 'style="background: transparent url(\'' . $featured_image . '\') repeat scroll 50% 0%;"';
            }

            if( $single_post_layout == 'hcode_single_layout_full_width' ) { ?>
            <section class="wow fadeIn blog-single-full-width-header fix-background parallax-fix" <?php echo $bg_img_style ?>>
                <div class="opacity-full <?php echo $hcode_image_overlay; ?>"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-8 position-relative full-width-headline text-center center-col">
                            <!-- post title  -->
                            <h2 class="white-text alt-font entry-title">
                                <?php 
                                if( $hcode_disable_post_title == 1 ){
                                    if( $hcode_post_title == 1 || empty($hcode_post_title) ){
                                        echo get_the_title();
                                    }
                                }
                                ?>
                            </h2>
                            <!-- end post title  -->
                            <!-- post date and categories  -->
                            <?php hcode_full_width_single_post_meta(); ?>
                            <!-- end post date and categories  -->
                        </div>

                    </div>
                </div>
            </section>
            <?php } ?>
            <section <?php echo post_class($section_class); ?>>
                <div class="<?php echo $class_main_section; ?>">
                    <div class="row">
                    <?php
                        // If Is Set Get Post Left Sidebar.
                        get_template_part('templates/post-sidebar-left'); 
                                    
                        switch ($single_post_layout) {
                            case 'hcode_single_layout_standard':
                                // Standard Post layout.
                                get_template_part('templates/single-post/standard','post');
                            break;

                            case 'hcode_single_layout_full_width':
                                // Full Width Header Image Post layout.
                                get_template_part('templates/single-post/full','post');
                            break;

                            case 'hcode_single_layout_full_width_image_slider':
                                // Full Width With Image Slider Post layout.
                                get_template_part('templates/single-post/full','post-with-slider');
                            break;

                            case 'hcode_single_layout_full_width_lightbox':
                                // Full Width With Lightbox Slider Gallery layout.
                                get_template_part('templates/single-post/full','width-with-lightbox-gallery');
                            break;
                        }
                        // If Is Set Get Post Right Sidebar.
                        get_template_part('templates/post-sidebar-right');

                        // If Is Set Get Post Related Posts.
                        $enable_related_posts = hcode_option('hcode_enable_related_posts');
                        
                        if($enable_related_posts == 1):
                            hcode_single_post_related_posts();
                        endif;
                    ?>
                    </div>
                </div>
            </section>
        <?php
        }
// End of the loop.
endwhile;

get_footer();