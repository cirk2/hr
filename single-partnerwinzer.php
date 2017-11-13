<?php
/**
 * Partnerwinzer Template
 *
 * @package H-Code
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
                <div class="brand-wrapper">
                    <div class="watermark">
                        <svg class="section-logo-svg animate-path" width="152" height="158" viewBox="0 0 152 158" xml:space="preserve">
                          <use class="animate-draw draw-frame" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-frame" style="stroke-dasharray: 521px; stroke-dashoffset: 521px;"></use>
                          <use class="animate-draw draw-mark"  xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-1" style="stroke-dasharray: 585px; stroke-dashoffset: 585px;"></use>
                          <use class="animate-draw draw-mark"  xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-2" style="stroke-dasharray: 626px; stroke-dashoffset: 626px;"></use>
                          <use class="animate-draw draw-mark"  xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-3" style="stroke-dasharray: 439px; stroke-dashoffset: 439px;"></use>
                          <use class="animate-draw draw-mark"  xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-4" style="stroke-dasharray: 82px; stroke-dashoffset: 82px;"></use>
                        </svg>
                    </div>
                    <h2 class="rebsorte-title"><?php the_title(); ?></h2>
                    <h2 class="ursprungsnummer-title"><?php the_field("ursprungsnummer") ?></h2>
                </div>
            </header>

            <div class="content">

                <h2>Winzer / Weingut</h2>

                <?php the_excerpt(); ?>

                <p>Spicy jalapeno bacon ipsum dolor amet boudin reprehenderit meatloaf ex mollit dolore excepteur picanha kielbasa. Shankle minim est voluptate short ribs ham hock filet mignon ea dolore in. Andouille short ribs lorem spare ribs duis jowl short loin pancetta meatloaf hamburger landjaeger porchetta consequat ut. Filet mignon ham hock venison do aute sed. Nostrud reprehenderit burgdoggen, sirloin excepteur quis velit pork chop corned beef commodo duis deserunt tail pastrami. Consectetur laboris flank, hamburger meatball cillum kevin lorem.</p>

                <h3>Welche Rebsorten hat der Winzer im Angebot</h3>

                <div class="rebsorten">

                  <?php $posts = get_field('rebsorten');

                    if( $posts ): ?>
                        <ul>
                        <?php foreach( $posts as $post):?>
                            <?php setup_postdata($post); ?>
                            <li>
                                <a class="modal-link" href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>

                </div>

                <h3>Warum HR</h3>

                <p>Meatball nisi shankle ribeye, incididunt filet mignon alcatra anim kielbasa aliquip short ribs. Beef ribs eiusmod voluptate tempor, irure burgdoggen cillum. Spare ribs veniam deserunt labore, corned beef tail laborum magna ground round tenderloin prosciutto eu sint est sausage. Tongue anim strip steak, deserunt ball tip ground round adipisicing burgdoggen occaecat chicken. Pork belly magna picanha, t-bone velit eiusmod tri-tip cupidatat sed venison aliquip. Duis ex shank dolor ground round spare ribs filet mignon shoulder andouille non fugiat eu tenderloin brisket.</p>

                <p>
                    Links zur HP
                    Links zum Shop
                </p>

            </div>

            <div class="sidebar">
                <div class="partner-featured-image-thumb hidden-xs">
                    <a href="<?php echo $thumb_url ?>" class="fancybox">
                        <img src="<?php echo $thumb_url ?>" />
                    </a>
                </div>
            </div>

            <footer><?php the_content(); ?></footer>

        </div>

</section>

<?php

// End of the loop.
endwhile;

get_footer();