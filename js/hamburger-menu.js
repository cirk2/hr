/*==============================================================
    pull menu
 ==============================================================*/

function bindEvent(el, eventName, eventHandler) {
    if (el.addEventListener) {
        el.addEventListener(eventName, eventHandler, false);
    } else if (el.attachEvent) {
        el.attachEvent('on' + eventName, eventHandler);
    }
}

(function ($) {

    var bodyEl = document.body,
            //content = document.querySelector( '.content-wrap' ),
            togglebtn = document.getElementById('menu-toggle'),
            closebtn = document.getElementById('close-button'),
            btncontainer = document.getElementById('btnContainer'),
            isOpen = false;

    function init() {
        initEvents();
    }

    function initEvents() {

        if (togglebtn) {
            bindEvent(togglebtn, 'click', toggleMenu);
        }

        if (closebtn) {

            bindEvent(closebtn, 'click', toggleMenu);
        }

    }

    function toggleMenu() {

        if (isOpen) {
            classie.remove(bodyEl, 'show-menu');
            classie.remove(togglebtn, 'open');
            classie.remove(btncontainer, 'open');

             if ( $( ".full-width-pull-menu" ).length ) {
                 classie.remove(bodyEl, 'overflow-hidden');
            }
        }
        else {
            classie.add(bodyEl, 'show-menu');
            classie.add(togglebtn, 'open');
            classie.add(btncontainer, 'open');

            if ( $( ".full-width-pull-menu" ).length ) {
                 classie.add(bodyEl, 'overflow-hidden');
            }

        }
        isOpen = !isOpen;
    }

    init();

})( jQuery );