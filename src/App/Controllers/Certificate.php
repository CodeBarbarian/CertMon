<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\CertificateModel;
use App\Models\FileModel;

/**
 * Home controller
 * @version: PHP: 8.1
 *
 * @Home
 */
class Certificate extends Controller {
	/**
	 * Show the list certificates page
	 *
	 * @return void
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError|\ReflectionException
	 * @throws \Exception
	 */
    public function listAction(): void {
        $Certificates = CertificateModel::renderCertificateArray();
        View::renderTemplate('Certificate/list.html', ['certificates' => $Certificates]);
    }
    
    /**
     * @return void
     * @throws \ReflectionException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function addAction(): void {
        View::renderTemplate('Certificate/add.html');
    }
    
    /**
     * @return void
     * @throws \ReflectionException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function confirmAction(): void {
        $CertificateName = CertificateModel::getCertificateName($this->route_params['name']);
        
        View::renderTemplate('Certificate/delete.html', [
            'certificate_name' => $CertificateName,
            'filename' => $this->route_params['name']
        ]);
    }
    
    /**
	 * Delete a specified certificate
	 *
     * @return void
     */
    public function deleteAction(): void {
        FileModel::removeFile($_POST);
        $this->redirect('/certificate/list');
    }
    
    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \ReflectionException
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function viewAction(): void {
		$Argument = $this->route_params['name'];

		$CertificateName = CertificateModel::getCertificateName($Argument);

        View::renderTemplate('Certificate/detail.html', [
			'name' => CertificateModel::getCertificateProperty($Argument, "name"),
			'subject' => CertificateModel::getCertificateProperty($Argument, "subject"),
			'hash' => CertificateModel::getCertificateProperty($Argument, "hash"),
			'issuer' => CertificateModel::getCertificateProperty($Argument, "issuer"),
			'serialNumber' => CertificateModel::getCertificateProperty($Argument, "serialNumber"),
			'serialNumberHex' => CertificateModel::getCertificateProperty($Argument, "serialNumberHex"),
			'validFrom' => CertificateModel::getCertificateProperty($Argument, "validFrom"),
			'validTo' => CertificateModel::getCertificateProperty($Argument, "validTo"),
			'validFrom_time_t' => CertificateModel::getCertificateProperty($Argument, "validTo_time_t"),
			'validTo_time_t' => CertificateModel::getCertificateProperty($Argument, "validTo_time_t"),
			'signatureTypeNID' => CertificateModel::getCertificateProperty($Argument, "signatureTypeNID"),
			'signatureTypeSN' => CertificateModel::getCertificateProperty($Argument, "signatureTypeSN"),
			'signatureTypeLN' => CertificateModel::getCertificateProperty($Argument, "signatureTypeLN"),
			'purposes' => CertificateModel::getCertificateProperty($Argument, "purposes"),
			'extensions' => CertificateModel::getCertificateProperty($Argument, "extensions")
		]);
    }
    
    public function uploadAction(): void {
        $UploadAction = FileModel::uploadFile($_FILES);

        if (!$UploadAction) {
            $this->redirect('/certificate/add');
        } else {
            $this->redirect('/certificate/list');
        }
    }
}
