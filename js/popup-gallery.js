/* =================================
 Popup Gallery
 ==================================== */


( function( $ ) {

"use strict";
    function ScrollStop() {
        return false;
    }
    function ScrollStart() {
        return true;
    }

    $(document).ready(function () {
        var isMobile = false;
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            isMobile = true;
        }
        
        $('.header-search-form').magnificPopup({
            closeOnContentClick: false,
            closeOnBgClick: false,
            modal: true,
            removalDelay: 500,
            preloader: false,
            whitebg: true,
            fixedContentPos: true,
            mainClass: 'mfp-zoom-out',
            callbacks: {
                open: function () {
                  setTimeout(function () { 
                  $('.search-input').focus(); 
                    if (isMobile) {
                      $(window).on('touchstart', '.mfp-bg', function(event) {
                        event.preventDefault();
                        $('.search-input').focus(); 
                      });
                    }
                  }, 500);

                    $('#search-header').parent().addClass('search-popup');
                    $('body').addClass('mfp-search-open');
                     
                    if (!isMobile) {
                        document.onmousewheel = ScrollStop;
                    } else {
                        $('body, html').on('touchmove', function(e){
                            e.preventDefault();
                        });
                    }
                    $('#search-header input').on('keydown', function(e) {
                        var $searchval = this.value;
                        $('.main-search input').val($searchval);
                    });

                },
                close: function () {
                    if(!isMobile){
                        $('#search-header input[type=text]').each(function (index) {
                            if (index == 0) {
                                $(this).val('');
                                $("#search-header").find("input:eq(" + index + ")").css({ "border": "none", "border-bottom": "2px solid #000" });
                            }
                        });
                        document.onmousewheel = ScrollStart;
                    } else {
                         $('body, html').unbind('touchmove');
                    }
                    $('body').removeClass('mfp-search-open');
                }
            }
        });
 
        /*==============================================================*/
        //HR Modals
        /*==============================================================*/

        // $('.modal-link').each(function() {
          
        //   $('.vc_basic_grid').off("click", ".vc_gitem-link");
        //   $('body').off('click', '.modal-link');
        //   // event.stopImmediatePropagation();

        //   $(this).magnificPopup({
        //     delegate: 'a',
        //     type: 'ajax',
        //     alignTop: true,
        //     closeOnContentClick: false,
        //     fixedContentPos: true,
        //     closeBtnInside: false,
        //     preloader: true,
        //     midClick: true,
        //     removalDelay: 300,
        //     blackbg: true,
        //     mainClass: 'mfp-zoom-out',
        //     callbacks: {
        //         open: function () {

        //             $('html').addClass('modal-is-open');
        //             $('.navbar-default').addClass('shrink-nav');
        //             $('#btnContainer').addClass('open');

        //             if ($(this).hasClass('small-modal')) {
        //                 $('.modal-wrapper').addClass('modal-small');
        //             } else {
        //                 $('.modal-wrapper').removeClass('modal-small');
        //             }

        //             $.magnificPopup.instance.close = function() {
        //                 if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
        //                     $.magnificPopup.proto.close.call(this);
        //                 } else {
        //                     $( 'button.mfp-close' ).live( 'click', function() {
        //                         $.magnificPopup.proto.close.call(this);
        //                     });
        //                 }
        //             }
        //         },
        //         parseAjax: function(mfpResponse) {
        //           // mfpResponse.data is a "data" object from ajax "success" callback
        //           // for simple HTML file, it will be just String
        //           // You may modify it to change contents of the popup
        //           // For example, to show just #some-element:
        //           // mfpResponse.data = $(mfpResponse.data).find('#some-element');

        //           // mfpResponse.data must be a String or a DOM (jQuery) element

        //           console.log('Ajax content loaded:', mfpResponse);
        //         },
        //         ajaxContentAdded: function() {
        //           // Ajax content is loaded and appended to DOM
        //           console.log(this.content);
        //         }  
        //     }
        //   });

        // });


    });


})( jQuery );
