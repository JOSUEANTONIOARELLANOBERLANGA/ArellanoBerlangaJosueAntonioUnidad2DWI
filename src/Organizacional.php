<!DOCTYPE html><html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Plan Estratégico | JAABWEB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      font-family: 'Orbitron', sans-serif;
      background: linear-gradient(135deg, #0f0f0f, #1a1a1a);
      color: #e0e0e0;
    }
    .neon-box {
      border: 2px solid #00ffe7;
      border-radius: 1rem;
      background: rgba(0, 0, 0, 0.3);
      box-shadow: 0 0 15px #00ffe7, 0 0 30px #0085a1;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .neon-box:hover {
      transform: scale(1.02);
      box-shadow: 0 0 30px #00ffe7, 0 0 50px #00a8ff;
    }
    h2.section-title {
      font-size: 2rem;
      text-transform: uppercase;
      color: #00ffe7;
      border-bottom: 2px solid #00ffe7;
      margin-bottom: 1rem;
      padding-bottom: 0.5rem;
    }
    body {
      background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
    }
    header {
      background: rgba(0,0,0,0.85);
      box-shadow: 0 0 20px rgba(0,255,255,0.3);
      padding: 1rem 2rem;
    }
    .navbar-brand { color: #00f2ff !important; font-weight: bold; font-size: 1.5rem; }
    .nav-link { color: #fff !important; margin-left: 1rem; }
    .section-title {
      font-size: 2rem;
      text-align: center;
      margin-bottom: 2rem;
      text-shadow: 0 0 5px #00f2ff;
    }
    .glass-card {
      background: rgba(255,255,255,0.05);
      border-radius: 1rem;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 20px rgba(0,255,255,0.2);
      transition: transform 0.3s;
    }
    .glass-card:hover { transform: translateY(-5px); }
    form input, form textarea {
      background: rgba(255,255,255,0.1);
      color: #fff;
      border: none;
    }
    .form-group i {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      color: #00f2ff;
    }
    .form-group {
      position: relative;
    }
    .form-group input, .form-group textarea {
      padding-left: 40px;
    }
    #chatbot-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #00f2ff;
      color: #000;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      font-size: 24px;
      border: none;
      cursor: pointer;
      box-shadow: 0 0 10px #00f2ff;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">JaabWeb</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="dashboard.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link text-danger" href="?logout=true"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
<body>
  <div class="container mx-auto px-4 py-10 space-y-12">
    <header class="text-center">
      <h1 class="text-4xl text-cyan-400 font-bold" data-aos="fade-down">Modelo Organizacional de JAABWEB</h1>
      <p class="text-gray-400 mt-2" data-aos="fade-up">Plan estratégico integral con visión tecnológica </p>
    </header><section class="neon-box p-6" data-aos="fade-up">
  <h2 class="section-title">Análisis del Modelo Organizacional</h2>
  <p>JAABWEB es una empresa especializada en desarrollo de soluciones web innovadoras y personalizadas. El modelo organizacional se basa en una estructura ágil y colaborativa, centrada en la satisfacción del cliente y la mejora continua.</p>
</section>

<section class="neon-box p-6" data-aos="fade-up">
  <h2 class="section-title">Análisis del Entorno</h2>
  <ul class="list-disc pl-5 space-y-2">
    <li><strong>Político:</strong> Estabilidad en normativas de comercio electrónico.</li>
    <li><strong>Económico:</strong> Crecimiento del mercado digital.</li>
    <li><strong>Social:</strong> Alta demanda de servicios web personalizados.</li>
    <li><strong>Tecnológico:</strong> Avances en frameworks, IA y automatización.</li>
    <li><strong>Legal:</strong> Cumplimiento con políticas de protección de datos (GDPR, etc.).</li>
  </ul>
</section>

<section class="grid md:grid-cols-2 gap-8">
  <div class="neon-box p-6" data-aos="fade-right">
    <h2 class="section-title">Misión</h2>
    <p>Desarrollar soluciones digitales con impacto real, elevando la experiencia de cada cliente a través de la tecnología.</p>
  </div>
  <div class="neon-box p-6" data-aos="fade-left">
    <h2 class="section-title">Visión</h2>
    <p>Ser líderes en innovación digital en LATAM, reconocidos por transformar ideas en plataformas funcionales y estéticas.</p>
  </div>
</section>

<section class="neon-box p-6" data-aos="zoom-in">
  <h2 class="section-title">Valores</h2>
  <div class="grid md:grid-cols-3 gap-4">
    <div><i class="fas fa-lightbulb text-yellow-400"></i> Innovación</div>
    <div><i class="fas fa-users text-green-400"></i> Trabajo en equipo</div>
    <div><i class="fas fa-shield-alt text-red-400"></i> Responsabilidad</div>
    <div><i class="fas fa-rocket text-purple-400"></i> Excelencia</div>
    <div><i class="fas fa-heart text-pink-400"></i> Compromiso</div>
    <div><i class="fas fa-handshake text-blue-400"></i> Confianza</div>
  </div>
</section>

<section class="neon-box p-6 space-y-4" data-aos="fade-up">
  <h2 class="section-title">Objetivos</h2>
  <ul class="list-decimal pl-5">
    <li>Incrementar la cartera de clientes en un 30% anual.</li>
    <li>Desarrollar 2 nuevos productos propios por año.</li>
    <li>Expandir operaciones a 2 países nuevos antes de 2027.</li>
  </ul>
</section>

<section class="grid md:grid-cols-2 gap-8">
  <div class="neon-box p-6" data-aos="fade-right">
    <h2 class="section-title">Estrategias</h2>
    <ul class="list-disc pl-5">
      <li>Marketing digital segmentado por nicho.</li>
      <li>Alianzas con desarrolladores independientes.</li>
      <li>Capacitación continua del equipo en nuevas tecnologías.</li>
    </ul>
  </div>
  <div class="neon-box p-6" data-aos="fade-left">
    <h2 class="section-title">Metas</h2>
    <ul class="list-disc pl-5">
      <li>100 nuevos clientes en 12 meses.</li>
      <li>2 lanzamientos de herramientas SaaS para técnicos IT.</li>
      <li>Presencia activa en 5 ferias tecnológicas por año.</li>
    </ul>
  </div>
</section>

<section class="neon-box p-6 space-y-4" data-aos="fade-up">
  <h2 class="section-title">Acciones</h2>
  <ul class="list-decimal pl-5">
    <li>Lanzar campañas SEO y Google Ads trimestralmente.</li>
    <li>Implementar CRM para gestión de leads y clientes.</li>
    <li>Crear material multimedia para redes sociales.</li>
  </ul>
</section>

<section class="grid md:grid-cols-2 gap-8">
  <div class="neon-box p-6" data-aos="fade-right">
    <h2 class="section-title">Recursos</h2>
    <ul class="list-disc pl-5">
      <li>Equipo técnico (desarrolladores, diseñadores).</li>
      <li>Plataformas cloud y herramientas de desarrollo.</li>
      <li>Presupuesto anual para innovación ($150,000 MXN).</li>
    </ul>
  </div>
  <div class="neon-box p-6" data-aos="fade-left">
    <h2 class="section-title">Responsables</h2>
    <ul class="list-disc pl-5">
      <li>Director General: Josue Arellano</li>
      <li>CTO: Coordinación tecnológica y capacitación</li>
      <li>CMO: Responsable de campañas y presencia digital</li>
    </ul>
  </div>
</section>

<section class="neon-box p-6" data-aos="zoom-in">
  <h2 class="section-title">Plazos</h2>
  <ul class="list-disc pl-5">
    <li><strong>Q3 2025:</strong> Implementación CRM y 1 herramienta SaaS</li>
    <li><strong>Q4 2025:</strong> Expansión de servicios, campaña regional</li>
    <li><strong>2026:</strong> Escalamiento internacional y nuevos productos</li>
  </ul>
</section>

  </div>  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>  <script>
    AOS.init({
      duration: 1200,
      once: true,
    });
  </script></body>
</html>