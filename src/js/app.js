'use strict'

import '@fancyapps/fancybox'

import loadMore from './load-more'
import filters from './filters'
import formsInit from './form'
import slider from './slider'

document.addEventListener('DOMContentLoaded', () => {
    loadMore();
    filters();
    formsInit();
    slider();
});