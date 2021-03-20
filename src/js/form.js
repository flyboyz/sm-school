'use strict';

let selfModal = document.getElementById('package-selfModal');

if (selfModal !== null) {
    document.getElementById('package-selfModal').querySelector('form').onsubmit = async (e) => {
        const data = new FormData()
        data.append('action', 'create_sm_user');

        console.log('1');

        fetch(backend_data.ajaxurl, {
            method: 'POST',
            credentials: 'same-origin',
            body: data,
        })
            .then(response => response.text())
            .then(function (data) {
                e.preventDefault();
                console.log(data);
                if (data) {

                } else {

                }
            });
    };
}