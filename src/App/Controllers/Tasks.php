<?php

namespace App\Controllers;

use App\Models\CertificateModel;
use Core\Controller;
use App\Helpers\Cron;
use Core\View;

use Core\Plugins\Flashcard\Flashcard;

class Tasks extends Controller {
    /**
     * Method for /tasks/run
     *
     * @throws \Exception
     * @return void
     */
    public function runAction(): void {
		// Let us use the flashcard to give some feedback to the user
		$Flashcard = new Flashcard();

        // Try sending the report
        Cron::sendReport();
        
        // Redirect on success
        $this->redirect('/certificate/list');
    }

	/**
	 * Method for testing if the functionality is working. Only used by the crontab for development
	 * Creates a file called developer in the public directory, and adds the authors name in it to check if
	 * everything works as expected.
	 *
	 * @return void
	 */
	public function testAction(): void {
		$File = fopen("developer.txt", "w") or die("Unable to open file!");
		$Text = "Morten Haugstad\n";

		fwrite($File, $Text);
		fclose($File);
	}
}