
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario - Universidad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
                    <img src="<?= base_url('assets/images/UNSMescudo.png') ?>" alt="Logo de la universidad" class="h-10 mr-2">
                    <span class="text-xl font-bold">Sistema de Inventario de equipos | UNSM</span>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <div class="flex items-center space-x-2 cursor-pointer">
                    <img src="<?= base_url('assets/images/UNSMescudo.png') ?>" alt="Foto de perfil del usuario - Persona con bata de laboratorio" class="h-8 w-8 rounded-full">
                    <span class="hidden md:inline">Admin</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex">
        
        <!-- Sidebar -->
        <div class="sidebar fixed h-full w-64 bg-whitle shadow-lg z-10 overflow-y-auto px-4 py-6">

            <!-- Logo y título -->
            <div class="flex justify-between items-center mb-8">
                <div class="text-center">
                    <img src="<?= base_url('assets/images/oti.jpg') ?>" alt="OTI" class="h-20 mx-auto">
                    <h2 class="text-xl font-semibold mt-4">OFICINA DE TECNOLOGÍAS DE LA INFORMACIÓN</h2>
                </div>
                <button id="sidebar-toggle" class="toggle-btn text-gray-500 hover:text-blue-700 focus:outline-none">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>

            <!-- Menú principal -->
            <ul class="space-y-2">

                <!-- Dashboard -->
                <li>
                    <a href="<?= base_url('dashboard') ?>"  
                    class="flex items-center px-4 py-3 rounded-lg <?= (uri_string() == 'dashboard') ? 'text-green-800 bg-green-100' : 'text-gray-600 hover:bg-green-50' ?>">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Gestión de equipos -->
                <li>
                    <a href="<?= base_url('GestionEquipos') ?>" 
                    class="flex items-center px-4 py-3 rounded-lg <?= (uri_string() == 'GestionEquipos') ? 'text-green-800 bg-green-100' : 'text-gray-600 hover:bg-green-50' ?>">
                        <i class="fas fa-desktop mr-3"></i>
                        <span>Gestión de Equipos</span>
                    </a>
                </li>

                <!-- Asignaciones -->
                <li>
                    <a href="<?= base_url('ModAsignacion/asignaciones') ?>"
                    class="flex items-center px-4 py3 rounded-lg <?= (uri_string() == 'ModAsignacion/asignaciones') ? 'text-green-800 bg-green-100' : 'text-gray-600 hover:bg-green-50' ?>">
                        <i class="fas fa-tasks mr-3"></i>
                        <span>Asignaciones de Equipos</span>
                    </a>
                </li>

                <!-- Historial -->
                <li>
                    <a href="<?= base_url('ModMovimientos/HistorialMovimientos') ?>" 
                    class="flex items-center px-4 py-3 rounded-lg <?= (uri_string() == 'HistorialMovimiento') ? 'text-green-800 bg-green-100' : 'text-gray-600 hover:bg-green-50' ?>">
                        <i class="fas fa-history mr-3"></i>
                        <span>Historial de Movimientos</span>
                    </a>
                </li>

                <!-- Catálogos -->
                <li x-data="{ open: false }">
                    <button @click="open = !open"
                            class="flex items-center w-full px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50">
                        <i class="fas fa-database mr-3"></i>
                        <span class="flex-1 text-left">Catálogos</span>
                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="ml-2"></i>
                    </button>
                    <template x-if="open">
                        <ul class="pl-10 mt-1 space-y-1">
                            <li><a href="<?= base_url('Catalogo/MarcaEquipos') ?>" class="block px-4 py-2 text-gray-600 hover:bg-green-50 rounded-lg"><i class="fas fa-tag mr-2"></i> Marcas</a></li>
                            <li><a href="<?= base_url('Catalogo/ModeloEquipos') ?>" class="block px-4 py-2 text-gray-600 hover:bg-green-50 rounded-lg"><i class="fas fa-cube mr-2"></i> Modelos</a></li>
                            <li><a href="<?= base_url('Catalogo/TipoEquipos') ?>" class="block px-4 py-2 text-gray-600 hover:bg-green-50 rounded-lg"><i class="fas fa-laptop mr-2"></i> Tipos de Equipo</a></li>
                            <li><a href="<?= base_url('Catalogo/AtributoEquipos') ?>" class="block px-4 py-2 text-gray-600 hover:bg-green-50 rounded-lg"><i class="fas fa-list mr-2"></i>Caracteristicas</a></li>
                            <li><a href="<?= base_url('Catalogo/EstadoEquipos') ?>" class="block px-4 py-2 text-gray-600 hover:bg-green-50 rounded-lg"><i class="fas fa-clipboard-check mr-2"></i> Estados</a></li>
                            <!-- Asignaciones -->
                            <li x-data="{ open: <?= (in_array(uri_string(), ['Catalogo/UnidadesOrganicasAdmin', 'Catalogo/UnidadesOrganicasAcadem'])) ? 'true' : 'false' ?> }">
                                <button @click="open = !open"
                                        class="flex items-center w-full px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50">
                                    <i class="fas fa-random mr-3"></i>
                                    <span class="flex-1 text-left">Unidades Organicas</span>
                                    <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="ml-2"></i>
                                </button>
                                <template x-if="open">
                                    <ul class="pl-10 mt-1 space-y-1">
                                        <li>
                                            <a href="<?= base_url('Catalogo/UnidadesOrganicasAdmin') ?>" 
                                            class="block px-4 py-2 rounded-lg <?= (uri_string() == 'Catalogo/UnidadesOrganicasAdmin') ? 'text-green-800 bg-green-100' : 'text-gray-600 hover:bg-green-50' ?>">
                                                <i class="fas fa-briefcase mr-2"></i> Tipo Unidad Administrativa
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('Catalogo/UnidadesOrganicasAcadem') ?>" 
                                            class="block px-4 py-2 rounded-lg <?= (uri_string() == 'Catalogo/UnidadesOrganicasAcadem') ? 'text-green-800 bg-green-100' : 'text-gray-600 hover:bg-green-50' ?>">
                                                <i class="fas fa-university mr-2"></i> Tipo Unidad Académica
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </li>
                            <li><a href="<?= base_url('Catalogo/Sedes') ?>" class="block px-4 py-2 text-gray-600 hover:bg-green-50 rounded-lg"><i class="fas fa-map-marker-alt mr-2"></i> Sedes</a></li>
                        </ul>
                    </template>
                </li>

                <!-- Seguridad -->
                <li x-data="{ open: false }">
                    <button @click="open = !open"
                            class="flex items-center w-full px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50">
                        <i class="fas fa-user-shield mr-3"></i>
                        <span class="flex-1 text-left">Seguridad</span>
                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="ml-2"></i>
                    </button>
                    <template x-if="open">
                        <ul class="pl-10 mt-1 space-y-1">
                            <li><a href="<?= base_url('Usuarios') ?>" class="block px-4 py-2 text-gray-600 hover:bg-green-50 rounded-lg"><i class="fas fa-users mr-2"></i> Usuarios</a></li>
                            <li><a href="<?= base_url('Perfiles') ?>" class="block px-4 py-2 text-gray-600 hover:bg-green-50 rounded-lg"><i class="fas fa-id-badge mr-2"></i> Perfiles/Roles</a></li>
                            <li><a href="<?= base_url('Permisos') ?>" class="block px-4 py-2 text-gray-600 hover:bg-green-50 rounded-lg"><i class="fas fa-key mr-2"></i> Permisos</a></li>
                        </ul>
                    </template>
                </li>

                <!-- Reportes -->
                <li>
                    <a href="<?= base_url('Reportes') ?>" 
                    class="flex items-center px-4 py-3 rounded-lg <?= (uri_string() == 'Reportes') ? 'text-green-800 bg-green-100' : 'text-gray-600 hover:bg-green-50' ?>">
                        <i class="fas fa-file-alt mr-3"></i>
                        <span>Reportes</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Dashboard Content -->
        <div class="content ml-64 flex-1 p-6">
            <!-- Toggle Button for collapsed sidebar -->
            <button id="sidebar-collapsed-toggle" class="toggle-btn hidden fixed top-20 left-0 bg-blue-800 text-white p-2 rounded-r-lg z-10 focus:outline-none">
                <i class="fas fa-chevron-right"></i>
            </button>

            <?php
            // Tarjetas de estadisticas dinamicas

            $conexion = new PDO("mysql:host=localhost;dbname=inventarioequipos", "root", "");

            $totalequipos = $conexion->query("SELECT COUNT(*) FROM equipo")->fetchColumn();
            $activos = $conexion->query("SELECT COUNT(*) FROM equipo WHERE id_estado_equipo = 1")->fetchColumn();
            $mantenimiento = $conexion->query("SELECT COUNT(*) FROM equipo WHERE id_estado_equipo = 2")->fetchColumn();
            $obsoletos = $conexion->query("SELECT COUNT(*) FROM equipo WHERE id_estado_equipo = 3")->fetchColumn();
        
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
                    <a href="<?= base_url('equipos/administrativa') ?>" class="bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg flex flex-col items-center">
                        <i class="fas fa-exchange-alt text-2xl mb-2"></i>
                        <span>Asignar Equipo</span>
                    </a>
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
    

    <script>
        // Toggle sidebar on mobile
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Toggle sidebar collapse/expand
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');
        const toggleBtn = document.getElementById('sidebar-toggle'); // Botón dentro
        const collapsedToggleBtn = document.getElementById('sidebar-collapsed-toggle'); // Botón fuera

        let isCollapsed = false;

        // Colapsar
        toggleBtn.addEventListener('click', function() {
            isCollapsed = true;

            // Ocultar sidebar
            sidebar.classList.add('collapsed');

            // Ajustar contenido
            content.classList.remove('ml-64');
            content.classList.add('expanded');

            // Ocultar botón interno y mostrar externo
            toggleBtn.classList.add('hidden');
            collapsedToggleBtn.classList.remove('hidden');
        });

        // Expandir
        collapsedToggleBtn.addEventListener('click', function() {
            isCollapsed = false;

            // Mostrar sidebar
            sidebar.classList.remove('collapsed');

            // Ajustar contenido
            content.classList.add('ml-64');
            content.classList.remove('expanded');

            // Mostrar botón interno y ocultar externo
            toggleBtn.classList.remove('hidden');
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
