<?php

namespace Core\Plugins\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class EmailConfig {
    /**
     * Is the plugin enabled?
     */
    const ENABLED = true;
    
    /**
     * SMTPDebug LEVEL:
     *  - SMTP::DEBUG_OFF
     *  - SMTP::DEBUG_CLIENT
     *  - SMTP::DEBUG_SERVER  (Informational, Verbose Deluxe)
     *  - SMTP::DEBUG_LOWLEVEL
     * */
    const SMTP_DEBUG = SMTP::DEBUG_OFF;
    
    /**
     * Set the SMTP
     */
    const SMTP_SECURE = PHPMailer::ENCRYPTION_STARTTLS;
    
    const SMTP_AUTO_TLS = true;
    /**
     * Set the SMTP Host
     */
    const SMTP_HOST = 'outlook.office365.com';
    
    /**
     * Set the SMTP Port
     */
    const SMTP_PORT = 587;
    
    /**
     * Use SMTP Auth?
     */
    const USE_SMTP_AUTH = true;
    
    /**
     * SMTP Username
     */
    const SMTP_USERNAME = '';
    
    /**
     * SMTP Password
     */
    const SMTP_PASSWORD = '';
    
    /**
     * Noreply Address
     */
    const SMTP_NOREPLY = '';
    
    /**
     * To Address
     */
    const TO_ADDRESS = '';
}