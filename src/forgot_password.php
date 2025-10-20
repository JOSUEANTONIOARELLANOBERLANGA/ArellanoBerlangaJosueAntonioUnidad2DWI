<?php
require 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function enviarCorreoRecuperacion($email, $token) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'webjaab@gmail.com ';
        $mail->Password = 'xikuowuqnvvlcfja';  
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('webjaab@gmail.com ', 'JAABWEB');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Recuperar contraseña - JAABWEB';

        $url = "http://localhost/JAABWEB/reset_password.php?token=$token";

      $mail->CharSet = 'UTF-8';
$mail->Body = '
  <div style="background:linear-gradient(135deg, #0f172a, #1e293b); padding:40px; border-radius:20px; max-width:700px; margin:auto; font-family:Segoe UI,sans-serif; color:#e2e8f0; position:relative; overflow:hidden;">

    <style>
      @keyframes pulseBtn {
        0% { transform: scale(1); box-shadow: 0 0 20px #fbbf24; }
        50% { transform: scale(1.05); box-shadow: 0 0 35px #fde047; }
        100% { transform: scale(1); box-shadow: 0 0 20px #fbbf24; }
      }

      .boton-brotech {
        display: inline-block;
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        padding: 18px 45px;
        color: #111;
        text-decoration: none;
        font-weight: 900;
        font-size: 22px;
        border-radius: 30px;
        box-shadow:
          inset 0 0 12px rgba(255,255,255,0.25),
          0 0 30px #fbbf24,
          0 0 50px #f59e0b,
          0 0 70px #f59e0b;
        transition: all 0.35s ease;
        animation: pulseBtn 3s infinite;
        letter-spacing: 1.2px;
        user-select: none;
        cursor: pointer;
      }

      /* Hover puede no funcionar en muchos clientes */
      .boton-brotech:hover,
      .boton-brotech:focus {
        transform: scale(1.12) rotate(-3deg);
        box-shadow:
          inset 0 0 18px rgba(255,255,255,0.5),
          0 0 50px #fde68a,
          0 0 80px #fbbf24,
          0 0 100px #f59e0b;
        outline: none;
      }
    </style>

    <h2 style="text-align:center; font-size:32px; color:#fbbf24; margin-bottom:25px; font-weight: 800;">
      🔐 ¡Restablece tu acceso en JAABWEB!
    </h2>

    <p style="font-size:17px; line-height:1.5;">
      Hola <strong>usuario JAABWEB</strong>,
    </p>

    <p style="font-size:17px; line-height:1.5;">
      Recibimos una solicitud para recuperar tu contraseña. Si fuiste tú, haz clic en el siguiente botón para restablecerla:
    </p>

    <div style="text-align:center; margin: 50px 0;">
      <a href="' . $url . '" target="_blank" rel="noopener noreferrer" aria-label="Restablecer ahora" class="boton-brotech">
        🔁 Restablecer ahora
      </a>
    </div>

    <p style="font-size:15px; color:#cbd5e1; margin-bottom: 25px;">
      Este enlace es temporal por motivos de seguridad. Si no solicitaste esto, simplemente ignora este correo.
    </p>

    <div style="text-align:center; margin-top:40px;">
      <img src="https://media.giphy.com/media/qgQUggAC3Pfv687qPC/giphy.gif" alt="Animación de restablecimiento" style="width:220px; border-radius:20px; box-shadow:0 0 25px #fbbf24;">
    </div>

    <p style="text-align:center; margin-top:35px; font-size:14px; color:#94a3b8; font-style: italic;">
      ⚡ JAABWEB - Seguridad, velocidad y estilo en cada línea de código.
    </p>

  </div>
';



        $mail->send();
        return true;

    } catch (Exception $e) {
        error_log("Error al enviar correo: {$mail->ErrorInfo}");
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $token = bin2hex(random_bytes(50));
        $stmt = $conn->prepare("UPDATE users SET reset_token=? WHERE email=?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        if (enviarCorreoRecuperacion($email, $token)) {
            echo "<script>
              Swal.fire({icon:'success', title:'Correo enviado', text:'Revisa tu bandeja de entrada.'}).then(() => {
                window.location = 'index.php';
              });
            </script>";
        } else {
            echo "<script>
              Swal.fire({icon:'error', title:'Error', text:'No se pudo enviar el correo. Intenta más tarde.'});
            </script>";
        }
    } else {
        echo "<script>
          Swal.fire({icon:'error', title:'Correo no registrado', text:'Este correo no está asociado a ninguna cuenta.'});
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8" />
  <title>Recuperar contraseña</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    .glass {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(20px);
    }
    .input-glow:focus {
      border-color: #f59e0b;
      box-shadow: 0 0 12px #f59e0b;
    }
    .btn-glow:hover {
      box-shadow: 0 0 18px #fbbf24;
      transform: scale(1.03);
    }
  </style>
</head>
<body class="bg-black min-h-screen flex items-center justify-center font-inter text-white relative">
  <div id="tsparticles" class="absolute inset-0 -z-10"></div>
  <div class="glass rounded-3xl p-8 w-full max-w-md shadow-xl transition-all duration-500">
    <h2 class="text-center text-2xl font-bold text-yellow-400 mb-6">
      <i class="fas fa-unlock-alt animate-pulse"></i> Recuperar Contraseña
    </h2>
    <form method="POST" novalidate>
      <label class="block mb-2 text-sm text-white/80">Ingresa tu correo electrónico:</label>
      <input type="email" name="email" required
             class="w-full px-4 py-2 mb-4 rounded-md bg-glass border border-white/20 input-glow focus:outline-none transition" />
      <button type="submit"
              class="w-full py-2 rounded-md btn-glow bg-gradient-to-r from-yellow-500 to-amber-600 text-white font-semibold tracking-wide transition duration-300">
        Enviar enlace de recuperación
      </button>
      <div class="text-center mt-4 text-sm text-white/70">
        ¿Recordaste tu contraseña? <a href="index.php" class="hover:underline text-yellow-400">Inicia sesión</a>
      </div>
    </form>
  </div>
  <script>
    tsParticles.load("tsparticles", {
      background: { color: "#00000000" },
      fpsLimit: 60,
      interactivity: {
        events: { onHover: { enable: true, mode: "repulse" }, resize: true },
        modes: { repulse: { distance: 100, duration: 0.4 } }
      },
      particles: {
        color: { value: "#fbbf24" },
        links: { color: "#fbbf24", distance: 150, enable: true, opacity: 0.4, width: 1 },
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
