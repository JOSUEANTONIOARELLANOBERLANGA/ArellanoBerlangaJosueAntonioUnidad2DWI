<?php
require 'db.php';

if (!isset($_GET['token'])) {
    die('Token no proporcionado.');
}

$token = $_GET['token'];
$stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Token inválido o expirado.');
}

$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if ($password !== $password_confirm) {
        $error = "Las contraseñas no coinciden.";
    } elseif (strlen($password) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt_update = $conn->prepare("UPDATE users SET password=?, reset_token=NULL WHERE id=?");
        $stmt_update->bind_param("si", $password_hash, $user['id']);
        $stmt_update->execute();

        echo '<!DOCTYPE html>
        <html lang="es" class="dark">
        <head>
          <meta charset="UTF-8" />
          <title>Redirigiendo...</title>
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.min.css"/>
          <style>
            body {
              background: #000;
              color: #fff;
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100vh;
              font-family: "Inter", sans-serif;
            }
          </style>
        </head>
        <body>
        <script>
          Swal.fire({
            icon: "success",
            title: "¡Éxito!",
            text: "Tu contraseña ha sido actualizada.",
            confirmButtonColor: "#ef4444"
          }).then(() => {
            window.location = "index.php";
          });
        </script>
        </body>
        </html>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8" />
  <title>Restablecer Contraseña | JAABWEB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    .glass {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(239, 68, 68, 0.2);
      backdrop-filter: blur(20px);
    }
    .input-glow {
      background: rgba(255, 255, 255, 0.9);
      color: black !important;
      border: 1px solid rgba(0, 0, 0, 0.15);
      transition: all 0.3s ease;
      padding-right: 2.5rem; 
      position: relative;
    }
    .input-glow:focus {
      border-color: #ef4444;
      box-shadow: 0 0 12px #ef4444;
      outline: none;
    }
    .btn-glow:hover {
      box-shadow: 0 0 18px #ef4444;
      transform: scale(1.03);
    }
    label {
      color: rgba(255 255 255 / 0.8);
    }
    .input-wrapper {
      position: relative;
      margin-bottom: 1rem;
    }
    .eye-btn {
      position: absolute;
      top: 50%;
      right: 0.75rem;
      transform: translateY(-50%);
      background: transparent;
      border: none;
      cursor: pointer;
      color: #ef4444;
      font-size: 1.2rem;
      padding: 0;
      z-index: 10;
    }
  </style>
</head>
<body class="bg-black min-h-screen flex items-center justify-center font-inter text-white relative">
  <div id="tsparticles" class="absolute inset-0 -z-10"></div>

  <div class="glass rounded-3xl p-8 w-full max-w-md shadow-xl transition-all duration-500">
    <h2 class="text-center text-2xl font-bold text-red-500 mb-6">
      <i class="fas fa-lock-open animate-pulse"></i> Restablecer Contraseña
    </h2>

    <?php if (!empty($error)): ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: <?= json_encode($error) ?>,
          confirmButtonColor: '#ef4444'
        });
      </script>
    <?php endif; ?>

    <form method="POST" novalidate>
      <div class="input-wrapper">
        <label class="block mb-2 text-sm">Nueva contraseña:</label>
        <input id="password" type="password" name="password" required minlength="6"
               class="w-full px-4 py-2 rounded-md input-glow focus:outline-none transition" />
        <button type="button" class="eye-btn" onclick="togglePassword('password', this)" aria-label="Mostrar/Ocultar contraseña">
          <i class="fa fa-eye"></i>
        </button>
      </div>

      <div class="input-wrapper">
        <label class="block mb-2 text-sm">Confirmar contraseña:</label>
        <input id="password_confirm" type="password" name="password_confirm" required minlength="6"
               class="w-full px-4 py-2 rounded-md input-glow focus:outline-none transition" />
        <button type="button" class="eye-btn" onclick="togglePassword('password_confirm', this)" aria-label="Mostrar/Ocultar contraseña">
          <i class="fa fa-eye"></i>
        </button>
      </div>

      <button type="submit"
              class="w-full py-2 rounded-md btn-glow bg-gradient-to-r from-red-600 to-red-400 text-white font-semibold tracking-wide transition duration-300">
        Actualizar contraseña
      </button>
      <div class="text-center mt-4 text-sm text-white/70">
        ¿Ya tienes acceso? <a href="index.php" class="hover:underline text-red-400">Inicia sesión</a>
      </div>
    </form>
  </div>

  <script>
    function togglePassword(id, btn) {
      const input = document.getElementById(id);
      const icon = btn.querySelector('i');
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }

    tsParticles.load("tsparticles", {
      background: { color: "#00000000" },
      fpsLimit: 60,
      interactivity: {
        events: { onHover: { enable: true, mode: "repulse" }, resize: true },
        modes: { repulse: { distance: 100, duration: 0.4 } }
      },
      particles: {
        color: { value: "#ef4444" },
        links: { color: "#ef4444", distance: 150, enable: true, opacity: 0.4, width: 1 },
        collisions: { enable: true },
        move: { direction: "none", enable: true, outModes: "bounce", speed: 1 },
        number: { density: { enable: true, area: 800 }, value: 50 },
        opacity: { value: 0.4 },
        shape: { type: "circle" },
        size: { value: { min: 1, max: 4 } }
      },
      detectRetina: true
    });
  </script>
</body>
</html>
