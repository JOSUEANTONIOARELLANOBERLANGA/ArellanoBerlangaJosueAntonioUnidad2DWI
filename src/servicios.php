<?php
session_start();
$usuario = $_SESSION['nombre'] ?? 'Invitado';

$servicios = [
  [
    'id' => 1,
    'titulo' => 'Desarrollo Web',
    'descripcion_corta' => 'Sitios web modernos, responsivos y seguros.',
    'descripcion_larga' => 'Creamos sitios web totalmente personalizados con las últimas tecnologías como React, Vue, PHP y bases de datos optimizadas para escalabilidad y seguridad. Ideal para empresas y emprendedores que quieren destacar en línea.',
    'categoria' => 'Desarrollo',
    'imagen' => 'https://cdn-icons-png.flaticon.com/512/919/919825.png',
  ],
  [
    'id' => 2,
    'titulo' => 'Soporte Técnico',
    'descripcion_corta' => 'Soluciones rápidas y efectivas para tus sistemas.',
    'descripcion_larga' => 'Nuestro equipo experto atiende tus incidencias 24/7, desde problemas con tu hosting hasta configuraciones avanzadas, para que nunca pierdas productividad.',
    'categoria' => 'Soporte',
    'imagen' => 'https://cdn-icons-png.flaticon.com/512/3524/3524659.png',
  ],
  [
    'id' => 3,
    'titulo' => 'Consultoría en Seguridad',
    'descripcion_corta' => 'Auditorías y estrategias para proteger tus datos.',
    'descripcion_larga' => 'Realizamos análisis completos de seguridad informática para detectar vulnerabilidades, proponer soluciones a medida y ayudarte a cumplir con normativas internacionales.',
    'categoria' => 'Seguridad',
    'imagen' => 'https://cdn-icons-png.flaticon.com/512/3064/3064197.png',
  ],
  [
    'id' => 4,
    'titulo' => 'Optimización SEO',
    'descripcion_corta' => 'Mejora tu posicionamiento en buscadores.',
    'descripcion_larga' => 'Con técnicas avanzadas y análisis profundo, aumentamos tu visibilidad orgánica para atraer más visitantes calificados y convertirlos en clientes.',
    'categoria' => 'Marketing',
    'imagen' => 'https://cdn-icons-png.flaticon.com/512/1055/1055672.png',
  ],
];

$categorias = array_unique(array_map(fn($s) => $s['categoria'], $servicios));
sort($categorias);
?>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Servicios - JAABWEB</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      background: var(--bg);
      color: var(--text);
      transition: background-color 0.4s, color 0.4s;
    }
    :root {
      --bg: #0f172a;
      --text: #e0e7ff;
      --glass-bg: rgba(255 255 255 / 0.06);
      --glass-border: rgba(255 255 255 / 0.2);
      --btn-bg: #0ea5e9;
      --btn-bg-hover: #0284c7;
      --shadow-glass: 0 8px 32px 0 rgb(0 0 0 / 0.37);
      --shadow-glass-hover: 0 12px 48px 0 rgb(0 150 255 / 0.7);
    }
    [data-theme="light"] {
      --bg: #f0f9ff;
      --text: #1e293b;
      --glass-bg: rgba(255 255 255 / 0.6);
      --glass-border: rgba(0 0 0 / 0.15);
      --btn-bg: #0284c7;
      --btn-bg-hover: #0ea5e9;
      --shadow-glass: 0 8px 32px 0 rgb(0 0 0 / 0.15);
      --shadow-glass-hover: 0 12px 48px 0 rgb(14 165 233 / 0.6);
    }
    .glass {
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      backdrop-filter: blur(20px);
      box-shadow: var(--shadow-glass);
      border-radius: 1rem;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .glass:hover,
    .glass:focus-visible {
      box-shadow: var(--shadow-glass-hover);
      transform: scale(1.05);
      outline: none;
    }
    @keyframes fadeSlideUp {
      0% {opacity: 0; transform: translateY(25px);}
      100% {opacity: 1; transform: translateY(0);}
    }
    .fade-slide-up {
      animation: fadeSlideUp 0.8s ease forwards;
    }
    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: transparent;
    }
    ::-webkit-scrollbar-thumb {
      background: var(--btn-bg);
      border-radius: 20px;
    }
    #buscador:focus,
    #filtroCategoria:focus {
      outline-offset: 2px;
      box-shadow: 0 0 10px var(--btn-bg);
      border-color: var(--btn-bg);
    }
    .line-clamp-3 {
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .btn-ripple {
      position: relative;
      overflow: hidden;
      user-select: none;
      -webkit-tap-highlight-color: transparent;
    }
    .btn-ripple:after {
      content: "";
      position: absolute;
      border-radius: 50%;
      width: 100px;
      height: 100px;
      top: 50%;
      left: 50%;
      pointer-events: none;
      background: rgba(255 255 255 / 0.3);
      transform: translate(-50%, -50%) scale(0);
      opacity: 0;
      transition: transform 0.5s, opacity 1s;
      z-index: 1;
    }
    .btn-ripple:active:after {
      transform: translate(-50%, -50%) scale(1);
      opacity: 1;
      transition: 0s;
    }
    #btnRegresar {
      position: fixed;
      top: 2rem;
      left: 2rem;
      background: var(--btn-bg);
      color: white;
      border-radius: 50%;
      width: 48px;
      height: 48px;
      box-shadow: 0 0 10px var(--btn-bg);
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      z-index: 1000;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }
    #btnRegresar:hover,
    #btnRegresar:focus-visible {
      background: var(--btn-bg-hover);
      outline: none;
      transform: scale(1.1);
    }
    #btnRegresar svg {
      stroke-width: 2.5;
    }
    [data-tooltip] {
      position: relative;
      cursor: pointer;
    }
    [data-tooltip]:hover::after,
    [data-tooltip]:focus-visible::after {
      content: attr(data-tooltip);
      position: absolute;
      bottom: 125%;
      left: 50%;
      transform: translateX(-50%);
      background: var(--btn-bg);
      color: white;
      padding: 4px 10px;
      border-radius: 6px;
      white-space: nowrap;
      font-size: 0.8rem;
      opacity: 1;
      pointer-events: none;
      z-index: 50;
      box-shadow: 0 0 8px var(--btn-bg);
      transition: opacity 0.3s;
    }
    [data-tooltip]::after {
      opacity: 0;
      transition: opacity 0.3s;
      pointer-events: none;
    }
    :focus-visible {
      outline: 2px solid var(--btn-bg);
      outline-offset: 3px;
    }
  </style>
