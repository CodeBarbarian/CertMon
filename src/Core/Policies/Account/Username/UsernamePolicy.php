<?php

namespace Core\Policies\Account\Username;

use Core\Policies\iPolicy;
use Core\Policies\Policy;

/**
 * Username Policy
 * @version: PHP: 8.1
 *
 * @UsernamePolicy
 */
class UsernamePolicy extends Policy implements iPolicy {
	/**
	 * Minimum Username Length
	 * @var int
	 */
	const MIN_LENGTH = 5;

	/***
	 * Maximum Username Length
	 * @var int
	 */
	const MAX_LENGTH = 15;

	/**
	 * Allowed characters in the username.
	 * As we don't want to store usernames in uppercase,
	 * let us just allow lowercase. We should convert all uppercase
	 * characters in the username to lowercase anyhow.
	 */
	const ALLOWED_CHARACTERS = "@[a-z0-9]@";

	/**
	 * Check Username Length Complexity Requirements
	 *
	 * @param $Username
	 * @return bool
	 */
	private static function checkUsernameComplexityLength($Username) : bool {
		if (strlen($Username) < self::MIN_LENGTH || strlen($Username) > self::MAX_LENGTH) {
			return false;
		}

		return true;
	}

	/**
	 * Check Username Allowed Characters Complexity Requirements
	 *
	 * @param $Username
	 * @return bool
	 */
	private static function checkUsernameComplexityCharacters($Username) : bool {
		if (!preg_match(self::ALLOWED_CHARACTERS, $Username)) {
			return false;
		}

		return true;
	}

	/**
	 * Check username compliance
	 *
	 * @param $ComplianceItem
	 * @return bool
	 */
	public static function checkCompliance($ComplianceItem): bool {
		if (!self::checkUsernameComplexityLength($ComplianceItem)) {
			return false;
		}

		if (!self::checkUsernameComplexityCharacters($ComplianceItem)) {
			return false;
		}

		return true;
	}
}