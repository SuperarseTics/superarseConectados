// js/main.js

// Función para mostrar la sección correspondiente
function showSection(sectionId) {
  var sections = document.querySelectorAll(".section-content");
  sections.forEach((section) => (section.style.display = "none"));
  document.getElementById(sectionId).style.display = "block";

  var navbarCollapse = document.getElementById("navbarNav");
  if (navbarCollapse.classList.contains("show")) {
    navbarCollapse.classList.remove("show");
  }
}

// Llama a esta función al cargar la página
document.addEventListener("DOMContentLoaded", function () {
  // Los datos están disponibles gracias al script en el HTML.
  const {
    informacionUsuario,
    programa,
    asignaturas,
    credenciales,
    datos_pagos,
  } = datosEstudiante;

  // Renderizamos la sección de Información del Estudiante
  renderizarInformacionEstudiante(informacionUsuario);

  // Renderizamos la sección de Carreras y Asignaturas
  renderizarAsignaturas(asignaturas, programa);

  // Renderizamos la sección de Credenciales
  renderizarCredenciales(credenciales, informacionUsuario.usuario);

  // Renderizamos la sección de Pagos
  renderizarPagos(datos_pagos);

  // Mostrar la primera sección por defecto
  showSection("informacion");
});

// Funciones de renderizado específicas para cada sección
function renderizarInformacionEstudiante(info) {
  const tabla = document.getElementById("tabla-informacion-estudiante");
  if (!info || Object.keys(info).length === 0) {
    tabla.innerHTML =
      '<tr><td colspan="2">No hay información de estudiante.</td></tr>';
    return;
  }
  let html = `
      <tr><th>Código de Matrícula</th><td>${info.codigo_matricula}</td></tr>
      <tr><th>Nombres</th><td>${info.nombres}</td></tr>
      <tr><th>Apellidos</th><td>${info.apellidos}</td></tr>
      <tr><th>Tipo de Identificación</th><td>${
        info.tipo_identificacion
      }</td></tr>
      <tr><th>Número de Identificación</th><td>${
        info.numero_identificacion
      }</td></tr>
      <tr><th>Estado / Cond. Matrícula</th><td>${info.estado} / ${
    info.cond_matricula
  }</td></tr>
      <tr><th>Carrera</th><td>${info.programa}</td></tr>
      <tr><th>Periodo</th><td>${info.periodo}</td></tr>
      <tr>
          <th>Nivel</th>
          <td>
              ${info.nivel}
              ${
                info.nivel !== "Nivel 1"
                  ? '<br><a href="https://site2.q10.com/Prematricula" target="_blank">¡Prematrículate aquí!</a> / <a href="..." target="_blank">¿Cómo me prematriculo?</a>'
                  : ""
              }
          </td>
      </tr>
      <tr><th>Usuario</th><td>${info.usuario}</td></tr>
  `;
  tabla.innerHTML = html;
}

function renderizarAsignaturas(asignaturas, programa) {
  const tabla = document.getElementById("tabla-asignaturas");
  if (!asignaturas || asignaturas.length === 0) {
    tabla.innerHTML =
      '<tr><td colspan="2">No hay programas asignados.</td></tr>';
    return;
  }

  const asignaturasPorNivel = asignaturas.reduce(
    (acc, asignatura) => {
      const nombre = asignatura.nombre;
      if (nombre.includes("N1")) {
        acc.n1.push(nombre);
      } else if (nombre.includes("N2")) {
        acc.n2.push(nombre);
      } else if (nombre.includes("N3")) {
        acc.n3.push(nombre);
      } else if (nombre.includes("N4")) {
        acc.n4.push(nombre);
      } else if (nombre.includes("N5")) {
        acc.n5.push(nombre);
      } else {
        acc.otros.push(nombre);
      }
      return acc;
    },
    { n1: [], n2: [], n3: [], n4: [], n5: [], otros: [] }
  );

  let asignaturasHtml = "";
  for (const nivel in asignaturasPorNivel) {
    if (asignaturasPorNivel[nivel].length > 0) {
      const titulo =
        nivel === "otros"
          ? "Prácticas y Vinculación / Ingles:"
          : `Nivel ${nivel.replace("n", "")}:`;
      asignaturasHtml += `<ul><strong>${titulo}</strong>`;
      asignaturasHtml += asignaturasPorNivel[nivel]
        .map((asig) => `<li>${asig}</li>`)
        .join("");
      asignaturasHtml += `</ul>`;
    }
  }

  const html = `
        <tr>
            <td>${programa.programa}</td>
            <td>${asignaturasHtml}</td>
        </tr>
    `;
  tabla.innerHTML = html;
}

