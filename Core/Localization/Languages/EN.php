<?php

namespace Core\Localization\Languages;

/**
 * English localization class
 * @version: PHP: 8.1
 */
class EN {
	public static array $Language = array(
		/**
		 * The naming convention should be based on the following
		 *
		 * [COMPONENT_LOCATION_NAME]
		 */
		"fields_header_title" => "Hello World!",

		/**
		 * Label text
		 */

		"label_text_username" => "Username",
		"label_text_password" => "Password",

		/**
		 * Button Text
		 */
		"button_text_create" => "Created",
		"button_text_read"   => "Read",
		"button_text_update" => "Update",
		"button_text_delete" => "Delete",
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