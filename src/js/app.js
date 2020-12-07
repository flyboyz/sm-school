'use strict'

import '@fancyapps/fancybox'

import sidebar from './sidebar'
import loadMore from './load-more'

document.addEventListener('DOMContentLoaded', () => {
    sidebar();
    loadMore();
})
