(function($) {

    'use strict';

    // IE Detection
    var isIE = false,
    ua = window.navigator.userAgent,
    oldIE = ua.indexOf('MSIE '), // IE10 or older
    newIE = ua.indexOf('Trident/'), // IE11
    edgIE = ua.indexOf('Edge/'); // EDGE

    if ((oldIE > -1) || (newIE > -1) || (edgIE > -1)) {
        isIE = true;
    }


    // HTML Escape function

    // function escapeHtml(text) {
    //     var div = document.createElement('div');
    //     div.innerText = text;
    //     return div.innerHTML;
    // }


    // Gets length of each <path> and sets it as svg stroke attributes
    // also workaround to get stroke animations running in IE

    var logoWaypoints = function() {

        var pathLengths = new Array();

        $('.logo-group path').each(function(i) {
            length = Math.round($(this).get(0).getTotalLength());
            pathLengths.push(length);
        });
         console.log(pathLengths);

        $('.section-logo').each(function() {
            var self = $(this);

            self.waypoint(function() {
                self.find('use').each(function(i) {
                    $(this).css({
                        strokeDasharray: pathLengths[i],
                        strokeDashoffset: pathLengths[i]
                    });
                    if (isIE) {
                        $(this).stop(true, true)
                    .delay(1000)
                    .animate({
                        strokeDashoffset: 0
                    },
                    2000);
                    }
                });

            }, {
            offset: "85%"
            })
        });
    };

    $(function() {

        // Debug

        var rh = $('#rebsorten').height();
        var ph = $('#partner').height();
        console.log('rebsorten: ' + rh + 'px');
        console.log('partner: ' + ph + 'px');


        $('body').imagesLoaded()

            .always( function( instance ) {
                console.log('all images loaded');
                $('body').addClass('images-loaded');
            })

            .done( function( instance ) {

                logoWaypoints();

                var excLength = 150;

                setTimeout(function() {
                    $(".rebsorten-grid-excerpt p").each(
                        function() {
                            if ($(this).text().length > excLength) {
                                $(this).text(
                                    $(this).text().substring(0, excLength) + '...'
                                );
                            }
                        });

                    if ( Modernizr.shapes ) {
                            $('.custom-post-grid .vc_gitem-link p')
                                .before("<div class=left-flow></div>" +
                                        "<div class=right-flow></div>");
                        }

                    $( '.wrap-first-word h6, .slider-text-middle span' ).each(function() {
                        var me = $(this);
                        me.html(me.text().replace(/(^\w+)/, '<span class="first-word">$1</span>'));
                    });

                    Waypoint.refreshAll();

                }, 1000);

            })

            .fail( function() {
                console.log( 'all images loaded, at least one is broken' );
            })

            // .progress( function( instance, image ) {
            //     var result = image.isLoaded ? 'loaded' : 'broken';
            //     console.log( 'image is ' + result + ' for ' + image.img.src );
            // });


    });

    // Reset section logo animations after scrolling top

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        var logo   = $('.section-logo.animated');
        if ( scroll < 10) {
            console.log('scrolled top, logo animatons resetted');
            if (logo.hasClass('animated')) {
                logo.removeClass('animated wpb_start_animation');
                Waypoint.refreshAll();
            }
        }
    });

    // $('window').on('click', '.mfp-close', function(e) {
    //     event.preventDefault();

    // });

    $('window').off("click", ".mfp-close");

    $('#search-header').on('click', function(event) {
        event.preventDefault();
        $('.mfp-close').trigger('click');
    });


    $('#search-header').trigger('click');


    // Initialize tooltips

    // $('[data-tooltip!=""]').qtip({
    //       content: {
    //         attr: 'data-tooltip'
    //       },
    //       style: 'qtip-bootstrap'
    // });


})(jQuery);





// jQuery('.vc_grid-item-mini').toggleClass('vc_is-hover');
// jQuery('.vc_grid-item').css({"pointerEvents": "none"});

// $(".section-logo").waypoint(function() {
//   console.log($(this[0]));
//   var paths = document.querySelectorAll('.draw-mark'),
//  offset = 1100;

//   var drawLine = function() {
//  [].forEach.call(paths, function( path ) {
//  path.style.strokeDashoffset = offset;
//  offset--;
//  if (offset <= 0) {
//  offset = 0;
//  return false;
//       }
//     });
//     requestAnimationFrame(drawLine);
//   }
//   drawLine();

// }, { offset: '80%'});