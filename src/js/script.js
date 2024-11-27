

function NotificacionEliminar() {
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

function addToCart(event) {
  event.preventDefault();

  Toastify({
      text: "Producto añadido al carrito",
      duration: 2500,
      close: true,
      gravity: "top",
      position: "left",
      style: {
          background: "linear-gradient(to right, #85a4ff, #5f94f6, #0538f1)",
      }
  }).showToast();

  setTimeout(() => {
      event.target.submit();
  }, 2500);
}

function confirmarVaciadoCarrito() {
  new bootstrap.Modal(document.getElementById('modalConfirmarVaciado')).show();
}

function vaciarCarrito() {
  var modal = bootstrap.Modal.getInstance(document.getElementById('modalConfirmarVaciado'));
  modal.hide();
  Toastify({
    text: "Carrito vaciado",
    duration: 2500,
    gravity: "top",
    position: "right",
    backgroundColor: "#ff5f5f",
    close: true
  }).showToast();
}


