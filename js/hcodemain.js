"use strict";
var $portfolio;
var $masonry_block;
var $portfolio_selectors;
var $blog;

var isMobile = false;
var isiPhoneiPad = false;

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    isMobile = true;
}
if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
    isiPhoneiPad = true;
}

/* For remove conflict */
( function( $ ) {

    $(document).ready(function () {
        
        // HamburgerMenuCustomScroll();

        $(document).on("scroll", OnePageActiveOnScroll);

/*==============================================================*/
//Placeholder For IE - START CODE
/*==============================================================*/

        // $('input, textarea').placeholder({customClass:'my-placeholder'});
    
/*==============================================================*/
//Placeholder For IE - START CODE
/*==============================================================*/
    
/*==============================================================*/
//Smooth Scroll - START CODE
/*==============================================================*/
        $('.inner-top').smoothScroll({
            speed: 900,
            offset: -68
        });
    
/*==============================================================*/
//Set Resize Header Menu - START CODE
/*============================================================*/
    // SetResizeHeaderMenu();

/*==============================================================*/
//Ipad And Mobile Icon Hover - START CODE
/*==============================================================*/
        IpadMobileHover();
          
/*==============================================================*/
//Set Parallax - START CODE
/*==============================================================*/
        SetParallax();
    
/*==============================================================*/
//Sliders owlCarousel - START CODE
/*==============================================================*/

        // jQuery use in Post slide loop
        $(".blog-gallery").owlCarousel({
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        });
        // jQuery use in hcode_feature_product_shop in Shop top five shortcode
        $("#owl-demo-small").owlCarousel({
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        });

    
/*==============================================================*/
//Stop Closing magnificPopup on selected elements - START CODE
/*==============================================================*/

        $(".owl-pagination > .owl-page").click(function (e) {
            if ($(e.target).is('.mfp-close'))
                return;
            return false;
        });
        $(".owl-buttons > .owl-prev").click(function (e) {
            if ($(e.target).is('.mfp-close'))
                return;
            return false;
        });
        $(".owl-buttons > .owl-next").click(function (e) {
            if ($(e.target).is('.mfp-close'))
                return;
            return false;
        });
        

/*==============================================================*/
//WOW Animation  - START CODE
/*==============================================================*/

        // var wow = new WOW({
        //     boxClass: 'wow',
        //     animateClass: 'animated',
        //     offset: 90,
        //     mobile: false,
        //     live: true
        // });
        // wow.init();
    
/*==============================================================*/
//accordion  - START CODE
/*==============================================================*/

        $('.collapse').on('show.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-minus"></i>');
        });
        $('.collapse').on('hide.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-plus"></i>');
        });
        $('.nav.navbar-nav a.inner-link').click(function () {
            $(this).parents('ul.navbar-nav').find('a.inner-link').removeClass('active');
            $(this).addClass('active');
            if ($('.navbar-header .navbar-toggle').is(':visible'))
                $(this).parents('.navbar-collapse').collapse('hide');
        });
        $('.accordion-style2 .collapse').on('show.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
        });
        $('.accordion-style2 .collapse').on('hide.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
        });
        $('.accordion-style3 .collapse').on('show.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
        });
        $('.accordion-style3 .collapse').on('hide.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
        });
    
/*==============================================================*/
//toggles  - START CODE
/*==============================================================*/

        $('toggles .collapse').on('show.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-minus"></i>');
        });
        $('toggles .collapse').on('hide.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-plus"></i>');
        });
        $('.toggles-style2 .collapse').on('show.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
        });
        $('.toggles-style2 .collapse').on('hide.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
        });
    
/*==============================================================*/
//fit video  - START CODE
/*==============================================================*/
        
        try {
            $(".fit-videos").fitVids();
        }
        catch (err) {

        }

    
/*==============================================================*/
//google map - mouse scrolling wheel behavior - START CODE
/*============================================================*/
    // you want to enable the pointer events only on click       $('#map_canvas1').addClass('scrolloff'); // set the pointer events to none on doc ready
        $('#canvas1').on('click', function () {
            $('#map_canvas1').removeClass('scrolloff'); // set the pointer events true on click
        });
        // you want to disable pointer events when the mouse leave the canvas area;

        $("#map_canvas1").mouseleave(function () {
            $('#map_canvas1').addClass('scrolloff'); // set the pointer events to none when mouse leaves the map area
        });
    
