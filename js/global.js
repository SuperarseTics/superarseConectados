document.addEventListener("DOMContentLoaded", function () {
  // ... (Tu código de pagos existente) ...
  const infoCuentas = {
    produbanco: {
      banco: "Banco del Produbanco",
      cuenta: "020052905577",
      ruc: "1792951704001",
    },
    guayaquil: {
      banco: "Banco de Guayaquil",
      cuenta: "13748241",
      ruc: "1792951704001",
    },
  };

  const opcionesContainer = document.getElementById("opciones-bancos");

  const infoContainer = document.getElementById("info-cuenta-seleccionada");

  const botones = opcionesContainer.querySelectorAll(".btn");

  const inputFile = document.getElementById("transferencia-file");

  const enviarBtn = document.getElementById("enviar-btn");

  // Función para mostrar la información de la cuenta seleccionada

  function mostrarInfoCuenta(bancoId) {
    const data = infoCuentas[bancoId];

    if (data) {
      infoContainer.innerHTML = `

                        <p><strong>Banco:</strong> ${data.banco}</p>

                        <p><strong>Cuenta de Ahorros:</strong> ${data.cuenta}</p>

                        <p><strong>RUC:</strong> ${data.ruc}</p>

                        `;

      botones.forEach((btn) => btn.classList.remove("active"));

      document
        .querySelector(`button[data-id="${bancoId}"]`)
        .classList.add("active");
    } else {
      infoContainer.innerHTML = "";
    }
  }

  // Agregar el event listener a cada botón de banco

  botones.forEach((btn) => {
    btn.addEventListener("click", function () {
      const bancoId = this.getAttribute("data-id");

      mostrarInfoCuenta(bancoId);
    });
  });

  // Mostrar la información del primer banco por defecto al cargar la página

  if (botones.length > 0) {
    mostrarInfoCuenta(botones[0].getAttribute("data-id"));
  }

  // Listener para el input de archivo

  inputFile.addEventListener("change", function () {
    if (this.files.length > 0) {
      // El usuario subió un archivo, mostramos el botón

      enviarBtn.classList.remove("d-none");

      // Creamos el enlace mailto

      const subject = encodeURIComponent("Comprobante de Pago");

      const body = encodeURIComponent(
        "Adjunto el comprobante de pago. \n\nGracias."
      );

      enviarBtn.href = `mailto:matriculas@superarse.edu.ec?subject=${subject}&body=${body}`;
    } else {
      // No hay archivo, ocultamos el botón
      enviarBtn.classList.add("d-none");
    }
  });
});

document
  .getElementById("payphone-link")
  .addEventListener("click", function (e) {
    e.preventDefault();

    const cantidadInput = document
      .getElementById("cantidad")
      .value.replace(",", ".");

    const cantidad = parseFloat(cantidadInput);

    if (!cantidad || isNaN(cantidad)) {
      alert("Por favor ingresa una cantidad válida");
      return;
    }

    const referencia = document.getElementById("referencia").value;

    const cantidadFinal = Math.round(cantidad * 100);

    const url =
      `/app/views/pagos.php?cantidad=` +
      encodeURIComponent(cantidadFinal) +
      `&referencia=` +
      encodeURIComponent(referencia);

    window.open(url, "_blank");
  });
