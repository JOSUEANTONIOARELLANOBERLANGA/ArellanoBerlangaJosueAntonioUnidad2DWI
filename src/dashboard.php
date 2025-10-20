<?php
require_once 'seguridad.php'; 
require_once 'db.php';

requiereLogin();

if (isset($_GET['logout'])) {
    cerrarSesion();
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'] ?? null;
$nombre_usuario = $_SESSION['nombre'] ?? '';
$correo_usuario = $_SESSION['correo'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contacto'])) {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $correo = limpiarEntrada($_POST['correo'] ?? '');
    $mensaje = limpiarEntrada($_POST['mensaje'] ?? '');

    if (!$nombre || !$correo || !$mensaje) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Todos los campos son obligatorios',
                icon: 'error',
                background: '#0f2027',
                color: '#00f2ff',
                confirmButtonColor: '#00f2ff'
            });
        </script>";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Correo inválido',
                icon: 'error',
                background: '#0f2027',
                color: '#00f2ff',
                confirmButtonColor: '#00f2ff'
            });
        </script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO mensajes (nombre, correo, mensaje, fecha) VALUES (?, ?, ?, NOW())");
        if ($stmt) {
            $stmt->bind_param("sss", $nombre, $correo, $mensaje);
            $stmt->execute();
            $stmt->close();

            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                Swal.fire({
                    title: '¡Mensaje enviado!',
                    text: 'Gracias por contactarnos, " . addslashes($nombre) . "',
                    icon: 'success',
                    background: '#0f2027',
                    color: '#00f2ff',
                    confirmButtonColor: '#00f2ff'
                });
            </script>";
        } else {
            error_log("Error BD insertar mensaje: " . $conn->error);
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo enviar el mensaje, intenta más tarde.',
                    icon: 'error',
                    background: '#0f2027',
                    color: '#00f2ff',
                    confirmButtonColor: '#00f2ff'
                });
            </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>JaabWeb | Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      overflow-x: hidden;
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
    }
    @keyframes gradientBG {
      0%{background-position:0% 50%;}
      50%{background-position:100% 50%;}
      100%{background-position:0% 50%;}
    }
    header {
      background: rgba(0,0,0,0.85);
      box-shadow: 0 0 20px rgba(0,255,255,0.3);
      padding: 1rem 2rem;
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    .navbar-brand { 
      color: #00f2ff !important; 
      font-weight: 900; 
      font-size: 1.8rem;
      letter-spacing: 2px;
      text-shadow: 0 0 10px #00f2ff;
    }
    .nav-link { 
      color: #fff !important; 
      margin-left: 1rem; 
      font-weight: 600;
      transition: color 0.3s ease;
    }
    .nav-link:hover {
      color: #00f2ff !important;
      text-shadow: 0 0 8px #00f2ff;
    }
    .section-title {
      font-size: 2.8rem;
      text-align: center;
      margin-bottom: 2.5rem;
      text-shadow: 0 0 8px #00f2ff;
      font-weight: 800;
    }
    .glass-card {
      background: rgba(255,255,255,0.06);
      border-radius: 1rem;
      backdrop-filter: blur(15px);
      box-shadow: 0 8px 30px rgba(0,255,255,0.25);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      overflow: hidden;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      height: 100%;
    }
    .glass-card:hover { 
      transform: translateY(-10px) scale(1.05);
      box-shadow: 0 15px 40px rgba(0,255,255,0.5);
    }
    .glass-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
      transition: transform 0.4s ease;
    }
    .glass-card:hover img {
      transform: scale(1.1);
    }
    .card-body {
      padding: 1rem 1.2rem;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .card-title {
      font-weight: 700;
      font-size: 1.25rem;
      margin-bottom: 0.75rem;
      color: #00e5ff;
      text-shadow: 0 0 6px #00e5ff;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .card-text {
      flex-grow: 1;
      color: #b0eaff;
      font-size: 0.95rem;
      margin-bottom: 1rem;
      line-height: 1.3;
    }
    .btn-outline-info {
      border-color: #00f2ff;
      color: #00f2ff;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .btn-outline-info:hover {
      background-color: #00f2ff;
      color: #000;
      box-shadow: 0 0 10px #00f2ff;
    }
    form input, form textarea {
      background: rgba(255,255,255,0.12);
      color: #e0ffff;
      border: none;
      border-radius: 0.5rem;
      padding: 0.75rem 1rem 0.75rem 2.5rem;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }
    form input:focus, form textarea:focus {
      background: rgba(0, 242, 255, 0.15);
      outline: none;
      box-shadow: 0 0 10px #00f2ff;
      color: #00f2ff;
    }
    .form-group i {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      color: #00f2ff;
      font-size: 1.2rem;
      pointer-events: none;
    }
    .form-group {
      position: relative;
      margin-bottom: 1rem;
    }
    button.btn-info {
      background: #00f2ff;
      border: none;
      font-weight: 700;
      font-size: 1.1rem;
      box-shadow: 0 0 15px #00f2ff;
    }
    button.btn-info:hover {
      background: #00c1e4;
      box-shadow: 0 0 20px #00c1e4;
    }
    /* Botón flotante chatbot */
    #chatbot-button {
      position: fixed;
      bottom: 25px;
      right: 25px;
      background-color: #00f2ff;
      color: #000;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      font-size: 28px;
      border: none;
      cursor: pointer;
      box-shadow: 0 0 15px #00f2ff;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.3s ease;
    }
    #chatbot-button:hover {
      background-color: #00d1ff;
      box-shadow: 0 0 25px #00d1ff;
    }
    /* Responsive */
    @media (max-width: 576px) {
      .card-body {
        padding: 0.8rem 1rem;
      }
      .card-title {
        font-size: 1.1rem;
      }
      .section-title {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
       <a class="navbar-brand" href="#">JaabWeb <i class="fa-solid fa-code"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="servicios.php">Servicios</a></li>
            <li class="nav-item"><a class="nav-link" href="#portafolio">Portafolio</a></li>
            <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
            <li class="nav-item"><a class="nav-link" href="pago.php">Pago</a></li>
            <li class="nav-item"><a class="nav-link" href="ayuda.php">Ayuda</a></li>
            <li class="nav-item"><a class="nav-link" href="mapa.php">Mapa de sitio</a></li>
            <li class="nav-item"><a class="nav-link text-danger" href="?logout=true"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-3">
      <form class="d-flex" role="search">
        <div class="input-group">
          <span class="input-group-text bg-dark border-0 text-info">
            <i class='bx bx-search'></i>
          </span>
          <input class="form-control bg-dark border-0 text-light" type="search" placeholder="Buscar..." aria-label="Buscar">
          <button class="btn btn-info" type="submit">Buscar</button>
        </div>
      </form>
    </div>
  </header>

  <section id="inicio" class="container py-5" data-aos="fade-up">
    <h1 class="section-title">Bienvenido a <strong>JaabWeb</strong></h1>
    <p class="text-center fs-5">Venta profesional de páginas web 100% funcionales y optimizadas</p>
  </section>

  <section id="servicios" class="container py-5" data-aos="zoom-in">
    <h2 class="section-title">Servicios</h2>
    <div class="row text-center">
      <div class="col-md-3 mb-4"><i class='bx bx-code-alt bx-lg text-info'></i><p>Desarrollo Web</p></div>
      <div class="col-md-3 mb-4"><i class='bx bx-search-alt-2 bx-lg text-info'></i><p>SEO</p></div>
      <div class="col-md-3 mb-4"><i class='bx bx-rocket bx-lg text-info'></i><p>Optimización</p></div>
      <div class="col-md-3 mb-4"><i class='bx bx-globe bx-lg text-info'></i><p>Hosting/Dominio</p></div>
    </div>
  </section>

  <section id="portafolio" class="container py-5" data-aos="fade-right">
    <h2 class="section-title">Portafolio</h2>
    <div class="row g-4">
     <?php
$cards = [
  ["img" => "https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80", "title" => "Proyecto One", "desc" => "Landing page para empresa de software.", "link" => "#"],
  ["img" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80", "title" => "Proyecto Two", "desc" => "Sitio web corporativo responsive.", "link" => "#"],
  ["img" => "https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=600&q=80", "title" => "Proyecto Three", "desc" => "E-commerce para tienda en línea.", "link" => "#"],
  ["img" => "https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=600&q=80", "title" => "Proyecto Four", "desc" => "Blog profesional con CMS.", "link" => "#"],
];
foreach ($cards as $card) {
    echo '<div class="col-sm-6 col-lg-3">';
    echo '<div class="glass-card">';
    echo '<img src="' . htmlspecialchars($card['img']) . '" alt="' . htmlspecialchars($card['title']) . '" loading="lazy">';
    echo '<div class="card-body">';
    echo '<h3 class="card-title"><i class="fa-solid fa-laptop-code"></i> ' . htmlspecialchars($card['title']) . '</h3>';
    echo '<p class="card-text">' . htmlspecialchars($card['desc']) . '</p>';
    echo '<a href="' . htmlspecialchars($card['link']) . '" class="btn btn-outline-info" target="_blank" rel="noopener">Ver proyecto</a>';
    echo '</div></div></div>';
}
?>
    </div>
  </section>

  <section id="contacto" class="container py-5" data-aos="fade-left">
    <h2 class="section-title">Contacto</h2>
    <form method="POST" novalidate>
      <input type="hidden" name="contacto" value="1" />
      <div class="form-group position-relative mb-3">
        <i class="fa-solid fa-user"></i>
        <input type="text" name="nombre" placeholder="Nombre completo" class="form-control" required value="<?= htmlspecialchars($nombre_usuario) ?>">
      </div>
      <div class="form-group position-relative mb-3">
        <i class="fa-solid fa-envelope"></i>
        <input type="email" name="correo" placeholder="Correo electrónico" class="form-control" required value="<?= htmlspecialchars($correo_usuario) ?>">
      </div>
      <div class="form-group position-relative mb-3">
        <i class="fa-solid fa-comment"></i>
        <textarea name="mensaje" rows="5" placeholder="Mensaje" class="form-control" required></textarea>
      </div>
      <button type="submit" class="btn btn-info w-100">Enviar mensaje</button>
    </form>
  </section>

  <button id="chatbot-button" aria-label="Abrir chatbot"><i class="fa-solid fa-robot"></i></button>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init();

    document.getElementById('chatbot-button').addEventListener('click', () => {
      Swal.fire({
        title: 'Chatbot',
        text: 'Aquí va tu chatbot integrado.',
        icon: 'info',
        background: '#0f2027',
        color: '#00f2ff',
        confirmButtonColor: '#00f2ff'
      });
    });
  </script>
</body>
</html>
