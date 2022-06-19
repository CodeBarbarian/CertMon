<?php

namespace Core\Plugins;

/**
 * Plugin Base
 * @version: PHP: 8.1
 *
 * @Plugin
 */
abstract class Plugin {
	/**
	 * Return ClassName using ReflectionClass.
	 *
	 * @return string
	 */
	private function getClassName() : string {
		$ClassName = new \ReflectionClass($this);
		return $ClassName->getShortName();
	}

	/**
	 * Return Config Filename as string.
	 * @return string
	 */
	private function getConfigFilename() : string {
		$ClassName = $this->getClassName();

		return '../Core/Plugins/'.$ClassName.'/'.$ClassName.'Config.php';
	}

	/**
	 * Return Config Class Name as string
	 *
	 * @return string
	 */
	private function getConfigClassName() : string {
		return get_class($this).'Config';
	}

	/**
	 * On ready method. When the plugin is loaded does the plugin have everything that is required of it?
	 * For now only the configuration file is required
	 *
	 * @return bool
	 */
	private function onReady(): bool {
		$ClassName = $this->getClassName();

		if (!file_exists($this->getConfigFilename())) {
			return false;
		}

		if (!include ($this->getConfigFilename())) {
			return false;
		}

		if (!class_exists($this->getConfigClassName())) {
			return false;
		}

		return true;
	}

	/**
	 * Prepare the plugin to be executed, check the configuration file if the plugin is enabled
	 *
	 * @return bool
	 */
	private function prepare(): bool {
		if (!($this->getConfigClassName())::ENABLED) {
			return false;
		}

		return true;
	}

	/**
	 * Magic method, used for handling the plugin
	 *
	 * @param $Method
	 * @param $Arguments
	 * @return false|mixed|void
	 */
	public function __call($Method, $Arguments) {
		if (method_exists($this, $Method)) {
			if (!$this->onReady()) {
				return false;
			}

			if (!$this->prepare()) {
				return false;
			}

			if ($Method === "execute") {
				return call_user_func_array(array($this, $Method), $Arguments);
			}
		}
	}
}