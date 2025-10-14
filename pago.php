<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}
require 'db.php';

$alerta = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pago'])) {
  $tarjeta = str_replace('-', '', $_POST['tarjeta']);
  $nombre = trim($_POST['nombre']);
  $mes_anio = $_POST['mesanio'];
  $cvv = $_POST['cvv'];

  if (empty($tarjeta) || empty($nombre) || empty($mes_anio) || empty($cvv)) {
    $alerta = "Por favor, completa todos los campos.";
  } elseif (!preg_match('/^\d{16}$/', $tarjeta)) {
    $alerta = "El número de tarjeta debe tener 16 dígitos.";
  } elseif (!preg_match('/^\d{3}$/', $cvv)) {
    $alerta = "El CVV debe tener 3 dígitos.";
  } elseif (preg_match('/\d/', $nombre)) {
    $alerta = "El nombre no debe contener números.";
  } else {
    list($mes, $anio) = explode('-', $mes_anio);
    $tarjeta_encriptada = password_hash($tarjeta, PASSWORD_DEFAULT);
    $cvv_encriptado = password_hash($cvv, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO pagos (tarjeta, nombre, mes, anio, cvv) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
      $stmt->bind_param("sssss", $tarjeta_encriptada, $nombre, $mes, $anio, $cvv_encriptado);
      $stmt->execute();
      $alerta = "Pago registrado exitosamente.";
    } else {
      $alerta = "Error al conectar con la base de datos.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pago | JaabWeb</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
      position: relative;
      overflow-x: hidden;
    }
    .contenedor {
      max-width: 900px;
      margin: auto;
      position: relative;
      z-index: 10; 
    }
    .formulario-tarjeta, .tarjeta {
      transition: all 0.4s ease-in-out;
    }
    .tarjeta {
      perspective: 1000px;
      margin-bottom: 2rem;
    }
    .formulario-tarjeta {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 0 25px rgba(0, 255, 255, 0.1);
    }
    .formulario-tarjeta .grupo label {
      color: #0ff;
      margin-bottom: .5rem;
      font-weight: 500;
    }
    .formulario-tarjeta .grupo input {
      background-color: rgba(255,255,255,0.07);
      border: 1px solid #0ff;
      color: #fff;
      border-radius: 10px;
      padding: 10px;
      width: 100%;
    }
    .formulario-tarjeta .btn {
      padding: 10px 20px;
      border-radius: 12px;
      font-weight: bold;
      transition: 0.3s ease;
    }
    .btn-success {
      background-color: #00c896;
      border: none;
    }
    .btn-success:hover {
      background-color: #00ffcc;
      color: #000;
    }
    .btn-danger {
      background-color: #ff4d4d;
      border: none;
    }
    .btn-danger:hover {
      background-color: #ff1a1a;
    }
    .btn-abrir-formulario {
      background-color: #111;
      color: #0ff;
      border: 2px solid #0ff;
      border-radius: 50%;
      padding: 10px 15px;
      font-size: 20px;
      transition: 0.3s ease;
    }
    .btn-abrir-formulario:hover {
      background-color: #0ff;
      color: #000;
    }
    /* Canvas para fondo animado */
    #fondoDinero {
      position: fixed;
      top: 0; left: 0;
      width: 100vw;
      height: 100vh;
      pointer-events: none;
      z-index: 1;
      display: block;
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
  </style>
</head>
<body>
<canvas id="fondoDinero"></canvas>

<header>
     <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
       <a class="navbar-brand" href="#">JaabWeb <i class="fa-solid fa-code"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="dashboard.php">Inicio</a></li>
          </ul>
        </div>
      </div>
    </nav>
</header>

<div class="contenedor mt-5">
  <section class="tarjeta" id="tarjeta">
    <div class="delantera">
      <div class="logo-marca" id="logo-marca"></div>
      <img src="img/chip-tarjeta.png" class="chip" alt="chip tarjeta">
      <div class="datos">
        <div class="grupo" id="numero">
          <p class="label">Número Tarjeta</p>
          <p class="numero">#### #### #### ####</p>
        </div>
        <div class="flexbox">
          <div class="grupo" id="nombre">
            <p class="label">Nombre Tarjeta</p>
            <p class="nombre">JAABWEB</p>
          </div>
          <div class="grupo" id="expiracion">
            <p class="label">Expiración</p>
            <p class="expiracion"><span class="mes">MM</span> / <span class="year">AA</span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="trasera">
      <div class="barra-magnetica"></div>
      <div class="datos">
        <div class="grupo" id="firma">
          <p class="label">Firma</p>
          <div class="firma"><p></p></div>
        </div>
        <div class="grupo" id="ccv">
          <p class="label">CCV</p>
          <p class="ccv"></p>
        </div>
      </div>
      <p class="leyenda">Pago seguro con JaabWeb.</p>
      <a href="#" class="link-banco">www.jaabweb.com</a>
    </div>
  </section>

  <div class="contenedor-btn mb-3 text-center">
    <button class="btn-abrir-formulario" id="btn-abrir-formulario"><i class="fas fa-plus"></i></button>
  </div>

  <form action="" method="POST" id="formulario-tarjeta" class="formulario-tarjeta">
    <input type="hidden" name="pago" value="1">
    <div class="grupo">
      <br/><br/>
      <label for="inputNumero">Número Tarjeta</label>
      <input type="text" id="inputNumero" name="tarjeta" maxlength="19" required>
    </div>
    <div class="grupo">
      <label for="inputNombre">Nombre</label>
      <input type="text" id="inputNombre" name="nombre" maxlength="60" autocomplete="off" required>
    </div>
    <div class="flexbox">
      <div class="grupo expira me-2">
        <label for="inputFecha">Expiración</label>
        <input type="month" name="mesanio" id="inputFecha" class="form-control" required>
      </div>
      <div class="grupo ccv">
        <label for="inputCCV">CVV</label>
        <input type="text" id="inputCCV" name="cvv" maxlength="3" required>
      </div>
    </div>
    <div class="d-flex justify-content-between mt-4">
      <button type="submit" class="btn btn-success">💳 Pagar</button>
      <button type="button" class="btn btn-danger" id="btn-limpiar">Limpiar</button>
    </div>
  </form>
</div>

<?php if (!empty($alerta)): ?>
<script>
  Swal.fire({
    icon: <?= strpos($alerta, 'exitosamente') !== false ? "'success'" : "'warning'" ?>,
    title: <?= strpos($alerta, 'exitosamente') !== false ? "'Éxito'" : "'Atención'" ?>,
    text: "<?= $alerta ?>",
    confirmButtonColor: '#00c896'
  });
</script>
<?php endif; ?>

<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.getElementById('inputNumero').addEventListener('input', function (e) {
    let value = e.target.value.replace(/[^\d]/g, '').slice(0, 16);
    e.target.value = value.replace(/(.{4})/g, '$1-').trim().slice(0, 19);
    document.querySelector('.numero').textContent = e.target.value || '#### #### #### ####';
  });

  document.getElementById('inputNombre').addEventListener('input', function (e) {
    let value = e.target.value.replace(/[0-9]/g, '').replace(/\s{2,}/g, ' ');
    e.target.value = value;
    document.querySelector('.nombre').textContent = e.target.value || 'JAABWEB';
  });

  document.getElementById('inputCCV').addEventListener('input', function (e) {
    e.target.value = e.target.value.replace(/[^\d]/g, '').slice(0, 3);
    document.querySelector('.ccv').textContent = e.target.value;
  });

  document.getElementById('inputFecha').addEventListener('input', function (e) {
    const [year, month] = e.target.value.split('-');
    document.querySelector('.mes').textContent = month || 'MM';
    document.querySelector('.year').textContent = year ? year.slice(2) : 'AA';
  });

  document.getElementById('btn-limpiar').addEventListener('click', function () {
    document.getElementById('formulario-tarjeta').reset();
    document.querySelector('.numero').textContent = '#### #### #### ####';
    document.querySelector('.nombre').textContent = 'JAABWEB';
    document.querySelector('.mes').textContent = 'MM';
    document.querySelector('.year').textContent = 'AA';
    document.querySelector('.ccv').textContent = '';
  });

  const btnAbrir = document.getElementById('btn-abrir-formulario');
  const formTarjeta = document.getElementById('formulario-tarjeta');
  btnAbrir.addEventListener('click', () => {
    if (formTarjeta.style.display === 'none' || !formTarjeta.style.display) {
      formTarjeta.style.display = 'block';
      btnAbrir.innerHTML = '<i class="fas fa-times"></i>';
    } else {
      formTarjeta.style.display = 'none';
      btnAbrir.innerHTML = '<i class="fas fa-plus"></i>';
    }
  });
</script>

<script>
  const canvas = document.getElementById('fondoDinero');
  const ctx = canvas.getContext('2d');
  let width, height;
  let monedas = [];

  class Moneda {
    constructor() {
      this.x = Math.random() * width;
      this.y = Math.random() * -height;
      this.size = 10 + Math.random() * 20;
      this.speed = 1 + Math.random() * 3;
      this.angle = Math.random() * Math.PI * 2;
      this.spinSpeed = 0.02 + Math.random() * 0.05;
    }

    draw() {
      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.rotate(this.angle);
      let grad = ctx.createRadialGradient(0, 0, this.size / 4, 0, 0, this.size);
      grad.addColorStop(0, '#fff700');
      grad.addColorStop(0.6, '#ffd700');
      grad.addColorStop(1, '#b8860b');
      ctx.fillStyle = grad;
      ctx.beginPath();
      ctx.ellipse(0, 0, this.size, this.size * 0.7, 0, 0, 2 * Math.PI);
      ctx.fill();
      ctx.strokeStyle = '#aa8400';
      ctx.lineWidth = 2;
      ctx.stroke();

      ctx.fillStyle = 'rgba(255, 255, 255, 0.6)';
      ctx.beginPath();
      ctx.ellipse(-this.size / 3, -this.size / 4, this.size / 4, this.size / 7, 0, 0, Math.PI * 2);
      ctx.fill();

      ctx.restore();
    }

    update() {
      this.y += this.speed;
      this.angle += this.spinSpeed;
      if (this.y > height + this.size) {
        this.x = Math.random() * width;
        this.y = -this.size;
        this.speed = 1 + Math.random() * 3;
        this.size = 10 + Math.random() * 20;
        this.spinSpeed = 0.02 + Math.random() * 0.05;
      }
    }
  }

  function setup() {
    width = window.innerWidth;
    height = window.innerHeight;
    canvas.width = width;
    canvas.height = height;
    monedas = [];
    for (let i = 0; i < 40; i++) {
      monedas.push(new Moneda());
    }
  }

  function animate() {
    ctx.clearRect(0, 0, width, height);
    monedas.forEach(moneda => {
      moneda.update();
      moneda.draw();
    });
    requestAnimationFrame(animate);
  }

  window.addEventListener('resize', setup);

  setup();
  animate();
</script>
</body>
</html>
