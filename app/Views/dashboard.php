
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario - Universidad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            transition: all 0.3s ease;
            transform: translateX(0);
        }
        .sidebar.collapsed {
            transform: translateX(-100%);
            width: 0;
            overflow: hidden;
        }
        .content {
            transition: all 0.3s ease;
        }
        .content.expanded {
            margin-left: 0;
        }
        .toggle-btn {
            transition: all 0.3s ease;
        }
        .toggle-btn.collapsed {
            transform: rotate(180deg);
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <nav class="bg-green-500 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button id="menu-toggle" class="md:hidden focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center">
                    <img src="../public/assets/images/UNSMescudo.png" alt="Logo de la universidad" class="h-10 mr-2">
                    <span class="text-xl font-bold">Sistema de Inventario de equipos | UNSM</span>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Buscar equipo..." class="border px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                    <i class="fas fa-search absolute right-3 top-3 text-green-500"></i>
                </div>
                <div class="flex items-center space-x-2 cursor-pointer">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/4d8c2055-986e-499e-a54c-18212b5833c4.png" alt="Foto de perfil del usuario - Persona con bata de laboratorio" class="h-8 w-8 rounded-full">
                    <span class="hidden md:inline">Admin</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar fixed h-full w-64 bg-white shadow-lg z-10">
            <div class="px-4 py-6">
                <div class="flex justify-between items-center mb-8">
                    <div class="text-center">
                        <img src="../public/assets/images/oti.jpg" alt="OFICINA TECNOLOGÍAS DE LA INFORMACIÓN" class="h-20 mx-auto">
                        <h2 class="text-xl font-semibold mt-4">OFICINA DE TECNOLOGÍAS DE LA INFORMACIÓN</h2>
                    </div>
                    <button id="sidebar-toggle" class="toggle-btn text-gray-500 hover:text-blue-700 focus:outline-none">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center px-4 py-3 text-blue-800 bg-blue-100 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="equipos.php"
                          class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-laptop mr-3"></i>
                            <span>Equipos</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-users mr-3"></i>
                            <span>Unidades Organicas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-building mr-3"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-file-alt mr-3"></i>
                            <span>Reportes</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="px-4 py-6 border-t border-gray-200 absolute bottom-0 w-full">
                <a href="#" class="flex items-center px-4 py-2 text-gray-600 hover:bg-blue-50 rounded-lg">
                    <i class="fas fa-cog mr-3"></i>
                    <span>Configuración</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-gray-600 hover:bg-blue-50 rounded-lg">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Cerrar sesion</span>
                </a>
            </div>
        </div>
        <!-- Dashboard Content -->
        <div class="content ml-64 flex-1 p-6">
            <!-- Toggle Button for collapsed sidebar -->
            <button id="sidebar-collapsed-toggle" class="toggle-btn hidden fixed top-20 left-0 bg-blue-800 text-white p-2 rounded-r-lg z-10 focus:outline-none">
                <i class="fas fa-chevron-right"></i>
            </button>

            <h1 class="text-2xl font-bold text-gray-800 mb-6">Inventario de Equipos</h1>
            <?php
            // Tarjetas de estadisticas dinamicas

            $conexion = new PDO("mysql:host=localhost;dbname=sistemainventario", "root", "");

            $totalequipos = $conexion->query("SELECT COUNT(*) FROM equipo")->fetchColumn();
            $activos = $conexion->query("SELECT COUNT(*) FROM equipo WHERE id_estadoEquipo = 1")->fetchColumn();
            $mantenimiento = $conexion->query("SELECT COUNT(*) FROM equipo WHERE id_estadoEquipo = 2")->fetchColumn();
            $obsoletos = $conexion->query("SELECT COUNT(*) FROM equipo WHERE id_estadoEquipo = 3")->fetchColumn();
        
            ?>
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Total de Equipos</p>
                            <h3 class="text-3xl font-bold text-blue-800"><?= $totalequipos ?></h3>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-laptop text-blue-700 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up mr-1"></i> 12% desde el último mes</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Activos</p>
                            <h3 class="text-3xl font-bold text-green-600"><?= $activos ?></h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up mr-1"></i> 5% desde el último mes</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">En Mantenimiento</p>
                            <h3 class="text-3xl font-bold text-yellow-500"><?= $mantenimiento ?></h3>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fas fa-tools text-yellow-500 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-red-500 text-sm mt-2"><i class="fas fa-arrow-down mr-1"></i> 3% desde el último mes</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Equipos Obsoletos</p>
                            <h3 class="text-3xl font-bold text-red-600"><?= $obsoletos ?></h3>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-red-500 text-sm mt-2"><i class="fas fa-arrow-up mr-1"></i> 8% desde el último mes</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Distribución de Equipos por Facultad</h3>
                    <canvas id="facultyChart" height="250"></canvas>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Estado del Inventario</h3>
                    <canvas id="statusChart" height="250"></canvas>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Acciones Rápidas</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <button class="bg-blue-700 hover:bg-blue-800 text-white py-3 px-4 rounded-lg flex flex-col items-center">
                        <i class="fas fa-plus-circle text-2xl mb-2"></i>
                        <span>Registrar Equipo</span>
                    </button>
                    <button class="bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg flex flex-col items-center">
                        <i class="fas fa-exchange-alt text-2xl mb-2"></i>
                        <span>Asignar Equipo</span>
                    </button>
                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white py-3 px-4 rounded-lg flex flex-col items-center">
                        <i class="fas fa-tools text-2xl mb-2"></i>
                        <span>Reportar Mantenimiento</span>
                    </button>
                    <button class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-4 rounded-lg flex flex-col items-center">
                        <i class="fas fa-file-export text-2xl mb-2"></i>
                        <span>Generar Reporte</span>
                    </button>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold">Actividad Reciente</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/727b98d9-ad80-46f6-a1e4-d6e17bdac649.png" alt="Imagen de usuario - Profesor con anteojos" class="h-10 w-10 rounded-full">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">Dr. Carlos Mendez</p>
                                <p class="text-sm text-gray-500 truncate">Ha solicitado un portátil para el laboratorio de Física</p>
                            </div>
                            <div class="text-sm text-gray-500">
                                10 min ago
                            </div>
                        </div>
                    </div>
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/142e364c-f34f-4bb2-988b-9115af9a55be.png" alt="Imagen de usuario - Técnico de laboratorio" class="h-10 w-10 rounded-full">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">Téc. Luis Ramírez</p>
                                <p class="text-sm text-gray-500 truncate">Ha finalizado el mantenimiento de 5 computadoras</p>
                            </div>
                            <div class="text-sm text-gray-500">
                                2 horas ago
                            </div>
                        </div>
                    </div>
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/e630b597-ffef-439a-868c-cedcb9b7ef3c.png" alt="Imagen de usuario - Estudiante de posgrado" class="h-10 w-10 rounded-full">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">MSc. Ana Torres</p>
                                <p class="text-sm text-gray-500 truncate">Ha devuelto 3 tablets del laboratorio de Química</p>
                            </div>
                            <div class="text-sm text-gray-500">
                                1 día ago
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Toggle sidebar collapse/expand
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const collapsedToggleBtn = document.getElementById('sidebar-collapsed-toggle');
        let isCollapsed = false;

        toggleBtn.addEventListener('click', function() {
            isCollapsed = !isCollapsed;
            
            // Toggle sidebar
            sidebar.classList.toggle('collapsed');
            
            // Adjust content margin
            content.classList.toggle('ml-64');
            content.classList.toggle('expanded');
            
            // Toggle button icons
            toggleBtn.classList.toggle('collapsed');
            collapsedToggleBtn.classList.toggle('hidden');
        });

        collapsedToggleBtn.addEventListener('click', function() {
            isCollapsed = false;
            
            // Show sidebar
            sidebar.classList.remove('collapsed');
            
            // Adjust content margin
            content.classList.add('ml-64');
            content.classList.remove('expanded');
            
            // Toggle button visibility
            toggleBtn.classList.remove('collapsed');
            collapsedToggleBtn.classList.add('hidden');
        });

        // Faculty Distribution Chart
        const facultyCtx = document.getElementById('facultyChart').getContext('2d');
        const facultyChart = new Chart(facultyCtx, {
            type: 'bar',
            data: {
                labels: ['Ingeniería', 'Ciencias', 'Medicina', 'Humanidades', 'Arquitectura'],
                datasets: [{
                    label: 'Equipos por Facultad',
                    data: [420, 280, 190, 150, 110],
                    backgroundColor: [
                        'rgba(30, 64, 175, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(244, 63, 94, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(139, 92, 246, 0.8)'
                    ],
                    borderColor: [
                        'rgba(30, 64, 175, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(244, 63, 94, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(139, 92, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Equipment Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Activos', 'Mantenimiento', 'Obsoletos', 'Sin asignar'],
                datasets: [{
                    data: [1127, 87, 40, 200],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(156, 163, 175, 0.8)'
                    ],
                    borderColor: [
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(156, 163, 175, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });
    </script>
</body>
</html>
