<?php

namespace App\Models;

use App\Config\Paths;
use Core\Model;

class Certificate extends Model {
	/**
	 * getCertificateFilename. Responsible for checking the directory for certificates,
	 *
	 * @return array
	 */
	public static function getCertificateFilename() : array {
		$Path = Paths::CERTIFICATE_DIR;
		return array_slice(scandir($Path), 2);
	}

	public static function getCertificates(): array {
		$CertificateCount = count(static::getCertificateFilename());

		$Certificates = static::getCertificateFilename();

		$StructuredArray = array();
		for ($CurrentCert = 0; $CurrentCert < $CertificateCount; $CurrentCert++) {
			$Data = openssl_x509_parse(file_get_contents((Paths::CERTIFICATE_DIR.'/'.$Certificates[$CurrentCert])));
			$ValidFrom = date('d-m-Y H:i:s', $Data['validFrom_time_t']);
			$ValidTo = date('d-m-Y H:i:s', $Data['validTo_time_t']);

			$StructuredArray[] = array("name" => $Data['name'], "subject" => $Data['subject']['CN'], "validfrom" => $ValidFrom , "validto" => $ValidTo);
		}

		return $StructuredArray;
	}
}