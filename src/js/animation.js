'use strict';

import lottie from 'lottie-web/build/player/lottie_svg.min'

let is_reopening = sessionStorage.getItem('reopening') || 0;

document.addEventListener('DOMContentLoaded', () => {
  let body = document.querySelector('body');
  let phoenix = document.querySelector('.phoenix');

  let is_mobile = animation_data.is_mobile === '1';
  let json_name = 'phoenix_full';

  if (!is_reopening) {
    body.querySelector('.header__logo').classList.add('hidden');

    let animation = lottie.loadAnimation({
      container: phoenix,
      renderer: 'svg',
      loop: 0,
      autoplay: true,
      path: `/wp-content/themes/sm-school/src/animation/${json_name}.json`
    });

    animation.addEventListener('DOMLoaded', () => {
      setTimeout(() => {
        body.classList.add('showing');
      }, 3000);

      if (is_mobile) {
        setTimeout(() => {
          phoenix.style.width = '60%';
          phoenix.style.transform = 'translateX(0)';
        }, 3300);
      }

      setTimeout(() => {
        phoenix.style.opacity = 0;
        body.querySelector('.header__logo').classList.remove('hidden');

        document.querySelector('.phoenix_box').remove();
      }, 4000);
    });

    sessionStorage.setItem('reopening', 1);
  } else {
    body.classList.remove('animation-page');

    document.querySelector('.phoenix_box').remove();
  }
})