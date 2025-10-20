<?php
include('db.php');

$mensajeStatus = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];
    $archivo = $_FILES['archivo']['name'];

    if ($archivo) {
        move_uploaded_file($_FILES['archivo']['tmp_name'], 'uploads/' . $archivo);
    }

    $sql = "INSERT INTO buzones (asunto, mensaje, archivo, fecha) VALUES ('$asunto', '$mensaje', '$archivo', NOW())";
    $mensajeStatus = $conn->query($sql) === TRUE ? "success" : "error";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Buzón | JaabWeb</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
    }

    .neon-box {
      border: 2px solid #00ffe7;
      border-radius: 0.75rem;
      padding: 1.5rem;
      box-shadow: 0 0 20px #00ffe7;
      background: rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(10px);
    }

    .input-icon {
      position: relative;
    }

    .input-icon i {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      color: #0ff;
    }

    .input-icon input,
    .input-icon textarea {
      padding-left: 2.5rem;
      background-color: rgba(255,255,255,0.07);
      border: 1px solid #0ff;
      color: #fff;
      border-radius: 10px;
    }

    .btn-submit {
      padding: 10px 25px;
      border-radius: 12px;
      font-weight: bold;
      background-color: #00c896;
      border: none;
    }

    .btn-submit:hover {
      background-color: #00ffcc;
      color: #000;
    }

    #fondoDinero {
      position: fixed;
      top: 0; left: 0;
      width: 100vw;
      height: 100vh;
      pointer-events: none;
      z-index: 1;
    }
  </style>
</head>
<body>

<canvas id="fondoDinero"></canvas>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark z-50">
    <div class="container-fluid">
      <a class="navbar-brand text-info" href="#">JaabWeb</a>
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

<div class="container mx-auto px-4 py-12 position-relative z-10">
  <h2 class="text-center text-4xl font-bold text-cyan-400 mb-8" data-aos="fade-down">
    <i class="fas fa-envelope-open-text text-cyan-400 mr-2"></i>Enviar un Mensaje
  </h2>

  <div class="neon-box" data-aos="fade-up">
    <form method="POST" enctype="multipart/form-data" class="space-y-6">
      <div class="space-y-2 input-icon">
        <label for="asunto" class="text-xl"><i class="fas fa-tag mr-1"></i>Asunto</label>
        <i class="fas fa-tag"></i>
        <input type="text" name="asunto" id="asunto" class="w-full p-3" required>
      </div>

      <div class="space-y-2 input-icon">
        <label for="mensaje" class="text-xl"><i class="fas fa-comment-alt mr-1"></i>Mensaje</label>
        <i class="fas fa-comment-alt"></i>
        <textarea name="mensaje" id="mensaje" rows="6" class="w-full p-3" required></textarea>
      </div>

      <div class="space-y-2 input-icon">
        <label for="archivo" class="text-xl"><i class="fas fa-paperclip mr-1"></i>Adjuntar archivo (opcional)</label>
        <i class="fas fa-paperclip"></i>
        <input type="file" name="archivo" id="archivo" class="w-full p-2">
      </div>

      <div class="text-center">
        <button type="submit" class="btn-submit"><i class="fas fa-paper-plane mr-2"></i>Enviar</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1200, once: true });

  <?php if ($mensajeStatus === "success"): ?>
    Swal.fire({
      icon: 'success',
      title: '¡Mensaje enviado!',
      text: 'Tu mensaje se ha guardado correctamente.',
      confirmButtonColor: '#00a8ff'
    });
  <?php elseif ($mensajeStatus === "error"): ?>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Hubo un problema al guardar tu mensaje.',
      confirmButtonColor: '#ff4c4c'
    });
  <?php endif; ?>
</script>

</body>
</html>
