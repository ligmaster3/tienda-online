



function confirmarCompra() {
  const modal = document.getElementById('exampleModal');
  const modalInstance = bootstrap.Modal.getInstance(modal);
  window.location.href = '/src/public/compra.php';
  console.log("Compra confirmada!");
  modalInstance.hide();
}

function mostrarNotificacionEliminar() {
  // Mostrar notificación Toastify
  Toastify({
      text: "Producto eliminado del carrito",
      duration: 2500,
      close: true,
      gravity: "top",
      position: "right",
      backgroundColor: "#ff5f5f",
  }).showToast();
}

function VaciarCompra() {
  const vaciarCarritoBtn = document.getElementById("shop-vaciar");
  const contenedorProductos = document.getElementById("shop-list");

  vaciarCarritoBtn.addEventListener("click", function () {
    // Mostrar notificación antes de vaciar el carrito
    Toastify({
      text: "Carrito vaciado",
      duration: 2500,
      gravity: "top",
      position: "right",
      backgroundColor: "#ff5f5f",
      close: true
    }).showToast();

    // Esperar antes de vaciar el carrito en el DOM
    setTimeout(() => {
      contenedorProductos.innerHTML = "";
      actualizarTotal();

      // Aquí puedes añadir código para enviar una solicitud al servidor y vaciar el carrito en la sesión
      // Ejemplo: usando un formulario oculto o redirigiendo a un archivo PHP
    }, 2500);
  });
}

function obtenerTotal() {
  document.getElementById("total").textContent = "$0";
  const carrito = obtenerCarrito();
  return carrito.reduce((total, producto) => total + (producto.precio * producto.cantidad), 0);
}

function actualizarTotal() {
  const totalElement = document.getElementById("total");
  const total = obtenerTotal(); // Obtén el total de productos en el carrito
  totalElement.textContent = `$${total.toFixed(2)}`;
}