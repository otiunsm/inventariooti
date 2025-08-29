<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1 class="text-2xl font-bold"></h1>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Equipos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Lista de Equipos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1 class="text-2xl font-bold mb-4">Lista de Equipos</h1>

    <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Nombre</th>
                <th class="py-2 px-4 border">Marca</th>
                <th class="py-2 px-4 border">Modelo</th>
                <th class="py-2 px-4 border">Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($equipos)): ?>
                <?php foreach($equipos as $equipo): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border"><?= $equipo['id'] ?></td>
                        <td class="py-2 px-4 border"><?= $equipo['nombre'] ?></td>
                        <td class="py-2 px-4 border"><?= $equipo['marca'] ?></td>
                        <td class="py-2 px-4 border"><?= $equipo['modelo'] ?></td>
                        <td class="py-2 px-4 border"><?= $equipo['estado'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center py-4">No hay equipos registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>


   

</body>
</html>



