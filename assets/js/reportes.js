// assets/js/reportes.js

document.addEventListener("DOMContentLoaded", () => {

    const formReporte = document.getElementById("form-reporte");
    const mensajeReporte = document.getElementById("mensaje-reporte");

    if (formReporte) {
        formReporte.addEventListener("submit", async (e) => {
            e.preventDefault();

            const formData = new FormData(formReporte);

            try {
                const response = await fetch("index.php?page=guardar_reporte", {
                    method: "POST",
                    body: formData
                });

                if (response.ok) {
                    mostrarMensaje(mensajeReporte, "Reporte creado correctamente", "success");
                    formReporte.reset();

                    // recargar tabla
                    setTimeout(() => location.reload(), 800);
                } else {
                    throw new Error("Error en la respuesta");
                }
            } catch (error) {
                mostrarMensaje(mensajeReporte, "Error al crear el reporte", "error");
            }
        });
    }

    document.querySelectorAll(".form-cambiar-estado").forEach(form => {
        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            const formData = new FormData(form);

            try {
                const response = await fetch("index.php?page=cambiar_estado", {
                    method: "POST",
                    body: formData
                });

                if (response.ok) {
                    location.reload();
                } else {
                    throw new Error();
                }
            } catch (error) {
                alert("Error al actualizar el estado");
            }
        });
    });

    document.querySelectorAll(".form-fecha-limite").forEach(form => {
        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            const formData = new FormData(form);

            try {
                const response = await fetch("index.php?page=asignar_fecha_limite", {
                    method: "POST",
                    body: formData
                });

                if (response.ok) {
                    location.reload();
                } else {
                    throw new Error();
                }
            } catch (error) {
                alert("Error al asignar la fecha límite");
            }
        });
    });

    const formSeguimiento = document.getElementById("form-seguimiento");

    if (formSeguimiento) {
        formSeguimiento.addEventListener("submit", async (e) => {
            e.preventDefault();

            const formData = new FormData(formSeguimiento);

            try {
                const response = await fetch("index.php?page=guardar_seguimiento", {
                    method: "POST",
                    body: formData
                });

                if (response.ok) {
                    location.reload();
                } else {
                    throw new Error();
                }
            } catch (error) {
                alert("Error al guardar el seguimiento");
            }
        });
    }

    function mostrarMensaje(container, texto, tipo) {
        if (!container) return;

        container.innerHTML = `
            <div class="alert ${tipo === "success" ? "alert-success" : "alert-error"}">
                ${texto}
            </div>
        `;

        setTimeout(() => {
            container.innerHTML = "";
        }, 3000);
    }

});