/*==============================================================*/
//Search - START CODE
/*==============================================================*/

        // $('#top-search').on('click', function(event) {
        //     event.stopImmediatePropagation;
        //     $.magnificPopup.proto.close.call(this);
        // });

        $('div').off('click', '.mfp-bg');
        $(window).on('click', '.mfp-bg', function(event) {
          event.preventDefault();

        });

        $("input.search-input").bind("keypress", function (event) {
            if (event.which == 13 && !isMobile) {
                $("button.search-button").click();
                event.preventDefault();
            }
        });
        $("input.search-input").bind("keyup", function (event) {
            if ($(this).val() == null || $(this).val() == "") {
                $(this).css({"border": "none", "border-bottom": "2px solid red"});
            }
            else {
                $(this).css({"border": "none", "border-bottom": "2px solid #000"});
            }
        });
        function validationSearchForm() {
            var error = true;
            $('#search-header input[type=text]').each(function (index) {
                if (index == 0) {
                    if ($(this).val() == null || $(this).val() == "") {
                        $("#search-header").find("input:eq(" + index + ")").css({"border": "none", "border-bottom": "2px solid red"});
                        error = false;
                    }
                    else {
                        $("#search-header").find("input:eq(" + index + ")").css({"border": "none", "border-bottom": "2px solid #000"});
                    }
                }
            });
            return error;
        }
        $("form.search-form, form.search-form-result").submit(function (event) {
            var error = validationSearchForm();
            if (error) {
                var action = $(this).attr('action');
                action = action + '?' + $(this).serialize();
                window.location = action;
            }

            event.preventDefault();
        });

        // $('.navbar .navbar-collapse a.dropdown-toggle, .accordion-style1 .panel-heading a, .accordion-style2 .panel-heading a, .accordion-style3 .panel-heading a, .toggles .panel-heading a, .toggles-style2 .panel-heading a, .toggles-style3 .panel-heading a, a.carousel-control, .nav-tabs a[data-toggle="tab"], a.shopping-cart').click(function (e) {
        //     e.preventDefault();
        // });
        // $('body').on('touchstart click', function (e) {
        //     if ($(window).width() < 992) {
        //         if (!$('.navbar-collapse').has(e.target).is('.navbar-collapse') && $('.navbar-collapse').hasClass('in') && !$(e.target).hasClass('navbar-toggle')) {
        //             $('.navbar-collapse').collapse('hide');
        //         }
        //     }
        //     else {
        //         if (!$('.navbar-collapse').has(e.target).is('.navbar-collapse') && $('.navbar-collapse ul').hasClass('in')) {
        //             $('.navbar-collapse').find('a.dropdown-toggle').addClass('collapsed');
        //             $('.navbar-collapse').find('ul.dropdown-menu').removeClass('in');
        //             $('.navbar-collapse a.dropdown-toggle').removeClass('active');
        //         }
        //     }
        // });
        // $('.navbar-collapse a.dropdown-toggle').on('touchstart', function (e) {
        //     $('.navbar-collapse a.dropdown-toggle').not(this).removeClass('active');
        //     if ($(this).hasClass('active'))
        //         $(this).removeClass('active');
        //     else
        //         $(this).addClass('active');
        // });

        // $("button.navbar-toggle").click(function () {
        //     if (isMobile) {
        //         $(".cart-content").css('opacity', '0');
        //         $(".cart-content").css('visibility', 'hidden');
        //     }
        // });
        // $("a.dropdown-toggle").click(function () {
        //     if (isMobile) {
        //         $(".cart-content").css('opacity', '0');
        //         $(".cart-content").css('visibility', 'hidden');
        //     }
        // });

    
