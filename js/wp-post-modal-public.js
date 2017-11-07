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

        /**
         * Close modal functionality
         */
        function hideModal() {
            // $('.modal').removeClass('show');
            $('.modal-wrapper').fadeOut('slow').removeClass('show');
            $('#modal-content').html('');
            $('html').removeClass('modal-open');
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

        // remove click handler from visual composer grid
        $('.vc_basic_grid').off("click", ".vc_gitem-link");
        $('.vc_basic_grid').off("click", ".vc_gitem-link");
        $('.vc_basic_grid').off("click", ".vc-zone-link a");
        $('.vc_basic_grid').off("click", ".vc-zone-link a");
        $('.vc_basic_grid').off("click", ".vc_gitem-is-link");

        // $('div').off("click", ".vc_gitem-link");
        // $('div').off("click", ".vc_gitem-link");
        // $('div').off("click", ".vc-zone-link a");
        // $('div').off("click", ".vc-zone-link a");
        // $('div').off("click", ".vc_gitem-is-link");

        $('body').on('click', '.modal-link', function (e) {

            console.log($(this));

            if ($(this).hasClass('small-modal')) {
                $('.modal-wrapper').addClass('modal-small');
            } else {
                $('.modal-wrapper').removeClass('modal-small');
            }

            // Define variables
            var modalContent = $('#modal-content');
                console.log("modalContent:");
                console.log(modalContent);
            var $this = ($(this).attr('href') != null) ? $(this) : $(this).children('a').first();
                console.log("$this:");
                console.log($this);
            var postLink = $this.attr('href');
                console.log("postLink:" + postLink);
            var postUrl = $this[0].pathname.substring(1);
                console.log("postUrl:" + postUrl);
            var postSlug = basename(postLink);
                console.log("postSlug:" + postSlug);
            var loader = '<div class="glass-container"><div class="glass-mask"><div class="glass"><div class="fill"></div></div></div></div>';

            // prevent link from being followed
            e.stopPropagation();

            // show loader
            modalContent.html(loader);

            // Load content from internal
            modalContent.load(postLink + ' #modal-ready');

            // add class to display the previously hidden modal
            $('html').addClass('modal-open');
            $('.modal-wrapper').fadeIn('slow', function () {
                $(this).addClass('show');
                $('.modal').addClass('show');
            });

            // if (e.isDefaultPrevented()) {
            //     e.stopPropagation();
            // }

            return false;
        });

    });

})(jQuery);