function renderizarCredenciales(credenciales, usuario) {
  const tabla = document.getElementById("tabla-credenciales");

  if (!credenciales || credenciales.length === 0) {
    tabla.innerHTML =
      '<tr><td colspan="3">No hay credenciales disponibles.</td></tr>';
    return;
  }

  const logoPaths = {
    Q10: "/superarseconectados/assets/logos/Q10.png",
    "Office 365 /Teams": "/superarseconectados/assets/logos/Office365.png",
    eLibro: "/superarseconectados/assets/logos/eLibro.png",
  };

  const urls = {
    Q10: "https://superarse.q10.com",
    "Office 365 /Teams": "https://m365.cloud.microsoft/?auth=2",
    eLibro:
      "https://elibro.net/es/lc/superarse/login_usuario/?next=/es/lc/superarse/inicio/",
  };

  const passwords = {
    Q10: "Superarse.2025",
    "Office 365 /Teams": "Superarse.2025",
    eLibro: "Biblioteca.2025",
  };

  const html = credenciales
    .map((credencial) => {
      const plataforma = credencial.plataforma;
      const logo =
        logoPaths[plataforma] ||
        "/superarseconectados/assets/logos/logo-default.png";
      const url = urls[plataforma] || "#";
      const password = passwords[plataforma] || "Contraseña no disponible";

      return `
            <tr>
                <td><a href="${url}" target="_blank"><img src="${logo}" alt="${plataforma}"></a></td>
                <td style="white-space: nowrap; font-size: medium;">${usuario}</td>
                <td>${password}</td>
            </tr>
        `;
    })
    .join("");

  tabla.innerHTML = html;
}

// Nueva función para renderizar la tabla de pagos
function renderizarPagos(datosPagos) {
  const tablaPagosContainer = document.getElementById("tabla-pagos-container");
  const abonoTotalSpan = document.getElementById("abono-total");
  const saldoTotalSpan = document.getElementById("saldo-total"); // <-- Nuevo
  const observacionSpan = document.getElementById("observacion");

  abonoTotalSpan.textContent = datosPagos.abono_total || "0";
  saldoTotalSpan.textContent = datosPagos.saldo_total || "0"; // <-- Nuevo
  observacionSpan.textContent = datosPagos.observacion || "Sin observaciones.";
}

// --- SIMULACIÓN DE DATOS Y LÓGICA DE LA PÁGINA ---

// 1. Simulación de datos de actividades ya registradas
let actividadesRegistradas = [
  {
    actividad:
      "Análisis y levantamiento de requisitos para el proyecto 'Connect'.",
    horas: 8,
    observacion: "Se realizó una reunión inicial con el equipo de ventas.",
    fecha: "2024-10-01",
  },
  {
    actividad: "Creación del esquema de base de datos en PostgreSQL.",
    horas: 10,
    observacion: "Validado por el jefe de área.",
    fecha: "2024-10-03",
  },
  {
    actividad: "Implementación del CRUD de usuarios en el backend.",
    horas: 12,
    observacion: "Módulo completado y en pruebas.",
    fecha: "2024-10-05",
  },
];

