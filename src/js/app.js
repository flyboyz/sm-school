'use strict'

import '@fancyapps/fancybox'

import loadMore from './load-more'
import filters from './filters'
import formsInit from './form'
import slider from './slider'
import sidebar from './sidebar'
import staticPageChanger from './static-page'
import promo from './promo'

document.addEventListener('DOMContentLoaded', () => {
  loadMore()
  filters()
  formsInit()
  slider()
  sidebar()
  staticPageChanger()
  promo()
})