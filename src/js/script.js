

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

  // Mostrar el spinner
  showSpinner();

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
      hideSpinner();
      event.target.submit();
  }, 2500);

  return false;
}

function showSpinner() {
  const spinner = document.createElement('div');
  spinner.id = 'spinnerOverlay';
  spinner.className = 'spinner-overlay';
  spinner.innerHTML = '<div class="spinner"></div>';
  document.body.appendChild(spinner);
}

function hideSpinner() {
  const spinner = document.getElementById('spinnerOverlay');
  if (spinner) {
      spinner.remove();
  }
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