/*==============================================================*/
//Parallax - START CODE
/*==============================================================*/

        var $elem = $('#content');
        $('#scroll_to_top').fadeIn('slow');
        $('#nav_down').fadeIn('slow');
        $(window).bind('scrollstart', function () {
            $('#scroll_to_top,#nav_down').stop().animate({'opacity': '0.2'});
        });
        $(window).bind('scrollstop', function () {
            $('#scroll_to_top,#nav_down').stop().animate({'opacity': '1'});
        });
        $('#nav_down').click(
                function (e) {
                    $('html, body').animate({scrollTop: $elem.height()}, 800);
                }
        );
        $('#scroll_to_top').click(
                function (e) {
                    $('html, body').animate({scrollTop: '0px'}, 800);
                }
        );
        
        // pull-menu close on href click event in mobile devices
        $( document ).on( 'click', '.pull-menu a.inner-link', function (e) {
            if( !( $( this ).parents( '.hamburger-menu1' ).length > 0 ) || isMobile ) {
                $('#close-button').click();
            }
        });

        // if( $('div').hasClass('feature_nav')){
        //     $(".feature_nav .next").click(function () {
        //         $(this).parent().parent().find('.owl-carousel').trigger('owl.next');
        //     });
        //     $(".feature_nav .prev").click(function () {
        //         $(this).parent().parent().find('.owl-carousel').trigger('owl.prev');
        //     });
        // }
    });

/*==============================================================*/
// Counter Number Appear - START CODE
/*==============================================================*/

    // if (php_vars.countdownTimer) {

    //     console.log('countdown timer active');

    //     $(document).ready(function () {
    //         // Check counter div is visible then animate counter
    //         $('.counter-number').appear();
    //         $(document.body).on('appear', '.counter-number', function (e) {
    //             // this code is executed for each appeared element
    //             var element = $(this);
    //             if (!$(this).hasClass('appear')) {
    //                 animatecounters(element);
    //                 $(this).addClass('appear');
    //             }
    //         });

    //         // Check chart div is visible then animate chart
    //         $('.chart').appear();
    //         $(document.body).on('appear', '.chart', function (e) {
    //             // this code is executed for each appeared element
    //             var element = $(this);
    //             if (!$(this).hasClass('appear')) {
    //                 animatecharts(element);
    //                 $(this).addClass('appear');
    //             }
    //         });
    //     });

        
    /*==============================================================*/
    //Counter Number - START CODE
    /*==============================================================*/

    //     function animatecounters(element) {
    //          var getCounterNumber = $(element).attr('data-to');
    //          $({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: getCounterNumber },
    //          {
    //              duration: 2000,
    //              easing: "swing",
    //              step: function (currentLeft) {
    //                  var roundNumber = Math.ceil( currentLeft );
    //                  $(element).text( roundNumber );
    //              }
    //          });
    //     }
    // }


/*==============================================================*/
//Parallax - START CODE
/*==============================================================*/
// Parallax Fix Image Scripts 

    $('.parallax-fix').each(function () {
        if ($(this).children('.parallax-background-img').length) {
            var imgSrc = $(this).children('.parallax-background-img').attr('src');
            $(this).css('background', 'url("' + imgSrc + '")');
            $(this).children('.parallax-background-img').remove();
            $(this).css('background-position', '50% 0%');
        }

    });
    var IsParallaxGenerated = false;
    function SetParallax() {

        if( isiPhoneiPad )
            return false;

        if ($(window).width() > 1030 && !IsParallaxGenerated) {
            $('.parallax1').parallax("50%", 0.1);
            $('.parallax2').parallax("50%", 0.2);
            $('.parallax3').parallax("50%", 0.3);
            $('.parallax4').parallax("50%", 0.4);
            $('.parallax5').parallax("50%", 0.5);
            $('.parallax6').parallax("50%", 0.6);
            $('.parallax7').parallax("50%", 0.7);
            $('.parallax8').parallax("50%", 0.8);
            $('.parallax9').parallax("50%", 0.05);
            $('.parallax10').parallax("50%", 0.02);
            $('.parallax11').parallax("50%", 0.01);
            $('.parallax12').parallax("50%", 0.099);
            IsParallaxGenerated = true;
        }
    }

/*==============================================================*/
//Mobile Toggle Control - START CODE
/*==============================================================*/

        $('.mobile-toggle').click(function () {
            $('nav').toggleClass('open-nav');
        });
        $('.dropdown-arrow').click(function () {
            if ($('.mobile-toggle').is(":visible")) {
                if ($(this).children('.dropdown').hasClass('open-nav')) {
                    $(this).children('.dropdown').removeClass('open-nav');
                } else {
                    $('.dropdown').removeClass('open-nav');
                    $(this).children('.dropdown').addClass('open-nav');
                }
            }
        });

