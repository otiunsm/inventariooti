<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">


<div class="p-6 bg-white rounded-lg shadow-md">
<h2 class="text-xl font-bold mt-8 mb-4 text-green-700">ASIGNACIÓN DE EQUIPOS | UNSM</h2>

    <!-- Botón para abrir modal para crear asignaciones -->
    <div class="flex justify-left mb-4">
        <button onclick="document.getElementById('modalCrearAsignacion').classList.remove('hidden')" 
            class="bg-green-700 text-white px-5 py-2 rounded-lg shadow-md hover:bg-green-800 transition duration-300 font-semibold flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Nueva Asignación</span>
        </button>
    </div>
    <!--Modal para crear una asignacion de un equipo recien ingresado al sistema -->
    <div id="modalCrearAsignacion" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <!-- Botón cerrar -->
            <button onclick="document.getElementById('modalCrearAsignacion').classList.add('hidden')" 
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">✕</button>

            <h2 class="text-xl font-semibold text-green-600 mb-4">Crear Asignación</h2>
            <form action="<?= base_url('asignacionequipo/crear') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Equipo -->
                <div class="mb-4">
                    <label for="id_equipo" class="block text-gray-700 font-medium mb-2">Equipo</label>
                    <select name="id_equipo" id="id_equipo" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500" required>
                        <option value="">Seleccione un equipo</option>
                        <?php foreach($equipos as $eq): ?>
                            <option value="<?= $eq['id_equipo'] ?>"><?= esc($eq['codig_patrimonial']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

               <!-- Unidad Orgánica -->
                <div class="mb-4">
                    <label for="id_unidad_organica" class="block text-gray-700 font-medium mb-2">Unidad Orgánica</label>
                    <select name="id_unidad_organica" id="id_unidad_organica"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500" required>
                        <option value="">Seleccione una unidad</option>
                        <?php foreach($unidades as $uo): ?>
                            <option value="<?= $uo['id_unidad_organica'] ?>"><?= esc($uo['unidad_organica']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Fecha de Asignación -->
                <div class="mb-4">
                    <label for="fecha_asignacion" class="block text-gray-700 font-medium mb-2">Fecha de Asignación</label>
                    <input type="date" name="fecha_asignacion" id="fecha_asignacion"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500" required>
                </div>

                <!-- Estado -->
                <div class="mb-4">
                    <label for="estado_asignacion" class="block text-gray-700 font-medium mb-2">Estado</label>
                    <select name="estado_asignacion" id="estado_asignacion" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500" required>
                        <option value="VIGENTE">VIGENTE</option>
                        <option value="FINALIZADO">FINALIZADO</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="document.getElementById('modalCrearAsignacion').classList.add('hidden')" 
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg shadow">
                        Cancelar
                    </button>
                    <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div style="overflow-x:auto;">
        <div class="rounded-lg shadow-lg border border overflow-hidden">
            <table class="w-full rounded-lg shadow-md border border-green-300">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th>ID_Asignacion</th><th>CodigoPatrimonial</th><th>UnidadAsignada</th><th>FechaAsignada</th><th>EstadoAsignacion</th><th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-200">
                    <?php if (!empty($asignaciones)): ?>
                        <?php foreach ($asignaciones as $a): ?>
                            <tr class="odd:bg-green-50 even:bg-white hover:bg-green-100 transition">
                                <td class="text-center px-5 py-3 align-middle"><?= esc($a['id_asignacion']) ?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($a['codig_patrimonial']) ?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($a['unidad_organica']) ?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($a['fecha_asignacion'])?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($a['estado_asignacion'])?></td>
                                <td class="px-5 py-3 text-center space-x-3 flex justify-center items-center">
                                    <!-- Botón Editar -->
                                    <?php if ($a['estado_asignacion'] === 'VIGENTE'): ?>
                                        <!-- Botón Editar (solo si está vigente) -->
                                        <button type="button" 
                                            onclick="document.getElementById('modalEditarAsignacion<?= $a['id_asignacion'] ?>').classList.remove('hidden')" 
                                            class="text-yellow-600 hover:text-yellow-800 focus:outline-none" 
                                            aria-label="Editar asignación <?= esc($a['id_asignacion']) ?>" 
                                            title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                                class="h-5 w-5" fill="none" viewBox="0 0 24 24" 
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/>
                                            </svg>
                                        </button>
                                    <?php else: ?>
                                        <!-- Ícono bloqueado cuando está Finalizado -->
                                        <span class="text-gray-400" title="Asignación finalizada (no editable)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" 
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </span>
                                    <?php endif; ?>

                                    <!-- Modal oculto para editar asignacion -->
                                    <div id="modalEditarAsignacion<?= $a['id_asignacion'] ?>" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                                        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                                            <!-- Botón cerrar -->
                                            <button onclick="document.getElementById('modalEditarAsignacion<?= $a['id_asignacion'] ?>').classList.add('hidden')" 
                                                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">✕</button>

                                            <h2 class="text-xl font-semibold text-yellow-600 mb-4">Editar Asignación</h2>
                                            <form id="formEditarAsignacion" method="post" action="<?= base_url('asignacionequipo/editar/'.$a['id_asignacion']) ?>">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id_asignacion" id="edit_id_asignacion">

                                                <!-- Fecha -->
                                                <div class="mb-4">
                                                    <label for="edit_fecha_asignacion" class="block text-gray-700 font-medium mb-2">Fecha Asignación</label>
                                                    <input type="date" name="fecha_asignacion" id="edit_fecha_asignacion" 
                                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-yellow-500" required>
                                                </div>

                                                <!-- Estado -->
                                                <div class="mb-4">
                                                    <label for="edit_estado_asignacion" class="block text-gray-700 font-medium mb-2">Estado</label>
                                                    <select name="estado_asignacion" id="edit_estado_asignacion" 
                                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500" required>
                                                        <option value="">Seleccione el Estado</option>
                                                        <option value="VIGENTE" <?= ($a['estado_asignacion'] === 'VIGENTE') ? 'selected' : '' ?>>VIGENTE</option>
                                                        <option value="FINALIZADO" <?= ($a['estado_asignacion'] === 'FINALIZADO') ? 'selected' : '' ?>>FINALIZADO</option>
                                                    </select>
                                                </div>

                                                <!-- Botones -->
                                                <div class="flex justify-end space-x-2 mt-6">
                                                    <button type="button" onclick="document.getElementById('modalEditarAsignacion<?= $a['id_asignacion'] ?>').classList.add('hidden')" 
                                                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg shadow">
                                                        Cancelar
                                                    </button>
                                                    <button type="submit" 
                                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow">
                                                        Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php if ($a['estado_asignacion'] === 'VIGENTE'): ?>
                                        <!-- Botón Reasignar (solo si está vigente) -->
                                        <button 
                                            type="button"
                                            onclick="document.getElementById('modalReasignar<?= $a['id_asignacion'] ?>').classList.remove('hidden')" 
                                            class="text-blue-600 hover:text-blue-800 focus:outline-none"
                                            aria-label="Reasignar equipo <?= esc($a['codig_patrimonial']) ?>" 
                                            title="Reasignar">
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                                class="h-5 w-5" 
                                                fill="none" 
                                                viewBox="0 0 24 24" 
                                                stroke="currentColor" 
                                                stroke-width="2">
                                                <path stroke-linecap="round" 
                                                    stroke-linejoin="round" 
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                                            </svg>
                                        </button>
                                    <?php else: ?>
                                        <!-- Ícono bloqueado cuando está Finalizado -->
                                        <span class="text-gray-400" title="Asignación finalizada (no se puede reasignar)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" 
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </span>
                                    <?php endif; ?>

                                    <!-- Eliminar -->
                                    <a href="<?= base_url('GestionEquipos/eliminar/'.$a['id_asignacion']) ?>" 
                                    onclick="return confirm('¿Eliminar este registro?')" 
                                    class="text-red-600 hover:text-red-800 focus:outline-none" aria-label="Eliminar equipo <?= esc($a['codig_patrimonial']) ?>" title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                                        </svg>
                                    </a>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                            <tr><td colspan="7" class="text-center py-6 text-gray-500 italic">No hay registros</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Script para abrir el modal editar asignacion-->
<script>
    function abrirModalEditarAsignacion(id, fecha, estado) {
        document.getElementById('edit_id_asignacion').value = id;
        document.getElementById('edit_fecha_asignacion').value = fecha;
        document.getElementById('edit_estado_asignacion').value = estado;

        // Cambiar acción dinámicamente
        document.getElementById('formEditarAsignacion').action = "<?= base_url('asignacionequipo/editar/') ?>" + id;

        // Mostrar modal
        document.getElementById('modalEditarAsignacion').classList.remove('hidden');
    }
</script>

<!-- Script para el tom-select para los select de equipo y unidad organica -->
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Para equipos
    new TomSelect("#id_equipo", {
        searchField: ["text"], // buscar por lo que se ve en <option>
        placeholder: "Escriba para buscar un equipo...",
        render: {
            no_results: function(data, escape) {
                return '<div class="text-red-500 px-3 py-2">' + escape('No se encontró ningún equipo') + '</div>';
            }
        }
    });

    // Para unidades orgánicas
    new TomSelect("#id_unidad_organica", {
        searchField: ["text"], // buscar por lo que se ve en <option>
        placeholder: "Escriba para buscar una unidad...",
        render: {
            no_results: function(data, escape) {
                return '<div class="text-red-500 px-3 py-2">' + escape('No se encontró ningúna unidad Organica') + '</div>';
            }
        }
    });
});
</script>



<?= $this->endSection(); ?>