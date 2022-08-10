<?php

namespace Core\Policies\Firewall;

use Core\Policies\iPolicyEngine;
use Core\Policies\Firewall\Inbound\FirewallPolicy;
use Core\Policies\PolicyEngine;

/**
 * Firewall Engine
 * @version: PHP: 8.1
 *
 * @Firewall
 */
class Firewall extends PolicyEngine implements iPolicyEngine {
	/**
	 * Retrieve Remote Server Address.
	 * Depending on implementation this is easier for now. As time
	 * changes different implementations of remote address may be required.
	 * For now, this is good enough for development.
	 *
	 * @return string
	 */
	private static function getRemoteAddress() : string {
		return $_SERVER['REMOTE_ADDR'];
	}

	/***
	 * Enforce compliance method.
	 *
	 * Retrieve the Remote IP Address using the static getRemoteAddress method,
	 * check against the policies included.
	 *
	 * @return void
	 */
	public static function enforceCompliance(): void {
		if (FirewallPolicy::checkCompliance(self::getRemoteAddress())) {
			die("Sorry, you are not allowed to enter the site");
		}
	}
}