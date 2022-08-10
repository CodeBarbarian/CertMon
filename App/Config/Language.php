<?php

namespace App\Config;

/**
 * Localization config
 * @version: PHP: 8.1
 *
 * @Language
 */
class Language extends \Core\Config {
	/**
	 * On/Off switch for using translations or not
	 * @var bool
	 */
	const USE_TRANSLATIONS = true;
    
    /**
     * On/Off switch for using the default language when using translations
     * @var bool
     */
    const USE_DEFAULT_LANGUAGE = false;

    /**
     * Direct replacement for FALLBACK_LANGUAGE
     * @var string
     */
    const DEFAULT_HTTP_ACCEPT_LANGUAGE = "en";
}