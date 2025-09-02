document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    const content = document.querySelector('.content');
    const toggleBtn = document.getElementById('sidebar-toggle');
    const collapsedToggleBtn = document.getElementById('sidebar-collapsed-toggle');
  
    function openSidebar() {
      if (!sidebar || !content) return;
      sidebar.classList.remove('collapsed');
      sidebar.classList.remove('active'); // mobile fallback
      content.classList.add('ml-64');
      content.classList.remove('expanded');
      toggleBtn?.classList.remove('collapsed');
      collapsedToggleBtn?.classList.add('hidden');
      localStorage.setItem('sidebar-collapsed', 'false');
    }
  
    function closeSidebar() {
      if (!sidebar || !content) return;
      sidebar.classList.add('collapsed');
      content.classList.remove('ml-64');
      content.classList.add('expanded');
      toggleBtn?.classList.add('collapsed');
      collapsedToggleBtn?.classList.remove('hidden');
      localStorage.setItem('sidebar-collapsed', 'true');
    }
  
    // Mobile hamburger (abre/cierra sidebar en pantallas pequeñas)
    if (menuToggle && sidebar) {
      menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
      });
    }
  
    // Botón de colapsar (en sidebar)
    if (toggleBtn) {
      toggleBtn.addEventListener('click', function() {
        if (sidebar.classList.contains('collapsed')) openSidebar();
        else closeSidebar();
      });
    }
  
    // Botón flotante para volver a abrir
    if (collapsedToggleBtn) {
      collapsedToggleBtn.addEventListener('click', function() {
        openSidebar();
      });
    }
  
    // Inicializa estado desde localStorage (opcional)
    if (localStorage.getItem('sidebar-collapsed') === 'true') closeSidebar();
    else openSidebar();
  });
  