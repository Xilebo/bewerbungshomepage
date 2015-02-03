<?php
/**
 * The class htmlObject represents a single object of the page.
 */
class htmlObject {
	protected static $validTypes = array('span', 'body', 'div', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6');
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

	static function getValidTypes() {
		return htmlObject::$validTypes;
	}

	static function isValidType($type) {
		$type = strtolower($type);
		$result = in_array($type, htmlObject::getValidTypes());
		return $result;
	}

	function __construct($type = 'span') {
		if (htmlObject::isValidType($type)) {
			$this->type = $type;
		} else {
			$this->type = htmlObject::getValidTypes()[0];
		}
	}

	/**
	 * helper function for toString()
	 * @return string the opening tag for this element
	 */
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

	/**
	 * helper function for toString()
	 * @return string the closing tag for this element
	 */
	protected function getCloseTag() {
		$result = '';

		$result .= htmlObject::generateTabs($this->tabLevel);
		$result .= '</' . $this->type . '>' . PHP_EOL;

		return $result;
	}

	/**
	 * helper function for toString()
	 * @return string stringrepresentation for all child elements
	 */
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

	function getType() {
		return $this->type;
	}

	function setType($newType) {
		if (isValidType::isValidType($newType)) {
			$this->type = $newType;
		}
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

	function addClass($class) {
		$this->addPropertyValue('class', $class);
	}

	function addPropertyValue($property, $value) {
		if (isset($this->properties[$property])) {
			$this->properties[$property] .= ' ' . $value;
		} else {
			$this->setProperty($property, $value);
		}
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