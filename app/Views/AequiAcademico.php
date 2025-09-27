<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2 class="text-2xl font-semibold mb-4 text-green-700">
    Asignación - Unidades de tipo Académicas
</h2>
<p class="mb-3 text-gray-600">
    Si la tabla es muy ancha, usa el contenedor con overflow-x:auto.
</p>

<div style="overflow-x:auto;">
    <div class="rounded-lg shadow-md border border-green-300 overflow-hidden">
        <table class="w-full">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">ID Asignación</th>
                    <th class="px-4 py-3 text-left">ID Equipo</th>
                    <th class="px-4 py-3 text-left">ID Unidad Orgánica</th>
                    <th class="px-4 py-3 text-left">Fecha Asignación</th>
                    <th class="px-4 py-3 text-center">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-green-200">
                <?php if (!empty($asignaciones)): ?>
                    <?php foreach ($asignaciones as $ae): ?>
                        <tr class="odd:bg-green-50 even:bg-white hover:bg-green-100 transition">
                            <td class="px-4 py-2"><?= esc($ae['Id_asignacion']) ?></td>
                            <td class="px-4 py-2"><?= esc($ae['codigoPatrimonial']) ?></td>
                            <td class="px-4 py-2"><?= esc($ae['unidadDestino']) ?></td>
                            <td class="px-4 py-2"><?= esc($ae['fecha']) ?></td>
                            <td class="px-4 py-2 text-center font-semibold 
                                <?= ($ae['estado'] == 'Activo') ? 'text-green-700' : 'text-red-600' ?>">
                                <?= esc($ae['estado']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-3 text-gray-500">
                            No hay registros
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>
