<?php
session_start();

if (!isset($_SESSION['initialized'])) {
    $_SESSION['initialized'] = true;

    $_SESSION['chat'] = [
        ['id'=>1,'message'=>'¡Bienvenido al chat en vivo de JAABWEB!','created_at'=>date('Y-m-d H:i:s', strtotime('-1 day 5 hours'))],
        ['id'=>2,'message'=>'¿Alguien sabe cómo configurar el hosting?','created_at'=>date('Y-m-d H:i:s', strtotime('-23 hours'))],
        ['id'=>3,'message'=>'Hola, yo puedo ayudar con el hosting.','created_at'=>date('Y-m-d H:i:s', strtotime('-22 hours 45 minutes'))],
        ['id'=>4,'message'=>'Gracias! Tengo problemas con el certificado SSL.','created_at'=>date('Y-m-d H:i:s', strtotime('-22 hours 30 minutes'))],
        ['id'=>5,'message'=>'Recuerden que la próxima conferencia será este viernes.','created_at'=>date('Y-m-d H:i:s', strtotime('-20 hours'))],
        ['id'=>6,'message'=>'¿Alguien recomienda un buen dominio .com?','created_at'=>date('Y-m-d H:i:s', strtotime('-18 hours 10 minutes'))],
        ['id'=>7,'message'=>'Recomiendo usar JAAB Domains, tienen buen precio.','created_at'=>date('Y-m-d H:i:s', strtotime('-17 hours 50 minutes'))],
        ['id'=>8,'message'=>'Se escuchan propuestas para nuevos servicios.','created_at'=>date('Y-m-d H:i:s', strtotime('-16 hours'))],
        ['id'=>9,'message'=>'Estoy trabajando en un plugin para mejorar la seguridad.','created_at'=>date('Y-m-d H:i:s', strtotime('-15 hours 30 minutes'))],
        ['id'=>10,'message'=>'JAABWEB siempre innovando, ¡me encanta!','created_at'=>date('Y-m-d H:i:s', strtotime('-14 hours 45 minutes'))],
        ['id'=>11,'message'=>'¿Cómo puedo reportar un bug?','created_at'=>date('Y-m-d H:i:s', strtotime('-13 hours 10 minutes'))],
        ['id'=>12,'message'=>'Puedes generar un ticket en la sección correspondiente.','created_at'=>date('Y-m-d H:i:s', strtotime('-12 hours 50 minutes'))],
        ['id'=>13,'message'=>'Gracias por la información, saludos a todos.','created_at'=>date('Y-m-d H:i:s', strtotime('-12 hours 30 minutes'))],
        ['id'=>14,'message'=>'¿Alguien ya asistió al webinar pasado?','created_at'=>date('Y-m-d H:i:s', strtotime('-11 hours 20 minutes'))],
        ['id'=>15,'message'=>'Sí, estuvo genial y aprendí mucho sobre gamificación.','created_at'=>date('Y-m-d H:i:s', strtotime('-10 hours 45 minutes'))],
    ];

    $_SESSION['tickets'] = [
        ['id'=>1,'description'=>'No puedo acceder a mi cuenta','created_at'=>date('Y-m-d H:i:s', strtotime('-2 days 3 hours'))],
        ['id'=>2,'description'=>'Error al procesar pago con tarjeta','created_at'=>date('Y-m-d H:i:s', strtotime('-1 day 5 hours'))],
        ['id'=>3,'description'=>'Falla en el servidor, sitio caído','created_at'=>date('Y-m-d H:i:s', strtotime('-20 hours'))],
        ['id'=>4,'description'=>'Necesito ayuda para configurar el correo','created_at'=>date('Y-m-d H:i:s', strtotime('-18 hours 30 minutes'))],
        ['id'=>5,'description'=>'Actualizar plan de hosting','created_at'=>date('Y-m-d H:i:s', strtotime('-15 hours'))],
        ['id'=>6,'description'=>'Solicito reembolso por doble cobro','created_at'=>date('Y-m-d H:i:s', strtotime('-12 hours'))],
        ['id'=>7,'description'=>'No llegan los correos a clientes','created_at'=>date('Y-m-d H:i:s', strtotime('-10 hours 30 minutes'))],
        ['id'=>8,'description'=>'Problemas con la base de datos','created_at'=>date('Y-m-d H:i:s', strtotime('-8 hours 45 minutes'))],
        ['id'=>9,'description'=>'Recomendación para mejorar seguridad','created_at'=>date('Y-m-d H:i:s', strtotime('-6 hours'))],
        ['id'=>10,'description'=>'Solicitud para nueva funcionalidad en dashboard','created_at'=>date('Y-m-d H:i:s', strtotime('-4 hours 15 minutes'))],
        ['id'=>11,'description'=>'No puedo generar tickets desde el móvil','created_at'=>date('Y-m-d H:i:s', strtotime('-3 hours 10 minutes'))],
        ['id'=>12,'description'=>'Consulta sobre integración de pagos','created_at'=>date('Y-m-d H:i:s', strtotime('-1 hour 45 minutes'))],
        ['id'=>13,'description'=>'Reporte de error al subir archivos','created_at'=>date('Y-m-d H:i:s', strtotime('-30 minutes'))],
        ['id'=>14,'description'=>'Ayuda para cambiar contraseña','created_at'=>date('Y-m-d H:i:s', strtotime('-10 minutes'))],
    ];

    $_SESSION['events'] = [
        ['id'=>1,'title'=>'Conferencia Anual JAABWEB - Anfitrión: JAABWEB Corp','start'=>date('Y-m-d', strtotime('+5 days'))],
        ['id'=>2,'title'=>'Reunión de Patrocinadores - Anfitrión: JAAB Partners','start'=>date('Y-m-d', strtotime('+10 days'))],
        ['id'=>3,'title'=>'Seminario de Innovación Digital - Anfitrión: JAAB Innovate','start'=>date('Y-m-d', strtotime('+15 days'))],
        ['id'=>4,'title'=>'Taller de Seguridad Informática - Anfitrión: JAAB Secure','start'=>date('Y-m-d', strtotime('+20 days'))],
        ['id'=>5,'title'=>'Webinar de Transformación Digital - Anfitrión: JAAB Digital','start'=>date('Y-m-d', strtotime('+25 days'))],
    ];

    $_SESSION['services'] = [
        ['id'=>1,'name'=>'Hosting Profesional JAABWEB','price'=>15.99,'status'=>'activo'],
        ['id'=>2,'name'=>'Dominio .com por 1 año','price'=>12.00,'status'=>'activo'],
        ['id'=>3,'name'=>'Certificado SSL Premium','price'=>9.99,'status'=>'activo'],
        ['id'=>4,'name'=>'Diseño Web Personalizado','price'=>300.00,'status'=>'inactivo'],
        ['id'=>5,'name'=>'Soporte Técnico 24/7','price'=>50.00,'status'=>'activo'],
        ['id'=>6,'name'=>'Backup y Recuperación','price'=>25.50,'status'=>'activo'],
        ['id'=>7,'name'=>'SEO Básico','price'=>40.00,'status'=>'inactivo'],
        ['id'=>8,'name'=>'Campañas de Marketing Digital','price'=>120.00,'status'=>'activo'],
        ['id'=>9,'name'=>'Mantenimiento Mensual Web','price'=>80.00,'status'=>'activo'],
        ['id'=>10,'name'=>'Consultoría TI','price'=>100.00,'status'=>'activo'],
    ];

    $_SESSION['users'] = [
        ['id'=>1,'nombre'=>'Juan Pérez','puntos'=>250],
        ['id'=>2,'nombre'=>'María Gómez','puntos'=>220],
        ['id'=>3,'nombre'=>'Luis Martínez','puntos'=>200],
        ['id'=>4,'nombre'=>'Ana Torres','puntos'=>180],
        ['id'=>5,'nombre'=>'Carlos Ruiz','puntos'=>160],
        ['id'=>6,'nombre'=>'Sofía López','puntos'=>140],
        ['id'=>7,'nombre'=>'Miguel Ángel','puntos'=>130],
    ];
}

