'use strict';

export default () => {
    let body = document.querySelector('body'),
        filterBtn = document.querySelector('.filter-btn');

    if (filterBtn) {
        filterBtn.addEventListener('click', () => {
            body.classList.toggle('page-filters-active');
        })
    }
}