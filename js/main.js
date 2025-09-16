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
        <tr><tr><th>Número de Identificación</th><td>${
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
