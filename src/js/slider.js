'use strict'

import Swiper, { Navigation, Pagination } from 'swiper/core'

const attrs = new Map([[
  'co-authors',
  {
    autoplay: false,
    centeredSlides: true,
    spaceBetween: 30,
    slidesPerView: 1.85,
  }
], [
  'contents-list',
  {
    autoplay: false,
    spaceBetween: 20,
    slidesPerView: 1.1,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      type: 'bullets',
    },
  }
], [
  'course-packages',
  {
    autoplay: false,
    spaceBetween: 120,
    slidesPerView: 2,
    initialSlide: 1,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  }
]])

export default () => {
  for (let [sliderName, attr] of attrs) {
    let slider = `.${sliderName}`

    if (document.querySelector(slider) !== null) {
      let ss

      Swiper.use([Pagination, Navigation])

      if ((sliderName === 'co-authors' || sliderName === 'contents-list') && window.matchMedia('(max-width:767px)').matches) {
        ss = new Swiper(slider, attr)
      } else if (sliderName === 'course-packages') {
        const slidesCount = document.querySelectorAll(`${slider} .swiper-slide`).length

        if (slidesCount === 1) {
          attr.centeredSlides = true
        }

        if (slidesCount < 3) {
          attr.navigation = false

          document.querySelectorAll(`${slider} [class*=swiper-button]`).forEach(function (item) {
            item.remove()
          })
        }

        new Swiper(slider, attr)
      }
    }
  }
}