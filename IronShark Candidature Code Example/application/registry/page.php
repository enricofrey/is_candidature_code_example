<?php
/**
 * Code Example for IronShark Candidature
 * @author Enrico Frey
 * Page Class
 */

namespace Registry;

class Page {
	/**
	 * The registry object
	 */
	private $_registry;
	
	/**
	 * Page title
	 */
	private $_title = '';
	
	/**
	 * Template bits
	 */
	private $_bits = array();
	
	/**
	 * Template tags
	 */
	private $_tags = array();
	
	/**
	 * Page content
	 */
	private $_content = "";
	
	public function __construct(Registry $registry) {
		$this->_registry = $registry;
	}
	
	/**
	 * Get the page title from the page
	 * @return string the page's title
	 */
	public function getTitle() {
		return $this->_title;
	}
	
	/**
	 * Set the title for the actual page
	 * @param string $title the page title to be set
	 * @return void
	 */
	public function setTitle($title) {
		$this->_title = $title;
	}
	
	/**
	 * Get the template bits to be entered into the page
	 * @return array the array of template bits and template file names
	 */
	public function getBits() {
		return $this->_bits;
	}
	
	/**
	 * Add a template bit to the page, doesnt actually add the content just yet
	 * @param String the tag where the template is added
	 * @param String the template file name
	 * @return void
	 */
	public function addBit($tag, $bit) {
		$this->_bits[$tag] = $bit;
	}
	
	/**
	 * Get tags associated with the page
	 * @return array tags
	 */
	public function getTags() {
		return $this->_tags;
	}
	
	/**
	 * Add a template tag and its replacement value/data to the page
	 * @param string $key the key to store within the tags array
	 * @param string $data the replacement data
	 * @return void
	 */
	public function addTag($key, $data) {
		$this->_tags[$key] = $data;
	}
	
	/**
	 * Get the page content
	 * @return string page content as string
	 */
	public function getContent() {
		return $this->_content;
	}
	
	/**
	 * Set the page content
	 * @param string $content the page content
	 * @return void
	 */
	public function setContent($content) {
		$this->_content = $content;
	}
	
	/**
	 * Get the page content to print
	 * @return string page content as string
	 */
	public function getContentToPrint()
	{
		$this->_content = preg_replace ('#{form_(.+?)}#si', '', $this->_content);
		$this->_content = preg_replace ('#{nbd_(.+?)}#si', '', $this->_content);
		
		return $this->_content;
	}
}
?>