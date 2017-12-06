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

                <h2><?php the_title(); ?></h2>

                <?php the_excerpt(); ?>

                <p>Spicy jalapeno bacon ipsum dolor amet boudin reprehenderit meatloaf ex mollit dolore excepteur picanha kielbasa. Shankle minim est voluptate short ribs ham hock filet mignon ea dolore in. Andouille short ribs lorem spare ribs duis jowl short loin pancetta meatloaf hamburger landjaeger porchetta consequat ut. Filet mignon ham hock venison do aute sed. Nostrud reprehenderit burgdoggen, sirloin excepteur quis velit pork chop corned beef commodo duis deserunt tail pastrami. Consectetur laboris flank, hamburger meatball cillum kevin lorem.</p>

                <h3>Verfügbare Rebsorten</h3>

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
                    <li><a href="<?php the_field("website") ?>"> Website von <?php the_title(); ?></a></li>
                    <li><a href="<?php the_field("shop_url") ?>"> Online Shop von <?php the_title(); ?></a></li>
                </ul>

            </div>

            <!-- <footer><?php the_content(); ?></footer> -->

        </div>

</section>

<?php

// End of the loop.
endwhile;

get_footer();
