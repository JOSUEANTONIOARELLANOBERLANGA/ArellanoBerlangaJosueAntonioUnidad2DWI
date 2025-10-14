<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mapa del Sitio - JAABWEB</title>

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/scrollreveal"></script>
  <script src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.7.0/dist/vanilla-tilt.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #e0f7fa;
      overflow-x: hidden;
    }

    .map-link {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(0, 229, 255, 0.2);
      backdrop-filter: blur(10px);
      transition: all 0.3s ease-in-out;
      position: relative;
      overflow: hidden;
    }

    .map-link::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(120deg, transparent, rgba(0, 229, 255, 0.15), transparent);
      transition: all 0.6s ease-in-out;
    }

    .map-link:hover::before {
      left: 100%;
    }

    .map-link:hover {
      transform: scale(1.04);
      border-color: #00e5ff;
      color: #00e5ff;
      box-shadow: 0 0 15px rgba(0, 229, 255, 0.6);
    }

    .neon-border {
      border: 2px solid #00e5ff;
      box-shadow: 0 0 12px #00e5ff, 0 0 25px #00e5ff;
    }

    #particles-js {
      position: fixed;
      width: 100%;
      height: 100%;
      z-index: -1;
    }

    .floating-btn {
      position: fixed;
      bottom: 25px;
      right: 25px;
      background: #00e5ff;
      color: #0f172a;
      border-radius: 9999px;
      padding: 12px 16px;
      font-size: 18px;
      box-shadow: 0 0 20px #00e5ff;
      transition: all 0.3s ease-in-out;
      z-index: 10;
    }

    .floating-btn:hover {
      background-color: #0f172a;
      color: #00e5ff;
      transform: scale(1.1);
      box-shadow: 0 0 30px #00e5ff;
    }
  </style>
</head>
<body>

  <div id="particles-js"></div>

  <div class="max-w-6xl mx-auto p-8 mt-10 animate__animated animate__fadeIn">
    <h1 class="text-4xl font-extrabold text-cyan-300 mb-12 text-center neon-border p-6 rounded-2xl shadow-2xl">
      Mapa del Sitio - JAABWEB <i class="fas fa-sitemap animate__animated animate__pulse animate__infinite"></i>
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <a href="dashboard.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-home"></i> Página Principal</a>
      <a href="index.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
      <a href="register.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-user-plus"></i> Crear Cuenta</a>
      <a href="forgot_password.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-unlock-alt"></i> Recuperar Contraseña</a>
      <a href="pago.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-credit-card"></i> Pago de Páginas</a>
      <a href="organizacional.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-project-diagram"></i> Modelo Organizacional</a>
      <a href="buzon.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-envelope-open-text"></i> Buzón de Mensajes</a>
      <a href="mapa.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-map"></i> Mapa del Sitio</a>
      <a href="404.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3 text-red-400" data-aos="zoom-in"><i class="fas fa-exclamation-triangle"></i> Error </a>
<a href="cupones.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-tags"></i> Cupones de Descuento</a>
<a href="ofertas.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-gift"></i> Ofertas Exclusivas</a>
<a href="soporte.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-headset"></i> Soporte Técnico</a>
      <a href="servicios.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-concierge-bell"></i> Servicios</a>
<a href="ayuda.php" class="map-link p-6 rounded-xl text-xl flex items-center gap-3" data-aos="zoom-in"><i class="fas fa-question-circle"></i> Centro de Ayuda</a>

    </div>
  </div>

  <a href="dashboard.php" class="floating-btn hvr-buzz" title="Regresar al Inicio">
    <i class="fas fa-arrow-left"></i>
  </a>

  <script>
    VanillaTilt.init(document.querySelectorAll(".map-link"), {
      max: 15,
      speed: 400,
      glare: true,
      "max-glare": 0.3
    });

    AOS.init();

    particlesJS("particles-js", {
      particles: {
        number: { value: 100 },
        color: { value: "#00e5ff" },
        shape: { type: "circle" },
        opacity: { value: 0.5 },
        size: { value: 2 },
        move: { enable: true, speed: 1.5 }
      },
      interactivity: {
        events: {
          onhover: { enable: true, mode: "repulse" }
        }
      }
    });
  </script>
</body>
</html>
