<?php

namespace App\Config;

use Core\Config;

/**
 * Database Config
 * @version: PHP: 8.1
 *
 * @Database
 */
class Database extends Config {

	/**
	 * Is database turned on
	 */
	const USE_DATABASE = true;

	/**
	 * Database Driver
	 * @var string
	 * */
	const DB_DRIVER = 'mysql';

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost';
    
    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'certmon';
    
    /**
     * Database user
     * @var string
     */
    const DB_USER = 'certmon';
    
    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = 'certmon';
}