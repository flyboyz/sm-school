'use strict';

const loadMoreElement = document.getElementById('load-more');

let pos;

export default () => {
    window.onscroll = () => {
        scrollListener()
    }
}

function scrollListener() {
    let scrollTop = window.scrollY;

    if (loadMoreElement) {
        pos = loadMoreElement.offsetTop;
    }

    if (pos && scrollTop > pos - window.innerHeight && scrollTop < pos
        && !loadMoreElement.classList.contains('loading') && backend_data.current_page < backend_data.max_page) {
        loadMoreElement.classList.add('loading');

        const data = new FormData()

        data.append('action', 'load_more')
        data.append('query', backend_data.posts)
        data.append('page', backend_data.current_page);
        data.append('post_type', loadMoreElement.getAttribute('data-type'));

        fetch(backend_data.ajax_url, {
            method: 'POST',
            credentials: 'same-origin',
            body: data,
        })
            .then(response => response.text())
            .then(function (data) {
                if (data) {
                    if (data[data.length - 1] === '0')
                        data = data.substring(0, data.length - 1);

                    const news = document.createElement('div');
                    news.innerHTML = data;

                    while (news.children.length > 0) {
                        document.querySelector('.content-list').append(news.children[0]);
                    }

                    loadMoreElement.classList.remove('loading');

                    backend_data.current_page++;
                } else {
                    loadMoreElement.remove();
                }
            });
    }
}