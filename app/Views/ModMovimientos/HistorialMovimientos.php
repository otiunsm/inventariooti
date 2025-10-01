<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="p-6 bg-white rounded-lg shadow-md">
<h2 class="text-xl font-bold mt-8 mb-4 text-green-700">HISTORIAL DE MOVIMIENTOS | UNSM</h2>
    <div style="overflow-x:auto;">
        <div class="rounded-lg shadow-lg border border overflow-hidden">
            <table class="w-full rounded-lg shadow-md border border-green-300">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th>id_historial</th><th>id_asignacion</th><th>codig_patrimonial</th><th>origen</th><th>destino</th><th>fechaMovimiento</th><th>Responsable</th><th>motivo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-200">
                    <?php if (!empty($movimientos)): ?>
                        <?php foreach ($movimientos as $m): ?>
                            <tr class="odd:bg-green-50 even:bg-white hover:bg-green-100 transition">
                                <td class="text-center px-5 py-3 align-middle"><?= esc($m['id_historial_movimiento']) ?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($m['id_asignacion']) ?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($m['codig_patrimonial']) ?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($m['origen']) ?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($m['destino'])?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($m['fecha_movimiento'])?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($m['nombre'])?></td>
                                <td class="text-center px-5 py-3 align-middle"><?= esc($m['motivo'])?></td>
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
<?= $this->endSection(); ?>