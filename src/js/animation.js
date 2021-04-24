'use strict';

import lottie from 'lottie-web/build/player/lottie_svg.min'

let is_reopening = sessionStorage.getItem('reopening') || 0;

document.addEventListener('DOMContentLoaded', () => {
  let body = document.querySelector('body');
  let phoenix_box = document.querySelector('.phoenix_box');

  if (!is_reopening) {
    body.querySelector('.header__logo').classList.add('hidden');

    let phoenix = lottie.loadAnimation({
      container: phoenix_box,
      renderer: 'svg',
      loop: 0,
      autoplay: true,
      path: '/wp-content/themes/sm-school/src/animation/phoenix_show.json'
    });

    setTimeout(() => {
      body.classList.remove('animation-page');
    }, 1550);

    phoenix.addEventListener('complete', () => {
      phoenix_box.style.width = 0;
      phoenix_box.style.top = '55%';

      setTimeout(() => {
        body.querySelector('.header__logo').classList.remove('hidden');
      }, 450);
    });

    sessionStorage.setItem('reopening', 1);
  } else {
    body.classList.remove('animation-page');
  }
})