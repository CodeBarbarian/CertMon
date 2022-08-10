<?php

namespace Core\Localization;

use App\Config\Language;
use App\Config\Paths;

/**
 * Localization (Translation) Class
 * @version: PHP: 8.1
 *
 * @Localization
 */
class Localization implements iLocalization {
    /**
     * Method for returning the HTTP_ACCEPT_LANGUAGE recieved by the server
     *
     * @return string
     */
    private static function getAgentLanguage(): string {
		return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	}
    
    /**
     * Method for constructing the Language Filename
     *
     * @param String $AcceptLanguage
     *
     * @return string|bool
     */
    private static function getLanguageFile(String $AcceptLanguage): string|bool {
        $LanguageFile = '../'.Paths::LANGUAGE_DIR.'/'.$AcceptLanguage.'.php';
        // Let us check if we support that language
        if (!file_exists($LanguageFile) || !is_readable($LanguageFile)) {
            return false;
        }
        
        return $LanguageFile;
    }
    
    /**
     * Method for constructing the class name
     *
     * @param String $AcceptLanguage
     *
     * @return string
     */
    private static function getLanguageClassName(String $AcceptLanguage): string {
        return '\Core\Localization\Languages\\'.$AcceptLanguage;
    }
    
    /**
     * Method for checking if localization is available
     *
     * @return bool|string
     */
    private static function isLocalizationAvailable(): bool|string {
        $Language = strtolower(static::getAgentLanguage());
        
        if (!static::getLanguageFile($Language)) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Method for returning the class name for the default language
     *
     * @return string
     */
    private static function useDefaultLanguage(): string {
      return static::getLanguageClassName(Language::DEFAULT_HTTP_ACCEPT_LANGUAGE);
    }
    
    /**
     * Method for returning the class name for the localized language
     *
     * @return string
     */
    private static function useLocalizedLanguage(): string {
        return static::getLanguageClassName(static::getAgentLanguage());
    }
    
    /**
     * Method for getting the language class and retrieving the static language array.
     *
     * @throws \ReflectionException
     */
	public static function Translate() {
		if (Language::USE_TRANSLATIONS) {
            /**
             * We need to check to see if the default language file exists.
             * If it does not exist, we have no reference so return false.
             */
            if (!static::getLanguageFile(Language::DEFAULT_HTTP_ACCEPT_LANGUAGE)) {
                return false;
            }
            
            // Check if we support localization for the clients language
            if (static::isLocalizationAvailable()) {
                $ClassName = new \ReflectionClass(objectOrClass: static::useLocalizedLanguage());
            } else {
                $ClassName = new \ReflectionClass(objectOrClass: static::useDefaultLanguage());
            }
            
            // Return the array with the translations
            return $ClassName->name::getLanguage();
		}
	}
}

/**
 * Not sure if I am happy about this solution, it works, but it is not sexy? Will come back to this when I am done with
 * other parts of the framework. Might also need other people to throw ideas at?
 */