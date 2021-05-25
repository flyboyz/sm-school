'use strict'

const body = document.querySelector('body');
const sidebarButton = $('#sidebarButton');

if (sidebarButton !== null) {
    $(sidebarButton).fancybox({
        src: '#sidebar',
        touch: false,
        baseClass: 'fancybox-sidebar',
        beforeShow: () => {
            body.classList.add('sidebar-opened')
        },
        beforeClose: () => {
            body.classList.remove('sidebar-opened')
        }
    });
}