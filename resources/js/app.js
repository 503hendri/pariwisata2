import Swiper from "swiper";
import {
    Navigation,
    Pagination,
    Autoplay,
    EffectFade,
} from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/effect-fade";

function initDestinationSwiper() {

    const el = document.querySelector(".destinations-swiper");

    if (!el) return;

    // destroy old instance
    if (el.swiper) {
        el.swiper.destroy(true, true);
    }

    new Swiper(el, {

        modules: [
            Navigation,
            Pagination,
            Autoplay,
        ],

        slidesPerView: 1,

        spaceBetween: 16,

        loop: true,

        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },

        observer: true,
        observeParents: true,
        observeSlideChildren: true,

        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },

            1024: {
                slidesPerView: 3,
                spaceBetween: 24,
            },

            1280: {
                slidesPerView: 3,
                spaceBetween: 32,
            },
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },

    });
}

function initHeroSwiper() {

    const hero = document.querySelector(".hero-swiper");

    if (!hero) return;

    // destroy old swiper
    if (hero.swiper) {
        hero.swiper.destroy(true, true);
    }

    const slideCount = hero.querySelectorAll(".swiper-slide").length;

    new Swiper(hero, {

        modules: [
            Pagination,
            Autoplay,
            EffectFade,
        ],

        slidesPerView: 1,

        effect: "fade",

        speed: 1200,

        loop: slideCount > 1,

        autoplay: slideCount > 1
            ? {
                  delay: 5500,
                  disableOnInteraction: false,
              }
            : false,

        pagination: {
            el: hero.querySelector(".swiper-pagination"),
            clickable: true,
        },

    });
}

function initSwipers() {
    initDestinationSwiper();
    initHeroSwiper();
}

document.addEventListener("DOMContentLoaded", initSwipers);

document.addEventListener("livewire:navigated", () => {
    initSwipers();
});