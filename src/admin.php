<?php

$conn = new mysqli("localhost", "root", "", "jaabweb");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

header('Content-Type: text/html; charset=utf-8');


function escapeHtml($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

$tablas = [
    "buzones" => ["id", "asunto", "mensaje", "archivo", "fecha"],
    "mensajes" => ["id", "correo", "mensaje", "fecha"],
    "pagos" => ["id", "tarjeta", "nombre", "mes", "anio", "cvv"],
    "users" => ["id", "name", "email", "password", "reset_token"],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    $tabla = $_POST['tabla'] ?? '';
    $id = intval($_POST['id'] ?? 0);

    if (!array_key_exists($tabla, $tablas)) {
        echo json_encode(["error" => "Tabla inválida"]);
        exit;
    }

    if ($accion === 'eliminar') {
        $sql = "DELETE FROM `$tabla` WHERE id = $id";
        $res = $conn->query($sql);
        echo json_encode(["success" => $res]);
        exit;
    }

    if ($accion === 'editar') {
        $cols = $tablas[$tabla];
        $cols = array_filter($cols, fn($c) => $c !== 'id');

        $updates = [];
        foreach ($cols as $col) {
            if (isset($_POST[$col])) {
                $val = $conn->real_escape_string($_POST[$col]);
                $updates[] = "`$col` = '$val'";
            }
        }
        if (empty($updates)) {
            echo json_encode(["error" => "No hay datos para actualizar"]);
            exit;
        }

        $sql = "UPDATE `$tabla` SET " . implode(", ", $updates) . " WHERE id = $id";
        $res = $conn->query($sql);
        echo json_encode(["success" => $res]);
        exit;
    }
}


function imprimirTabla($titulo, $tabla, $columnas) {
    global $conn;
    $colsStr = implode(", ", $columnas);
    $result = $conn->query("SELECT $colsStr FROM `$tabla`");
    echo "<section>";
    echo "<h2>$titulo</h2>";
    echo "<input type='text' class='buscador' placeholder='Buscar en $titulo...'>";
    echo "<div class='table-wrapper'>";
    echo "<table class='tabla-datos' data-tabla='$tabla'>";
    echo "<thead><tr>";
    foreach ($columnas as $col) {
        echo "<th>" . escapeHtml(ucfirst($col)) . "</th>";
    }
    echo "<th>Acciones</th>";
    echo "</tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-id='{$row['id']}'>";
        foreach ($columnas as $col) {
            echo "<td>" . escapeHtml($row[$col]) . "</td>";
        }
        echo "<td>
                <button class='btn-editar' data-tabla='$tabla'>✏️</button>
                <button class='btn-eliminar' data-tabla='$tabla'>🗑️</button>
              </td>";
        echo "</tr>";
    }
    echo "</tbody></table></div></section>";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Panel Admin BroTech</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
  body {
    background: #0c0c0c;
    color: #00ffe1;
    font-family: 'Orbitron', sans-serif;
    margin: 0; padding: 20px;
  }
  h1 { text-align: center; margin-bottom: 30px; }
  h2 { border-bottom: 2px solid #00ffe1; padding-bottom: 5px; margin-top: 40px; }
  .buscador {
    width: 100%; padding: 8px; margin-bottom: 10px;
    background: #000; color: #0f0;
    border: 1px solid #0f0;
    font-size: 16px;
  }
  table {
    width: 100%; border-collapse: collapse; margin-top: 10px;
  }
  th, td {
    border: 1px solid #00ffe1; padding: 8px; text-align: left;
  }
  th { background: #111; }
  td { background: #1a1a1a; }
  .table-wrapper { overflow-x: auto; }
  button {
    background: none; border: none; font-size: 16px;
    cursor: pointer; color: #0f0; margin: 0 5px;
  }
  mark {
    background-color: #00ffe1; color: #000; font-weight: bold;
  }
  /* Modal edición */
  #modalEditar {
    display: none; position: fixed; top:0; left:0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.8); justify-content: center; align-items: center;
  }
  #modalEditar.active { display: flex; }
  #modalEditar .modal-content {
    background: #111; padding: 20px; border-radius: 8px;
    width: 90%; max-width: 600px; color: #0f0;
  }
  #modalEditar label {
    display: block; margin-top: 10px;
  }
  #modalEditar input, #modalEditar textarea {
    width: 100%; padding: 8px; margin-top: 5px;
    background: #000; border: 1px solid #0f0; color: #0f0;
    font-family: 'Orbitron', sans-serif; font-size: 14px;
  }
  #modalEditar textarea {
    resize: vertical;
  }
  #modalEditar .btn-cerrar {
    background: #ff0055; color: #fff; border: none;
    padding: 8px 12px; cursor: pointer; margin-top: 10px;
  }
  #modalEditar .btn-guardar {
    background: #00ffe1; color: #000; border: none;
    padding: 10px 15px; font-weight: bold; cursor: pointer;
    margin-top: 15px;
  }
</style>
</head>
<body>

<h1>📊 Panel de Administración JAABWEB</h1>
<?php
$ordenTablas = ['users', 'pagos', 'mensajes', 'buzones'];

