<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\CertificateModel;

/**
 * Home controller
 * @version: PHP: 8.1
 *
 * @Home
 */
class Home extends Controller {
    /**
     * Show the index page
     *
     * @return void
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError|\ReflectionException
	 */
    public function indexAction(): void {
        //var_dump(openssl_x509_parse(file_get_contents('./certificates/test.cer')));
		// var_dump(hash('sha256','./certificates/test.cer'));

		$Certificates = CertificateModel::getCertificates();

		View::renderTemplate('Home/index.html', ['certificates' => $Certificates]);
    }
}
