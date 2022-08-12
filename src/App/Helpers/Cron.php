<?php

namespace App\Helpers;

use Core\View;
use App\Models\CertificateModel;
use Core\Plugins\Email\Email;

/**
 * So the idea of this class is that this class should be called from crontab in linux, and list all the certificates
 * and send them as an email to a given address
 */
class Cron {
    /**
     * Method for sending the report
     *
     * @throws \Exception
     * @return bool
     */
    public static function sendReport(): bool {
        
        $TEXT = "It does not work!";
        $HTML = View::getTemplate('Tasks/email.html', [
            'certificates' => CertificateModel::renderCertificateArray(),
            'todays_date'  => date('d-m-Y H:i:s')
        ]);
        
        if (!Email::send(\Core\Plugins\Email\EmailConfig::TO_ADDRESS, 'CertMon Report', $TEXT, $HTML)) {
            return false;
        }
        return true;
    }
}