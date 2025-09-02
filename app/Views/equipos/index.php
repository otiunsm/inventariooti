<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1 class="text-2xl font-bold mb-4">Lista de Equipos</h1>

<!-- Formulario para crear o editar un equipo -->
<div class="mb-6 bg-white p-4 shadow-md rounded-lg border border-gray-200">
    <h2 class="text-lg font-bold mb-3">
        <?= isset($equipoEditar) ? 'Editar Equipo' : 'Nuevo Equipo' ?>
    </h2>

    <form action="<?= isset($equipoEditar) 
                        ? base_url('equipos/actualizar/'.$equipoEditar['id_equipo']) 
                        : base_url('equipos/guardar') ?>" 
          method="post" class="space-y-4">

        <!--tipo de equipo-->
        <div>
            <label class="block text-gray-700">Tipo de Equipo</label>
            <select name="id_tipoEquipo" class="w-full border rounded-lg px-3 py-2" required>
                <option value="">Seleccione...</option>
                    <?php foreach ($tipos as $t): ?>
                <option value="<?= $t['id_tipo']; ?>"
                    <?= isset($equipoEditar) && $equipoEditar['id_tipoEquipo'] == $t['id_tipo'] ? 'selected' : '' ?>>
                    <?= esc($t['nombre']); ?>
                </option>
                    <?php endforeach; ?>
                <option value="nuevo">+otro (Agregar nuevo)</option>
            </select>
                <!--Este input solo aparece si eligen "otro"-->
                <input type="text" name="nuevo_tipo" id="nuevo_tipo" placeholder="Escribe el nuevo tipo"
                 class="w-full border rounded-lg px-3 py-2 mt-2 hidden">  
                
                 <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const selectTipo = document.querySelector('select[name="id_tipoEquipo"]');
                        const inputNuevo = document.getElementById('nuevo_tipo');

                    selectTipo.addEventListener('change', function () {
                        if (this.value === 'nuevo') {
                            inputNuevo.classList.remove('hidden');
                            inputNuevo.required = true;
                        } else {
                            inputNuevo.classList.add('hidden');
                            inputNuevo.required = false;
                            inputNuevo.value = '';
                        }
                    });
                });
                </script>
            
        </div>
        <!--Estado -->
        <div>
            <label class="block text-gray-700">Estado</label>
            <select name="id_estadoEquipo" class="w-full border rounded-lg px-3 py-2" required>
                <option value="">Seleccione...</option>
                    <?php foreach ($estados as $e): ?>
                <option value="<?= $e['id_estado']; ?>"
                    <?= isset($equipoEditar) && $equipoEditar['id_estadoEquipo'] == $e['id_estado'] ? 'selected' : '' ?>>
                    <?= esc($e['estado']); ?>
                </option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!--Modelo-->
        <div>
            <label class="block text-gray-700">Modelo</label>
            <select name="id_modeloEquipo" class="w-full border rounded-lg px-3 py-2" required>
                <option value="">Seleccione...</option>
                    <?php foreach ($modelos as $m): ?>
                <option value="<?= $m['id_modelo']; ?>"
                    <?= isset($equipoEditar) && $equipoEditar['id_modeloEquipo'] == $m['id_modelo'] ? 'selected' : '' ?>>
                    <?= esc($m['modelo']); ?>
                </option>
                    <?php endforeach; ?>
                <option value="nuevo">+otro (Agregar nuevo)</option>
            </select>
            <!--Este input solo aparece si eligen "otro"-->
            <input type="text" name="nuevo_modelo" id="nuevo_modelo" placeholder="Escribe el nuevo modelo"
             class="w-full border rounded-lg px-3 py-2 mt-2 hidden">  
             
             <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const selectModelo = document.querySelector('select[name="id_modeloEquipo"]');
                    const inputNuevo = document.getElementById('nuevo_modelo');

                    selectModelo.addEventListener('change', function () {
                        if (this.value === 'nuevo') {
                            inputNuevo.classList.remove('hidden');
                            inputNuevo.required = true;
                        } else {
                            inputNuevo.classList.add('hidden');
                            inputNuevo.required = false;
                            inputNuevo.value = '';
                        }
                    });
                });
            </script>
             
        </div>
        <!--unidad organica-->
        <div>
            <label class="block text-gray-700">Unidad Orgánica</label>
            <select name="id_unidadOrganicaEquipo" id="unidadOrganicaEquipo" class="w-full border rounded-lg px-3 py-2" required>
                <option value="">Seleccione...</option>
                    <?php foreach ($unidades as $u): ?>
                <option value="<?= $u['id_unidadOrganica']; ?>"
                    <?= isset($equipoEditar) && $equipoEditar['id_unidadOrganicaEquipo'] == $u['id_unidadOrganica'] ? 'selected' : '' ?>>
                    <?= esc($u['nombre']); ?>
                </option>
                    <?php endforeach; ?>
            </select>
            <script>
                $(document).ready(function() {
                    $('#unidadOrganicaEquipo').select2({
                        placeholder: 'Seleccione...',
                        allowClear: true,
                        width: '100%'
                    });
                });
            </script>
        </div>

        <div class="flex space-x-2">
            <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                <?= isset($equipoEditar) ? 'Actualizar' : 'Guardar' ?>
            </button>

            <?php if(isset($equipoEditar)): ?>
                <a href="<?= base_url('equipos') ?>" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Cancelar
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>
<!--Contenido de equipo-->
<div class="w-full overflow-x-auto">
<table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-green-500 text-white">
            <tr>
                <th class="py-3 px-4 text-left">IDequipo</th>
                <th class="py-3 px-4 text-left">TipoEquipo</th>
                <th class="py-3 px-4 text-left">Estado</th>
                <th class="py-3 px-4 text-left">Modelo</th>
                <th class="py-3 px-4 text-left">UnidadOrganica</th>
                <th class="py-3 px-4 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($equipos)): ?>
                <?php foreach($equipos as $equipo): ?>
                    <tr class="border-b hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4"><?= $equipo['id_equipo'] ?></td>
                        <td class="py-2 px-4"><?= $equipo['tipo'] ?></td>
                        <td class="py-2 px-4">
                            <?php 
                            $color = match($equipo['estado']) {
                                'Activo'        => 'bg-green-500',
                                'Mantenimiento' => 'bg-yellow-500 text-black',
                                'Obsoleto'      => 'bg-red-500',
                                default         => 'bg-gray-400'
                            };
                            ?>
                            <span class="px-2 py-1 rounded text-white <?= $color ?>">
                                <?= $equipo['estado'] ?>
                            </span>
                        </td>
                        <td class="py-2 px-4"><?= $equipo['modelo'] ?></td>
                        <td class="py-2 px-4"><?= $equipo['unidad'] ?></td>
                        <td class="py-2 px-4 text-center">
                            <div class="flex justify-center space-x-3">
                                <!--Boton editar -->
                                <a href="<?= base_url('equipos/editar/'.$equipo['id_equipo']) ?>"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!--Boton eliminar-->
                                <a href="<?= base_url('equipos/eliminar/'.$equipo['id_equipo']) ?>"
                                    onclick="return confirm('¿Estas seguro de eliminar este registro?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    <i class="fas fa-trash"></i>
                                </a> 
                            </div>   
                        </td>   
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center py-4">No hay equipos registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>

