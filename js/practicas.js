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
