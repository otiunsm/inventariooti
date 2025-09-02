<?php
// Detectar la ruta actual (CodeIgniter 4)
$current_page = uri_string(); 
?>

<!-- Sidebar -->
<div class="sidebar fixed h-full w-64 bg-white shadow-lg z-10">
    <div class="px-4 py-6">
        <div class="flex justify-between items-center mb-8">
            <div class="text-center">
                <img src="<?= base_url('assets/images/oti.jpg') ?>" 
                     alt="OFICINA TECNOLOGÍAS DE LA INFORMACIÓN" 
                     class="h-20 mx-auto">
                <h2 class="text-xl font-semibold mt-4">
                    OFICINA DE TECNOLOGÍAS DE LA INFORMACIÓN
                </h2>
            </div>
            <button id="sidebar-toggle" class="toggle-btn text-gray-500 hover:text-blue-700 focus:outline-none">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="<?= base_url('dashboard') ?>"  
                   class="flex items-center px-4 py-3 rounded-lg 
                          <?= ($current_page == 'dashboard') ? 'text-blue-800 bg-blue-100' : 'text-gray-600 hover:bg-blue-50' ?>">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Equipos -->
            <li>
                <a href="<?= base_url('equipos/gestion') ?>"  
                   class="flex items-center px-4 py-3 rounded-lg 
                          <?= (strpos($current_page, 'equipos') === 0) ? 'text-blue-800 bg-blue-100' : 'text-gray-600 hover:bg-blue-50' ?>">
                    <i class="fas fa-laptop mr-3"></i>
                    <span>Equipos</span>
                </a>
            </li>

            <!-- Unidades -->
            <li>
                <a href="<?= base_url('unidades') ?>"  
                   class="flex items-center px-4 py-3 rounded-lg 
                          <?= ($current_page == 'unidades') ? 'text-blue-800 bg-blue-100' : 'text-gray-600 hover:bg-blue-50' ?>">
                    <i class="fas fa-users mr-3"></i>
                    <span>Unidades Orgánicas</span>
                </a>
            </li>

            <!-- Usuarios -->
            <li>
                <a href="<?= base_url('usuarios') ?>"  
                   class="flex items-center px-4 py-3 rounded-lg 
                          <?= ($current_page == 'usuarios') ? 'text-blue-800 bg-blue-100' : 'text-gray-600 hover:bg-blue-50' ?>">
                    <i class="fas fa-building mr-3"></i>
                    <span>Usuarios</span>
                </a>
            </li>

            <!-- Reportes -->
            <li>
                <a href="<?= base_url('reportes') ?>"  
                   class="flex items-center px-4 py-3 rounded-lg 
                          <?= ($current_page == 'reportes') ? 'text-blue-800 bg-blue-100' : 'text-gray-600 hover:bg-blue-50' ?>">
                    <i class="fas fa-file-alt mr-3"></i>
                    <span>Reportes</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="px-4 py-6 border-t border-gray-200 absolute bottom-0 w-full">
        <a href="<?= base_url('configuracion') ?>" 
           class="flex items-center px-4 py-2 text-gray-600 hover:bg-blue-50 rounded-lg">
            <i class="fas fa-cog mr-3"></i>
            <span>Configuración</span>
        </a>
        <a href="<?= base_url('logout') ?>" 
           class="flex items-center px-4 py-2 text-gray-600 hover:bg-blue-50 rounded-lg">
            <i class="fas fa-sign-out-alt mr-3"></i>
            <span>Cerrar sesión</span>
        </a>
    </div>
</div>




