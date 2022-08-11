<?php

namespace App\Models;

use App\Config\Paths;
use Core\Model;

use Core\Plugins\Flashcard\Flashcard;
/**
 * Home Model
 *
 * @version: PHP: 8.1
 */
class CertificateModel extends Model {
    /**
     * Get all the certificates in the certificate directory
     * Clean them up, and return array of all certificate basename(s).
     *
     * @return array
     */
    public static function getCertificateFilename(): array {
        $Path = Paths::CERTIFICATE_DIR .'/';
        $Files = glob($Path.'*.cer');
        
        $Certificates = array();
        
        foreach($Files as $Value) {
            $Certificates[] = basename($Value);
        }
        
        return $Certificates;
    }
    
    /**
     * Extract useful information from all the certificates
     * Returns array of wanted (structured) data.
     *
     * @return array
     * @throws \Exception
     */
	public static function getCertificates(): array {
		$CertificateCount = count(static::getCertificateFilename());

		$Certificates = static::getCertificateFilename();

		$StructuredArray = array();
		for ($CurrentCert = 0; $CurrentCert < $CertificateCount; $CurrentCert++) {
            $Filename = Paths::CERTIFICATE_DIR.'/'.$Certificates[$CurrentCert];
			$Data = openssl_x509_parse(file_get_contents(($Filename)));
			$ValidFrom = date('d-m-Y H:i:s', $Data['validFrom_time_t']);
			$ValidTo = date('d-m-Y H:i:s', $Data['validTo_time_t']);

            $FirstDate = new \Datetime(date('d-m-Y H:i:s'));
            $SecondDate = new \DateTime($ValidTo);
            
            $DateDiff = (array) $FirstDate->diff($SecondDate);
            
            // EXPIRED (BUT KEEP COUNTING)
            if ($DateDiff['invert'] === 1) {
                $Code = "danger";
                $Output = "EXPIRED";
                $Sort = 1;
            } elseif ($DateDiff['days'] < 31) {
                $Code = "danger";
                $Output = "+".$DateDiff['days'] . " days";
                $Sort = 2;
            } elseif ($DateDiff['days'] < 61) {
                $Code = "warning";
                $Output = "+".$DateDiff['days'] . " days";
                $Sort = 3;
            } elseif ($DateDiff['days'] < 91) {
                $Code = "info";
                $Output = "+".$DateDiff['days'] . " days";
                $Sort = 4;
            } else {
                $Output = "+".$DateDiff['days'] . " days";
                $Code = "success";
                $Sort = 5;
            }
            
			$StructuredArray[] = array(
                "sort" => $Sort,
                "filename" => pathinfo($Filename, PATHINFO_FILENAME),
				"name" => $Data['subject']['CN'],
				"subject" => $Data['subject']['CN'],
				"validfrom" => $ValidFrom ,
				"validto" => $ValidTo,
                "daysuntil" => $Output,
                "code" => $Code
            );
		}
  
		return $StructuredArray;
	}
    
    public static function getCertificateName(string $CertificateIdentifier) {
        if (!in_array($CertificateIdentifier.'.cer', static::getCertificateFilename())) {
            return false;
        }
        $Filename = Paths::CERTIFICATE_DIR.'/'.$CertificateIdentifier.'.cer';
        $Data = openssl_x509_parse(file_get_contents(($Filename)));
        
        return $Data['subject']['CN'];
    }
    
	public static function getCertificate(string $CertificateIdentifier) {
        $Filename = Paths::CERTIFICATE_DIR.'/'.$CertificateIdentifier.'.cer';
        $Data = openssl_x509_parse(file_get_contents(($Filename)));
        
        return $Data;
	}

	public static function addCertificate($Data) {
 
	}
    
	public static function removeCertificate(array $Data = []): bool {
        $Flashcard = new Flashcard();
        
        // Do we actually get a filename?
        if (!$Data['filename']) {
            $Flashcard::addMessage("Filename not present!", "danger");
            return false;
        }
        
        if (!in_array($Data['filename'].'.cer', static::getCertificateFilename())) {
            $Flashcard::addMessage("File does not exists!", "danger");
            return false;
        }
        
        if (!unlink('./certificates/'.$Data['filename'].'.cer')) {
            $Flashcard::addMessage("Unable to delete file!", "danger");
            return false;
        }
        
        $Flashcard::addMessage("Successfully deleted certificate: ".$Data['filename'], "info");
        return true;
	}
}