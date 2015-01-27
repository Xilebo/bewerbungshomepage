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

	static function generateTabs($count) {
		$result = '';
		for ($i = 0; $i < $count; $i++) {
			$result .= "\t";
		}
		return $result;
	}

	function __construct($type = 'span') {
		$this->type = $type;
	}

	protected function getOpenTag() {
		$result = '';

		$result .= htmlObject::generateTabs($this->tabLevel);
		$result .= '<' . $this->type;
		foreach ($this->properties as $property => $value) {
			$result .= ' ' . $property . '="' . $value . '"';
		}
		$result .= '>' . PHP_EOL;

		return $result;
	}

	protected function getCloseTag() {
		$result = '';

		$result .= htmlObject::generateTabs($this->tabLevel);
		$result .= '</' . $this->type . '>' . PHP_EOL;

		return $result;
	}

	protected function contentToString() {
		$result = '';

		foreach ($this->content as $childelement) {
			if (get_class($childelement) == 'htmlObject') {
				$result .= $childelement->toString();
			} else {
				$result .= htmlObject::generateTabs($this->tabLevel + 1);
				$result .= $childelement . PHP_EOL;
			}
		}

		return $result;
	}

	function toString() {
		$result = '';
		$result .= $this->getOpenTag();
		$result .= $this->contentToString();
		$result .= $this->getCloseTag();

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