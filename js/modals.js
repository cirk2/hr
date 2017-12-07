/**
 * Custom Ajax Modal Plugin
 *
 * @package H-Code
 * @author  reflect.media GmbH
 *
 */

(function ($) {

    'use strict';

    $(function () {

        var modalOpen = false;

        function hideModal() {
            $('.modal-wrapper, .modal').removeClass('show');
            $('#btnContainer').removeClass('open');
            setTimeout(function() {
              $('.modal-wrapper').hide(0);
              $('#modal-content').html('');
              $('html').removeClass('modal-is-open');
            }, 500);
        }

        $(document).keydown(function (e) {
            if (e.keyCode === 27 && $('.modal-wrapper').hasClass('show')) {
                hideModal();
            }
        });

        $(document).on('click', '.close-modal', hideModal);
       
        $(window).click(function(event) {
          if (!$('body').hasClass('show-menu')) {
            hideModal();
          }
        });

        $(document).on('click', '.modal', function (e) {
            e.stopPropagation();
        });

        // remove click handlers
        $('.vc_basic_grid').off("click", ".vc_gitem-link");
        $('body').off('click', '.modal-link');

        $('body').on('click', '.modal-link', function (event) {

            var modalOpen = $('html').hasClass('modal-is-open');

            event.stopImmediatePropagation();

            if ($(this).hasClass('small-modal')) {
                $('.modal-wrapper').addClass('modal-small');
            } else {
                $('.modal-wrapper').removeClass('modal-small');
            }
            var modalContent = $('#modal-content');
            var $this = ($(this).attr('href') != null) ? $(this) : $(this).children('a').first();
            var postLink = $this.attr('href');
            // var loader = '<div class="glass-container"><div class="glass-mask"><div class="glass"><div class="fill"></div></div></div></div>';
            var loader = '<svg id="wineLoader" xmlns="http://www.w3.org/2000/svg" width="86" height="160" viewBox="0 0 100 200" fill="none" opacity="0.5"> <path id="glassShape" transform="translate(-0.5,-0.5)"  stroke="#B5F0E8" stroke-opacity=".7" stroke-width="5" d="M8.13 20h84.3c.98 29.1-3.73 48.87-14.15 59.28C70.35 87.22 59.9 91.13 49.5 91c-10.07-.13-20.1-4.03-27.78-11.72C11.3 68.88 6.77 49.1 8.12 20zm42.52 75.5v81h-.5v-81h.5zM16.5 178.9h68v.1h-68v-.1z"/> <path id="wineFill" fill="#e3001a" fill-rule="nonzero" d="M50 51c11.67-6.6 23.33-6.6 35 0 0 19.32-15.67 35-35 35S15 70.3 15 51c11.67 6.57 23.33 6.57 35 0z"> <animate attributeName="d" calcMode="spline" values="M15 50 Q32.5 40 50 50 Q67.5 60 85 50 A35 35 0 0 1 15 50;M15 50 Q32.5 60 50 50 Q67.5 40 85 50 A35 35 0 0 1 15 50;M15 50 Q32.5 40 50 50 Q67.5 60 85 50 A35 35 0 0 1 15 50" keyTimes="0;0.5;1" dur="2" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" begin="0s" repeatCount="indefinite"/> </path> </svg>';
            
            modalContent.html(loader);

            event.preventDefault();

            modalContent.load(postLink + ' #modal-ready', function( status ) {

                // wrap first part of excerpt
                var excLength = 180;
                $(".modal-excerpt p").text(function (i,text) {
                  var first = text.substring(0, text.indexOf(' ', excLength)),
                      last  = text.substring(text.indexOf(' ', excLength));
                  $(this).html('<span class="grid-excerpt">' + first + ' [...] </span>' + last);
                });

                // var devHeight = window.innerHeight;
                // var devWidth = window.innerWidth;

                // if (devHeight <= 736 && devWidth <= 414) {
                //   var opts = {
                //       offset: '80%',
                //       context: '.modal'
                //   };
                // } else {
                  var opts = {
                      offset: '80%',
                      context: '.modal'
                  };
                // }

                $('.rebsorte-status').waypoint(function(event, direction) {
                    console.log('modal-waypoint hit');
                    $('.progress-bar').addClass('animated');
                }, opts);

                // var waypoints = $('.rebsorte-status').waypoint({
                //   handler: function() {
                //     console.log('modal-waypoint loaded');
                //     $('.rebsorte-status').addClass('animated');
                //   },
                //   context: '.modal',
                //   offset: '50%'
                // })
            });
            // $('.navbar-default').addClass('shrink-nav');

            $('html').addClass('modal-is-open');
            $('#btnContainer').addClass('open');
            setTimeout(function() {
              $('.modal-wrapper, .modal').addClass('show');
            }, 100);

            return false;
        });
    });

})(jQuery);
