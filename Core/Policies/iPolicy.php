<?php

namespace Core\Policies;

/**
 * Policy Interface
 *
 * @version: PHP: 8.1
 */
interface iPolicy {
	/**
	 * Check Compliance
	 *
	 * @param $ComplianceItem
	 * @return bool
	 */
	public static function checkCompliance($ComplianceItem) : bool;
}