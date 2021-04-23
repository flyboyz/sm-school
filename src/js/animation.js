'use strict';

import lottie from 'lottie-web/build/player/lottie_svg.min'

export default () => {
  let is_reopening = sessionStorage.getItem('reopening') || 0;

  if (!is_reopening) {
    console.log('animation!')

    lottie.loadAnimation({
      container: document.querySelector('.anim'),
      renderer: 'svg',
      loop: 0,
      autoplay: true,
      path: '/wp-content/themes/sm-school/logo_anim_1.json'
    });

    sessionStorage.setItem('reopening', 1);
  }
}