// 2. Función para mostrar secciones (basada en el `onclick` de la navegación)
function showSection(sectionId) {
  const sections = document.querySelectorAll(".section-content");
  sections.forEach((section) => {
    section.classList.remove("active");
  });

  const target = document.getElementById(sectionId);
  if (target) {
    target.classList.add("active");
  }

  // Actualizar el estado 'active' en el navbar
  document.querySelectorAll(".navbar-nav .nav-link").forEach((link) => {
    link.classList.remove("active");
    if (
      link.getAttribute("onclick") &&
      link.getAttribute("onclick").includes(`'${sectionId}'`)
    ) {
      link.classList.add("active");
    }
  });

  // Si es la sección de prácticas, cargamos los datos
  if (sectionId === "practicas") {
    loadActividadesRealizadas();
  }
}

// 3. Función para cargar las actividades registradas en la tabla de Fase III
function loadActividadesRealizadas() {
  const tbody = document.getElementById("actividades-realizadas-body");
  if (!tbody) return;

  tbody.innerHTML = ""; // Limpiar registros anteriores
  let totalHoras = 0;

  if (actividadesRegistradas.length > 0) {
    actividadesRegistradas.forEach((item, index) => {
      totalHoras += item.horas;
      const row = tbody.insertRow();

      row.insertCell().textContent = item.actividad;
      row.insertCell().textContent = item.horas;
      row.insertCell().textContent = item.observacion || "Sin observación";
      row.insertCell().textContent = item.fecha;

      // Celda de Acciones (Editar/Eliminar)
      const actionsCell = row.insertCell();
      actionsCell.classList.add("text-center");
      actionsCell.innerHTML = `
                        <button class="btn btn-sm btn-primary me-2 rounded-pill" title="Editar" onclick="showCustomAlert('Editar ítem ${
                          index + 1
                        }')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger rounded-pill" title="Eliminar" onclick="deleteActividad(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
    });
  } else {
    // Mensaje si no hay registros
    const row = tbody.insertRow();
    const cell = row.insertCell();
    cell.colSpan = 6; // Seis columnas incluyendo acciones
    cell.classList.add("text-center", "text-muted", "p-4");
    cell.textContent =
      'No hay actividades registradas todavía. Usa el botón "Registrar Nueva Actividad" para empezar.';
  }

  // Actualizar el total de horas
  document.getElementById("horas-actuales").textContent = totalHoras;
}

// 4. Función de alerta personalizada (Reemplaza alert())
function showCustomAlert(message) {
  console.log("ALERTA: " + message);
}

// 5. Función para eliminar una actividad (Demostración)
function deleteActividad(index) {
  if (
    window.confirm(
      `¿Estás seguro de que quieres eliminar la actividad: "${actividadesRegistradas[index].actividad}"?`
    )
  ) {
    actividadesRegistradas.splice(index, 1);
    loadActividadesRealizadas(); // Recargar la tabla
  }
}

// 6. Función para manejar el envío del formulario del modal (Guardar)
document
  .getElementById("formulario-registro-actividad")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const actividad = document.getElementById("inputActividad").value;
    const horas = parseInt(document.getElementById("inputHoras").value);
    const fecha = document.getElementById("inputFecha").value;
    const observacion = document.getElementById("inputObservacion").value;

    if (!actividad || !horas || !fecha) {
      showCustomAlert("Por favor, complete todos los campos obligatorios.");
      return;
    }

    const nuevoRegistro = {
      actividad: actividad,
      horas: horas,
      observacion: observacion,
      fecha: fecha,
    };

    actividadesRegistradas.push(nuevoRegistro);

    // Cerrar el modal
    const modalElement = document.getElementById("registroActividadModal");
    const modalInstance =
      bootstrap.Modal.getInstance(modalElement) ||
      new bootstrap.Modal(modalElement);
    modalInstance.hide();

    loadActividadesRealizadas();
    this.reset();
  });

// 7. Inicialización de la página al cargar
document.addEventListener("DOMContentLoaded", () => {
  // Muestra la sección 'practicas' y carga los datos al inicio
  showSection("practicas");
});

