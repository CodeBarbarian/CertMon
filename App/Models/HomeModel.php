<?php

namespace App\Models;

use Core\Model;


/**
 *	Home Model
 * @version:
 */
class HomeModel extends Model {
	/**
	 * @return string
	 */
	public static function getGreeting() : string {
		return "Welcome to Metamorphosis PHP Framework!";
	}
}