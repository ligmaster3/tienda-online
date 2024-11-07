



function confirmarCompra() {
  const modal = document.getElementById('exampleModal');
  const modalInstance = bootstrap.Modal.getInstance(modal);
  window.location.href = '/src/public/compra.php';
  console.log("Compra confirmada!");
  modalInstance.hide();
}

function eliminarProductoCarrito(idProducto) {
  // Mostrar notificación antes de eliminar el producto
  Toastify({
    text: "Producto eliminado del carrito",
    duration: 3000,
    gravity: "top",
    position: "right",
    backgroundColor: "#ff5f5f",
    close: true
  }).showToast();

  // Esperar antes de enviar el formulario
  setTimeout(() => {
    // Crear un formulario oculto para enviar el ID del producto al servidor
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "eliminar_del_carrito.php"; // Archivo PHP que procesará la eliminación

    // Crear un campo oculto para el ID del producto
    const inputId = document.createElement("input");
    inputId.type = "hidden";
    inputId.name = "id";
    inputId.value = idProducto;

    // Agregar el campo oculto al formulario
    form.appendChild(inputId);

    // Agregar el formulario al cuerpo del documento y enviarlo
    document.body.appendChild(form);
    form.submit();
  }, 3000); // Esperar 3 segundos antes de enviar el formulario
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