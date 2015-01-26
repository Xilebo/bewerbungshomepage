<?php
/**
 * The class htmlObject represents a single object of the page.
 */
class htmlObject {
	private $type = '';
	private $content = array();
	private $properties = array();

	function __construct($type = 'span') {
		$this->type = $type;
	}

	function getType() {
		return $this->type;
	}

	function setType($newType) {
		$this->type = $newType;
	}

	function addContent($newContent) {
		$this->content[] = $newContent;
	}

	function setProperty($property, $value) {
		$this->properties[$property] = '' . $value;
	}

	function addPropertyValue ($property, $value) {
		$this->properties[$property] .= $value;
	}

	function getProperty($property) {
		$result = array_key_exists ($property, $this->properties) ? $this->properties[$property] : false;
		return $result;
	}

	function removeProperty($property) {
		unset($this->properties[$property]);
	}

}
?>