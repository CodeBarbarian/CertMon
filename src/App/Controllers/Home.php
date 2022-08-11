<?php


namespace App\Controllers;

use Core\Controller;
use Core\View;

/**
 * Home controller
 *
 * @version: PHP: 8.1
 *
 * @Home
 */
class Home extends Controller {
    
    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \ReflectionException
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function indexAction(): void {
        View::renderTemplate('Home/index.html');
    }
}