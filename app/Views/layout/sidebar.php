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
            <li x-data="{ open: <?= (in_array(uri_string(), ['TipoUnidadAdministrativa', 'TipoUnidadAcademica'])) ? 'true' : 'false' ?> }">
                <button @click="open = !open"
                        class="flex items-center w-full px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50">
                    <i class="fas fa-random mr-3"></i>
                    <span class="flex-1 text-left">Asignaciones</span>
                    <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="ml-2"></i>
                </button>
                <template x-if="open">
                    <ul class="pl-10 mt-1 space-y-1">
                        <li>
                            <a href="<?= base_url('TipoUnidadAdministrativa') ?>" 
                            class="block px-4 py-2 rounded-lg <?= (uri_string() == 'AequiAdminis') ? 'text-green-800 bg-green-100' : 'text-gray-600 hover:bg-green-50' ?>">
                                <i class="fas fa-briefcase mr-2"></i> Unidad Administrativa
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('TipoUnidadAcademica') ?>" 
                            class="block px-4 py-2 rounded-lg <?= (uri_string() == 'AequiAcademi') ? 'text-green-800 bg-green-100' : 'text-gray-600 hover:bg-green-50' ?>">
                                <i class="fas fa-university mr-2"></i> Unidad Académica
                            </a>
                        </li>
                    </ul>
                </template>
            </li>

            <!-- Historial -->
            <li>
                <a href="<?= base_url('HistorialMovimiento') ?>" 
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
                        <li><a href="<?= base_url('Catalogo/EstadoEquipos') ?>" class="block px-4 py-2 text-gray-600 hover:bg-green-50 rounded-lg"><i class="fas fa-circle mr-2"></i> Estados</a></li>
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







