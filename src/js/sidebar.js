'use strict';

export default () => {
    let body = document.querySelector('body'),
        sidebar = document.querySelector('.sidebar'),
        hamburger = document.querySelector('.hamburger');

    if (hamburger && sidebar) {
        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar_opened');
            body.classList.toggle('overflow');
        })

        sidebar.querySelector('.sidebar__close-btn').addEventListener('click', () => {
            sidebar.classList.remove('sidebar_opened');
            body.classList.remove('overflow');
        })
    }
}