/*==============================================================*/
//Contact Form Focus Remove Border- START CODE
/*==============================================================*/

        // $("form.wpcf7-form input").focus(function () {
        //     if ($(this).hasClass("wpcf7-not-valid")) {
        //         $(this).removeClass("wpcf7-not-valid");
        //         $(this).parent().find(".wpcf7-not-valid-tip").remove();
        //         $(this).parents().find(".wpcf7-validation-errors").css("display", "none"); 
        //     }
        // });

/*==============================================================*/
//Position Fullwidth Subnavs fullwidth correctly - START CODE
/*==============================================================*/
// $('.dropdown-fullwidth').each(function () {
//     $(this).css('width', $('.row').width());
    //     var subNavOffset = -($('nav .row').innerWidth() - $('.menu').innerWidth() - 15);
    //     $(this).css('left', subNavOffset);
    // });

/*==============================================================*/
//Smooth Scroll - START CODE
/*==============================================================*/

        var scrollAnimationTime = 1200,
            scrollAnimation = 'easeInOutExpo';
        $('a.scrollto').bind('click.smoothscroll', function (event) {
            event.preventDefault();
            var target = this.hash;
            $('html, body').stop()
                    .animate({
                        'scrollTop': $(target)
                                .offset()
                                .top
                    }, scrollAnimationTime, scrollAnimation, function () {
                        window.location.hash = target;
                    });
        });

        // Inner links
        $(document).ready(function () {
            $('.inner-link').smoothScroll({
                speed: 900,
                offset: -0
            });
        });

        $(document).ready(function () {
            // Stop Propagation After Button Click
            $('.scrollToDownSection .inner-link, .scrollToDownSection form').click(function(event) {
                event.stopPropagation();
            });

            $('section.scrollToDownSection').click(function(){
               var section_id = $( $(this).attr('data-section-id') );
               $('html, body').animate({scrollTop: section_id.offset().top}, 800);
            });
        });
        // Single Product Readmore button link
        $('.woo-inner-link').click(function(){
            $(this).attr("data-toggle","tab");
            $("html,body").animate({scrollTop:$(".product-deails-tab").offset().top - 80 }, 1000);
            $(".nav-tabs-light li").removeClass("active");
            $(".nav-tabs-light li.description_tab ").addClass("active");
        });


/*==============================================================*/
//Full Screen Header - START CODE
/*==============================================================*/

        function SetResizeContent() {
             var minheight = $(window).height();
             $(".full-screen").css('min-height', minheight);

             var minwidth = $(window).width();
             $(".full-screen-width").css('min-width', minwidth);

             $('.menu-first-level').each(function () {
                 $(this).find('ul.collapse').removeClass('in');
                 var menu_link = $(this).children('a');
                 var dataurl = menu_link.attr('data-redirect-url');
                 var datadefaulturl = menu_link.attr('data-default-url');
                 // if (minwidth >= 992) {
                     $(menu_link).removeAttr('data-toggle');
                     $(this).children('a').attr('href', dataurl);
                 // } else {
                     // $(menu_link).attr('data-toggle', 'collapse');
                     // $(this).children('a').attr('href', datadefaulturl);
                 // }
             });
        }

    SetResizeContent();
    

/*==============================================================*/
//Window Resize Events - START CODE
/*==============================================================*/
    $(window).resize(function () {

        // HamburgerMenuCustomScroll();

        //Position Fullwidth Subnavs fullwidth correctly
        $('.dropdown-fullwidth').each(function () {
            $(this).css('width', $('.row').width());
            var subNavOffset = -($('nav .row').innerWidth() - $('.menu').innerWidth() - 15);
            $(this).css('left', subNavOffset);
        });
        SetResizeContent();
        // setTimeout(function () {
        //     SetResizeHeaderMenu();
        // }, 200);

        if ($(window).width() >= 992 && $('.navbar-collapse').hasClass('in')) {
            $('.navbar-collapse').removeClass('in');
            //$('.navbar-collapse').removeClass('in').find('ul.dropdown-menu').removeClass('in').parent('li.dropdown').addClass('open');
            $('.navbar-collapse ul.dropdown-menu').each(function () {
                if ($(this).hasClass('in')) {
                    $(this).removeClass('in'); //.parent('li.dropdown').addClass('open');
                }
            });
            $('ul.navbar-nav > li.dropdown > a.dropdown-toggle').addClass('collapsed');
            $('.logo').focus();
            $('.navbar-collapse a.dropdown-toggle').removeClass('active');
        }

        setTimeout(function () {
            SetParallax();
        }, 1000);
    });

