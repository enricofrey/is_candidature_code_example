<?php
/**
 * Code Example for IronShark Candidature
 * @author Enrico Frey
 * Bootstrap Class
 */

// Start session
session_start();

// Enable class autoloading
include_once 'autoload.php';

// Define separator constant
define('SEPARATOR', DIRECTORY_SEPARATOR);

// Define path constants
define('FRAMEWORK_PATH', dirname(__FILE__) . SEPARATOR);
define('TEMPLATE_PATH', FRAMEWORK_PATH . 'views' . SEPARATOR);

// Define url constants
DEFINE('BASE_URL', $_SERVER['BASE_URL']);

// Store required class objects in registry
$registry = new Registry\Registry();
$registry->createAndStoreObject('Registry\Template', 'template');

// Set controller statically without url processor
// (not efficient, just for the purpose of this code example)
$controller_name = 'controller1';
$controller = 'controllers\\' . $controller_name;

// Execute controller logic
// (The appropriate page will be assembled by the controller class)
new $controller($registry);

// Output page
$registry->getObject('template')->output();
?>