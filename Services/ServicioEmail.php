<?php
// Servicio para manejar el envío de correos
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class ServicioEmail {

    // Configuración del servidor de correo
    private $host = 'smtp.mailtrap.io'; // Cambia esto por tu servidor SMTP
    private $port = 587; // Puerto SMTP
    private $username = 'your_username'; // Tu usuario SMTP
    private $password = 'your_password'; // Tu contraseña SMTP
    private $fromEmail = 'from@example.com'; // Dirección de correo del remitente
    private $fromName = 'Biblioteca'; // Nombre del remitente

    // Enviar correo
    public function enviarCorreo($to, $subject, $body) {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = $this->host;
            $mail->SMTPAuth = true;
            $mail->Username = $this->username;
            $mail->Password = $this->password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $this->port;

            // Configuración del remitente y destinatario
            $mail->setFrom($this->fromEmail, $this->fromName);
            $mail->addAddress($to); // Agregar destinatario
            $mail->addReplyTo($this->fromEmail, $this->fromName);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            // Enviar el correo
            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "El correo no pudo enviarse. Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}
?>
