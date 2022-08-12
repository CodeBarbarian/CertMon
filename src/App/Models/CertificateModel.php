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
	/**
	 * Generate array of all certificate files in the certificate directory
	 *
	 * @return array
	 */
	public static function getCertificateFiles(): array {
		$Files = glob(Paths::CERTIFICATE_DIR .'/'.'*.cer');
		$Certificates = array();

		foreach($Files as $Value) {
			$Certificates[] = basename($Value);
		}

		return $Certificates;
	}

	/**
	 * A helper for comparing dates, and structure the Code, Output and Sorting order
	 *
	 * @param $ExpirationDate
	 * @return array
	 * @throws \Exception
	 */
	private static function getDateHelper($ExpirationDate): array {
		$Now  = new \Datetime(date('d-m-Y H:i:s'));
		$ExpirationDate = new \DateTime($ExpirationDate);
		$DateDiff = (array) $Now->diff($ExpirationDate);

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

		return ["code" => $Code, "sort" => $Sort, "output" => $Output];
	}

	/**
	 * @throws \Exception
	 */
	public static function renderCertificateArray(): array {
		$CertificateFiles = static::getCertificateFiles();
		$CertificateFilesCount = count($CertificateFiles);

		$CertificateArray = array();

		for ($CurrentCert = 0; $CurrentCert < $CertificateFilesCount; $CurrentCert++) {
			$Filename = Paths::CERTIFICATE_DIR.'/'.$CertificateFiles[$CurrentCert];
			$Data = openssl_x509_parse(file_get_contents(($Filename)));

			// ValidFrom / ValidTo
			$ValidFrom = date('d-m-Y H:i:s', $Data['validFrom_time_t']);
			$ValidTo = date('d-m-Y H:i:s', $Data['validTo_time_t']);

			$DateHelper = static::getDateHelper($ValidTo);

			$Filename = pathinfo($Filename, PATHINFO_FILENAME);
			// Build the certificate array
			$CertificateArray[] = array(
				"sort" => $DateHelper['sort'],
				"daysuntil" => $DateHelper['output'],
				"code" => $DateHelper['code'],
				"filename" => $Filename,
				"issuer" => static::getCertificateProperty($Filename, 'issuer'),
				"name" => $Data['subject']['CN'],
				"subject" => $Data['subject']['CN'],
				"validfrom" => $ValidFrom ,
				"validto" => $ValidTo
			);
            
            // Added some sorting to make sure the ones who are expiring are moved to the top
            $Sort = array_column($CertificateArray, 'sort');
            array_multisort($Sort, SORT_ASC, $CertificateArray);
		}
		return $CertificateArray;
	}


	/**
	 * Get the certificate common name
	 *
	 * @param string $CertificateIdentifier
	 * @return mixed
	 */
	public static function getCertificateName(string $CertificateIdentifier): mixed {
        if (!in_array($CertificateIdentifier.'.cer', static::getCertificateFiles())) {
            return false;
        }

        $Filename = Paths::CERTIFICATE_DIR.'/'.$CertificateIdentifier.'.cer';
        $Data = openssl_x509_parse(file_get_contents(($Filename)));
        
        return $Data['subject']['CN'];
    }

	/**
	 * Get Certificate Data
	 *
	 * @param string $CertificateIdentifier
	 * @return bool|array
	 */
	public static function getCertificate(string $CertificateIdentifier): bool|array {
        $Filename = Paths::CERTIFICATE_DIR.'/'.$CertificateIdentifier.'.cer';
		return openssl_x509_parse(file_get_contents(($Filename)));
	}

	/**
	 * Helper methods for /certificate/detail
	 */
	private static function getCertificatePropertyPurpose(string $CertificateIdentifier) {
		$Data = static::getCertificate($CertificateIdentifier);
		$StructuredArray = array();

		foreach ($Data['purposes'] as $Key => $Value) {
			$StructuredArray[] = ($Data['purposes'][$Key][2]);
		}

		return $StructuredArray;
	}


	public static function getCertificateProperty(string $CertificateIdentifier, string $Property) {
		$Data = static::getCertificate($CertificateIdentifier);
		$Output = [];

		switch ($Property) {
			case 'name':
				$Output = $Data['name'];
				break;
			case 'subject':
				$Output = implode(", ",$Data['subject']);
				break;
			case 'hash':
				$Output = $Data['hash'];
				break;
			case 'issuer':
				$Output = $Data['issuer']['CN'];
				break;
			case 'version':
				$Output = $Data['version'];
				break;
			case 'serialNumber':
				$Output = $Data['serialNumber'];
				break;
			case 'serialNumberHex':
				$Output = $Data['serialNumberHex'];
				break;
			case 'validFrom':
				$Output = $Data['validFrom'];
				break;
			case 'validTo':
				$Output = $Data['validTo'];
				break;
			case 'validFrom_time_t':
				$Output = $Data['validFrom_time_t'];
				break;
			case 'validTo_time_t':
				$Output = $Data['validTo_time_t'];
				break;
			case 'signatureTypeSN':
				$Output = $Data['signatureTypeSN'];
				break;
			case 'signatureTypeLN':
				$Output = $Data['signatureTypeLN'];
				break;
			case 'signatureTypeNID':
				$Output = $Data['signatureTypeNID'];
				break;
			case 'purposes':
				$Output = implode(", ", static::getCertificatePropertyPurpose($CertificateIdentifier));
				break;
			case 'extensions':
				$Output = implode(", ", $Data['extensions']);
				break;
		}

		return $Output;
	}

}