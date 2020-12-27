'use strict'

import '@fancyapps/fancybox'

import sidebar from './sidebar'
import loadMore from './load-more'
import filters from './filters'

document.addEventListener('DOMContentLoaded', () => {
    sidebar();
    loadMore();
    filters();
})