/*==============================================================*/
//Scroll To Top - START CODE
/*==============================================================*/
    $(window).scroll(function () {
        if ($(this)
                .scrollTop() > 100) {
            $('.scrollToTop')
                    .fadeIn();
        } else {
            $('.scrollToTop')
                    .fadeOut();
        }
    });
    //Click event to scroll to top
    $('.scrollToTop').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });

/*=============================================================*/
//  Hamburger Menu 2
/*=============================================================*/

    $('nav ul.panel-group li.dropdown a.dropdown-toggle').click(function () {

        if ($(this).parent('li').find('ul.dropdown-menu').length > 0) {
            $(this).parents('ul').find('li.dropdown-toggle').not($(this).parent('li')).removeClass('open');
            if ($(this).parent('li').hasClass('open')) {
                $(this).parent('li').removeClass('open');
            }
            else {
                $(this).parent('li').addClass('open');
            }
        }
    });

    $('.hamburger-menu2 a.megamenu-right-icon, .hamburger-menu3 a.megamenu-right-icon').click(function () {

        if ($(this).parents('li').find('ul.sub-menu').length > 0) {
            
            if ($(this).hasClass('open')) {
                $(this).removeClass('open');
                $(this).next().slideUp();
            }
            else {
                $(this).addClass('open');
                $(this).next().slideDown();
            }
        }
        return false;
    });


/*==============================================================*/
// NewsLetter Validation - START CODE
/*==============================================================*/

    // $('.submit_newsletter').click(function () {
    //     var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    //     var current = $(this);
    //     var address = $(this).closest('form').find('.xyz_em_email').val();
    //     if(reg.test(address) == false) {
    //         //alert('Please check whether the email is correct.');
    //         current.closest('form').find('.xyz_em_email').addClass('newsletter-error');
    //     return false;
    //     }else{
    //     //document.subscription.submit();
    //     return true;
    //     }
    // });

    // $('.xyz_em_email').on('focus', function(){
    //   $(this).removeClass('newsletter-error');
    // });

    
/*==============================================================*/
// Post Like Dislike Button JQuery - START CODE
/*==============================================================*/

        // $(document).ready(function () {
        //     $(document).on('click', '.sl-button', function() {
        //         var button = $(this);
        //         var post_id = button.attr('data-post-id');
        //         var security = button.attr('data-nonce');
        //         var iscomment = button.attr('data-iscomment');
        //         var allbuttons;
        //         if ( iscomment === '1' ) { /* Comments can have same id */
        //             allbuttons = $('.sl-comment-button-'+post_id);
        //         } else {
        //             allbuttons = $('.sl-button-'+post_id);
        //         }
        //         var loader = allbuttons.next('#sl-loader');
        //         if (post_id !== '') {
        //             $.ajax({
        //                 type: 'POST',
        //                 url: simpleLikes.ajaxurl,
        //                 data : {
        //                     action : 'process_simple_like',
        //                     post_id : post_id,
        //                     nonce : security,
        //                     is_comment : iscomment
        //                 },
        //                 beforeSend:function(){
        //                 },  
        //                 success: function(response){
        //                     var icon = response.icon;
        //                     var count = response.count;
        //                     allbuttons.html(icon+count);
        //                     if(response.status === 'unliked') {
        //                         var like_text = simpleLikes.like;
        //                         allbuttons.prop('title', like_text);
        //                         allbuttons.removeClass('liked');
        //                     } else {
        //                         var unlike_text = simpleLikes.unlike;
        //                         allbuttons.prop('title', unlike_text);
        //                         allbuttons.addClass('liked');
        //                     }
        //                     loader.empty();                 
        //                 }
        //             });
                    
        //         }
        //         return false;
        //     });
        // });

