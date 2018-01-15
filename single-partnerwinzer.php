<?php
/**
 * Partnerwinzer Template
 *
 * @package H-Code
 * @author  reflect.media GmbH
 *
 */

get_header(); ?>

<?php
    // Start of the loop.

    while ( have_posts() ) : the_post();
?>

<section <?php echo post_class($section_class); ?>
    <div id="modal-ready">

        <div class="grid-container">
            <?php
                $thumb_id = get_post_thumbnail_id();
                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
                $thumb_url = $thumb_url_array[0];
            ?>

            <header class="custom-post-header">
                <div class="featured-image-thumb">
                    <img src="<?php echo $thumb_url ?>" />
                </div>
            </header>

            <div class="content">

                <h2 class="text-center"><?php the_title(); ?></h2>

                <div class="partnerwinzer-content text-center">
                  <?php the_field( 'partnerwinzer-text' ) ?>
                </div>

                <h3 class="text-center">Verfügbare Rebsorten</h3>

                <div class="rebsorten">

                  <?php $posts = get_field('rebsorten');

                    if( $posts ): ?>
                        <ul>
                        <?php foreach( $posts as $post):?>
                            <?php setup_postdata($post); ?>
                            <li>
                                <a class="modal-link" href="<?php the_permalink(); ?>">
                                    <div class="watermark"></div>
                                    <h2 class="rebsorte-title"><?php the_title(); ?></h2>
                                    <h2 class="ursprungsnummer-title"><?php the_field("ursprungsnummer") ?></h2>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>

                </div>

                <ul>
                    <?php if( get_field("website")): ?>
                      <li><a href="<?php the_field("website") ?>" target="_blank"> Website von <?php if (get_field( "website_link_text" )) {
                        the_field( "website_link_text" );
                      } else { the_title(); } ?></a></li>
                    <?php endif; ?>
                    <?php if( get_field("shop_url")): ?>
                      <li><a href="<?php the_field("shop_url") ?>" target="_blank"> Online Shop von <?php if (get_field( "website_link_text" )) {
                        the_field( "website_link_text" );
                      } else { the_title(); } ?></a></li>
                    <?php endif; ?>
                </ul>

                <?php 
                  $show_posts = "style='display: none;'"; 

                  global $post;
                  $args = array( 'numberposts' => 5, 
                                 'category_name' => get_the_title(), 
                               );
                  $posts = get_posts( $args );

                  if (!empty($posts)) {
                    $show_posts = "style='display: block;'";
                  }
                ?>

                <h3 <?php echo $show_posts ?> >Artikel zu <?php echo the_title(); ?></h3>
                
                <ul class="related-post-links">
                  
                <?php foreach( $posts as $post ): setup_postdata($post); ?>
                 
                  <li><a href="<?php echo the_permalink() ?>">
                    <?php echo the_title() ?></a>
                  </li>

                <?php 
                  endforeach; 
                  wp_reset_postdata();
                ?>

                </ul>

            </div>

            <!-- <footer></footer> -->

        </div>

</section>

<?php

// End of the loop.
endwhile;

get_footer();
