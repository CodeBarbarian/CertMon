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
class Certificate extends Controller {
    /**
     * Show the list certificates page
     *
     * @return void
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError|\ReflectionException
     */
    public function listAction(): void {
        //var_dump(openssl_x509_parse(file_get_contents('./certificates/test.cer')));
        // var_dump(hash('sha256','./certificates/test.cer'));
        
        $Certificates = CertificateModel::getCertificates();
        
        View::renderTemplate('Certificate/list.html', ['certificates' => $Certificates]);
    }
    
    /**
     * Show the manage page
     *
     * @throws \Twig\Error\SyntaxError
     * @throws \ReflectionException
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function manageAction(): void {
        View::renderTemplate('Certificate/manage.html');
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
    public function deleteAction(): void {
        View::renderTemplate('Certificate/delete.html');
    }
    
    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \ReflectionException
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function viewAction(): void {
        View::renderTemplate('Certificate/detail.html');
    }
}
