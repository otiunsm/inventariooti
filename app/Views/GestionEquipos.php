<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-3xl font-bold font-serif text-green-800">
        Equipos UNSM
    </h2>
    <br>
    <p class="text-gray-700 font-sans">
        Listado actualizado de equipos institucionales
    </p>
    <br>
    <!-- Botón agregar -->
    <button onclick="document.getElementById('modalCrear').classList.remove('hidden')" 
        class="bg-green-700 text-white px-5 py-2 rounded-md mb-5 hover:bg-green-800 transition duration-300 font-semibold shadow-md flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        <span>Agregar Equipo</span>
    </button>

    <div style="overflow-x:auto;">
        <div class="rounded-lg shadow-lg border border overflow-hidden">
            <table class="w-full rounded-lg shadow-md border border-green-300">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th>Tipo</th><th>Código</th><th>Serie</th><th>Marca</th><th>Modelo</th><th>Estado</th><th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-200">
                    <?php if (!empty($equipos)): ?>
                        <?php foreach ($equipos as $e): ?>
                            <tr class="odd:bg-green-50 even:bg-white hover:bg-green-100 transition">
                                <td class="text-center px-5 py-3 align-middle"><?= esc($e['tipoEquipo']) ?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($e['codigoPatrimonial']) ?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($e['numeroSerie']) ?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($e['marcaEquipo'])?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($e['modeloEquipo']) ?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($e['estadoEquipo']) ?></td>
                                <td class="px-5 py-3 text-center space-x-3 flex justify-center items-center">
                                    <!-- Botón Editar -->
                                    <button type="button" 
                                            onclick="document.getElementById('modalEditar<?= $e['Id'] ?>').classList.remove('hidden')" 
                                            class="text-green-700 hover:text-green-900 focus:outline-none" aria-label="Editar equipo <?= esc($e['codigoPatrimonial']) ?>" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                                        </svg>
                                    </button>

                                    <!-- Modal Editar -->
                                    <div id="modalEditar<?= $e['Id'] ?>" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
                                        <div class="bg-white p-8 rounded-lg shadow-xl w-96 max-w-full">
                                            <h3 class="text-xl font-semibold mb-6 text-green-800 border-b border-gray-300 pb-2">Editar Equipo</h3>
                                            <form action="<?= base_url('GestionEquipos/editar/'.$e['Id']) ?>" method="post" class="space-y-4">

                                            <div id="error-container-editar-<?= $e['Id'] ?>">
                                                <?php if (session('showModal') === 'editar-' . $e['Id'] && session('errors')): ?>
                                                    <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
                                                        <?php foreach (session('errors') as $error): ?>
                                                            <p>⚠ <?= esc($error) ?></p>
                                                        <?php endforeach ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                                <input type="text" name="codig_patrimonial" 
                                                    value="<?= esc($e['codigoPatrimonial']) ?>" 
                                                    class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none" required>

                                                <input type="text" name="num_serie" 
                                                    value="<?= esc($e['numeroSerie']) ?>" 
                                                    class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none" required>

                                                <!-- Tipo -->
                                                <select name="id_tipo_equipo" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none"> 
                                                    <?php foreach ($tipos as $t): ?>
                                                        <option value="<?= $t['id_tipo_equipo'] ?>" 
                                                            <?= ($t['id_tipo_equipo'] == $e['id_tipo_equipo']) ? 'selected' : '' ?>>
                                                            <?= esc($t['tipo_equipo']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>

                                                <!-- Modelo -->
                                                <select name="id_modelo_equipo" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none"> 
                                                    <?php foreach ($modelos as $m): ?>
                                                        <option value="<?= $m['id_modelo_equipo'] ?>" 
                                                            <?= ($m['id_modelo_equipo'] == $e['id_modelo_equipo']) ? 'selected' : '' ?>>
                                                            <?= esc($m['modelo_equipo']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>

                                                <!-- Estado -->
                                                <select name="id_estado_equipo" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none"> 
                                                    <?php foreach ($estados as $s): ?>
                                                        <option value="<?= $s['id_estado_equipo'] ?>" 
                                                            <?= ($s['id_estado_equipo'] == $s['id_estado_equipo']) ? 'selected' : '' ?>>
                                                            <?= esc($s['estado_equipo']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>

                                                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                                                    <button type="button" 
                                                            onclick="document.getElementById('modalEditar<?= $e['Id'] ?>').classList.add('hidden');
                                                            document.getElementById('error-container-editar-<?= $e['Id'] ?>').innerHTML='';"
                                                            class="px-4 py-2 border border-gray-400 rounded-md hover:bg-gray-100 transition duration-200 focus:outline-none">
                                                        Cancelar
                                                    </button>
                                                    <button type="submit" class="bg-green-700 text-white px-5 py-2 rounded-md font-semibold hover:bg-green-800 transition duration-300 focus:outline-none">
                                                        Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!--Botom para ver detalle de equipo-->
                                    <a href="<?= base_url('DetalleEquipos/'.$e['Id'])?>" 
                                        class="text-blue-600 hover:text-blue-800" title="Ver detalle" aria-label="Ver detalles del equipo">
                                        <span class="sr-only">Ver detalles</span>
                                        <!--SVG del ojo-->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <!-- pupila -->
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <!-- contorno del ojo -->
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>  
                                    </a>

                                    <!-- Botón Eliminar -->
                                    <a href="<?= base_url('GestionEquipos/eliminar/'.$e['Id']) ?>" 
                                    onclick="return confirm('¿Eliminar este registro?')" 
                                    class="text-red-600 hover:text-red-800 focus:outline-none" aria-label="Eliminar equipo <?= esc($e['codigoPatrimonial']) ?>" title="Eliminar">
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

    <!-- Modal Crear oculto -->
    <div id="modalCrear" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-xl w-96 max-w-full">
            <h3 class="text-xl font-semibold mb-6 text-green-800 border-b border-gray-300 pb-2">Agregar Equipo</h3>
            <form action="<?= base_url('GestionEquipos/crear') ?>" method="post" class="space-y-4">

            <!-- Contenedor errores -->
            <div id="error-container">
                <?php if (session('errors')): ?>
                    <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
                        <?php foreach (session('errors') as $error): ?>
                            <p>⚠ <?= esc($error) ?></p>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>
            </div>

                <input type="text" name="codig_patrimonial" placeholder="Código Patrimonial" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none" required>
                <input type="text" name="num_serie" placeholder="Número de Serie" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none" required>

                <!-- Tipo -->
                <select name="id_tipo_equipo" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none">
                    <option value="">-- Selecciona un Tipo de Equipo --</option> 
                    <?php foreach ($tipos as $t): ?>
                        <option value="<?= $t['id_tipo_equipo'] ?>"><?= esc($t['tipo_equipo']) ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Marca -->
                <select id="marca" name="id_marca_equipo" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none"> 
                    <option value="">-- Selecciona una Marca --</option>
                    <?php foreach ($marcas as $mar): ?>
                        <option value="<?= $mar['id_marca_equipo'] ?>"><?= esc($mar['marca_equipo']) ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Modelo -->
                <select id="modelo" name="id_modelo_equipo" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none"> 
                    <option value="">-- Selecciona un Modelo --</option>
                    <?php foreach ($modelos as $m): ?>
                        <option value="<?= $m['id_modelo_equipo'] ?>"><?= esc($m['modelo_equipo']) ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Estado -->
                <select name="id_estado_equipo" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600 focus:outline-none"> 
                    <option value="">-- Selecciona un Estado --</option>
                    <?php foreach ($estados as $es): ?>
                        <option value="<?= $es['id_estado_equipo'] ?>"><?= esc($es['estado_equipo']) ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="document.getElementById('modalCrear').classList.add('hidden');document.getElementById('error-container').innerHTML='';" class="px-4 py-2 border border-gray-400 rounded-md hover:bg-gray-100 transition duration-200 focus:outline-none">Cancelar</button>
                    <button type="submit" class="bg-green-700 text-white px-5 py-2 rounded-md font-semibold hover:bg-green-800 transition duration-300 focus:outline-none">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (session('showModal') === 'crear'): ?>
<script>
    document.getElementById('modalCrear').classList.remove('hidden');
</script>
<?php endif; ?>

<script src="<?= base_url('assets/js/gestion_equipos.js') ?>"></script>



<?php if (session('showModal') && strpos(session('showModal'), 'editar-') === 0): ?>
<script>
    const id = "<?= explode('-', session('showModal'))[1] ?>";
    document.getElementById('modalEditar' + id).classList.remove('hidden');
</script>
<?php endif; ?>


<script>
function cerrarModalCrear() {
    document.getElementById('modalCrear').classList.add('hidden');
    document.getElementById('error-container').innerHTML = ''; 
}
</script>



<?= $this->endSection(); ?>
