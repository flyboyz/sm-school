'use strict';

import Swiper from "swiper";

const attrs = new Map([[
    'co-authors',
    {
        autoplay: false,
        centeredSlides: true,
        grabCursor: true,
        loopedSlides: 2,
        spaceBetween: 30,
        slidesPerView: 2,
    }
]])

export default () => {
    for (let [sliderName, attr] of attrs) {
        let slider = `.${sliderName}`;

        if (document.querySelector(slider) !== null) {
            let ss;

            if (sliderName === 'co-authors' && window.matchMedia('(max-width:767px)').matches) {
                ss = new Swiper(slider, attr);
            }
        }
    }
}