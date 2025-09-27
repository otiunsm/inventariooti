<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<!-- Botones -->
<div class="mt-6 flex flex-wrap gap-3">
    <!-- Botón volver -->
    <a href="<?= base_url('GestionEquipos') ?>" 
        class="inline-flex items-center gap-2 bg-green-700 text-white px-5 py-2 rounded-lg hover:bg-green-800 shadow transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Volver
    </a>

    <!-- Botón agregar -->
    <button onclick="document.getElementById('modalCaracteristica').classList.remove('hidden')"
        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 shadow transition">
        + Agregar característica
    </button>
</div>

<!-- Modal -->
<div id="modalCaracteristica" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative">
        <!-- Botón cerrar -->
        <button onclick="document.getElementById('modalCaracteristica').classList.add('hidden')" 
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">
            ✕
        </button>

        <h3 class="text-2xl font-semibold mb-6 text-green-700 border-b pb-2">Agregar característica</h3>

        <form action="<?= base_url('equipos/agregar-caracteristica') ?>" method="post" class="space-y-5">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Característica</label>
                <select name="id_atributo_equipo" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-green-200 focus:outline-none" 
                        required>
                    <option value="">-- Seleccione --</option>
                    <?php foreach($atributos as $a): ?>
                        <option value="<?= esc($a['id_atributo_equipo']) ?>">
                            <?= esc($a['equipo_atributo']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Detalle</label>
                <input type="text" name="valor_atributo" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-green-200 focus:outline-none" 
                    placeholder="Ej: Intel Core i5" required>
            </div>

            <!-- id del equipo -->
            <input type="hidden" name="id_equipo" value="<?= esc($id_equipo ?? '') ?>">

            <div class="text-right">
                <button type="submit" 
                        class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 shadow">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Contenedor principal -->
<div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8 border">
    <?php if (!empty($caracteristicas)): ?>
        <h2 class="text-2xl font-bold mb-6 text-green-700 border-b pb-3">
            Equipo <?= esc($caracteristicas[0]['codig_patrimonial']) ?> 
            <span class="text-gray-600 font-normal">- Serie: <?= esc($caracteristicas[0]['num_serie']) ?></span>
        </h2>

        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="w-full text-left">
                <thead class="bg-green-700 text-white text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3">Característica</th>
                        <th class="px-4 py-3">Detalle</th>
                        <th class="px-4 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-700">
                    <?php foreach($caracteristicas as $c): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium"><?= esc($c['equipo_atributo']) ?></td>
                            <td class="px-4 py-3"><?= esc($c['valor_atributo']) ?></td>
                            <td class="px-5 py-3 flex justify-center space-x-2">
                                <!-- Botón Eliminar -->
                                <form action="<?= base_url('equipos/eliminar-caracteristica/'.$c['id_valor_atributo'].'/'.$id_equipo) ?>" method="post" 
                                        onclick="return confirm('¿Seguro que deseas eliminar esta caracteristica?');">
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
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-gray-500 text-center py-6">No se encontraron características para este equipo.</p>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
