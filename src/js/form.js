'use strict'

import Message from './message'

export default () => {
  let sendpulseForms = document.querySelectorAll('.sendpulse-form')

  if (sendpulseForms !== null) {
    sendpulseForms.forEach(form => {
      form.addEventListener('submit', function (e) {
        const formData = new FormData(form)

        e.preventDefault()

        form.querySelector('[type="submit"]').setAttribute('disabled', 'disabled')
        form.querySelector('[type="submit"]').classList.add('progress-btn')

        fetch(backend_data.ajax_url, {
          method: 'POST',
          credentials: 'same-origin',
          body: formData,
        })
          .then((response) => response.json())
          .then(function (data) {
            let goalName = form.getAttribute('data-reach-goal')

            checkAndReachGoal(goalName)
            form.querySelector('[type="submit"]').classList.remove('progress-btn')

            if (data.is_error) {
              $.fancybox.open(Message('Ошибка отправки', 'Сообщите об этом администратору'))
            } else {
              if (form.hasAttribute('data-form-submit')) {
                HTMLFormElement.prototype.submit.call(form)
              } else {
                $.fancybox.close()

                form.querySelector('[type="submit"]').removeAttribute('disabled')
                form.reset()

                if (form.classList.contains('sendpulse-form')) {
                  $.fancybox.open(Message('Спасибо за регистрацию!', 'Проверьте пожалуйста Вашу почту! Вам должно прийти важное письмо! Если его там нет - проверьте СПАМ. Если его и там нет - возможно Вы не верно ввели адрес своей почты.'))
                } else {
                  $.fancybox.open(Message('Успешно', ''))
                }
              }
            }
          })
      })
    })
  }

  let feedbackForm = document.getElementById('wpforms-form-387')

  if (feedbackForm !== null) {
    feedbackForm.addEventListener('submit', function () {
      const feedback = document.querySelector('.feedback__item_moderate')

      feedback.querySelector('.dialog__author span').innerHTML = this.querySelector('[type="text"]').value
      feedback.querySelector('.dialog__text').innerHTML = this.querySelector('textarea').value

      setTimeout(() => {
        feedback.classList.add('active')
      }, 1400)
    })
  }
}

function checkAndReachGoal (goalName) {
  if (!!goalName && typeof ym === 'function') {
    ym(80102551, 'reachGoal', goalName)
  }
}