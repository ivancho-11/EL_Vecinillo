document.addEventListener('DOMContentLoaded', function () {
  // Inicialización del slider principal
  var swiper1 = new Swiper('.mySwiper-1', {
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
          delay: 3000, // Tiempo en milisegundos entre cambios
          disableOnInteraction: false, // Mantiene el autoplay tras la interacción
      },
  });

  // Inicialización de los sliders en las pestañas
  var swiper2 = new Swiper('.mySwiper-2', {
      loop: true,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      autoplay: {
          delay: 3000, // Tiempo en milisegundos entre cambios
          disableOnInteraction: false, // Mantiene el autoplay tras la interacción
      },
  });

  var swiper3 = new Swiper('.mySwiper-3', {
      loop: true,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      autoplay: {
          delay: 3000, // Tiempo en milisegundos entre cambios
          disableOnInteraction: false, // Mantiene el autoplay tras la interacción
      },
  });
});