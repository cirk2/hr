<?php
/**
 * Rebsorten Template
 * 
 * @package H-Code
 */

get_header(); ?>

<?php
    // Start of the loop.

    while ( have_posts() ) : the_post();
?>

<?php // echo "<pre>"; print_r(is_front_page()); echo "</pre>"; ?> 

<section <?php echo post_class($section_class); ?>
  <div id="modal-ready">
    <div class="grid-container">
      <?php
      $thumb_id = get_post_thumbnail_id();
      $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
      $thumb_url = $thumb_url_array[0];
      ?>
      <header class="custom-post-header">
            <div class="brand-wrapper">
                <div class="watermark">
                    <svg class="animated-logo animate-path" width="152" height="158" viewBox="0 0 152 158" xml:space="preserve">
                      <use class="animate-draw draw-frame" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-frame" style="stroke-dasharray: 521px; stroke-dashoffset: 521px;"></use>
                      <use class="animate-draw draw-mark" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-1" style="stroke-dasharray: 585px; stroke-dashoffset: 585px;"></use>
                      <use class="animate-draw draw-mark" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-2" style="stroke-dasharray: 626px; stroke-dashoffset: 626px;"></use>
                      <use class="animate-draw draw-mark" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-3" style="stroke-dasharray: 439px; stroke-dashoffset: 439px;"></use>
                      <use class="animate-draw draw-mark" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-4" style="stroke-dasharray: 82px; stroke-dashoffset: 82px;"></use>
                    </svg>
                </div>
                <h2 class="rebsorte-title"><?php the_title(); ?></h2>
                <h2 class="ursprungsnummer-title"><?php the_field("ursprungsnummer") ?></h2>
            </div>
      </header>
      <div class="content grid-fullwidth">

      <blockquote id="claim"><?php the_field( 'claim' ) ?></blockquote>

      <?php if (get_field( 'claim' ) ): ?>
      <div class="section-heading">
        <div class="subheader">
          <h2 class="section-title">
            <b class="quote-mark-left">&#x275E;</b><?php the_field( 'claim' ) ?><b class="quote-mark-right">&#x275D;</b>
          </h2>
        </div>
      </div>
      <?php endif; ?>

      </div>
        <div class="content grid-fullwidth text-center">

          <!-- <div class="text-center modal-excerpt"><?php the_excerpt(); ?></div> -->
          <div class="text-center modal-excerpt"><p><?php the_field( 'rebsorten_excerpt' ); ?></p></div>

          <?php if( get_field('wein_vorhanden')): ?>
            <?php if( get_field('wein_vorhanden') ){
                    $field_wv = get_field_object('wein_vorhanden');
                    $value_wv = $field_wv['value'];
                    $label_wv = $field_wv['choices'][ $value_wv ];
                  } 
            ?>

          <h3>Wie weit wir sind</h3>

          <div class="rebsorte-status">
            <div class="rebsorte-status-icons <?php echo get_field('wein_vorhanden'); ?>">
              <div class="icon-map"><span>Entdeckt</span></div>
              <div class="icon-sprout"><span>Im Aufbau</span></div>
              <div class="icon-grape"><span>Im Anbau</span></div>
              <div class="icon-wine"><span>Erlebbar</span></div>
            </div>
            <div class="progress">
              <div class="progress-bar"></div>
            </div>
          </div>
          <?php endif; ?>
          <div class="partnerwinzer">
         
            <?php  $partners = get_posts(array(
                    'post_type' => 'partnerwinzer',
                    'numberposts' => 8,
                    'meta_query' => array(
                        array(
                        'key' => 'rebsorten',
                        'value' => '"' . get_the_ID() . '"',
                        'compare' => 'LIKE'
                        )
                    ),
                    'meta_key' => 'reihenfolge', 
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                ));
              if( $partners ): ?>

            <h3 class="text-center">Partnerwinzer</h3>

            <ul> 

              <?php foreach( $partners as $partner ): ?>

              <li>
                  <a href="<?php echo get_permalink( $partner->ID ); ?>"
                      title="<?php echo get_the_title( $partner->ID ); ?>"
                      class="modal-link">
                      <?php echo get_the_post_thumbnail( $partner->ID, 'full' ); ?>
                  </a>
              </li>

              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            
          </div>

          <?php 
            $show_posts = "style='display: none;'"; 

            global $post;
            $args = array( 'numberposts' => 10, 
                           'category_name' => get_the_title(), 
                         );
            $posts = get_posts( $args );

            if (!empty($posts)) {
              $show_posts = "style='display: block;'";
            }
          ?>

          <h3 <?php echo $show_posts ?> >Blogbeiträge zur Rebsorte <?php echo the_title(); ?></h3>
          
          <ul class="related-post-links">
            
          <?php foreach( $posts as $post ): setup_postdata($post); ?>
           
            <li>
              <a target="_blank" href="<?php echo the_permalink() ?>">
                <?php echo the_title() ?>
              </a>
            </li>

          <?php 
            endforeach; 
            wp_reset_postdata();
          ?>

          </ul>

          <div class="separator">&#x2766;</div>
        </div>
        <div class="content">
        <!-- research section -->

        <?php if (get_field( 'forschung' )): ?>
        
          <h2 class="section-science">Forschungsergebnisse Andreas Jung</h2>

          <div class="featured-image-thumb visible-sm visible-xs" >
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium' ); }  ?>
          </div>

          <?php while(has_sub_field('forschung')): ?>

              <h3><?php the_sub_field('heading-select') ?></h3>

              <p><?php the_sub_field('paragraph') ?></p>

          <?php endwhile; ?>

        <?php endif; ?>

        </div>
        <!-- sidebar -->
        <div class="sidebar">
          <div class="featured-image-thumb hidden-sm hidden-xs" >
            <!-- <a href="<?php echo $thumb_url ?>" class="fancybox"> -->
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium' ); }  ?>
            <!-- </a> -->
          </div>
          <?php if ( get_field( 'pdf' ) ):
                  $pdf_url = get_field( 'pdf' );
                  $pdf_thumb = substr($pdf_url, 0, -4) . '-pdf-212x300.jpg';
          ?>

          <h3>Ursprungsnachweis</h3>

          <div class="view-pdf" style="margin-bottom: 22px">
            <a  href="<?php the_field( 'pdf' ) ?>" class="fancybox-pdf" target="_blank">
              <img src="<?php echo $pdf_thumb ?>" alt="">
            </a>
          </div>
          <?php endif; ?>
          
        <!-- end sidebar -->
        </div>

        <footer></footer>

    </div>
</section>

<?php

// End of the loop.
endwhile;

get_footer();
