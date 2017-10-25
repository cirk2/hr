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
?>
<section <?php echo post_class($section_class); ?>>
    <div class="container" id="modal-ready">
        <div class="row">

            <?php
                $thumb_id = get_post_thumbnail_id();
                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
                $thumb_url = $thumb_url_array[0];
            ?>
            <div class="row custom-post-header">
                <div class="col-md-12 flex-container">
                    <div class="watermark">
                        <img src="<?php get_stylesheet_directory_uri() ?>/wp-content/themes/h-code-child/i/logo-hr.svg">
                    </div>
                    <h2 class="rebsorte-title"><?php the_title(); ?></h2>
                    <h2 class="ursprungsnummer-title">Nr. <?php the_field("ursprungsnummer") ?></h2>
                </div>
            </div>

            <div class="entry-content">

                <?php if (get_field( 'zitat' ) ): ?>
                <blockquote><?php the_field( 'zitat' ) ?></blockquote>
                <?php endif; ?>

                <div class="rebsorte-featured-image-thumb">
                    <a href="<?php echo $thumb_url ?>" class="fancybox">
                        <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium' ); }  ?>
                    </a>
                </div>

                <?php if (get_field( 'status' )): ?>

                    <h3>Status</h3>
                    <p><?php the_field( 'status' ) ?></p>

                <?php endif;
                    if (get_field( 'fundsituation' )): ?>

                    <h3>Fundsituation</h3>
                    <p><?php the_field( 'fundsituation' ) ?></p>

                <?php endif;
                    if (get_field( 'herkunft_und_verbreitung' )): ?>

                    <h3>Herkunft und Verbreitung</h3>
                    <p><?php the_field( 'herkunft_und_verbreitung' ) ?></p>

                <?php endif;
                     if (get_field( 'eigenschaften' )): ?>

                    <h3>Eigenschaften</h3>
                    <p><?php the_field( 'eigenschaften' ) ?></p>

                <?php endif; ?>


                <?php
                    if( get_field('wein_vorhanden') ){
                        $field_wv = get_field_object('wein_vorhanden');
                        $value_wv = $field_wv['value'];
                        $label_wv = $field_wv['choices'][ $value_wv ];
                    }
                ?>

                <?php if( get_field('wein_vorhanden')): ?>

                    <h3>Wie weit wir sind</h3>

                    <p class="wein-vorhanden">

                    <?php if( get_field('wein_vorhanden') == 'developing' ): ?>
                        <i class="fa fa-cogs"></i> <?php echo $label_wv ?>
                    <?php endif; ?>
                    <?php if( get_field('wein_vorhanden') == 'growing' ): ?>
                        <i class="fa fa-pagelines"></i> <?php echo $label_wv ?>
                    <?php endif; ?>
                    <?php if( get_field('wein_vorhanden') == 'available' ): ?>
                        <i class="icon-wine"></i> <?php echo $label_wv ?>
                    <?php endif; ?>

                    </p>

                <?php endif; ?>

                <?php if ( get_field( 'pdf' ) ):
                        $pdf_url = get_field( 'pdf' );
                        $pdf_thumb = substr($pdf_url, 0, -4) . '-pdf-212x300.jpg';
                ?>

                <h3>Die Sorte im Detail</h3>
                <p>Für noch ausführlichere Informationen gibt es hier eine mehrseitige PDF Datei.</p>

                <div class="view-pdf" style="margin-bottom: 22px">
                    <a href="<?php the_field( 'pdf' ) ?>" class="fancybox-pdf">
                        <img src="<?php echo $pdf_thumb ?>" alt="">
                    </a>
                </div>
                <?php endif; ?>

                <h3>Partnerwinzer</h3>

                    <ul class="partnerwinzer">

                    <?php
                    $partners = get_posts(array(
                            'post_type' => 'partnerwinzer',
                            'meta_query' => array(
                                array(
                                'key' => 'rebsorten',
                                'value' => '"' . get_the_ID() . '"',
                                'compare' => 'LIKE'
                                )
                            )
                        ));

                        if( $partners ): ?>

                        <?php foreach( $partners as $partner ): ?>

                        <li>
                            <a href="<?php echo get_permalink( $partner->ID ); ?>"><?php echo get_the_title( $partner->ID ); ?></a>

                        </li>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    </ul>

            </div>

        </div>
    </div>
</section>

<?php

// End of the loop.
endwhile;

get_footer();