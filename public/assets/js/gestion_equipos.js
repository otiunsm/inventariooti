// public/assets/js/gestion_equipos.js

document.addEventListener('DOMContentLoaded', () => {
    const marcaSelect = document.getElementById('marca');
    const modeloSelect = document.getElementById('modelo');

    if (marcaSelect && modeloSelect) {
        marcaSelect.addEventListener('change', function () {
            let idMarca = this.value;

            // Limpiar opciones anteriores
            modeloSelect.innerHTML = '<option value="">-- Selecciona un Modelo --</option>';

            if (idMarca) {
                fetch('/GestionEquipos/modelos/' + idMarca, {
                    headers: { 'X-Resquested-With': 'XMLHttpRequest'}
                })
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(m => {
                            let option = document.createElement('option');
                            option.value = m.id_modelo_equipo;
                            option.textContent = m.modelo_equipo;
                            modeloSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    }
});
