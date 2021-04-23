'use strict';

import Message from "./message";

export default () => {
    let sendpulseForms = document.querySelectorAll('.sendpulse-form');

    if (sendpulseForms !== null) {
        sendpulseForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(form)

                form.querySelector('[type="submit"]').setAttribute('disabled', 'disabled');

                fetch(backend_data.ajaxurl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData,
                })
                    .then((response) => response.json())
                    .then(function (data) {
                        e.preventDefault();

                        if (data.is_error) {
                            $.fancybox.open(Message('Ошибка отправки', 'Сообщите об этом администратору'));
                        } else {
                            $.fancybox.close();

                            form.querySelector('[type="submit"]').removeAttribute('disabled');
                            form.reset();

                            if (form.classList.contains('sendpulse-form')) {
                                $.fancybox.open(Message('Поздравляем', 'Вы успешно записались на мастер-класс!'));
                            } else {
                                $.fancybox.open(Message('Успешно', ''));
                            }
                        }
                    });
            });
        });
    }
}
