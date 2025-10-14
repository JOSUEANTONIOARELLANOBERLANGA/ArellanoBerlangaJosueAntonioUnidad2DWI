<?php
session_start();
$usuario = $_SESSION['nombre'] ?? 'Invitado';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Centro de Ayuda - JAABWEB</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>

  <style>
    body {
      background-color: #0f172a;
      color: #f1f5f9;
      font-family: 'Segoe UI', sans-serif;
    }
    .glass {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(16px);
    }
  </style>
</head>
<body>
  <div id="tsparticles" class="fixed inset-0 -z-10"></div>
  <script>
    tsParticles.load("tsparticles", {
      background: { color: "#0f172a" },
      particles: {
        color: { value: "#38bdf8" },
        links: { enable: true, color: "#38bdf8", distance: 120 },
        move: { enable: true, speed: 1 },
        number: { value: 80 },
        size: { value: 2 }
      }
    });
  </script>

  <div class="min-h-screen flex items-center justify-center px-4">
    <div class="glass p-8 rounded-2xl shadow-2xl max-w-3xl w-full animate-fade-in">
      <h1 class="text-3xl font-bold text-cyan-400 mb-4 flex items-center gap-2">
        <i data-lucide="life-buoy" class="w-6 h-6 text-cyan-400"></i> Centro de Ayuda - JAABWEB
      </h1>
      <p class="mb-6">Hola <strong class="text-cyan-300"><?= htmlspecialchars($usuario) ?></strong>, encuentra aquí soluciones rápidas y soporte técnico.</p>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-4 bg-slate-800 rounded-xl hover:ring-2 ring-cyan-400 transition duration-300">
          <h2 class="text-xl font-semibold text-cyan-300 mb-2 flex items-center gap-2">
            <i data-lucide="wrench" class="w-5 h-5"></i> Problemas Técnicos
          </h2>
          <ul class="list-disc list-inside text-slate-300 space-y-1">
            <li>Error al iniciar sesión</li>
            <li>No recibes correos</li>
            <li>Problemas de conexión</li>
          </ul>
        </div>

        <div class="p-4 bg-slate-800 rounded-xl hover:ring-2 ring-cyan-400 transition duration-300">
          <h2 class="text-xl font-semibold text-cyan-300 mb-2 flex items-center gap-2">
            <i data-lucide="shield-check" class="w-5 h-5"></i> Seguridad
          </h2>
          <ul class="list-disc list-inside text-slate-300 space-y-1">
            <li>Recuperar contraseña</li>
            <li>Revisar actividad sospechosa</li>
            <li>Proteger tu cuenta</li>
          </ul>
        </div>

        <div class="p-4 bg-slate-800 rounded-xl hover:ring-2 ring-cyan-400 transition duration-300">
          <h2 class="text-xl font-semibold text-cyan-300 mb-2 flex items-center gap-2">
            <i data-lucide="user-plus" class="w-5 h-5"></i> Registro y Cuenta
          </h2>
          <ul class="list-disc list-inside text-slate-300 space-y-1">
            <li>¿Cómo registrarte?</li>
            <li>Modificar tus datos</li>
            <li>Eliminar tu cuenta</li>
          </ul>
        </div>

        <div class="p-4 bg-slate-800 rounded-xl hover:ring-2 ring-cyan-400 transition duration-300">
          <h2 class="text-xl font-semibold text-cyan-300 mb-2 flex items-center gap-2">
            <i data-lucide="mail" class="w-5 h-5"></i> Contacto
          </h2>
          <p class="text-slate-300">
            ¿No encontraste solución? <br />
            Escríbenos a: <br />
            <span class="text-cyan-400">soporte@jaabweb.com</span>
          </p>
        </div>
      </div>

      <div class="mt-10 text-center">
        <button onclick="volverInicio()" class="bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-2 px-6 rounded-xl flex items-center justify-center gap-2 mx-auto transition duration-300">
          <i data-lucide="arrow-left-circle" class="w-5 h-5"></i> Volver al inicio
        </button>
      </div>
    </div>
  </div>

  <script>
    lucide.createIcons();

    function volverInicio() {
      Swal.fire({
        title: '¿Deseas regresar?',
        text: "Volverás a la página principal.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0ea5e9',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Sí, regresar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "dashboard.php";
        }
      });
    }
  </script>
</body>
</html>
