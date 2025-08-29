<nav class="bg-green-500 text-white shadow-lg">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <button id="menu-toggle" class="md:hidden focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <div class="flex items-center">
                <img src="<?= base_url('assets/images/UNSMescudo.png') ?>" alt="LogoUniversidad" class="h-10 mr-2">
                <span class="text-xl font-bold">Sistema de Inventario de equipos | UNSM</span>
            </div>
        </div>
        <div class="flex items-center space-x-6">
            <div class="relative hidden md:block">
                <input type="text" placeholder="Buscar equipo..." class="border px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                <i class="fas fa-search absolute right-3 top-3 text-green-500"></i>
            </div>
            <div class="flex items-center space-x-2 cursor-pointer">
                <img src="<?= base_url('assets/images/oti.jpg') ?>" alt="Usuario" class="h-8 w-8 rounded-full">
                <span class="hidden md:inline">Admin</span>
                <i class="fas fa-chevron-down text-sm"></i>
            </div>
        </div>
    </div>
</nav>
