'use strict'

import '@fancyapps/fancybox'

import loadMore from './load-more'
import filters from './filters'
import formsInit from './form'
import slider from './slider'
import animation from './animation'

document.addEventListener('DOMContentLoaded', () => {
    loadMore();
    // filters();
    // formsInit();
    slider();
    // animation();
});