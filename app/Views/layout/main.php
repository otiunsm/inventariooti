<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistema de Inventario' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar { transition: all 0.3s ease; transform: translateX(0); }
        .sidebar.collapsed { transform: translateX(-100%); width: 0; overflow: hidden; }
        .content { transition: all 0.3s ease; }
        .content.expanded { margin-left: 0; }
        .toggle-btn { transition: all 0.3s ease; }
        .toggle-btn.collapsed { transform: rotate(180deg); }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">

        <!--Incluye navbar-->
        <?= view('layout/navbar') ?>
    
        <div class="flex">
            <!--Incluye sidebar -->
            <?= view('layout/sidebar')
        <div class="content ml-64 flex-1 p-6">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script>
        // Sidebar toggle
        document.getElementById('menu-toggle')?.addEventListener('click', () => {
            document.querySelector('.sidebar')?.classList.toggle('active');
        });

        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const collapsedToggleBtn = document.getElementById('sidebar-collapsed-toggle');

        toggleBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('ml-64');
            content.classList.toggle('expanded');
            toggleBtn.classList.toggle('collapsed');
            collapsedToggleBtn?.classList.toggle('hidden');
        });

        collapsedToggleBtn?.addEventListener('click', () => {
            sidebar.classList.remove('collapsed');
            content.classList.add('ml-64');
            content.classList.remove('expanded');
            toggleBtn.classList.remove('collapsed');
            collapsedToggleBtn.classList.add('hidden');
        });
    </script>
</body>
</html>

