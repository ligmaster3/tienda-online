


function addToCart(id) {
  const contador = document.getElementById('num_cnt');
  if (contador) {
    const cantidadActual = parseInt(contador.textContent) || 0;
    contador.textContent = cantidadActual + cantidad;
    }

    // Mostrar notificación con Toastify
    Toastify({
      text: "Añadido al Carrito",
      duration: 2500,
      close: true,
      gravity: "top", // `top` o `bottom`
      position: "left", // `left`, `center` o `right`
      style: {
        background: "linear-gradient(to right, #85a4ff, #5f94f6, #0538f1)",
      }
    }).showToast();
  }

  function agregarAlCarrito(formElement) {
    formElement.submit();
    addToCart(1);
    return false;
}

  function confirmarCompra() {
    const modal = document.getElementById('exampleModal');
    const modalInstance = bootstrap.Modal.getInstance(modal);
    window.location.href = '/src/public/compra.php';
    console.log("Compra confirmada!");
    modalInstance.hide();
  }

  function VaciarCompra() {
    const vaciarCarritoBtn = document.getElementById("shop-vaciar");
    const contenedorProductos = document.getElementById("shop-list");
    vaciarCarritoBtn.addEventListener("click", function () {
      console.log("Carrito vaciado", id);
      contenedorProductos.innerHTML = "";
      actualizarTotal();
    });
  }

  function obtenerTotal() {
    document.getElementById("total").textContent = "$0";
    const carrito = obtenerCarrito();
    return carrito.reduce((total, producto) => total + (producto.precio * producto.cantidad), 0);
  }

  function actualizarTotal() {
    const totalElement = document.getElementById("total");
    totalElement.textContent = "$0"; // Restablecer el total a $0
  }