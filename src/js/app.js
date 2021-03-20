'use strict'

import '@fancyapps/fancybox'
// import lottie from 'lottie-web/build/player/lottie_svg.min'

import loadMore from './load-more'
import filters from './filters'
import formsInit from './form'

document.addEventListener('DOMContentLoaded', () => {
    loadMore();
    filters();
    // formsInit();

    // lottie.loadAnimation({
    //     container: document.querySelector('.anim'),
    //     renderer: 'svg',
    //     loop: 0,
    //     autoplay: true,
    //     path: '/wp-content/themes/sm-school/logo_anim_1.json'
    // });
});