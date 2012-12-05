<?php
/**
 * Code Example for IronShark Candidature
 * @author Enrico Frey
 * Class Autoloader Class
 */

/**
 * Include class files if needed by object creation
 * @param string $class_name
 * @return void
 */
function classLoader($class_name) {
	$path = FRAMEWORK_PATH . str_replace('\\', SEPARATOR, $class_name);
	$file = strtolower($path) . '.php';
	
	if (file_exists($file)) {
		include_once $file;
	}
}

// Settings for PHP's autoloader
spl_autoload_extensions('.php');
spl_autoload_register('classLoader');
?>