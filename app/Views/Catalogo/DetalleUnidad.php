<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="p-6 bg-white rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mt-8 mb-4 text-green-700">LUGARES FÍSICOS | <?= esc($unidad['unidad_organica']) ?></h3>

    <div class="flex space-x-3 mb-5">
        <!-- Botón para Volver -->
        <a href="<?= base_url('Catalogo/UnidadesOrganicasAcadem') ?>" 
            class="bg-green-500 text-white px-5 py-2 rounded-md hover:bg-green-600 transition duration-300 font-semibold shadow-md flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Volver</span>
        </a>
        <!-- Botón para Crear -->
        <button onclick="document.getElementById('modalCrearLugar').classList.remove('hidden')" 
            class="bg-green-700 text-white px-5 py-2 rounded-md hover:bg-green-800 transition duration-300 font-semibold shadow-md flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            <span>Agregar Nuevo Lugar Físico</span>
        </button>
    </div>



    <!-- Modal Crear -->
    <div id="modalCrearLugar" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-xl w-96 max-w-full">
            <h3 class="text-xl font-semibold mb-6 text-green-800 border-b border-gray-300 pb-2">Agregar un Lugar Físico</h3>
            <form action="<?= base_url('DetalleUnidad/crear/'.$unidad['id_unidad_organica']) ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <!-- Input oculto con el ID de la unidad orgánica -->
                <input type="hidden" name="id_unidad_organica" value="<?= esc($unidad['id_unidad_organica']) ?>">

                <input type="text" name="lugar_fisico" placeholder="Nombre del lugar físico"
                    class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none" required>

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="document.getElementById('modalCrearLugar').classList.add('hidden');" class="px-4 py-2 border border-gray-400 rounded-md hover:bg-gray-100 transition">Cancelar</button>
                    <button type="submit" class="bg-green-700 text-white px-5 py-2 rounded-md font-semibold hover:bg-green-800 transition">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <div style="overflow-x:auto;">
        <div class="rounded-lg shadow-lg border border overflow-hidden">
            <table class="w-full rounded-lg shadow-md border border-green-300">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th>Nombre Unidad</th><th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-200">
                    <?php if (!empty($lugares)): ?>
                        <?php foreach ($lugares as $l): ?>
                            <tr class="odd:bg-green-50 even:bg-white hover:bg-green-100 transition">
                                <td class="text-center px-5 py-3 align-middle"><?= esc($l['espacio_fisico']) ?></td>
                                <td class="px-5 py-3 flex justify-center space-x-2">
                                    <!-- Botón Editar -->
                                    <button 
                                        onclick="abrirModalEditarLugar('<?= $l['id_lugar'] ?>', '<?= $l['espacio_fisico'] ?>')" 
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-lg shadow-md transition duration-200" 
                                        title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/>
                                        </svg>
                                    </button>
                                    <!-- Modal Editar -->
                                    <div id="modalEditarLugar" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                                        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                                            <!-- Botón cerrar -->
                                            <button onclick="document.getElementById('modalEditarLugar').classList.add('hidden')" 
                                                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
                                                ✕
                                            </button>

                                            <h2 class="text-xl font-semibold text-yellow-600 mb-4">Editar Lugar Físico</h2>
                                            <!-- Formulario -->
                                            <form id="formEditarLugar"  method="post">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id_lugar" id="edit_id_lugar">

                                                <div class="mb-4">
                                                    <label for="edit_lugar_fisico" class="block text-gray-700 font-medium mb-2">Nombre del Modelo</label>
                                                    <input type="text" name="lugar_fisico" id="edit_lugar_fisico" 
                                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                                        required>
                                                </div>
                                            
                                                <!-- Botones -->
                                                <div class="flex justify-end space-x-2 mt-6">
                                                    <button type="button" onclick="document.getElementById('modalEditarLugar').classList.add('hidden')" 
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
                                    <form action="<?= base_url('DetalleUnidad/'.$unidad['id_unidad_organica'].'/eliminar/'.$l['id_lugar']) ?>" 
                                        method="post" 
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este lugar físico?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" 
                                            class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-lg shadow-md transition duration-200" 
                                            title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-gray-500">No hay espacios fisicos registrados</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function abrirModalEditarLugar(idLugar, nombre) {
    document.getElementById('edit_lugar_fisico').value = nombre;

    // Generar la URL correcta con idUnidad y idLugar
    let idUnidad = "<?= $unidad['id_unidad_organica'] ?>";
    let form = document.getElementById('formEditarLugar');
    form.action = "<?= base_url('DetalleUnidad') ?>/" + idUnidad + "/editar/" + idLugar;

    document.getElementById('modalEditarLugar').classList.remove('hidden');
}

</script>
<?= $this->endSection(); ?>