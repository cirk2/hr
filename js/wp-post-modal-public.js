(function ($) {

    'use strict';

    /**
     * Basename function for JS
     *
     * @param path
     * @param suffix
     * @returns {*}
     */
    function basename(path, suffix) {
        var b = path;
        var lastChar = b.charAt(b.length - 1);
        if (lastChar === '/' || lastChar === '\\') {
            b = b.slice(0, -1);
        }
        b = b.replace(/^.*[/\\]/g, '');
        if (typeof suffix === 'string' && b.substr(b.length - suffix.length) === suffix) {
            b = b.substr(0, b.length - suffix.length);
        }
        return b;
    }

    $(function () {

        // Detect windows width function
        var $window = $(window);

        /**
         * Close modal functionality
         */
        function hideModal() {
            // $('.modal').removeClass('show');
            $('.modal-wrapper').fadeOut('slow').removeClass('show');
            $('#modal-content').html('');
            $('html').removeClass('modal-is-open');
        }
        // when pressing esc
        $(document).keydown(function (e) {
            if (e.keyCode === 27 && $('.modal-wrapper').hasClass('show')) {
                hideModal();
            }
        });
        // when clicking on close button
        $(document).on('click', '.close-modal', hideModal);
        // when clicking outside of modal
        $(window).on('click', hideModal);

        $(document).on('click', '.modal', function (e) {
            e.stopPropagation();
        });


        function checkWidth() {
            // remove click handler
            $('.vc_basic_grid').off("click", ".vc_gitem-link");

            $('body').off('click', '.modal-link');

            $('body').on('click', '.modal-link', function (event) {

                event.stopImmediatePropagation();

                if ($(this).hasClass('small-modal')) {
                    $('.modal-wrapper').addClass('modal-small');
                } else {
                    $('.modal-wrapper').removeClass('modal-small');
                }
                // Define variables
                var modalContent = $('#modal-content');
                var $this = ($(this).attr('href') != null) ? $(this) : $(this).children('a').first();
                var postLink = $this.attr('href');
                var postUrl = $this[0].pathname.substring(1);
                var postSlug = basename(postLink);
                // var loader = '<section> <div class="grid-container"> <header class="custom-post-header"> <div class="watermark"> <svg class="section-logo-svg animate-path" width="152" height="158" viewBox="0 0 152 158" xml:space="preserve"> <use class="animate-draw draw-frame" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-frame" style="stroke-dasharray: 521px; stroke-dashoffset: 521px;"></use> <use class="animate-draw draw-mark" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-1" style="stroke-dasharray: 585px; stroke-dashoffset: 585px;"></use> <use class="animate-draw draw-mark" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-2" style="stroke-dasharray: 626px; stroke-dashoffset: 626px;"></use> <use class="animate-draw draw-mark" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-3" style="stroke-dasharray: 439px; stroke-dashoffset: 439px;"></use> <use class="animate-draw draw-mark" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-mark-4" style="stroke-dasharray: 82px; stroke-dashoffset: 82px;"></use> </svg> </div> </header> </div> </section>';
                var loader = '<div class="glass-container"><div class="glass-mask"><div class="glass"><div class="fill"></div></div></div></div>';
                // prevent link from being followed
                event.preventDefault();
                // show loader
                modalContent.html(loader);
                // Load content from internal
                modalContent.load(postLink + ' #modal-ready');
                // add class to display the previously hidden modal
                $('html').addClass('modal-is-open');
                $('.modal-wrapper').fadeIn('slow', function () {
                    $(this).addClass('show');
                    $('.modal').addClass('show');
                });
                // if (e.isDefaultPrevented()) {
                //     e.stopPropagation();
                // }
                return false;
            });
        };
        // checkWidth();
        $(window).resize(checkWidth);
    });
})(jQuery);
