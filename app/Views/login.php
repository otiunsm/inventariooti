<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesion - Sistema de Inventario de Equipos | UNSM </title>
    <link rel="icon" href="assets/images/UNSMescudo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(-45deg, #06a11d, #28a745, #218838, #1e7e34);
               background-size: 400% 400%;
               font-family: 'Arial', 'sans-serif';}
        .login-card {
            max-width: 400px; margin: auto; padding: 2rem;
            border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .btn-unsm { background-color: #006633; color: white; }
        .btn-unsm:hover { background-color: #004d26; }
        .subtexto { font-size: 0.9rem; 
                      color: #6c757d; }
        .error-message {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body >
    <div class="container vh-100 d-flex align-items-center">
        <div class="login-card">
            <div class="text-center mb-4">
                <img src="assets/images/UNSMescudo.png" width="80">
                <hr>
                <h4 class="text-success">Universidad Nacional de San Martín</h4>
                <p class="titulo-sistema text-muted">Sistema de Inventario de equipos</p>
                <small class="subtexto">Acceso exclusivo para personal autorizado</small>
                <p class="text-muted">Iniciar sesión</p>
            </div>
            
            <form action="<?= base_url('/validar') ?>" id="loginForm" method="POST">
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="contrasena" autocomplete="off" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-unsm">Ingresar</button>
                </div>
            </form>

            <!--Muestra mensaje de error-->
            <?php if(session()->getFlashdata('error')): ?>
                <p style="color:red;"><?= session()->getFlashdata('error') ?></p>
            <?php endif; ?>

        </div>
    </div>
    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
