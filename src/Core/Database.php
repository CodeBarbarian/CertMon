<?php

namespace Core;

use PDO;

/**
 * Database Handler
 * @version: PHP: 8.1
 *
 * @Database
 */
abstract class Database extends PDO {
	/**
	 * Get the PDO database connection
	 *
	 * @return PDO|null
	 */
	protected static function getDB(): ?PDO {
		if (\App\Config\Database::USE_DATABASE) {
			static $DB = null;

			if ($DB === null) {
				$DSN = sprintf("mysql:host=%s;dbname=%s;charset=utf8", \App\Config\Database::DB_HOST, \App\Config\Database::DB_NAME);
				$DB = new PDO($DSN, \App\Config\Database::DB_USER, \App\Config\Database::DB_PASSWORD);

				// Throw an Exception when an error occurs
				$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}

			return $DB;
		}

		return false;
	}
}