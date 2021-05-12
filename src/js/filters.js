'use strict';

export default () => {
    let body = document.querySelector('body'),
      filterBtn = document.querySelector('.filter-btn:not([disabled])');

    if (filterBtn) {
        let form = document.getElementById('filterForm');

        filterBtn.addEventListener('click', () => {
            body.classList.toggle('page-filters-active');
        })

        document.getElementById('authorSelect').addEventListener('change', () => {
            form.submit();
        })
    }
}