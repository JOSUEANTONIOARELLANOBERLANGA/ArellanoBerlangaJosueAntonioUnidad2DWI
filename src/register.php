<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if (empty($name) || empty($email) || empty($password)) {
    $_SESSION['error'] = "Por favor, completa todos los campos.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "El correo no es válido.";
  } else {
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
      $_SESSION['error'] = "Este correo ya está registrado.";
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $name, $email, $hash);
      $stmt->execute();
      $_SESSION['success'] = "Registro exitoso. Bienvenido a JAABWEB.";
      header("Location: index.php");
      exit;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro JAABWEB</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.7.2/dist/vanilla-tilt.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            orbitron: ['Orbitron', 'sans-serif'],
            inter: ['Inter', 'sans-serif']
          },
          colors: {
            primary: '#6366f1',
            glass: 'rgba(255, 255, 255, 0.05)',
          },
          boxShadow: {
            glow: '0 0 15px rgba(99,102,241,0.6)',
          },
          animation: {
            float: 'float 3s ease-in-out infinite',
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-5px)' },
            }
          }
        }
      }
    }
  </script>
  <style>
    .glass {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(20px);
    }
    .input-glow:focus {
      border-color: #6366f1;
      box-shadow: 0 0 12px #6366f1;
    }
    .btn-glow:hover {
      box-shadow: 0 0 18px #818cf8;
      transform: scale(1.03);
    }
    .toggle-dark {
      position: absolute;
      top: 20px;
      right: 20px;
      cursor: pointer;
      z-index: 50;
    }
    .toggle-password {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
    }
  </style>
</head>
<body class="bg-black min-h-screen flex items-center justify-center font-inter text-white relative overflow-hidden">

  <div id="tsparticles" class="absolute inset-0 -z-10"></div>

  <div class="toggle-dark text-gray-400 hover:text-white transition">
    <i class="fas fa-moon fa-2x"></i>
  </div>

  <div class="glass rounded-3xl p-10 w-full max-w-md shadow-glow animate-float" data-tilt>
    <h2 class="text-center text-3xl font-orbitron text-primary mb-8 drop-shadow">
      <i class="fas fa-user-plus text-primary animate-pulse"></i> Crear Cuenta
    </h2>

    <form method="POST" onsubmit="return validar();">
      <div class="mb-4">
        <label class="block text-sm mb-1 text-white/80">Nombre</label>
        <input type="text" name="name" id="name" required
               class="w-full px-4 py-2 rounded-md bg-glass border border-white/20 input-glow focus:outline-none transition"/>
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1 text-white/80">Correo electrónico</label>
        <input type="email" name="email" id="email" required
               class="w-full px-4 py-2 rounded-md bg-glass border border-white/20 input-glow focus:outline-none transition"/>
      </div>

      <div class="mb-4 relative">
        <label class="block text-sm mb-1 text-white/80">Contraseña</label>
        <input type="password" name="password" id="password" required
               class="w-full px-4 py-2 rounded-md bg-glass border border-white/20 input-glow focus:outline-none transition pr-10"/>
        <i class="fas fa-eye toggle-password text-white/60 absolute right-3 top-9" onclick="togglePassword()"></i>
      </div>

      <button type="submit"
              class="w-full py-2 rounded-md btn-glow bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold tracking-wide transition duration-300">
        Registrarse
      </button>

      <div class="text-center mt-4 text-sm text-white/70">
        ¿Ya tienes cuenta? <a href="index.php" class="hover:underline text-indigo-400">Inicia sesión</a>
      </div>
    </form>
  </div>

  <?php if (isset($_SESSION['error'])): ?>
    <script>
      Swal.fire({ icon: 'error', title: 'Error', text: '<?= $_SESSION['error'] ?>' });
    </script>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['success'])): ?>
    <script>
      Swal.fire({ icon: 'success', title: 'Éxito', text: '<?= $_SESSION['success'] ?>' });
    </script>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <script>
    document.querySelector('.toggle-dark').onclick = () => {
      document.body.classList.toggle('dark');
    };

    function togglePassword() {
      const input = document.getElementById('password');
      const icon = document.querySelector('.toggle-password');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }

    function validar() {
      const nombre = document.getElementById("name").value.trim();
      const correo = document.getElementById("email").value.trim();
      const clave = document.getElementById("password").value.trim();

      if (!nombre || !correo || !clave) {
        Swal.fire({ icon: 'warning', title: 'Campos vacíos', text: 'Debes completar todos los campos.' });
        return false;
      }
      if (!correo.includes('@')) {
        Swal.fire({ icon: 'error', title: 'Correo inválido', text: 'El correo debe contener @.' });
        return false;
      }
      return true;
    }

    VanillaTilt.init(document.querySelector(".glass"), {
      max: 15,
      speed: 400,
      glare: true,
      "max-glare": 0.3,
    });

    tsParticles.load("tsparticles", {
      background: { color: "#00000000" },
      fpsLimit: 60,
      interactivity: {
        events: { onHover: { enable: true, mode: "repulse" }, resize: true },
        modes: { repulse: { distance: 100, duration: 0.4 } }
      },
      particles: {
        color: { value: "#6366f1" },
        links: { color: "#6366f1", distance: 150, enable: true, opacity: 0.4, width: 1 },
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
