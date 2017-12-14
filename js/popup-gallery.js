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

        /*==============================================================*/
        //Lightbox gallery - START CODE
        /*==============================================================*/
        var lightboxgallerygroups = {};
        $('.lightboxgalleryitem').each(function() {
          var id = $(this).attr('data-group');
          if(!lightboxgallerygroups[id]) {
            lightboxgallerygroups[id] = [];
          } 
          
          lightboxgallerygroups[id].push( this );
        });


        $.each(lightboxgallerygroups, function() {
            $(this).magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                gallery: { enabled:true },
                image: {
                    titleSrc: function (item) {
                        var title = '';
                        var lightbox_caption = '';
                        if( item.el.attr('title') ){
                            title = item.el.attr('title');
                        }
                        if( item.el.attr('lightbox_caption') ){
                            lightbox_caption = '<span class="hcode-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                        }
                        return title + lightbox_caption;
                    }
                },
                // Remove close on popup bg v1.5
                callbacks: {
                    open: function () {
                        $.magnificPopup.instance.close = function() {
                            if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                                $.magnificPopup.proto.close.call(this);
                            } else {
                                $( 'button.mfp-close' ).live( 'click', function() {
                                    $.magnificPopup.proto.close.call(this);
                                });
                            }
                        }
                    }
                }
            });
        });
        
        $('.header-search-form').magnificPopup({
            // mainClass: 'mfp-fade',
            closeOnBgClick: false,
            removalDelay: 500,
            preloader: false,
            whitebg: true,
            // alignTop: true,
            fixedContentPos: true,
            // closeBtnInside: false,
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

                  // function focusInput() {
                  //     var input = this;
                  //     setTimeout(function () {
                  //         input.selectionStart = 0;
                  //         input.selectionEnd = input.value.length;
                  //     }, 100);
                  // }
                    
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
        //Lightbox gallery - END CODE
        /*==============================================================*/

        /*==============================================================*/
        //Ajax MagnificPopup For Onepage Portfolio - START CODE
        /*==============================================================*/
        $('.simple-ajax-popup-align-top').magnificPopup({
            type: 'ajax',
            alignTop: true,
            closeOnContentClick: false,
            fixedContentPos: true,
            closeBtnInside: false,
            callbacks: {
                open: function () {
                    $('.navbar .collapse').removeClass('in');
                    $('.navbar a.dropdown-toggle').addClass('collapsed');

                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( 'button.mfp-close' ).live( 'click', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                }
            }
        });
        /*==============================================================*/
        //Ajax MagnificPopup For Onepage Portfolio - END CODE
        /*==============================================================*/

        /*==============================================================*/
        //Ajax MagnificPopup For Menu Link - START CODE
        /*==============================================================*/
        $('.hcode-menu-ajax-popup a').magnificPopup({
            type: 'ajax',
            alignTop: true,
            closeOnContentClick: false,
            fixedContentPos: true,
            closeBtnInside: false,
            callbacks: {
                open: function () {
                    $('.navbar .collapse').removeClass('in');
                    $('.navbar a.dropdown-toggle').addClass('collapsed');

                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( 'button.mfp-close' ).live( 'click', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                }
            }
        });
        /*==============================================================*/
        //Ajax MagnificPopup For Menu Link - END CODE
        /*==============================================================*/


        /*==============================================================*/
        //Video MagnificPopup - START CODE
        /*==============================================================*/
        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            callbacks: {
                open: function () {
                    if (!isMobile)
                        $('body').addClass('overflow-hidden');

                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( 'button.mfp-close' ).live( 'click', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                },
                close: function () {
                    if (!isMobile)
                        $('body').removeClass('overflow-hidden');
                }
                // e.t.c.
            }
        });
        /*==============================================================*/
        //Video MagnificPopup - END CODE
        /*==============================================================*/

        /*==============================================================*/
        // magnificPopup - START CODE
        /*==============================================================*/
        $('.popup-youtube-landing').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            // for black backgriund
            blackbg: true,
            fixedContentPos: false,
            callbacks: {
                open: function () {
                    if (!isMobile)
                        $('body').addClass('overflow-hidden');

                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( 'button.mfp-close' ).live( 'click', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                },
                close: function () {
                    if (!isMobile)
                        $('body').removeClass('overflow-hidden');
                }
                // e.t.c.
            }
        });
        /*==============================================================*/
        // magnificPopup - END CODE
        /*==============================================================*/

        /*==============================================================*/
        //Single image lightbox - zoom animation - START CODE
        /*==============================================================*/
        $('.image-popup-no-margins').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            fixedContentPos: true,
            closeBtnInside: false,
            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                        var title = '';
                        var lightbox_caption = '';
                        if( item.el.attr('title') ){
                            title = item.el.attr('title');
                        }
                        if( item.el.attr('lightbox_caption') ){
                            lightbox_caption = '<span class="hcode-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                        }
                        return title + lightbox_caption;
                }
            },
            zoom: {
                enabled: true,
                duration: 300 // don't foget to change the duration also in CSS
            },
            callbacks: {
                open: function () {
                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( 'button.mfp-close' ).live( 'click', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                },
            }
        });
        /*==============================================================*/
        //Single image lightbox - zoom animation - END CODE
        /*==============================================================*/

        /*==============================================================*/
        //Single image -  fits horizontally and vertically - START CODE
        /*==============================================================*/
        $('.image-popup-vertical-fit').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            closeBtnInside: false,
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    var title = '';
                    var lightbox_caption = '';
                    if( item.el.attr('title') ){
                        title = item.el.attr('title');
                    }
                    if( item.el.attr('lightbox_caption') ){
                        lightbox_caption = '<span class="hcode-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                    }
                    return title + lightbox_caption;
                }
            },
            callbacks: {
                open: function () {
                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( 'button.mfp-close' ).live( 'click', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                },
            }
        });
        /*==============================================================*/
        //Single image -  fits horizontally and vertically - END CODE
        /*==============================================================*/

        /*==============================================================*/
        //Zoom gallery - START CODE
        /*==============================================================*/
        $('.product-zoom-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            closeBtnInside: false,
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    var title = '';
                    var lightbox_caption = '';
                    if( item.el.attr('title') ){
                        title = item.el.attr('title');
                    }
                    if( item.el.attr('lightbox_caption') ){
                        lightbox_caption = '<span class="hcode-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                    }
                    return title + lightbox_caption;
                }
            },
            gallery: {
                enabled: true
            },
            callbacks: {
                open: function () {
                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( 'button.mfp-close' ).live( 'click', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                },
            }
        });
        /*==============================================================*/
        //Zoom gallery - END CODE
        /*==============================================================*/

        /*==============================================================*/
        //Zoom gallery - START CODE
        /*==============================================================*/
        
        var lightboxzoomgallerygroups = {};
        $('.lightboxzoomgalleryitem').each(function() {
          var id = $(this).attr('data-group');
          if(!lightboxzoomgallerygroups[id]) {
            lightboxzoomgallerygroups[id] = [];
          } 
          
          lightboxzoomgallerygroups[id].push( this );
        });


        $.each(lightboxzoomgallerygroups, function() {
            $(this).magnificPopup({
                type: 'image',
                mainClass: 'mfp-with-zoom mfp-img-mobile',
                closeBtnInside: false,
                image: {
                    verticalFit: true,
                    titleSrc: function (item) {
                        var title = '';
                        var lightbox_caption = '';
                        if( item.el.attr('title') ){
                            title = item.el.attr('title');
                        }
                        if( item.el.attr('lightbox_caption') ){
                            lightbox_caption = '<span class="hcode-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                        }
                        return title + lightbox_caption;
                    }
                },
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300, // don't foget to change the duration also in CSS
                    opener: function (element) {
                        return element.find('img');
                    }
                },
                callbacks: {
                    open: function () {
                        // Remove close on popup bg v1.5
                        $.magnificPopup.instance.close = function() {
                            if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                                $.magnificPopup.proto.close.call(this);
                            } else {
                                $( 'button.mfp-close' ).live( 'click', function() {
                                    $.magnificPopup.proto.close.call(this);
                                });
                            }
                        }
                    },
                }
            })
        });

        /*==============================================================*/
        //Zoom gallery - END CODE
        /*==============================================================*/

        /*==============================================================*/
        //Popup with form - START CODE
        /*==============================================================*/
        $('.popup-with-form').magnificPopup({
            type: 'inline',
            preloader: false,
            closeBtnInside: true,
            focus: '#name',
            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function () {
                    if ($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                },
                open: function () {
                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( 'button.mfp-close' ).live( 'click', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                },
            }
        });
        /*==============================================================*/
        //Popup with form - END CODE
        /*==============================================================*/

        /*==============================================================*/
        //Modal popup - START CODE
        /*==============================================================*/
        $('.modal-popup').magnificPopup({
            type: 'inline',
            preloader: false,
            // modal: true,
            blackbg: true,
            callbacks: {
                open: function () {
                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( 'button.mfp-close' ).live( 'click', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                },
            }
        });
        $(document).on('click', '.popup-modal-dismiss', function (e) {
            e.preventDefault();
            $.magnificPopup.proto.close.call(this);
        });
        /*==============================================================*/
        //Modal popup - END CODE
        /*==============================================================*/

        /*==============================================================*/
        //Modal popup - zoom animation - START CODE
        /*==============================================================*/
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            blackbg: true,
            mainClass: 'my-mfp-zoom-in',
            callbacks: {
                open: function () {
                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( 'button.mfp-close' ).live( 'click', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                },
            }
        });

        $('.popup-with-move-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            blackbg: true,
            mainClass: 'my-mfp-slide-bottom',
            callbacks: {
                open: function () {
                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( 'button.mfp-close' ).live( 'click', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                },
            }
        });
        /*==============================================================*/
        //Modal popup - zoom animation - END CODE
        /*==============================================================*/

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
