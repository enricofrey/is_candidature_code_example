<?php
/**
 * Code Example for IronShark Candidature
 * @author Enrico Frey
 * Registry Class
 */

namespace Registry;

class Registry {
	/**
	 * Array of objects
	 */
	private $_objects_arr_arr;
	
	public function __construct() {}
	
	/**
	 * Create a new object and store it in the registry
	 * @param string $object the object file prefix
	 * @param string $key pair for the object
	 * @return void
	 */
	public function createAndStoreObject($object, $key) {			
		$this->_objects_arr[$key] = new $object($this);
	}
	
	/**
	 * Get an object from the registry's store
	 * @param string $key the objects array key
	 * @return object specific class object
	 */
	public function getObject($key) {
		return $this->_objects_arr[$key];
	}
	
	/**
	 * Get configuration data from XML files
	 * @param string $filename XML filename
	 * @param string $attr the attribute to be read
	 * @return string attribute value from xml config file
	 */
	public function getConfigs($file, $element, $attr) {
		$configs = simplexml_load_file(FRAMEWORK_PATH . 'configuration' . SEPARATOR . $file . '.xml');
		
		return $configs->$element->$attr;
	}
}
?>