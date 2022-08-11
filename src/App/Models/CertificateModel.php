<?php

namespace App\Models;

use App\Config\Paths;
use Core\Model;


/**
 * Home Model
 *
 * @version: PHP: 8.1
 */
class CertificateModel extends Model {
	public static function getCertificateFilename() : array {
		$Path = Paths::CERTIFICATE_DIR .'/';
		return array_slice(scandir($Path), 2);
	}
    
    /**
     * Functional test presentation. Not production ready
     * @return array
     */
	public static function getCertificates(): array {
		$CertificateCount = count(static::getCertificateFilename());

		$Certificates = static::getCertificateFilename();

		$StructuredArray = array();
		for ($CurrentCert = 0; $CurrentCert < $CertificateCount; $CurrentCert++) {
			$Data = openssl_x509_parse(file_get_contents((Paths::CERTIFICATE_DIR.'/'.$Certificates[$CurrentCert])));
			$ValidFrom = date('d-m-Y H:i:s', $Data['validFrom_time_t']);
			$ValidTo = date('d-m-Y H:i:s', $Data['validTo_time_t']);

			$StructuredArray[] = array(
				"name" => $Data['name'],
				"subject" => $Data['subject']['CN'],
				"validfrom" => $ValidFrom ,
				"validto" => $ValidTo);
		}

		return $StructuredArray;
	}

	public static function getCertificate(string $CertificateIdentifier) {
 
	}

	public static function addCertificate($Data) {
 
	}

	public static function removeCertificate(int $CertID) {

	}
}