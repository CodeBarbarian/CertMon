<?php

namespace App\Helpers;

use Core\View;
use App\Models\CertificateModel;
use Core\Plugins\Email\Email;
use Core\Plugins\Flashcard\Flashcard;

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
		// User feedback
		$Flashcard = new Flashcard();

        // Make sure all parameters are entered as required before trying to send mail
		if (empty(\Core\Plugins\Email\EmailConfig::SMTP_HOST)) {
			$Flashcard::addMessage("SMTP_HOST is not set!", "danger");
			return false;
		}

		if (empty(\Core\Plugins\Email\EmailConfig::SMTP_USERNAME)) {
			$Flashcard::addMessage("SMTP_USERNAME is not set!", "danger");
			return false;
		}

		if (empty(\Core\Plugins\Email\EmailConfig::SMTP_PASSWORD)) {
			$Flashcard::addMessage("SMTP_PASSWORD is not set!", "danger");
			return false;
		}

		if (empty(\Core\Plugins\Email\EmailConfig::SMTP_NOREPLY)) {
			$Flashcard::addMessage("SMTP_NOREPLY is not set!", "danger");
			return false;
		}

		if (empty(\Core\Plugins\Email\EmailConfig::TO_ADDRESS)) {
			$Flashcard::addMessage("TO_ADDRESS is not set!", "danger");
			return false;
		}

        $TEXT = "It does not work!";
        $HTML = View::getTemplate('Tasks/email.html', [
            'certificates' => CertificateModel::renderCertificateArray(),
            'todays_date'  => date('d-m-Y H:i:s')
        ]);
        
        if (!Email::send(\Core\Plugins\Email\EmailConfig::TO_ADDRESS, 'CertMon Report', $TEXT, $HTML)) {
			$Flashcard::addMessage("Unable to send report!", 'danger');
            return false;
        }
		Flashcard::addMessage("Report successfully sent!", 'success');
        return true;
    }
}