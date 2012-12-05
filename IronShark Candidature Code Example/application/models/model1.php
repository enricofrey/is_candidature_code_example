<?php
/**
 * Code Example for IronShark Candidature
 * @author Enrico Frey
 * Model1 Class
 * Hint: the methods of this model only delivers static content
 * (not efficient, just for the purpose of this code example) 
 */

namespace Models;

class Model1 {
	public function __construct() {}
	
	/**
	 * Return some static content for the main part
	 * of the example page
	 * @return string content for the main part
	 */
	public function getContent() {
		$content = 'Hello Main!';
		return $content;
	}
}
?>