<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4 text-green-700">Historial de Movimientos</h2>

    <div style="overflow-x:auto;">
        <table class="min-w-full border border-gray-300 rounded-lg">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Asignación</th>
                    <th class="px-4 py-2">Unidad Origen</th>
                    <th class="px-4 py-2">Unidad Destino</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Usuario</th>
                    <th class="px-4 py-2">Motivo</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <?php if (!empty($movimientos)): ?>
                    <?php foreach ($movimientos as $m): ?>
                        <tr>
                            <td class="px-4 py-2"><?= esc($m['id_historial_movimiento']) ?></td>
                            <td class="px-4 py-2"><?= esc($m['id_asignacion']) ?></td>
                            <td class="px-4 py-2"><?= esc($m['origen']) ?></td>
                            <td class="px-4 py-2"><?= esc($m['destino']) ?></td>
                            <td class="px-4 py-2"><?= esc($m['fecha_movimiento']) ?></td>
                            <td class="px-4 py-2"><?= esc($m['usuario']) ?></td>
                            <td class="px-4 py-2"><?= esc($m['motivo']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-gray-500">No hay movimientos registrados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
