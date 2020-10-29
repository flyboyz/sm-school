'use strict';

export default () => {
    let body = document.querySelector('body'),
        sidebar = document.querySelector('.sidebar');

    if (sidebar) {
        document.querySelector('.hamburger').addEventListener('click', () => {
            sidebar.classList.toggle('sidebar_opened');
            body.classList.toggle('overflow');
        })

        document.querySelector('.sidebar__close-btn').addEventListener('click', () => {
            sidebar.classList.remove('sidebar_opened');
            body.classList.remove('overflow');
        })
    }
}
