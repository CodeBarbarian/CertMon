<?php

namespace App\Config;

use Core\Config;

/**
 * Token Config
 * @version: PHP: 8.1
 *
 * @Token
 */
class Token extends Config {
    /**
     * Secret key for hashing
     * @var boolean
     */
    const SECRET_KEY = 'metamorphosis';
}