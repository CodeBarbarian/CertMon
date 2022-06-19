<?php

namespace App\Config;

/**
 * Localization config
 * @version: PHP: 8.1
 *
 * @Localization
 */
class Language extends \Core\Config {
	/**
	 * On/Off switch for using translations or not
	 * @var bool
	 */
	const USE_TRANSLATIONS = true;

	/**
	 * Fallback language if for some reason it can't find anything matching in the web browser.
	 * @var string
	 */
	const FALLBACK_LANGUAGE = "EN";
}