<?php

namespace App\Controllers;

use App\Models\CertificateModel;
use Core\Controller;
use App\Helpers\Cron;
use Core\View;
class Tasks extends Controller {
    /**
     * Method for /tasks/run
     *
     * @throws \Exception
     * @return void
     */
    public function runAction(): void {
        // Try sending the report
        Cron::sendReport();
        
        // Redirect on success
        $this->redirect('/certificate/list');
    }
}