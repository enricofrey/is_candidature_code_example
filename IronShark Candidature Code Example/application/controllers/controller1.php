<?php
/**
 * Code Example for IronShark Candidature
 * @author Enrico Frey
 * Controller1 Class
 */

namespace Controllers;

use Registry\Registry;

class Controller1 {
	/**
	 * The registry object
	 */
	private $_registry;
	
	/**
	 * The model object
	 */
	private $_model;
	
	public function __construct(Registry $registry) {
		$this->_registry = $registry;
		$this->_model = new \Models\Model1;
		
		// Set page title
		$this->_registry->getObject('template')->getPage()->setTitle('IronShark Candidature Code Example');
		
		// Select page skeleton
		$this->_registry->getObject('template')->buildPageFromTemplates('skeleton.tpl.html');
		
		// Add templates
		$this->addHeaderTemplate();
		$this->addMainTemplate();
		$this->addFooterTemplate();
	}
	
	/**
	 * Add header template and it's content
	 * @return void
	 */
	private function addHeaderTemplate() {
		$this->_registry->getObject('template')->addTemplateBit('header', 'header.tpl.html');
	}
	
	/**
	 * Add main template and it's content
	 * @return void
	 */
	private function addMainTemplate() {
		$this->_registry->getObject('template')->addTemplateBit('main', 'main.tpl.html');
		$this->_registry->getObject('template')->getPage()->addTag('main_content', 'Hello World!');
	}
	
	/**
	 * Add footer template and it's content
	 * @return void
	 */
	private function addFooterTemplate() {
		$this->_registry->getObject('template')->addTemplateBit('footer', 'footer.tpl.html');
	}
}
?>