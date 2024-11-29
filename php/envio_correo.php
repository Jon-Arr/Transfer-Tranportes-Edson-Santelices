<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $date = $_POST['date'];
    $service = $_POST['service'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $comments = $_POST['texto'];

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'edson.santelices.e@gmail.com';
        $mail->Password = 'rwgw wywm dzmc bbrb';     
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo
        $mail->setFrom($email, $name);
        $mail->addAddress('edson.santelices.e@gmail.com');
        $mail->Subject = "Transfer & Tranportes Edson Santelices";
        $mail->Body = "El usuario $name, solicita el servicio: $service con los siguientes datos:\n\nEmail: $email\nTeléfono:+56 $number\nFecha: $date\nOrigen: $origin\nDestino: $destination\nComentarios: $comments";

        $mail->send();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $mail->ErrorInfo]);
    }
}