<?php

namespace Core\Policies;

/**
 * Base Policy
 *
 * @version: PHP: 8.1
 */
class Policy implements iPolicy {
	/**
	 * Compliance check method.
	 *
	 * @param $ComplianceItem
	 * @return bool
	 */
	public static function checkCompliance($ComplianceItem) : bool {
	}
}