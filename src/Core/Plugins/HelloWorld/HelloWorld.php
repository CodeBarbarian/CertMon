<?php

namespace Core\Plugins\HelloWorld;

use Core\Plugins\Plugin;

/**
 * Hello World Plugin
 */
class HelloWorld extends Plugin {
	protected function execute() : string {
		return "Hello World from Plugin!";
	}
}