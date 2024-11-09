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

                    // Función para mostrar información
                    function mostrarInfo(id) {
                        document.getElementById(id).style.display = 'block';
                    }
                
                    // Función para ocultar información
                    function ocultarInfo(id) {
                        document.getElementById(id).style.display = 'none';
                    }
                    function mostrarInfo(id) {
                      ocultarTodo(); // Ocultar toda la info antes de mostrar la nueva
                      document.getElementById(id).style.display = 'block';
                  }
              
                  // Función para ocultar información
                  function ocultarInfo(id) {
                      document.getElementById(id).style.display = 'none';
                  }
              
                  // Función para ocultar todas las secciones al mismo tiempo
                  function ocultarTodo() {
                      var infos = document.querySelectorAll('.info');
                      infos.forEach(function(info) {
                          info.style.display = 'none';
                      });
                  }
                  // MENU EMERGENTE 
                  function openMenu() {
                    document.getElementById("modalOverlay").style.display = "flex";
                }
                function closeMenu() {
                    document.getElementById("modalOverlay").style.display = "none";
                  }
                  // Datos de los productos
const productos = [
  { id: 1, nombre: "Gaseosas", precio: 3000 },
  { id: 2, nombre: "Arepas rellenas", precio: 5000 },
  { id: 3, nombre: "Arepas con queso", precio: 3000 },
  { id: 4, nombre: "Arepas con chorizo", precio: 5000 },
  { id: 5, nombre: "Arepa rellena", precio: 11000 },
  { id: 6, nombre: "Papas rellenas", precio: 3000 },
  { id: 7, nombre: "Chorizos", precio: 3000 },
  { id: 8, nombre: "Hamburguesas", precio: 10000 },
  { id: 9, nombre: "Perros", precio: 15000 },
  { id: 10, nombre: "Flautas", precio: 20000 },
  { id: 11, nombre: "Salchipapas", precio: 15000 },
  { id: 12, nombre: "Gaseosa Coca Cola 1.5", precio: 7000 },
  { id: 13, nombre: "Cuatro Personal", precio: 3000 },
  { id: 14, nombre: "Coca Cola 2 litros", precio: 7000 },
  { id: 15, nombre: "Hamburguesa de la casa", precio: 7500 },
  { id: 16, nombre: "CocaCola 3,5", precio: 3000 }
];

// Función para inicializar el menú
function inicializarMenu() {
  const listaProductos = document.getElementById('lista-productos');
  
  productos.forEach(producto => {
      const li = document.createElement('li');
      li.className = 'producto-item';
      li.innerHTML = `
          <img src="/api/placeholder/100/100" alt="${producto.nombre}" class="producto-imagen">
          <div class="producto-nombre">${producto.nombre}</div>
          <div class="producto-precio">$${producto.precio.toLocaleString()}</div>
          <button class="btn-agregar" onclick="agregarAlCarrito(${producto.id})">
              Agregar al carrito
          </button>
      `;
      listaProductos.appendChild(li);
  });
}

// Función para agregar al carrito
function agregarAlCarrito(id) {
  const producto = productos.find(p => p.id === id);
  if (producto) {
      console.log(`Agregado al carrito: ${producto.nombre} - $${producto.precio}`);
      // Aquí puedes implementar la lógica del carrito
  }
}

// Función para cerrar el menú
function cerrarMenu() {
  const menu = document.getElementById('popup-menu');
  menu.style.display = 'none';
}

// Inicializar el menú cuando cargue la página
document.addEventListener('DOMContentLoaded', inicializarMenu);