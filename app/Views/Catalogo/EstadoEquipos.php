<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="p-6 bg-white rounded-lg shadow-md">
    <h3 class="text-xl font-bold mt-8 mb-4 text-green-700">Estados para equipos de la UNSM</h3>

    <!-- Botón para abrir modal -->
    <div class="flex justify-left mb-4">
        <button onclick="document.getElementById('modalCrearEstado').classList.remove('hidden')" 
            class="bg-green-700 text-white px-5 py-2 rounded-lg shadow-md hover:bg-green-800 transition duration-300 font-semibold flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Nuevo estado</span>
        </button>
    </div>
    <!-- Modal -->
    <div id="modalCrearEstado" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <!-- Botón cerrar -->
            <button onclick="document.getElementById('modalCrearEstado').classList.add('hidden')" 
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
                ✕
            </button>

            <h2 class="text-xl font-semibold text-green-700 mb-4">Añadir estado</h2>
            
            <!-- Formulario -->
            <form action="<?= base_url('Catalogo/EstadoEquipos/guardar') ?>" method="post">
                <div class="mb-4">
                    <label for="estado_equipo" class="block text-gray-700 font-medium mb-2">Ingresar un estado</label>
                    <input type="text" name="estado_equipo" id="estado_equipo" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Ejemplo: Activo" required> 
                </div>
                <!-- Botones -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="document.getElementById('modalCrearEstado').classList.add('hidden')" 
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg shadow">
                        Cancelar
                    </button>
                    <button type="submit" 
                        class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg shadow">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div style="overflow-x:auto;"> 
        <!-- Primera tabla: Modelo Equipo -->
        <div class="rounded-lg shadow-lg border border overflow-hidden">
            <table class="w-full rounded-lg shadow-md border border-green-300">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-200">
                    <?php if(!empty($estado_equipos)): ?>
                        <?php foreach ($estado_equipos as $estado): ?>
                            <tr class="odd:bg-green-50 even:bg-white hover:bg-green-100 transition">
                                <td class="text-center px-5 py-3 align-middle"><?= $estado['estado_equipo']?></td>
                                <td class="px-5 py-3 flex justify-center space-x-2">
                                    <!-- Botón Editar -->
                                    <button 
                                        onclick="abrirModalEditarEstado('<?= $estado['id_estado_equipo'] ?>', '<?= $estado['estado_equipo'] ?>')" 
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-lg shadow-md transition duration-200" 
                                        title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/>
                                        </svg>
                                    </button>
                                    <!-- Modal Editar -->
                                    <div id="modalEditarEstado" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                                        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                                            <!-- Botón cerrar -->
                                            <button onclick="document.getElementById('modalEditarEstado').classList.add('hidden')" 
                                                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
                                                ✕
                                            </button>

                                            <h2 class="text-xl font-semibold text-yellow-600 mb-4">Editar Modelo de Equipo</h2>
                                            
                                            <!-- Formulario -->
                                            <form id="formEditarEstado" action="<?= base_url('Catalogo/EstadoEquipos/editar') ?>" method="post">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="estado_equipo" id="id_estado_equipo">

                                                <div class="mb-4">
                                                    <label for="estado_equipo" class="block text-gray-700 font-medium mb-2">Nombre del Modelo</label>
                                                    <input type="text" name="estado_equipo" id="estado_equipo_edit" 
                                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                                        required>
                                                </div>
                                                <!-- Botones -->
                                                <div class="flex justify-end space-x-2 mt-6">
                                                    <button type="button" onclick="document.getElementById('modalEditarEstado').classList.add('hidden')" 
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
                                    <!-- Botón Eliminar -->
                                    <form action="<?= base_url('Catalogo/EstadoEquipos/eliminar/'.$estado['id_estado_equipo']) ?>" method="post" 
                                        onsubmit="return confirm('¿Seguro que deseas eliminar esta marca de equipo?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" 
                                            class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-lg shadow-md transition duration-200" 
                                            title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">No hay estados registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function abrirModalEditarEstado(id, nombre) {
        // Llenar los valores en el modal
        document.getElementById('id_estado_equipo').value = id;
        document.getElementById('estado_equipo_edit').value = nombre;

        // Cambiar la acción del formulario dinámicamente
        document.getElementById('formEditarEstado').action = "<?= base_url('Catalogo/EstadoEquipos/editar/') ?>" + id;

        // Mostrar el modal
        document.getElementById('modalEditarEstado').classList.remove('hidden');
    }
</script>

<?= $this->endSection(); ?>