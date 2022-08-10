<?php

namespace Core\Policies\Firewall;

use Core\Policies\iPolicyEngine;
use Core\Policies\Firewall\Inbound\InboundFirewallPolicy;
use Core\Policies\PolicyEngine;

/**
 * FirewallEngine Engine
 * @version: PHP: 8.1
 *
 * @FirewallEngine
 */
class FirewallEngine extends PolicyEngine implements iPolicyEngine {
    /**
     * Determine firewall direction
     * @var string
     */
    const FIREWALL_DIRECTION = 'inbound';
    
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
    
    /**
     * Retrieve server address.
     *
     * @return string
     */
    private static function getServerAddress() : string {
        return $_SERVER['SERVER_ADDR'];
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
        if (static::FIREWALL_DIRECTION === 'inbound') {
            if (InboundFirewallPolicy::checkCompliance(self::getRemoteAddress())) {
                http_response_code(403);
                die("Sorry, you are not allowed to enter the site");
            }
        } else {
            http_response_code(403);
            die("Blocked by software firewall.");
        }
	}
}

/**
 * Might just create two sets of engines, one for inbound and one for outbound.
 * Not really happy about the way this is done, but is good for inspiration when I come back to it.
 */