/*==============================================================*/
// Menu Icon Click jQuery - START CODE
/*==============================================================*/

        // $(document).ready(function () {
        //      $( '.menu-first-level a.dropdown-toggle:first-of-type' ).bind( 'click', function (event) {
        //          var minwidth = $(window).width();
        //          if (minwidth >= 992) {
        //             var geturl = $(this).attr('href');
        //             if((typeof geturl) !== 'undefined' ){
        //                  if (event.ctrlKey || event.metaKey) {
        //                      if (geturl != '#' && geturl != '') {
        //                          window.open(geturl, '_blank');
        //                      }
        //                  } else {
        //                      if (geturl != '#' && geturl != '') {
        //                          if ($(this).attr('target') == '_blank') {
        //                              window.open(geturl, '_blank');
        //                          } else {
        //                              window.location.href = geturl;
        //                          }
        //                      }
        //                  }
        //             }
        //          } else {
        //             var geturl = $(this).attr('data-redirect-url');
        //             if((typeof geturl) !== 'undefined' ){
        //                  if (event.ctrlKey || event.metaKey) {
        //                      if (geturl != '#' && geturl != '') {
        //                          window.open(geturl, '_blank');
        //                      }
        //                  } else {
        //                      if (geturl != '#' && geturl != '') {
        //                          if ($(this).attr('target') == '_blank') {
        //                              window.open(geturl, '_blank');
        //                          } else {
        //                              window.location.href = geturl;
        //                          }
        //                      }
        //                  }
        //              }
        //          }
        //      });
        // });
    
/*==============================================================*/
// Menu Icon Add jQuery - START CODE
/*==============================================================*/
    // $(document).ready(function () {
    //     if($("li.menu-item-language").find("ul").first().length != 0){
    //         $("li.menu-item-language a:first").append("<i class='fa fa-angle-down'></i>");
    //     }
    // });

/*==============================================================*/
// Comment Validation - START CODE
/*==============================================================*/

    // $(document).ready(function () {
      
    //     $(".comment-button").on("click", function () {
    //         var fields;
    //             fields = "";
    //         if($(this).parent().parent().find('#author').length == 1) {
    //             if ($("#author").val().length == 0 || $("#author").val().value == '')
    //             {
    //                 fields ='1';
    //                 $("#author").addClass("inputerror");
    //             }
    //         }
    //         if($(this).parent().parent().find('#comment').length == 1) {
    //             if ($("#comment").val().length == 0 || $("#comment").val().value == '')
    //             {
    //                 fields ='1';
    //                 $("#comment").addClass("inputerror");
    //             }
    //         }
    //         if($(this).parent().parent().find('#email').length == 1) {
    //             if ($("#email").val().length == 0 || $("#email").val().length =='')
    //             {
    //                 fields ='1';
    //                 $("#email").addClass("inputerror");
    //             }
    //             else
    //                 {
    //                     var re = new RegExp();
    //                     re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    //                     var sinput ;
    //                     sinput= "" ;
    //                     sinput = $("#email").val();
    //                     if (!re.test(sinput))
    //                     {
    //                         fields ='1';
    //                         $("#email").addClass("inputerror");
    //                     }
    //                 }
    //         }
    //         if(fields !="")
    //         {
    //             return false;
    //         }           
    //         else
    //         {
    //             return true;
    //         }
    //     });

    // });
    // function inputfocus(id){
    //     $('#'+id).removeClass('inputerror');
    // }
    
    var IpadMobileHover = function () {
      if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
          $('.icon-box > i').on('touchstart', function () {
              $(this).trigger('hover');
          }).on('touchend', function () {
              $(this).trigger('hover');
          });
      }
    };


/*==============================================================*/
// Add extra class into menu - START CODE
/*==============================================================*/

    // $(document).ready(function () {
    //     hcodeMobileMenuDynamicClass();
    // });

    // $(window).resize(function () {
    //     hcodeMobileMenuDynamicClass();
    // });

    // function hcodeMobileMenuDynamicClass() {
    //     if (window.matchMedia('(max-width: 991px)').matches) {
    //         $( '.accordion-menu' ).addClass( 'mobile-accordion-menu' );
    //     } else {
    //         $( '.accordion-menu' ).removeClass( 'mobile-accordion-menu' );
    //     }
    // }


