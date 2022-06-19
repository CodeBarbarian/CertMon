<?php

namespace Core\Policies\Account\Password;

use Core\Policies;

/**
 * Password Policy
 *
 * @version: PHP: 8.1
 */
class PasswordPolicy implements Policies\iPolicy {
	/**
	 * Uppercase Letters
	 *
	 * @var string
	 */
	const UPPERCASE = "@[A-Z]@";

	/**
	 * Lowercase Letters
	 *
	 * @var string
	 * */
	const LOWERCASE = "@[a-z]@";

	/**
	 * Numbers
	 *
	 * @var string
	 * */
	const NUMBER = "@\d@";

	/**
	 * Special Characters
	 *
	 * @var string
	 */
	const SPECIAL = "@\W@";

	/**
	 * Minimum Password Length
	 */
	const PASSWORD_LENGTH = 10;

	/**
	 * Helper function to check Password Complexity Length Requirements
	 *
	 * @param $Password
	 * @return bool
	 */
	private static function checkPasswordComplexityLength($Password) : bool {
		if (strlen($Password) < self::PASSWORD_LENGTH) {
			return false;
		}

		return true;
	}

	/**
	 * Helper function to check Password Complexity Uppercase Characters Requirements
	 *
	 * @param $Password
	 * @return bool
	 */
	private static function checkPasswordComplexityUppercase($Password) : bool {
		if(!preg_match(self::UPPERCASE, $Password)) {
			return false;
		}

		return true;
	}

	/**
	 * Helper function to check Password Complexity Lowercase Characters Requirements
	 *
	 * @param $Password
	 * @return bool
	 */
	private static function checkPasswordComplexityLowercase($Password) : bool {
		if (!preg_match(self::LOWERCASE, $Password)) {
			return false;
		}

		return true;
	}

	/**
	 * Helper function to check Password Complexity Number Requirements
	 *
	 * @param $Password
	 * @return bool
	 */
	private static function checkPasswordComplexityNumber($Password) : bool {
		if (!preg_match(self::NUMBER, $Password)) {
			return false;
		}

		return true;
	}

	/**
	 * Helper function to check Password Complexity Special Character Requirements
	 *
	 * @param $Password
	 * @return bool
	 */
	private static function checkPasswordComplexitySpecial($Password) : bool {
		if (!preg_match(self::SPECIAL, $Password)) {
			return false;
		}

		return true;
	}


	/**
	 * Check compliance.
	 * Check if the password meets the required complexity requirements.
	 *
	 * @param $ComplianceItem
	 * @return bool
	 */
	public static function checkCompliance($ComplianceItem) : bool{
		// Check password length
		if (!self::checkPasswordComplexityLength($ComplianceItem)) {
			return false;
		}

		// Check UPPERCASE
		if(!self::checkPasswordComplexityUppercase($ComplianceItem)) {
			return false;
		}

		// Check LOWERCASE
		if (!self::checkPasswordComplexityLowercase($ComplianceItem)) {
			return false;
		}

		// Check NUMBER
		if (!self::checkPasswordComplexityNumber($ComplianceItem)) {
			return false;
		}

		// Check SPECIAL characters
		if (!self::checkPasswordComplexitySpecial($ComplianceItem)) {
			return false;
		}

		return true;
	}
}