<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio sesión - Sistema de Inventario de Equipos | UNSM </title>
  <link rel="icon" href="<?= base_url('assets/images/UNSMescudo.png') ?>" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(-45deg, #06a11d, #28a745, #218838, #1e7e34);
      background-size: 400% 400%;
      animation: gradientBG 12s ease infinite;
      font-family: 'Arial', sans-serif;
    }

    @keyframes gradientBG {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
    }

    .overlay {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(6px);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-card {
      max-width: 420px;
      width: 100%;
      padding: 2.5rem;
      border-radius: 20px;
      background-color: #fff;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
      animation: fadeInUp 0.8s ease;
    }

    @keyframes fadeInUp {
      from {opacity: 0; transform: translateY(30px);}
      to {opacity: 1; transform: translateY(0);}
    }

    .btn-unsm {
      background-color: #006633;
      color: #fff;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .btn-unsm:hover {
      background-color: #004d26;
      transform: scale(1.05);
    }

    .form-control:focus {
      border-color: #28a745;
      box-shadow: 0 0 5px rgba(40,167,69,.5);
    }

    .input-group-text {
      background-color: #f8f9fa;
      border-right: 0;
    }

    .titulo-sistema {
      font-size: 1rem;
      font-weight: 500;
    }

    .error-message {
      background-color: #f8d7da;
      border: 1px solid #f5c6cb;
      color: #721c24;
      padding: 10px;
      border-radius: 5px;
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="overlay">
    <div class="login-card">
      <div class="text-center mb-4">
        <img src="<?= base_url('assets/images/UNSMescudo.png') ?>" width="90" class="mb-2">
        <h4 class="text-success fw-bold">Universidad Nacional de San Martín</h4>
        <p class="titulo-sistema text-muted">Sistema de Inventario de Equipos</p>
        <hr>
        <p class="text-muted fw-semibold">Iniciar sesión</p>
      </div>

      <form action="<?= base_url('/acceso') ?>" id="loginForm" method="POST">
        <div class="mb-3 input-group">
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
        </div>
        <div class="mb-3 input-group">
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          <input type="password" name="contrasena" autocomplete="off" class="form-control" placeholder="Contraseña" required>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-unsm">Ingresar</button>
        </div>
      </form>

      <?php if(session()->getFlashdata('error')): ?>
        <div class="error-message mt-3">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