/*==============================================================*/
// Infinite Scroll jQuery - START CODE
/*==============================================================*/

    if (php_vars.infiniteScroll) {

        console.log("infinite scroll active");

        var pagesNum = $("div.hcode-infinite-scroll").attr('data-pagination');
        $(document).ready(function(){
            $('.infinite-scroll-pagination').infinitescroll({
                nextSelector: 'div.hcode-infinite-scroll a',
                loading: {
                    // img: hcodeajaxurl.loading_image,
                    img: '',
                    msgText: '<div class="paging-loader" style="transform:scale(0.35);"><div class="circle"><div></div></div><div class="circle"><div></div></div><div class="circle"><div></div></div><div class="circle"><div></div></div></div>',
                    // finishedMsg: '<div class="finish-load">' + hcode_infinite_scroll_message.message + '</div>',
                    finishedMsg: '<div class="finish-load">' + 'Alle Posts geladen' + '</div>',
                    speed: 'fast',
                },
                navSelector: 'div.hcode-infinite-scroll',
                contentSelector: '.infinite-scroll-pagination',
                itemSelector: '.infinite-scroll-pagination div.blog-single-post',
                maxPage: pagesNum,
            }, function (newElements) {
                $('.hcode-infinite-scroll').remove();
                $('#infscr-loading').remove();
                /* For new element set masonry */
                var $newblogpost = $(newElements);
                // append other items when they are loaded
                $newblogpost.imagesLoaded( function() {
                $('.blog-masonry').append( $newblogpost )
                  .isotope( 'appended', $newblogpost );
                });

                try {
                    $(".fit-videos").fitVids();
                }catch (err) { }

                /* For owl slider */
                $(".blog-gallery").owlCarousel({
                    navigation: true, // Show next and prev buttons
                    slideSpeed: 300,
                    paginationSpeed: 400,
                    singleItem: true,
                    navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                });
                /* For Magnific Popup */
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
                                        $('button.mfp-close').click(function() {
                                            $.magnificPopup.proto.close.call(this);
                                        });
                                    }
                                }
                            }
                        }
                    });
                });
            });
        });

    }

/*==============================================================*/
// Custom Scroll Bar - START CODE
/*==============================================================*/

    // function HamburgerMenuCustomScroll() {

    //     var windowHeight = $(window).height();
    //     $(".hamburger-menu1 .navbar-default").css('height', ( windowHeight / 2 ) );

    //     $(".hamburger-menu1 .navbar-default").mCustomScrollbar({
    //         scrollInertia: 100,
    //         scrollButtons:{
    //             enable:false
    //         },
    //         keyboard:{
    //             enable: true
    //         },
    //         mouseWheel:{
    //             enable:true,
    //             scrollAmount:200
    //         },
    //         callbacks:{
    //             whileScrolling:function(){
    //             },
    //         }
    //     });
    // }

    
/*=============================================================*/
//  Hamburger Menu 1 Auto Active Menu - START CODE
/*=============================================================*/

        function OnePageActiveOnScroll(event){
            var scrollPos = $(document).scrollTop();
            $('.navigation-menu a.inner-link, .navbar a.inner-link').each(function () {
                var currLink = $(this);
                var refElement = $(currLink.attr("href"));
                if( refElement.length > 0 ) {
                    if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
                        $('a.inner-link').removeClass("active");
                        currLink.addClass("active");
                    }
                    else{
                        currLink.removeClass("active");
                    }
                }
            });
        }

        
/*==========================================================*/
//  One Page Main JS - START CODE
/*==========================================================*/

        $(window).load(function () {
            init_scroll_navigate();

            $(window).trigger("scroll");
            $(window).trigger("resize");
        });
        function init_scroll_navigate() {
            var sections = $(".parent-section .row > section");
            var menu_links = $(".navbar-nav li a");

            $(window).scroll(function () {
                setTimeout(function () {
                    sections.filter(":in-viewport:first").each(function () {
                        var active_section = $(this);
                        var active_link = $('.navbar-nav li a[href="#' + active_section.attr("id") + '"]');
                        menu_links.removeClass("active");
                        active_link.addClass("active");

                    });
                }, 500);
            });
        }

    
})( jQuery );
