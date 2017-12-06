'use strict';

var isMobile = false;
var isiPhoneiPad = false;

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    isMobile = true;
}
if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
    isiPhoneiPad = true;
}

// IE Detection
var isIE  = false,
    ua    = window.navigator.userAgent,
    oldIE = ua.indexOf('MSIE '), // IE10 or older
    newIE = ua.indexOf('Trident/'), // IE11
    edgIE = ua.indexOf('Edge/'); // EDGE

if ((oldIE > -1) || (newIE > -1) || (edgIE > -1)) {
    isIE = true;
}

(function($) {

    // Gets length of each <path> and sets it as svg stroke attributes
    // also workaround to get stroke animations running in IE

    var logoWaypoints = function() {

        var pathLengths = new Array();

        $('.logo-group path').each(function(i) {
          var length = Math.round($(this).get(0).getTotalLength());
          if (isMobile) {
            var length = length * 2;
            console.log("hiDPI path length: " + length + "px");
          }
            pathLengths.push(length);
        });
        console.log(pathLengths);

        $('.animated-logo').each(function() {
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
                               .animate({ strokeDashoffset: 0 },
                    2000);
                        $(this).animate({ fillOpacity: 1},
                    1000);
                    }
                });

            }, {
            offset: "85%"
            })
        });
    };

    $(function() {

        $('body').imagesLoaded()

            .always( function( instance ) {

                $('body').addClass('images-loaded');

                setTimeout(function() {
                  $('#loading-page').remove();
                }, 1000);

                logoWaypoints();

                // Shrink nav on scroll and reset section logo animations after scrolling top 

                $(window).scroll(function () {
                    var $scroll = $(window).scrollTop();
                    var $logo   = $('.section-logo.animated');
                    var hasShrink = $('nav.navbar').hasClass('shrink-nav');

                    if ( $scroll > 10 && !hasShrink ) {
                        $('nav.navbar').addClass('shrink-nav');
                    } else if ( $scroll < 10 && hasShrink ) {
                        $('nav.navbar').removeClass('shrink-nav');
                        $logo.removeClass('animated wpb_start_animation');
                        Waypoint.refreshAll();
                    }
                });

                setTimeout(function() {
                    // trim excerpt length without cutting words
                    var excLength = 185;
                    $(".rebsorten-grid-excerpt p").each(
                        function() {
                            if ($(this).text().length > excLength) {

                                var trimmedExc = $(this).text().substr(0, excLength),
                                    trimmedExc = trimmedExc.substr(0, Math.min(trimmedExc.length, trimmedExc.lastIndexOf(" ")));
                                $(this).text( trimmedExc + ' ...' );
                            }
                        });

                    // wrap excerpt in two divs with css shapes
                    if ( Modernizr.shapes ) {
                            $('.rebsorten-grid-excerpt p')
                                .before("<div class='left-flow'></div>" +
                                        "<div class='right-flow'></div>");
                        }

                    // highlight first word
                    $( '.wrap-first-word h6, .slider-text-middle span' ).each(function() {
                        var me = $(this);
                        me.html(me.text().replace(/(^\w+)/, '<strong class="first-word">$1</strong>'));
                    });

                    // refresh waypoint triggers
                    setTimeout(function() {
                      Waypoint.refreshAll();
                    }, 2000);

                }, 2000);

            })

            .done( function( instance ) {
                console.log('all images loaded');
            })

            .fail( function() {
                console.log( 'all images loaded, at least one is broken' );
                logoWaypoints();
            })
    });

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
