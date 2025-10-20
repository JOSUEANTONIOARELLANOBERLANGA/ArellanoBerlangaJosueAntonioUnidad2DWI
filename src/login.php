<?php
require_once 'db.php';
require_once 'functions.php';
require_once 'seguridad.php';

$secretKey = trim(file_get_contents(__DIR__ . '/secret.key'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
    $response = json_decode($verify);

    if (!$response || !$response->success) {
        echo "<script>alert('❌ Verificación reCAPTCHA fallida'); window.location='index.php';</script>";
        exit;
    }

    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "<script>alert('⚠️ Debe ingresar correo y contraseña'); window.location='index.php';</script>";
        exit;
    }

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    if (!$stmt) {
        echo "<script>alert('⚠️ Error en la base de datos.'); window.location='index.php';</script>";
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            iniciarSesionSegura($user['id'], $user['role']);
            if (strtolower(trim($user['role'])) === 'admin') {
                header('Location: administrador.php');
            } else {
                header('Location: dashboard.php');
            }
            exit;
        } else {
            echo "<script>alert('❌ Contraseña incorrecta'); window.location='index.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('❌ Usuario no encontrado'); window.location='index.php';</script>";
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
