<?php

namespace Core\System;
use App\Config\Paths;

class System {
    /**
     * Get the framework version from the version.txt file
     * @return string|bool
     */
    public static function getVersion() : string|bool {
		$Filename = '../'.Paths::SYSTEM_DIR.'/version.txt';

        if (file_exists($Filename) && is_readable($Filename)) {
            $File = fopen($Filename, 'r');
            $Version = fgets($File);
            fclose($File);

			// Hacky to get a float to be able to check if correctly
            return (floatval($Version) ? $Version : false);
        }
        return false;
    }
}