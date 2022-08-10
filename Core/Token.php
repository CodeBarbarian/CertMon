<?php

/**
 * Namespace Core
 * */
namespace Core;

/**
 * Unique random tokens
 * @version: PHP: 8.1
 *
 * @Token
 */
class Token {

	/**
	 * The token value
	 *
	 * @var string
	 */
	protected string $Token;

	/**
	 * Class constructor. Create a new random token or assign an existing one if passed in.
	 *
	 * @param null $Token_Value
	 * @throws \Exception
	 */
	public function __construct($Token_Value = null) {
		$this->Token = $Token_Value ? $Token_Value : bin2hex(random_bytes(16));
	}

	/**
	 * Get the token value
	 *
	 * @return array|string The value
	 */
	public function getValue(): array|string {
		return $this->Token;
	}

	/**
	 * Get the hashed token value
	 *
	 * @return string The hashed value
	 */
	public function getHash(): string {
		return hash_hmac('sha256', $this->Token, \App\Config\Token::SECRET_KEY);  // sha256 = 64 chars
	}
}
