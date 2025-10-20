<?php 
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  http_response_code(403);
  exit('Acceso directo no permitido.');
}

require_once 'db.php';

function obtenerUsuario($id) {
  global $conn;
  $stmt = $conn->prepare("SELECT id, name, email, role FROM users WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

function estaAutenticado() {
  return isset($_SESSION['user_id']);
}

function esAdmin() {
  if (!estaAutenticado()) return false;
  $usuario = obtenerUsuario($_SESSION['user_id']);
  return $usuario && $usuario['role'] === 'admin';
}

function esCliente() {
  if (!estaAutenticado()) return false;
  $usuario = obtenerUsuario($_SESSION['user_id']);
  return $usuario && $usuario['role'] === 'cliente';
}

function redireccionarSegunRol() {
  if (esAdmin()) {
    header("Location: administrador.php");
    exit;
  } elseif (esCliente()) {
    header("Location: cliente.php");
    exit;
  } else {
    session_destroy();
    header("Location: index.php");
    exit;
  }
}
?>
