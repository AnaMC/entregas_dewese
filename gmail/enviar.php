<?php
require '../links_favoritos/classes/autoload.php';
require '../classes/vendor/autoload.php';

use izv\tools\Session;

$sesion = new SeSsion();

$origen = "troglodita91@gmail.com";
$alias = "Trabajo usuarios";
$destino = "troglodita91@gmail.com";
$asunto = "Prueba de correo";
$mensaje = "¿Llegará?";
$cliente = new Google_Client();


$cliente->setApplicationName('dewese');
$cliente->setClientId('1093272371904-3m2qmtqmscg9q6n0cu47vk85qohv457q.apps.googleusercontent.com');
$cliente->setClientSecret('WFUsJy_8qK0mCN2AmPktheze');

$cliente->setAccessToken(file_get_contents('token.conf'));
if ($cliente->getAccessToken()) {
    $service = new Google_Service_Gmail($cliente);
    try {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->From = $origen;
        $mail->FromName = $alias;
        $mail->AddAddress($destino);
        $mail->AddReplyTo($origen, $alias);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
        $mail->preSend();
        $mime = $mail->getSentMIMEMessage();
        $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
        $mensaje = new Google_Service_Gmail_Message();
        $mensaje->setRaw($mime);
        $service->users_messages->send('me', $mensaje);
        echo "Correo enviado correctamente";
    } catch (Exception $e) {
        echo ("Error en el envío del correo: " . $e->getMessage());
    }
} else {
    echo "No conectado con gmail";
}