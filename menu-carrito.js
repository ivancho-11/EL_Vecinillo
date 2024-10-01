// Estilos CSS (puedes ponerlo en un archivo separado si prefieres)
const styles = `
body {
  background-color: #1a1a1a;
  color: #ffffff;
  font-family: Arial, sans-serif;
}

#popup-menu {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #2a2a2a;
  padding: 20px;
  border: 2px solid #4a4a4a;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
  z-index: 1000;
  max-height: 80vh;
  overflow-y: auto;
}

#popup-menu h2 {
  color: #ffd700;
  text-align: center;
  margin-bottom: 20px;
}

#lista-productos {
  list-style-type: none;
  padding: 0;
}

#lista-productos li {
  background-color: #3a3a3a;
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 5px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

#lista-productos button {
  background-color: #ffd700;
  color: #1a1a1a;
  border: none;
  padding: 5px 10px;
  border-radius: 3px;
  cursor: pointer;
  transition: background-color 0.3s;
}

#lista-productos button:hover {
  background-color: #ffeb3b;
}

#carrito {
  position: fixed;
  top: 10px;
  right: 10px;
  background-color: #2a2a2a;
  padding: 20px;
  max-height: 400px;
  overflow-y: auto;
  border: 2px solid #4a4a4a;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
}

#carrito h3 {
  color: #ffd700;
  text-align: center;
  margin-bottom: 15px;
}

#items-carrito {
  list-style-type: none;
  padding: 0;
}

#items-carrito li {
  background-color: #3a3a3a;
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 5px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

#items-carrito button {
  background-color: #ff4d4d;
  color: #ffffff;
  border: none;
  padding: 5px 10px;
  border-radius: 3px;
  cursor: pointer;
  transition: background-color 0.3s;
}

#items-carrito button:hover {
  background-color: #ff6666;
}

#total-carrito {
  font-size: 1.2em;
  font-weight: bold;
  color: #ffd700;
}

button {
  font-weight: bold;
}
`;

// Agregar estilos al documento
const styleSheet = document.createElement("style");
styleSheet.innerText = styles;
document.head.appendChild(styleSheet);

// Crear elementos del menú y carrito
const popupMenu = document.createElement('div');
popupMenu.id = 'popup-menu';
popupMenu.innerHTML = `
    <h2>Menú de Productos</h2>
    <ul id="lista-productos"></ul>
    <button onclick="cerrarMenu()">Cerrar</button>
`;

const carrito = document.createElement('div');
carrito.id = 'carrito';
carrito.innerHTML = `
    <h3>Carrito</h3>
    <ul id="items-carrito"></ul>
    <p>Total: $<span id="total-carrito">0</span></p>
`;

document.body.appendChild(popupMenu);
document.body.appendChild(carrito);

let productos = [];
let carritoItems = [];

function mostrarMenu(event) {
    event.preventDefault();
    document.getElementById('popup-menu').style.display = 'block';
    cargarProductos();
}

function cerrarMenu() {
    document.getElementById('popup-menu').style.display = 'none';
}

function cargarProductos() {
    fetch('obtener_productos.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
                return;
            }
            productos = data;
            const lista = document.getElementById('lista-productos');
            lista.innerHTML = '';
            productos.forEach(producto => {
                lista.innerHTML += `
                    <li>
                        ${producto.nombre} - $${producto.precio}
                        <button onclick="agregarAlCarrito(${producto.id})">Agregar al carrito</button>
                    </li>`;
            });
        })
        .catch(error => console.error('Error:', error));
}

function agregarAlCarrito(id) {
    const producto = productos.find(p => p.id == id);
    carritoItems.push(producto);
    actualizarCarrito();
}

function actualizarCarrito() {
    const lista = document.getElementById('items-carrito');
    lista.innerHTML = '';
    let total = 0;
    carritoItems.forEach((item, index) => {
        lista.innerHTML += `
            <li>
                ${item.nombre} - $${item.precio}
                <button onclick="eliminarDelCarrito(${index})">Eliminar</button>
            </li>`;
        total += parseFloat(item.precio);
    });
    document.getElementById('total-carrito').textContent = total.toFixed(2);
}

function eliminarDelCarrito(index) {
    carritoItems.splice(index, 1);
    actualizarCarrito();
}

// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Buscar el enlace del menú
    const menuLink = Array.from(document.querySelectorAll('.btn-1')).find(el => el.textContent.trim().toLowerCase() === 'menu');
    
    if (menuLink) {
        menuLink.addEventListener('click', mostrarMenu);
    } else {
        console.error('No se encontró el enlace del menú');
    }

    // Opcionalmente, puedes agregar funcionalidad al botón de comprar aquí
    const comprarLink = Array.from(document.querySelectorAll('.btn-1')).find(el => el.textContent.trim().toLowerCase() === 'comprar');
    if (comprarLink) {
        comprarLink.addEventListener('click', function(event) {
            event.preventDefault();
            // Aquí puedes agregar la lógica para el proceso de compra
            console.log('Iniciar proceso de compra');
        });
    }
});