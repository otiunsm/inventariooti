<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistema de Inventario' ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar { transition: all 0.3s ease; 
                     transform: translateX(0); 
        }
        .sidebar.collapsed { transform: translateX(-100%);
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

        <!--Incluye navbar-->
        <?= view('layout/navbar') ?>
    
        <div class="flex">
            <!--Incluye sidebar -->
            <?= view('layout/sidebar') ?>

            <!--contenido dinamico-->
            <main class="content flex-1 p-6 transition-all duration-300">
                <!--Boton para mostra sidebar cuando esta oculto -->
                <button id="sidebar-collapsed-toggle"
                        class="toggle-btn hidden fixed to-20 left-0 bg-blue-800 text-white p-2 rounded-r-lg shadow-lg">
                    <i class="fas fa-chevron-right"></i>
                 </button>
                    
                <?= $this->renderSection('content') ?>
            </main>
        </div>

    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    
</body>
</html>