foreach ($ordenTablas as $tabla) {
    $cols = $tablas[$tabla];
    $titulo = match($tabla) {
        "buzones" => "📬 Buzones",
        "mensajes" => "💬 Mensajes",
        "pagos" => "💳 Pagos",
        "users" => "👤 Usuarios",
        default => ucfirst($tabla),
    };
    imprimirTabla($titulo, $tabla, $cols);
}
?>


<div id="modalEditar">
  <div class="modal-content">
    <h2>Editar registro</h2>
    <form id="formEditar">
    </form>
    <button class="btn-cerrar" id="btnCerrarModal">Cancelar</button>
  </div>
</div>

<script>
const modal = document.getElementById('modalEditar');
const formEditar = document.getElementById('formEditar');
let currentTabla = "";
let currentId = 0;
let columnas = {
  buzones: ["id", "asunto", "mensaje", "archivo", "fecha"],
  mensajes: ["id", "correo", "mensaje", "fecha"],
  pagos: ["id", "tarjeta", "nombre", "mes", "anio", "cvv"],
  users: ["id", "name", "email", "password", "reset_token"],
};

function escapeHtml(text) {
  return text.replace(/[&<>"']/g, function(m) {
    return {'&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'":'&#39;'}[m];
  });
}

function marcarTexto(text, filtro) {
  if (!filtro) return text;
  const re = new RegExp(filtro, 'gi');
  return text.replace(re, (match) => `<mark>${match}</mark>`);
}

document.querySelectorAll('.buscador').forEach(input => {
  input.addEventListener('input', (e) => {
    const filtro = e.target.value.trim().toLowerCase();
    const tabla = e.target.nextElementSibling.querySelector('table');
    const filas = tabla.querySelectorAll('tbody tr');
    filas.forEach(fila => {
      let textoFila = fila.innerText.toLowerCase();
      if (textoFila.includes(filtro)) {
        fila.style.display = "";
        // resaltar
        fila.querySelectorAll('td').forEach(td => {
          td.innerHTML = marcarTexto(td.textContent, filtro);
        });
      } else {
        fila.style.display = "none";
      }
    });
  });
});

document.querySelectorAll('.btn-editar').forEach(btn => {
  btn.addEventListener('click', () => {
    currentTabla = btn.dataset.tabla;
    const tr = btn.closest('tr');
    currentId = tr.dataset.id;
    const cols = columnas[currentTabla];

    let htmlInputs = '';
    for (const col of cols) {
      const valor = tr.querySelector(`td:nth-child(${cols.indexOf(col)+1})`).textContent;
      if (col === 'id') {
        htmlInputs += `<input type="hidden" name="id" value="${escapeHtml(valor)}" />`;
      } else if (col === 'mensaje' || col === 'archivo' || col === 'reset_token') {
        htmlInputs += `<label>${col.charAt(0).toUpperCase() + col.slice(1)}:<textarea name="${col}">${escapeHtml(valor)}</textarea></label>`;
      } else {
        htmlInputs += `<label>${col.charAt(0).toUpperCase() + col.slice(1)}:<input type="text" name="${col}" value="${escapeHtml(valor)}" required /></label>`;
      }
    }
    formEditar.innerHTML = htmlInputs + `<input type="hidden" name="tabla" value="${currentTabla}" /> <input type="hidden" name="accion" value="editar" /> <button type="submit" class="btn-guardar">Guardar Cambios</button>`;
    modal.classList.add('active');
  });
});

document.getElementById('btnCerrarModal').addEventListener('click', () => {
  modal.classList.remove('active');
});
formEditar.addEventListener('submit', async (e) => {
  e.preventDefault();
  const formData = new FormData(formEditar);

  try {
    const res = await fetch('', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    if (data.success) {
      Swal.fire('¡Éxito!', 'Registro actualizado correctamente.', 'success').then(() => {
        location.reload();
      });
    } else {
      Swal.fire('Error', data.error || 'No se pudo actualizar.', 'error');
    }
  } catch (err) {
    Swal.fire('Error', 'Error de comunicación con el servidor.', 'error');
  }
});

document.querySelectorAll('.btn-eliminar').forEach(btn => {
  btn.addEventListener('click', () => {
    const tabla = btn.dataset.tabla;
    const tr = btn.closest('tr');
    const id = tr.dataset.id;

    Swal.fire({
      title: '¿Estás seguro?',
      text: "¡No podrás revertir esta acción!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar!',
      cancelButtonText: 'Cancelar'
    }).then(async (result) => {
      if (result.isConfirmed) {
        const formData = new FormData();
        formData.append('accion', 'eliminar');
        formData.append('tabla', tabla);
        formData.append('id', id);

        try {
          const res = await fetch('', {
            method: 'POST',
            body: formData
          });
          const data = await res.json();
          if (data.success) {
            Swal.fire('¡Eliminado!', 'El registro ha sido eliminado.', 'success').then(() => {
              location.reload();
            });
          } else {
            Swal.fire('Error', 'No se pudo eliminar el registro.', 'error');
          }
        } catch (err) {
          Swal.fire('Error', 'Error de comunicación con el servidor.', 'error');
        }
      }
    });
  });
});
</script>
</body>
</html>
