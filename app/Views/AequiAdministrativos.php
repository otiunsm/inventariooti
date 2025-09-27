<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2 class="text-2xl font-semibold mb-4 text-green-700">Asignación - Unidades Administrativas</h2>

<div class="flex space-x-6">
    <!-- Formulario Agregar -->
    <div id="formAgregar" class="w-1/2 bg-white p-6 rounded-lg shadow-md border border-green-300">
        <h3 class="text-xl font-semibold mb-4 text-green-700">Agregar nueva asignación</h3>
        <form action="<?= base_url('AequiAdminis') ?>" method="post" class="space-y-4">
            <div>
                <label>Equipo</label>
                <select name="id_equipo" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">-- Selecciona un equipo --</option>
                    <?php foreach ($equipos as $eq): ?>
                        <option value="<?= $eq['id_equipo'] ?>"><?= $eq['codig_patrimonial'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label>Unidad Destino</label>
                <select name="id_unidad_organica" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">-- Selecciona una unidad --</option>
                    <?php foreach ($unidades as $unidad): ?>
                        <option value="<?= $unidad['id_unidad_organica'] ?>"><?= $unidad['unidad_organica'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label>Fecha</label>
                <input type="date" name="fecha" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label>Estado</label>
                <select name="estado" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800">Guardar</button>
            </div>
        </form>
    </div>

    <!-- Formulario Editar (oculto por defecto) -->
    <div id="formEditar" class="w-1/2 hidden bg-white p-6 rounded-lg shadow-md border border-green-300">
        <h3 class="text-xl font-semibold mb-4 text-green-700">Editar asignación</h3>
        <form id="formEditAsignacion" method="post" class="space-y-4">
            <input type="hidden" name="id_asignacion" id="edit_id_asignacion">
            <div>
                <label>Equipo</label>
                <select name="id_equipo" id="edit_id_equipo" class="w-full border rounded-lg px-3 py-2" required>
                    <?php foreach ($equipos as $eq): ?>
                        <option value="<?= $eq['id_equipo'] ?>"><?= $eq['codig_patrimonial'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label>Unidad Destino</label>
                <select name="id_unidad_organica" id="edit_id_unidad" class="w-full border rounded-lg px-3 py-2" required>
                    <?php foreach ($unidades as $unidad): ?>
                        <option value="<?= $unidad['id_unidad_organica'] ?>"><?= $unidad['unidad_organica'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label>Fecha</label>
                <input type="date" name="fecha" id="edit_fecha" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label>Estado</label>
                <select name="estado" id="edit_estado" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800">
                    Actualizar
                </button>
                <button type="button" id="cancelEdit" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabla de asignaciones -->
<h3 class="text-xl font-semibold mt-8 mb-4 text-green-700">Historial de Asignaciones</h3>
<div style="overflow-x:auto;">
    <table class="w-full rounded-lg shadow-md border border-green-300">
        <thead class="bg-green-700 text-white">
            <tr>
                <th>ID</th><th>Código</th><th>Unidad</th><th>Fecha</th><th>Estado</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-green-200">
            <?php foreach($asignaciones as $ae): ?>
                <tr class="odd:bg-green-50 even:bg-white hover:bg-green-100 transition">
                    <td><?= $ae['Id_asignacion'] ?></td>
                    <td><?= $ae['codigoPatrimonial'] ?></td>
                    <td><?= $ae['unidadDestino'] ?></td>
                    <td><?= $ae['fecha'] ?></td>
                    <td class="<?= ($ae['estado']==1)?'text-green-700':'text-red-600' ?> text-center font-semibold">
                        <?= ($ae['estado']==1)?'Activo':'Inactivo' ?>
                    </td>
                    <td class="text-center">
                    <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 mr-2 editBtn"
                                data-id="<?= $ae['Id_asignacion'] ?>"
                                data-equipo="<?= $ae['codigoPatrimonial'] ?>"
                                data-unidad="<?= $ae['unidadDestino'] ?>"
                                data-fecha="<?= $ae['fecha'] ?>"
                                data-estado="<?= $ae['estado'] ?>">
                            Editar
                    </button>
                        <a href="<?= base_url('AequiAdminis/eliminar/'.$ae['Id_asignacion']) ?>" 
                           class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                           onclick="return confirm('¿Seguro que deseas eliminar este registro?');">
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
// Función para mostrar formulario de edición
document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('formAgregar').classList.add('hidden');
        document.getElementById('formEditar').classList.remove('hidden');

        document.getElementById('edit_id_asignacion').value = button.dataset.id;

        const equipoSelect = document.getElementById('edit_id_equipo');
        for (let option of equipoSelect.options) {
            option.selected = option.text === button.dataset.equipo;
        }

        const unidadSelect = document.getElementById('edit_id_unidad');
        for (let option of unidadSelect.options) {
            option.selected = option.text === button.dataset.unidad;
        }

        document.getElementById('edit_fecha').value = button.dataset.fecha;
        document.getElementById('edit_estado').value = button.dataset.estado;

        document.getElementById('formEditAsignacion').action = '<?= base_url("AequiAdminis/actualizar") ?>/' + button.dataset.id;
    });
});

// Botón cancelar para regresar al formulario de agregar
document.getElementById('cancelEdit').addEventListener('click', () => {
    document.getElementById('formEditar').classList.add('hidden');
    document.getElementById('formAgregar').classList.remove('hidden');

    // Limpiar campos de edición
    document.getElementById('formEditAsignacion').reset();
});
</script>
<?= $this->endSection(); ?>

