'use strict';

import Swiper, {Pagination} from "swiper/core";

const attrs = new Map([[
    'co-authors',
    {
        autoplay: false,
        // centeredSlides: true,
        spaceBetween: 30,
        slidesPerView: 1.7,
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
]])

export default () => {
    for (let [sliderName, attr] of attrs) {
        let slider = `.${sliderName}`;

        if (document.querySelector(slider) !== null) {
            let ss;

            Swiper.use([Pagination]);

            if ((sliderName === 'co-authors' || sliderName === 'contents-list') && window.matchMedia('(max-width:767px)').matches) {
                ss = new Swiper(slider, attr);
            }
        }
    }
}