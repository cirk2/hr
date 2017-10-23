(function ($) {
    'use strict';

    console.log('before first-word');

    $('.wrap-first-word h6, .slider-text-middle span').each(function(){
      var me = $(this);
      me.html( me.text().replace(/(^\w+)/,'<span class="first-word">$1</span>') );
    });

    console.log('after first-word');

    function addShapeDivs() {
        $('.custom-post-grid .vc_gitem-link p').before("<div class=left-flow></div><div class=right-flow></div>");
    }
    setTimeout(addShapeDivs, 2000);


    // $('[data-tooltip!=""]').qtip({
    //     content: {
    //         attr: 'data-tooltip'
    //     },
    //     style: 'qtip-bootstrap'
    // });

    // jQuery('.vc_grid-item-mini').toggleClass('vc_is-hover');
    // jQuery('.vc_grid-item').css({"pointerEvents": "none"});


})(jQuery);

