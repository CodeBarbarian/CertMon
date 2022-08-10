<?php

namespace Core\Policies;

/**
 * Interface for Policy Engine
 *
 * @version: PHP: 8.1
 */
interface iPolicyEngine {
	/**
	 * Enforce compliance method
	 * @return void
	 */
	public static function enforceCompliance() : void;
}