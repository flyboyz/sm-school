'use strict';

import lottie from 'lottie-web/build/player/lottie_svg.min'

let is_reopening = sessionStorage.getItem('reopening') || 0;

document.addEventListener('DOMContentLoaded', () => {
  let body = document.querySelector('body');
  let phoenix = document.querySelector('.phoenix');
  let light = document.querySelector('.light');

  let is_mobile = animation_data.is_mobile === '1';

  if (!is_reopening) {
    body.querySelector('.header__logo').classList.add('hidden');

    let phoenix_animation = lottieAnimation(phoenix, 'phoenix_full');

    phoenix_animation.addEventListener('DOMLoaded', () => {
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

    phoenix_animation.addEventListener('complete', () => {
      let frame_animation = lottieAnimation(light, 'frame_begin');

      frame_animation.addEventListener('complete', () => {
        lottieAnimation(light, 'frame_loop', true);
        frame_animation.destroy();
      });
    });

    sessionStorage.setItem('reopening', 1);
  } else {
    lottieAnimation(light, 'frame_loop', true);

    body.classList.remove('animation-page');
    document.querySelector('.phoenix_box').remove();
  }
})

function lottieAnimation(containerEl, jsonName, loop = 0) {
  return lottie.loadAnimation({
    container: containerEl,
    renderer: 'svg',
    loop: loop,
    autoplay: true,
    path: `/wp-content/themes/sm-school/src/animation/${jsonName}.json`,
  });
}