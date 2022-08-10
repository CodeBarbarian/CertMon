<?php
namespace Core\Localization\Languages;

use Core\Localization\Localization;
use Core\Localization\iLanguage;

/**
 * English localization class
 *
 * @version: PHP: 8.1
 * @nb
 */
class en extends Localization implements iLanguage {
	public static array $Language = array(
		/**
		 * The naming convention should be based on the following
		 *
		 * [COMPONENT_LOCATION_NAME]
		 */
		"fields_header_title" => "Hello World!"
	);

	/**
	 * Static get the language array
	 *
	 * @return array
	 */
	public static function getLanguage(): array {
		return static::$Language;
	}
}