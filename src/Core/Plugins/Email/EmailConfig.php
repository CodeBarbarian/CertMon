<?php

namespace Core\Plugins\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class EmailConfig {
    /**
     * Is the plugin enabled?
     * @var bool
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
     * @var object
     */
    const SMTP_SECURE = PHPMailer::ENCRYPTION_STARTTLS;
    
    /**
     * Set SMTP auto tls
     * @var bool
     */
    const SMTP_AUTO_TLS = true;
    
    /**
     * Set the SMTP Host
     * @var string
     */
    const SMTP_HOST = 'outlook.office365.com';
    
    /**
     * Set the SMTP Port
     * @var int
     */
    const SMTP_PORT = 587;
    
    /**
     * Use SMTP Auth?
     * @var bool
     */
    const USE_SMTP_AUTH = true;
    
    /**
     * SMTP Username
     * @var string
     */
    const SMTP_USERNAME = '';
    
    /**
     * SMTP Password
     * @var string
     */
    const SMTP_PASSWORD = '';
    
    /**
     * Noreply Address
     * @var string
     */
    const SMTP_NOREPLY = '';
    
    /**
     * To Address
     * @var string
     */
    const TO_ADDRESS = '';
}