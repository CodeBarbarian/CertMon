<?php
namespace Core\Localization;

/**
 * Interface for all languages
 * @Version: PHP: 8.1
 * @iLanguage
 */
interface iLanguage {
    public static function getLanguage() : array;
}