function jsonResponse($data){
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $action = $_POST['action'] ?? '';

    if($action == 'sendChat'){
        $msg = trim($_POST['message'] ?? '');
        if($msg !== ''){
            $id = count($_SESSION['chat']) + 1;
            $_SESSION['chat'][] = ['id'=>$id,'message'=>$msg,'created_at'=>date('Y-m-d H:i:s')];
        }
        exit;
    }

    if($action == 'search'){
        $query = strtolower(trim($_POST['query'] ?? ''));
        $filter = strtolower(trim($_POST['filter'] ?? ''));
        $results = array_filter($_SESSION['services'], function($s) use($query,$filter){
            $matchName = $query === '' || strpos(strtolower($s['name']), $query) !== false;
            $matchStatus = $filter === '' || strtolower($s['status']) === $filter;
            return $matchName && $matchStatus;
        });
        $out = "";
        foreach($results as $r){
            $out .= "<div class='service-result'><i class='bi bi-cpu'></i> {$r['name']} <span class='price'>$ {$r['price']}</span></div>";
        }
        exit($out);
    }

    if($action == 'genTicket'){
        $desc = trim($_POST['desc'] ?? '');
        if($desc !== ''){
            $id = count($_SESSION['tickets']) + 1;
            $created_at = date('Y-m-d H:i:s');
            $_SESSION['tickets'][] = ['id'=>$id,'description'=>$desc,'created_at'=>$created_at];
            foreach($_SESSION['users'] as &$u){
                if($u['id'] == 1){
                    $u['puntos'] += 10;
                    break;
                }
            }
            $card = "<div class='ticket-card'><h5>🎫 Ticket #{$id}</h5><p>{$desc}</p><span>{$created_at}</span></div>";
            exit($card);
        }
        exit;
    }

    if($action == 'loadTickets'){
        $tickets = array_reverse($_SESSION['tickets']);
        $tickets = array_slice($tickets,0,10);
        $out = "";
        foreach($tickets as $t){
            $out .= "<div class='ticket-card'><h5>🎫 Ticket #{$t['id']}</h5><p>{$t['description']}</p><span>{$t['created_at']}</span></div>";
        }
        exit($out);
    }

    if($action == 'addEvent'){
        $title = trim($_POST['title'] ?? '');
        $start = trim($_POST['start'] ?? '');
        if($title !== '' && $start !== ''){
            $id = count($_SESSION['events']) + 1;
            $_SESSION['events'][] = ['id'=>$id, 'title'=> $title . ' - Anfitrión: JAABWEB Corp', 'start'=>$start];
            exit('OK');
        }
        exit;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])){
    $action = $_GET['action'];

    if($action == 'loadChat'){
        $lastChat = array_slice($_SESSION['chat'],-10);
        $out = "";
        foreach($lastChat as $c){
            $out .= "<div class='chat-msg'><i class='bi bi-chat-dots'></i> {$c['message']} <span class='time'>{$c['created_at']}</span></div>";
        }
        exit($out);
    }

    if($action == 'loadStats'){
        $labels = [];
        $data = [];
        for($h = 0; $h < 12; $h++){
            $hourLabel = date('H:00', strtotime("-$h hours"));
            $labels[] = $hourLabel;
            $data[] = rand(0,10);
        }
        $labels = array_reverse($labels);
        $data = array_reverse($data);
        jsonResponse(['labels'=>$labels, 'sales'=>$data]);
    }

    if($action == 'loadEvents'){
        jsonResponse($_SESSION['events']);
    }

    if($action == 'getPoints'){
        $user = null;
        foreach($_SESSION['users'] as $u){
            if($u['id'] == 1){
                $user = $u;
                break;
            }
        }
        exit($user ? $user['puntos'] : 0);
    }

    if($action == 'topUsers'){
        $users = $_SESSION['users'];
        usort($users, function($a,$b){ return $b['puntos'] - $a['puntos']; });
        $top3 = array_slice($users, 0, 3);
        jsonResponse($top3);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>JAABWEB Plataforma Simulada</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
body { background: linear-gradient(135deg,#0f0c29,#302b63,#24243e); color:#eee; font-family:'Segoe UI',sans-serif; overflow-x:hidden; }
.navbar { background: rgba(0,0,0,0.7); backdrop-filter: blur(10px); box-shadow: 0 0 10px #0ff; }
.navbar-brand { color:#0ff !important; font-weight: 900; letter-spacing: 2px; font-size: 1.5rem; }
.nav-link { color:#0ff !important; font-weight:600; transition: color 0.3s ease; }
.nav-link:hover { color:#0f0 !important; }
.section-card { background: rgba(255,255,255,0.05); backdrop-filter: blur(15px); border-radius: 15px; box-shadow: 0 0 20px rgba(0,255,255,0.2); padding: 25px; margin-bottom: 40px; transition: transform 0.4s; }
.section-card:hover { transform: scale(1.02); box-shadow: 0 0 30px rgba(0,255,255,0.4); }
.ticket-card { background: rgba(0,0,0,0.5); backdrop-filter: blur(10px); border-left: 5px solid #0ff; padding: 15px; border-radius: 10px; margin-bottom: 10px; }
.ticket-card h5 { color: #0ff; }
.ticket-card span { font-size: 12px; color: #aaa; }
.chat-msg { border-bottom: 1px solid #444; padding: 10px; }
.chat-msg i { color: #0ff; }
.chat-msg .time { font-size: 10px; color: #888; }
#chatBox { height: 300px; overflow-y: auto; border-radius: 10px; background: rgba(0,0,0,0.4); }
.btn-custom { border-radius: 50px; padding: 10px 30px; background: linear-gradient(45deg,#0ff,#0f0); color: #000; font-weight: bold; border: none; box-shadow: 0 0 10px #0ff; }
input, textarea, select { background: rgba(255,255,255,0.1); border: none; color: #fff; }
input:focus, textarea:focus, select:focus { background: rgba(0,0,0,0.3); outline: none; }
#statsChart { max-height: 250px; }
#calendar { max-width: 900px; margin: 0 auto; background: rgba(255,255,255,0.05); border-radius: 15px; padding: 15px; }
.service-result { padding: 5px 10px; border-bottom: 1px solid #444; }
.price { float: right; color: #0ff; }
#topUsersList { list-style: none; padding: 0; }
#topUsersList li { background: rgba(0,255,255,0.2); margin: 5px 0; padding: 10px; border-radius: 8px; color: #0ff; font-weight: 700; font-size: 1.1rem; }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">JAABWEB</a>
    <button class="navbar-toggler btn btn-custom" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon" style="color:#0ff;"><i class="bi bi-list"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="#chatSection">Chat</a></li>
        <li class="nav-item"><a class="nav-link" href="#ticketsSection">Tickets</a></li>
        <li class="nav-item"><a class="nav-link" href="#statsSection">Estadísticas</a></li>
        <li class="nav-item"><a class="nav-link" href="#calendarSection">Eventos</a></li>
        <li class="nav-item"><a class="nav-link" href="#searchSection">Buscador</a></li>
        <li class="nav-item"><a class="nav-link" href="#gamificationSection">Gamificación</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container py-5" style="padding-top:80px;">

  <section id="chatSection" class="section-card">
    <h3>💬 Chat en Vivo JAABWEB</h3>
    <div id="chatBox"></div>
    <div class="input-group mt-3">
      <input type="text" id="chatInput" class="form-control" placeholder="Escribe un mensaje..."/>
      <button id="btnSendChat" class="btn btn-custom">Enviar</button>
    </div>
  </section>

  <section id="ticketsSection" class="section-card">
    <h3>🎫 Generar Ticket de Soporte</h3>
    <textarea id="ticketDesc" rows="3" placeholder="Describe tu problema o consulta" class="form-control"></textarea>
    <button id="btnGenTicket" class="btn btn-custom mt-2">Generar Ticket</button>
    <div id="ticketsList" class="mt-3"></div>
  </section>

  <section id="statsSection" class="section-card">
    <h3>📊 Estadísticas de Ventas Últimas 12 horas</h3>
    <canvas id="statsChart"></canvas>
  </section>

  <section id="calendarSection" class="section-card">
    <h3>📅 Calendario de Eventos JAABWEB</h3>
    <div id="calendar"></div>
    <div class="mt-3">
      <input type="text" id="eventTitle" placeholder="Título del evento" class="form-control mb-2" />
      <input type="date" id="eventDate" class="form-control mb-2" />
      <button id="btnAddEvent" class="btn btn-custom">Agregar Evento</button>
    </div>
  </section>

  <section id="searchSection" class="section-card">
    <h3>🔍 Buscador de Servicios JAABWEB</h3>
    <input type="text" id="searchQuery" placeholder="Buscar servicios..." class="form-control mb-2" />
    <select id="searchFilter" class="form-select mb-2">
      <option value="">Todos</option>
      <option value="activo">Activos</option>
      <option value="inactivo">Inactivos</option>
    </select>
    <div id="searchResults"></div>
  </section>

  <section id="gamificationSection" class="section-card">
    <h3>🏆 Gamificación y Usuarios Top</h3>
    <p>Puntos actuales de Juan Pérez: <span id="userPoints">0</span></p>
    <h5>Top 3 Usuarios</h5>
    <ul id="topUsersList"></ul>
  </section>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function loadChat(){
  $.get('?action=loadChat', data => {
    $('#chatBox').html(data);
    $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
  });
}

function loadTickets(){
  $.post('', {action:'loadTickets'}, data => {
    $('#ticketsList').html(data);
  });
}

function loadStats(){
  $.getJSON('?action=loadStats', data => {
    const ctx = document.getElementById('statsChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: data.labels,
        datasets: [{
          label: 'Ventas',
          data: data.sales,
          backgroundColor: 'rgba(0,255,255,0.7)'
        }]
      },
      options: { scales: { y: { beginAtZero: true } }, responsive:true }
    });
  });
}

function loadEvents(){
  $.getJSON('?action=loadEvents', data => {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      themeSystem: 'bootstrap5',
      events: data
    });
    calendar.render();
    window.fc = calendar;
  });
}

function searchServices(){
  const query = $('#searchQuery').val();
  const filter = $('#searchFilter').val();
  $.post('', {action:'search', query, filter}, data => {
    $('#searchResults').html(data);
  });
}

function loadUserPoints(){
  $.get('?action=getPoints', data => {
    $('#userPoints').text(data);
  });
}

function loadTopUsers(){
  $.getJSON('?action=topUsers', data => {
    let out = '';
    data.forEach(u => {
      out += `<li>${u.nombre}: ${u.puntos} pts</li>`;
    });
    $('#topUsersList').html(out);
  });
}

$(function(){
  loadChat();
  loadTickets();
  loadStats();
  loadEvents();
  searchServices();
  loadUserPoints();
  loadTopUsers();

  $('#btnSendChat').click(() => {
    const msg = $('#chatInput').val();
    if(msg.trim() === '') return;
    $.post('', {action:'sendChat', message:msg}, () => {
      $('#chatInput').val('');
      loadChat();
    });
  });

  $('#btnGenTicket').click(() => {
    const desc = $('#ticketDesc').val();
    if(desc.trim() === ''){
      Swal.fire('Error','Describe tu problema antes de enviar','error');
      return;
    }
    $.post('', {action:'genTicket', desc}, data => {
      $('#ticketsList').prepend(data);
      $('#ticketDesc').val('');
      loadUserPoints();
      loadTopUsers();
      Swal.fire('Éxito','Ticket generado correctamente','success');
    });
  });

  $('#searchQuery, #searchFilter').on('input change', () => {
    searchServices();
  });

  $('#btnAddEvent').click(() => {
    const title = $('#eventTitle').val().trim();
    const start = $('#eventDate').val();
    if(title === '' || start === ''){
      Swal.fire('Error','Completa el título y la fecha','error');
      return;
    }
    $.post('', {action:'addEvent', title, start}, data => {
      if(data === 'OK'){
        Swal.fire('Éxito','Evento agregado','success');
        $('#eventTitle').val('');
        $('#eventDate').val('');
        if(window.fc) window.fc.refetchEvents();
      } else {
        Swal.fire('Error','No se pudo agregar evento','error');
      }
    });
  });
});
</script>

</body>
</html>
