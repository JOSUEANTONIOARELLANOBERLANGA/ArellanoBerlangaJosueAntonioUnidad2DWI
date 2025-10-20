<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>ERROR• JAABWEB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@3.3.0/tsparticles.bundle.min.js"></script>
  <style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body, html {
      width:100%; height:100%; font-family:'Orbitron',sans-serif;
      background:#000; color:#0ff; overflow:hidden;
    }
    #tsparticles { position:fixed; top:0;left:0;width:100%;height:100%;z-index:-1; }
    .container {
      height:100vh; display:flex; align-items:center; justify-content:center;
      padding:20px; text-align:center;
    }
    .glass {
      backdrop-filter:blur(25px);
      background:rgba(0,0,0,0.6);
      border:2px solid rgba(0,255,255,0.2);
      border-radius:15px;
      padding:30px;
      max-width:720px; width:95%;
      box-shadow:0 0 40px rgba(0,255,255,0.5);
      animation:fadeInUp 1s ease-out;
    }
    @keyframes fadeInUp {
      from { opacity:0; transform:translateY(50px);}
      to { opacity:1; transform:translateY(0);}
    }
    .title {
      font-size:3.5rem; margin-bottom:10px;
      color:#0ff; text-shadow:0 0 10px #0ff;
      animation:glitch 2s infinite;
    }
    @keyframes glitch {
      0%,100%{transform:translate(0);}
      20%{transform:translate(-2px,2px);}
      40%{transform:translate(2px,-2px);}
      60%{transform:translate(-1px,1px);}
      80%{transform:translate(1px,-1px);}
    }
    .gif-sleep {
      width:100%;max-width:360px;
      border-radius:20px;
      box-shadow:0 0 30px #0ff;
      margin:25px auto;
      animation:pulse 2.5s infinite;
    }
    @keyframes pulse {
      0%,100%{transform:scale(1);}
      50%{transform:scale(1.03);}
    }
    .message {
      font-size:1.2rem; margin:15px 0;
      color:#ccc;
    }
    .ayuda {
      text-align:left;
      background:rgba(0,255,255,0.03);
      border-left:3px solid #0ff;
      border-radius:10px;
      padding:20px;
      color:#b3f7ff;
      font-family:'Courier New', monospace;
      margin:20px 0;
      line-height:1.6;
      animation:fadeInUp 1.2s ease-out;
    }
    .ayuda i { color:#0ff; margin-right:8px; }
    .btn-home {
      padding:14px 40px; font-size:1.1rem;
      background:#0ff; color:#000;
      border:none; border-radius:35px;
      box-shadow:0 0 30px #0ff;
      transition:all .3s;
    }
    .btn-home:hover {
      background:#000; color:#0ff;
      transform:scale(1.1);
      box-shadow:0 0 40px #0ff;
    }
    .timer {
      font-family:'Orbitron'; font-size:1.2rem;
      color:#0ff;
      margin-top:10px;
    }
  </style>
</head>
<body onload="init();">

  <div id="tsparticles"></div>

  <div class="container">
    <div class="glass">
      <div class="title">😴 Inactividad Detectada</div>
      <img src="https://media.giphy.com/media/FTjBvXExGHXzUpufiK/giphy.gif" alt="Durmiendo frente a compu" class="gif-sleep">
      <div class="message">
        Tu sesión fue cerrada por inactividad. El sistema te ha dado un descanso forzado.
      </div>

      <div class="ayuda">
        <i class="fa-solid fa-robot"></i>
        <strong>JAABWEB Assistant:</strong><br>
        "Detecté que llevas tiempo sin moverte frente a tu equipo.<br>
        Para regresar, haz clic en <strong>Volver al Inicio</strong>.<br>
        Si prefieres, serás redirigido automáticamente en <span id="timer">10</span> seg.<br>
        ¡Nos vemos pronto, mi crack!"
      </div>

      <a href="index.php" class="btn-home">🔁 Volver al Inicio</a>
      <div class="timer">Redireccionando en: <span id="timer2">10</span>s</div>
    </div>
  </div>

  <script>
    function init(){
      Swal.fire({
        title:'⚠️ Sesión Caducada',
        text:'Por seguridad, tu sesión expiró por inactividad.',
        icon:'warning',
        confirmButtonColor:'#0ff',
        background:'#111',
        color:'#0ff',
        backdrop:`rgba(0,0,0,0.9)
          url("https://media.giphy.com/media/FTjBvXExGHXzUpufiK/giphy.gif")
          center no-repeat`
      });
      let count=10;
      const t1 = document.getElementById('timer');
      const t2 = document.getElementById('timer2');
      const interval = setInterval(()=>{
        count--;
        t1.textContent = t2.textContent = count;
        if(count<=0){
          clearInterval(interval);
          window.location.href='index.php';
        }
      }, 1000);
    }
    tsParticles.load("tsparticles", {
      particles:{ number:{value:70}, color:{value:"#0ff"}, shape:{type:"circle"},
        opacity:{value:0.3}, size:{value:{min:1,max:3}}, move:{enable:true,speed:1,direction:"none",outModes:{default:"bounce"}}},
      interactivity:{events:{onHover:{enable:true,mode:"repulse"}, onClick:{enable:true,mode:"push"}},
        modes:{repulse:{distance:80}, push:{quantity:4}}}
    });
  </script>

</body>
</html>
