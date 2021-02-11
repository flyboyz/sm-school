'use strict'

import '@fancyapps/fancybox'
// import lottie from 'lottie-web/build/player/lottie_svg.min'

// import sidebar from './sidebar'
import loadMore from './load-more'
import filters from './filters'

document.addEventListener('DOMContentLoaded', () => {
    // sidebar();
    loadMore();
    filters();

    // lottie.loadAnimation({
    //     container: document.querySelector('.anim'),
    //     renderer: 'svg',
    //     loop: 0,
    //     autoplay: true,
    //     path: '/wp-content/themes/sm-school/logo_anim_1.json'
    // });
})
