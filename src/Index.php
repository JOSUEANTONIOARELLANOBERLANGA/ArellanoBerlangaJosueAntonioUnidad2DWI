<?php
require_once 'seguridad.php';
require_once 'db.php';

if (isset($_SESSION['user_id'], $_SESSION['session_token'])) {
    $user_id = $_SESSION['user_id'];
    $token = $_SESSION['session_token'];

    $stmt = $conn->prepare("SELECT session_token, role FROM users WHERE id = ?");
    if (!$stmt) {
        die("Error en la consulta SQL: " . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($token_db, $role_db);
    $stmt->fetch();
    $stmt->close();

    if ($token_db && hash_equals($token_db, $token)) {
        $role = strtolower(trim($role_db));
        if ($role === 'admin') {
            header('Location: administrador.php');
            exit;
        } else {
            header('Location: dashboard.php');
            exit;
        }
    } else {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>JAABWEB | Acceso </title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
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
            primary: '#8b5cf6',
            neon: '#22d3ee'
          },
          boxShadow: {
            neon: '0 0 25px rgba(139, 92, 246, 0.6)',
            hard: '0 0 50px rgba(34,211,238,0.5)',
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-8px)' },
            }
          },
          animation: {
            float: 'float 5s ease-in-out infinite'
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <style>
    .glass {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(16px);
    }
    .input-glow:focus {
      border-color: #8b5cf6;
      box-shadow: 0 0 15px #8b5cf6;
    }
    .btn-glow:hover {
      box-shadow: 0 0 20px #8b5cf6;
      transform: scale(1.04);
    }
    .toggle-dark {
      position: absolute;
      top: 20px;
      right: 20px;
      cursor: pointer;
      z-index: 50;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-black via-gray-900 to-black min-h-screen flex items-center justify-center font-inter text-white relative overflow-hidden">
  <div id="tsparticles" class="absolute inset-0 -z-10"></div>
  <div class="toggle-dark text-gray-400 hover:text-white transition">
    <i class="fas fa-moon fa-2x"></i>
  </div>
  <div class="glass rounded-3xl p-10 w-full max-w-md shadow-neon animate-float transition-all duration-500">
    <h2 class="text-center text-3xl font-orbitron text-primary mb-8 drop-shadow">
      <i class="fas fa-fingerprint text-neon animate-pulse"></i> JAABWEB Login
    </h2>
    <form method="POST" action="login.php" onsubmit="return validarFormulario();">
      <div class="mb-4">
        <label for="email" class="block text-sm mb-1 text-white/80">Correo electrónico</label>
        <input type="email" id="email" name="email" required
               class="w-full px-4 py-2 rounded-md bg-white/10 border border-white/20 input-glow focus:outline-none transition"/>
      </div>
      <div class="mb-4 relative">
        <label for="password" class="block text-sm mb-1 text-white/80">Contraseña</label>
        <input type="password" id="password" name="password" required
               class="w-full px-4 py-2 pr-10 rounded-md bg-white/10 border border-white/20 input-glow focus:outline-none transition"/>
        <i class="fas fa-eye absolute top-9 right-3 text-white/60 cursor-pointer" id="togglePassword"></i>
      </div>
      <div class="mb-5 flex justify-center">
        <div class="g-recaptcha" data-sitekey="6Lf5RFkrAAAAABKsEEPkTXS-_1jOUvNduQTKW57J"></div>
      </div>
      <button type="submit"
              class="w-full py-2 rounded-md btn-glow bg-gradient-to-r from-purple-600 to-blue-500 text-white font-semibold tracking-wide transition duration-300">
        Iniciar Sesión
      </button>
      <div class="text-center mt-4 text-sm text-white/70">
        <a href="register.php" class="hover:underline text-indigo-400">Crear cuenta</a> |
        <a href="forgot_password.php" class="hover:underline text-yellow-400">¿Olvidaste tu contraseña?</a>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
  <script>
    tsParticles.load("tsparticles", {
      fullScreen: { enable: false },
      background: { color: { value: "#00000000" } },
      fpsLimit: 60,
      interactivity: {
        events: {
          onHover: { enable: true, mode: "repulse" },
          resize: true
        },
        modes: {
          repulse: { distance: 100, duration: 0.4 }
        }
      },
      particles: {
        color: { value: "#3b82f6" },
        links: {
          color: "#3b82f6",
          distance: 120,
          enable: true,
          opacity: 0.4,
          width: 1
        },
        collisions: { enable: true },
        move: {
          direction: "none",
          enable: true,
          outModes: { default: "bounce" },
          speed: 2
        },
        number: {
          density: { enable: true, area: 700 },
          value: 60
        },
        opacity: { value: 0.5 },
        shape: { type: "circle" },
        size: { value: { min: 1, max: 5 } }
      },
      detectRetina: true
    });
  </script>
  <script>
    document.querySelector('.toggle-dark').onclick = () => {
      document.body.classList.toggle('dark');
    };
    const toggle = document.getElementById('togglePassword');
    const pwd = document.getElementById('password');
    toggle.onclick = () => {
      const type = pwd.type === 'password' ? 'text' : 'password';
      pwd.type = type;
      toggle.classList.toggle('fa-eye');
      toggle.classList.toggle('fa-eye-slash');
    };
    function validarFormulario() {
      const response = grecaptcha.getResponse();
      if (response.length === 0) {
        Swal.fire({
          title: '¡Intento de intrusión!',
          html: 'Sistema detectó intento de acceso sin verificación <b>reCAPTCHA</b>.<br><br><i>Saltamuros bloqueado.</i>',
          imageUrl: 'https://media.giphy.com/media/hqU2KkjW5bE2v2Z7Q2/giphy.gif',
          imageWidth: 300,
          imageHeight: 200,
          imageAlt: 'Intruso detectado',
          background: '#1f1f1f',
          color: '#fff',
          confirmButtonText: 'Entendido',
          confirmButtonColor: '#8b5cf6'
        });
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
