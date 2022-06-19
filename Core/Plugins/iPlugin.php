<?php

namespace Core\Plugins;

/**
 * Plugin Interface
 * @version: PHP:8.1
 *
 * @iPlugin
 */
interface iPlugin {
	/**
	 * All plugins should be able to do a very specific thing.
	 * It should encompass the idea of a set of methods inside a class which does something oddly specific.
	 *
	 * The function in the interface itself that all other classes should implement some sort of basic structure
	 *
	 * We need to test if all the requirements for the plugin exists and are ready to be used
	 * We need to prepare the plugin for execution
	 * We need to execute the plugin and provide or return something
	 */

	/**
	 * On ready method. When the plugin is loaded does the plugin have everything that is required of it?
	 * For now only the configuration file is required
	 *
	 * @return bool
	 */
	function onReady() : bool;

	/**
	 * Prepare the plugin to be executed, check the configuration file if the plugin is enabled
	 *
	 * @return bool
	 */
	function prepare() : bool;
}