document.addEventListener('DOMContentLoaded', initSliders);

function initSliders() {
  const sliderConfigs = [
    {
      selector: '.mySwiper-1',
      options: {
        loop: true,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
      },
    },
    {
      selector: '.mySwiper-2',
      options: {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 30,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 30,
          },
        },
      },
    },
    {
      selector: '.mySwiper-3',
      options: {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 30,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 30,
          },
        },
      },
    },
  ];

  sliderConfigs.forEach((config) => {
    initSwiper(config.selector, config.options);
  });
}

function initSwiper(selector, options) {
  try {
    const swiper = new Swiper(selector, options);
    swiper.on('error', (error) => console.error(`Swiper ${selector} error:`, error));
  } catch (error) {
    console.error(`Error inicializando Swiper ${selector}:`, error);
  }
}