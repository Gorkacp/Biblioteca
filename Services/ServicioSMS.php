<?php
// Servicio para manejar envíos de mensajes
require_once '/path/to/vendor/autoload.php'; // Asegúrate de incluir Twilio autoload

use Twilio\Rest\Client;

class ServicioSMS {

    // Configuración de Twilio
    private $sid = 'your_twilio_sid'; // Tu SID de Twilio
    private $authToken = 'your_twilio_auth_token'; // Tu Auth Token de Twilio
    private $fromPhone = '+1234567890'; // Tu número de Twilio

    // Enviar mensaje SMS
    public function enviarSMS($to, $message) {
        $client = new Client($this->sid, $this->authToken);

        try {
            $client->messages->create(
                $to, // El número de teléfono del destinatario
                [
                    'from' => $this->fromPhone, // El número de Twilio desde donde se envía
                    'body' => $message // El contenido del mensaje
                ]
            );
            return true;
        } catch (Exception $e) {
            echo "El mensaje no pudo enviarse. Error: {$e->getMessage()}";
            return false;
        }
    }
}
?>
