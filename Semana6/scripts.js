document.addEventListener('DOMContentLoaded', () => {
    class Paquete {
        constructor(id, destino, fecha, precio) {
            this.id = id;
            this.destino = destino;
            this.fecha = fecha;
            this.precio = precio;
        }

        mostrar() {
            return `${this.fecha} - $${this.precio}`;
        }
    }

    const paquetes = [
        new Paquete(1, 'París', '2024-08-01', 1200),
        new Paquete(2, 'Nueva York', '2024-09-15', 1500),
        new Paquete(3, 'Tokio', '2024-10-05', 1700)
    ];

    let carrito = [];

    function mostrarOfertas() {
        const ContenedorOfertas = document.getElementById('ofertas');
        paquetes.forEach(pkg => {
            const div = document.createElement('div');
            div.innerHTML = `<br> ${pkg.destino} <strong> <br> ${pkg.precio} <br></strong>Dólares  💵<br><br>`;
            
            const addToCartButton = document.createElement('button');
            addToCartButton.textContent = "Añadir al carrito";
            addToCartButton.onclick = function() {
                agregarAlCarrito(pkg);
            };
            
            div.appendChild(addToCartButton);
            ContenedorOfertas.appendChild(div);
        });
    }

    function agregarAlCarrito(paquete) {
        carrito.push(paquete);
        actualizarCarrito();
    }

    function actualizarCarrito() {
        const cartCount = document.getElementById('cartCount');
        cartCount.textContent = carrito.length;
    }

    document.getElementById('cartIcon').onclick = function() {
        mostrarCarrito();
    };

    function mostrarCarrito() {
        alert("Carrito:\n" + carrito.map(pkg => `${pkg.destino} - ${pkg.fecha} - $${pkg.precio}`).join("\n"));
    }

    mostrarOfertas();
    actualizarMenuDesplegable();

    
    


function agregarAlCarrito(paquete) {
    carrito.push(paquete);
    actualizarCarrito();
    guardarCarritoEnSesion();
}

function guardarCarritoEnSesion() {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "guardarCarrito.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("carrito=" + JSON.stringify(carrito));
}
});
document.addEventListener('mousemove', resetSessionTimer);
    document.addEventListener('click', resetSessionTimer);
    document.addEventListener('keypress', resetSessionTimer);
    
    function resetSessionTimer() {
        fetch('RenovarSesion.php');
    }