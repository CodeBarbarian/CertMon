<?php

namespace Core\Localization;

use App\Config\Language;

/**
 * Localization (Translation) Class
 * @version: PHP: 8.1
 *
 * @Localization
 */
class Localization implements iLocalization {
	private static function getAgentLanguage() {
		return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	}

	/**
	 * Method for getting the language class and retrieving the static language array
	 *
	 * @throws \ReflectionException
	 */
	public static function Translate() {
		if (Language::USE_TRANSLATIONS) {
			$Language = static::getAgentLanguage();

			// Build the filename
			$LanguageFile 	= '../Core/Localization/Languages/'.$Language.'.php';

			if (!file_exists($LanguageFile) || !is_readable($LanguageFile)) {
				// Fallback Language in case of failure
				$Language = Language::FALLBACK_LANGUAGE;
			}

			$ClassName = new \ReflectionClass('Core\Localization\Languages\\'.$Language);
			return $ClassName->name::getLanguage();
		}
	}
}