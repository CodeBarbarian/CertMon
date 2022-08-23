<?php

namespace Core\Plugins\Email;

use Core\Plugins\Plugin;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email extends Plugin {
    /**
     * Instantiate the PHPMailer with Exceptions turned on.
     *
     * @return PHPMailer
     */
    private static function instantiateMailHandler(): PHPMailer {
        return new PHPMailer(true);
    }
    
    /**
     * Send Email
     *
     * @throws Exception
     * @throws \Exception
     */
    public static function send(string $To, string $Subject, string $Text, string $HTML) {
        try {
            $Mail = static::instantiateMailHandler();
            $Mail->SMTPDebug = EmailConfig::SMTP_DEBUG;
            $Mail->isSMTP();
    
            $Mail->Host = EmailConfig::SMTP_HOST;
            $Mail->Port = EmailConfig::SMTP_PORT;
            
            $Mail->SMTPSecure = EmailConfig::SMTP_SECURE;
            $Mail->SMTPAutoTLS = EmailConfig::SMTP_AUTO_TLS;
            
            $Mail->SMTPAuth = EmailConfig::USE_SMTP_AUTH;
            $Mail->Username = EmailConfig::SMTP_USERNAME;
            $Mail->Password = EmailConfig::SMTP_PASSWORD;
    
            $Mail->setFrom(EmailConfig::SMTP_NOREPLY);
    
            $Mail->addAddress($To);
    
            $Mail->Subject = $Subject;
    
            if (!empty($HTML)) {
                $Mail->isHTML(true);
                $Mail->Body = $HTML;
            } else {
                $Mail->AltBody = $Text;
            }
            $Mail->send();
        } catch (\Exception $e) {
            throw new \Exception("Unable to send email: " . $e->getMessage());
        }
    }
}