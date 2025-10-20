<?php
$to = "arellanoberlangajosueantonio@gmail.com"; 
$subject = "Recupera tu contraseña - JAABWEB";
$link = "http://localhost/JAABWEB/reset_password.php?token=123456"; 

$apiKey = "xsmtpsib-00f9eb87f848e5301254ac988135441c0a57e7bd3de5eb352b87147cc1d2d159-KpaGfsmEn05Aqjvc";

$fromEmail = "8f5ec0001@smtp-brevo.com";
$fromName = "JAABWEB Support";

$body = "<h2>Restablecer contraseña</h2>
<p>Haz clic en este enlace para crear una nueva contraseña:</p>
<a href='$link'>$link</a>";

$data = [
    "sender" => ["name" => $fromName, "email" => $fromEmail],
    "to" => [["email" => $to]],
    "subject" => $subject,
    "htmlContent" => $body
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.brevo.com/v3/smtp/email");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "accept: application/json",
    "api-key: $apiKey",
    "content-type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// === Resultado ===
if ($httpCode == 201) {
    echo "✅ ¡Correo enviado correctamente!";
} else {
    echo "❌ Error al enviar. Código: $httpCode <br><pre>$response</pre>";
}
?>