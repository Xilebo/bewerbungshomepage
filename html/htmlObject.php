<?php
/**
 * The class htmlObject represents a single object of the page.
 */
class htmlObject {
	protected static $validTypes = array('div', 'span', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6');
	private $type = '';
	private $tabLevel = 0;
	private $content = array();
	private $properties = array();

	function __construct($type = 'span') {
		$this->type = $type;
	}

	function toString() {
		$result = '';

		$result .= '<' . $type;
		foreach ($this->properties as $property => $value) {
			$result .= ' ' . $property . '="' . $value . '"';
		}
		$result .= '>' . PHP_EOL;
		foreach ($this->content as $childelement) {
			$result .= $childelement . PHP_EOL;
		}
		$result .= '</' . $type . '>'; //no EOL; EOL will be added by parent element
		return $result;
	}

	function getValidTypes() {
		return $this->validTypes;
	}

	function isValidType($type) {
		return in_array(strtolower($type), htmlObject::validTypes);

	}

	function getType() {
		return $this->type;
	}

	function setType($newType) {
		$this->type = $newType;
	}

	function setTabLevel($newTabLevel) {
		$this->tabLevel = $newTabLevel;
		foreach ($this->content as $element) {
			if (get_class($element) == 'htmlObject') {
				$element->setTabLevel($this->tabLevel + 1);
			}
		}
	}

	function addContent($newContent) {
		if (get_class($newContent) == 'htmlObject') {
			$newContent->setTabLevel($this->tabLevel + 1);
		}
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