</head>
<body data-theme="dark">

  <div id="tsparticles" class="fixed inset-0 -z-20"></div>
  <script>
    tsParticles.load("tsparticles", {
      background: { color: "transparent" },
      fpsLimit: 60,
      particles: {
        number: { value: 90, density: { enable: true, area: 900 } },
        color: { value: "#0ea5e9" },
        shape: { type: "circle" },
        opacity: { value: 0.3 },
        size: { value: 3, random: { enable: true, minimumValue: 1 } },
        move: { enable: true, speed: 1.2, direction: "none", outModes: "bounce" },
        links: { enable: true, distance: 140, color: "#0ea5e9", opacity: 0.25, width: 1 }
      },
      interactivity: {
        detectsOn: "canvas",
        events: {
          onHover: { enable: true, mode: "grab" },
          onClick: { enable: true, mode: "push" },
          resize: true
        },
        modes: {
          grab: { distance: 130, links: { opacity: 0.6 } },
          push: { quantity: 4 }
        }
      }
    });
  </script>

  <button id="btnRegresar" aria-label="Regresar a página principal" title="Regresar a inicio" onclick="location.href='index.php'">
    <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-arrow-left" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="26" height="26" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
    </svg>
  </button>

  <main class="min-h-screen flex flex-col items-center px-6 py-12 max-w-7xl mx-auto">

    <header class="w-full max-w-5xl mb-10 text-center fade-slide-up" role="banner">
      <h1 class="text-4xl font-extrabold text-cyan-400 mb-2 select-none flex justify-center items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-10 w-10 stroke-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
          <path d="M21 12v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-8" />
          <polyline points="7 10 12 15 17 10" />
          <line x1="12" y1="15" x2="12" y2="3" />
        </svg>
        Servicios JAABWEB
      </h1>
      <p class="text-slate-300 max-w-3xl mx-auto text-lg" role="contentinfo" aria-live="polite">
        Hola <span class="font-semibold text-cyan-300 select-text"><?= htmlspecialchars($usuario) ?></span>, explora nuestros servicios diseñados para ayudarte a crecer y proteger tu negocio.
      </p>
    </header>

    <section class="w-full max-w-5xl mb-8 flex flex-col md:flex-row md:justify-between items-center gap-4 fade-slide-up" role="search" aria-label="Buscar y filtrar servicios">
      <div>
        <label for="filtroCategoria" class="block text-cyan-300 font-semibold mb-1 select-none">Filtrar por categoría:</label>
        <select id="filtroCategoria" class="bg-transparent border border-cyan-400 rounded-lg px-4 py-2 text-cyan-300 font-medium cursor-pointer transition focus:outline-none focus:ring-2 focus:ring-cyan-400" aria-controls="listaServicios" aria-describedby="categoriaHelp">
          <option value="all" selected>Todos</option>
          <?php foreach ($categorias as $cat): ?>
            <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
          <?php endforeach; ?>
        </select>
        <span id="categoriaHelp" class="sr-only">Filtra los servicios según su categoría</span>
      </div>
      <div class="flex-grow max-w-md w-full">
        <label for="buscador" class="block text-cyan-300 font-semibold mb-1 select-none">Buscar servicios:</label>
        <input type="search" id="buscador" placeholder="Ejemplo: desarrollo, seguridad..." class="w-full bg-transparent border border-cyan-400 rounded-lg px-4 py-2 text-cyan-300 placeholder-cyan-500 focus:ring-2 focus:ring-cyan-400 transition" aria-controls="listaServicios" aria-describedby="busquedaHelp" />
        <span id="busquedaHelp" class="sr-only">Busca servicios por nombre o descripción</span>
      </div>
    </section>

    <section id="listaServicios" class="w-full max-w-5xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 fade-slide-up" role="list" aria-live="polite" aria-label="Lista de servicios disponibles">
      <?php foreach ($servicios as $servicio): ?>
        <article role="listitem" tabindex="0" data-categoria="<?= htmlspecialchars($servicio['categoria']) ?>" class="glass p-6 shadow-lg hover:shadow-cyan-500 transition flex flex-col justify-between" onclick="mostrarDetalle(<?= $servicio['id'] ?>)" onkeypress="if(event.key==='Enter') mostrarDetalle(<?= $servicio['id'] ?>)" aria-describedby="desc<?= $servicio['id'] ?>">
          <img src="<?= htmlspecialchars($servicio['imagen']) ?>" alt="Icono de <?= htmlspecialchars($servicio['titulo']) ?>" class="w-16 h-16 mb-4 mx-auto" loading="lazy" />
          <h3 id="titulo<?= $servicio['id'] ?>" class="text-xl font-semibold text-cyan-300 mb-2 text-center"><?= htmlspecialchars($servicio['titulo']) ?></h3>
          <p id="desc<?= $servicio['id'] ?>" class="text-slate-300 text-center line-clamp-3 mb-4"><?= htmlspecialchars($servicio['descripcion_corta']) ?></p>
          <button 
            aria-label="Más información sobre <?= htmlspecialchars($servicio['titulo']) ?>" 
            class="self-center bg-cyan-600 hover:bg-cyan-500 text-white font-semibold py-2 px-6 rounded-xl transition btn-ripple" 
            type="button" 
            onclick="event.stopPropagation(); mostrarDetalle(<?= $servicio['id'] ?>)" 
            data-tooltip="Más info"
          >
            Más info
          </button>
        </article>
      <?php endforeach; ?>
    </section>

    <footer class="w-full max-w-5xl mt-16 text-center fade-slide-up select-none" role="contentinfo">
      <p class="text-slate-400 text-sm">© 2025 JAABWEB. Todos los derechos reservados.</p>
    </footer>
  </main>

  <script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/64a45e3fcc26a871b0210e4d/1h1r6uqcc';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
  })();
  </script>

  <script>
    lucide.createIcons();

    const buscador = document.getElementById('buscador');
    const filtroCategoria = document.getElementById('filtroCategoria');
    const serviciosElems = document.querySelectorAll('#listaServicios article');

    function filtrarServicios() {
      const texto = buscador.value.toLowerCase();
      const categoria = filtroCategoria.value;

      serviciosElems.forEach(servicio => {
        const titulo = servicio.querySelector('h3').textContent.toLowerCase();
        const desc = servicio.querySelector('p').textContent.toLowerCase();
        const cat = servicio.getAttribute('data-categoria').toLowerCase();

        const textoCoincide = titulo.includes(texto) || desc.includes(texto);
        const categoriaCoincide = (categoria === 'all' || cat === categoria.toLowerCase());

        if(textoCoincide && categoriaCoincide) {
          servicio.style.display = '';
        } else {
          servicio.style.display = 'none';
        }
      });
    }

    buscador.addEventListener('input', filtrarServicios);
    filtroCategoria.addEventListener('change', filtrarServicios);

    function mostrarDetalle(id) {
      const servicio = <?= json_encode($servicios) ?>.find(s => s.id === id);
      if(!servicio) return;

      Swal.fire({
        title: servicio.titulo,
        html: `
          <img src="${servicio.imagen}" alt="Icono de ${servicio.titulo}" style="width:80px; margin-bottom:15px;" loading="lazy" />
          <p style="text-align: justify;">${servicio.descripcion_larga}</p>
        `,
        confirmButtonText: 'Cerrar',
        background: 'rgba(15,23,42,0.95)',
        color: '#cbd5e1',
        showCloseButton: true,
        focusConfirm: false,
      });
    }
  </script>

</body>
</html>
