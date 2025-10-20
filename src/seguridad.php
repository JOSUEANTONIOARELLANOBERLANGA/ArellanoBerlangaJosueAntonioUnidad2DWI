<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';

function limpiarEntrada($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function iniciarSesionSegura($user_id, $role) {
    global $conn;
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user_id;
    $_SESSION['role'] = $role;

    $token = bin2hex(random_bytes(32)); // Token seguro de 64 caracteres hex
    $_SESSION['session_token'] = $token;

    $stmt = $conn->prepare("UPDATE users SET session_token = ? WHERE id = ?");
    if ($stmt === false) {
        error_log("Error preparar UPDATE session_token: " . $conn->error);
        return false;
    }
    $stmt->bind_param("si", $token, $user_id);
    $stmt->execute();
    $stmt->close();

    return true;
}

/**
 * Verifica que el usuario esté autenticado y tenga el rol permitido.
 * @param mixed 
 * @param string 
 */
function requiereLogin($roles = null, $redirectUrl = 'index.php') {
    global $conn;

    if (!isset($_SESSION['user_id'], $_SESSION['session_token'])) {
        cerrarSesion();
        header("Location: $redirectUrl");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $token = $_SESSION['session_token'];

    $stmt = $conn->prepare("SELECT role, session_token FROM users WHERE id = ?");
    if ($stmt === false) {
        error_log("Error preparar SELECT session_token: " . $conn->error);
        cerrarSesion();
        header("Location: $redirectUrl");
        exit;
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($role_db, $token_db);
    $stmt->fetch();
    $stmt->close();

    if (!$token_db || !hash_equals($token_db, $token)) {
        cerrarSesion();
        header("Location: $redirectUrl?error=sesion_invalida");
        exit;
    }

    if ($roles !== null) {
        if (is_array($roles)) {
            if (!in_array($role_db, $roles)) {
                header("Location: $redirectUrl?error=permiso_denegado");
                exit;
            }
        } else {
            if ($role_db !== $roles) {
                header("Location: $redirectUrl?error=permiso_denegado");
                exit;
            }
        }
    }
}

function verificarTokenRecuperacion($token) {
    global $conn;
    $token = limpiarEntrada($token);
    if (empty($token) || strlen($token) !== 64) return false;

    $stmt = $conn->prepare("SELECT id, email FROM users WHERE reset_token = ?");
    if ($stmt === false) {
        error_log("Error preparar SELECT reset_token: " . $conn->error);
        return false;
    }
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }
    $stmt->close();
    return false;
}

function limpiarTokenRecuperacion($user_id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET reset_token = NULL WHERE id = ?");
    if ($stmt === false) {
        error_log("Error preparar UPDATE reset_token: " . $conn->error);
        return false;
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    return true;
}


function cerrarSesion() {
    global $conn;
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("UPDATE users SET session_token = NULL WHERE id = ?");
        if ($stmt !== false) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->close();
        }
    }

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    $_SESSION = [];
    session_destroy();
}


function estaLogueado() {
    return isset($_SESSION['user_id'], $_SESSION['session_token']) && is_numeric($_SESSION['user_id']);
}
?>
