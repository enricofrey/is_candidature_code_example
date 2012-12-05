<?php
/**
 * Code Example for IronShark Candidature
 * @author Enrico Frey
 * Template Class
 */

namespace Registry;

class Template {
	/**
	 * The registry object
	 */
	private $_registry;
	
	/**
	 * The page object
	 */
	private $_page;
	
	/**
	 * Include the page class and build a page object to
	 * manage the content and structure of the page
	 * @param Registry $registry the registry object
	 */
	public function __construct(Registry $registry) {
		$this->_registry = $registry;
		$this->_page = new Page($this->_registry);
	}

	/**
	 * Set the content of the page based on a number of templates;
	 * Pass template file locations as individual arguments
	 * @return void
	 */
	public function buildPageFromTemplates() {
		$bits = func_get_args();
		$content = "";
	
		foreach ($bits as $bit) {
			if (strpos($bit, TEMPLATE_PATH) === false) {
				$bit = TEMPLATE_PATH . $bit;
			}
				
			if (file_exists($bit) == true) {
				$content .= file_get_contents($bit);
			}
		}
	
		$this->_page->setContent($content);
	}
	
	/**
	 * Get the page object
	 * @return object the page object
	 */
	public function getPage() {
		return $this->_page;
	}
	
	/**
	 * Add a template bit from a view to the page
	 * @param string $tag the tag where the template content will be inserted, e.g. {main}
	 * @param string $bit the template bit (this is a path to a file or the filename itself
	 * @return void
	 */
	public function addTemplateBit($tag, $bit) {
		if (strpos($bit, TEMPLATE_PATH) == false) {
			$bit = TEMPLATE_PATH . $bit;
		}
		
		$this->_page->addBit($tag, $bit);
	}
	
	/**
	 * Add path tags for front-end resources
	 * @return void
	 */
	private function addPathTags() {
		$this->_page->addTag('base_url', BASE_URL);
		$this->_page->addTag('css_url', BASE_URL . 'css');
		$this->_page->addTag('img_url', BASE_URL . 'img');
		$this->_page->addTag('js_url', BASE_URL . 'js');
	}
	
	/**
	 * Replace bits in the page with templates
	 * Updates the page's content
	 * @return void
	 */
	private function replaceBits() {
		$bits = $this->_page->getBits();
	
		// Iterate through template bits
		foreach ($bits as $tag => $template) {
			$template_content = file_get_contents($template);
			$new_content = str_replace('{' . $tag . '}', $template_content, $this->_page->getContent());
			$this->_page->setContent($new_content);
		}
	}
	
	/**
	 * Replace tags in the page with content
	 * @param bool $pp the Post Parse tags flag
	 * @return void
	 */
	private function replaceTags() {
		// Get tags in the page
		$tags = $this->_page->getTags();
	
		// Iterate through the tags
		foreach ($tags as $tag => $data) {
			// Replace the content
			$new_content = str_replace('{' . $tag . '}', $data, $this->_page->getContent());
	
			// Update the page's content
			$this->_page->setContent($new_content);
		}
	}
	
	/**
	 * Replace title in header template
	 * @return void
	 */
	private function parseTitle() {
		$newContent = str_replace('<title></title>', 
							'<title>' . $this->_page->getTitle() . '</title>', 
							$this->_page->getContent());
		$this->_page->setContent($newContent);
	}
	
	/**
	 * Parse the page object into output
	 * @return void
	 */
	private function parseOutput() {
		$this->addPathTags();
		$this->replaceBits();
		$this->replaceTags();
		$this->parseTitle();
	}
	
	/**
	 * Output page content
	 * @return string the page content
	 */
	public function output() {
		$this->parseOutput();
		echo $this->getPage()->getContentToPrint();
	}
}
?>