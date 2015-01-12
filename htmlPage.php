<?php
/**
 * Die Klasse HtmlPage verwaltet den HTML-Code der Seite.
 * Sie stellt hilfreiche Funktionen zum bearbeiten des Codes zur Verfügung
 * und gibt ihn am Ende aus.
 */
class HtmlPage {
	private static $htmlPage = 0;

	public $html = '';
	public $tabLevel = 0;

	function __construct() {
		$this->html = file_get_contents('html/template.html');
	}

	function IncTabLevel() {
		$this->tabLevel++;
	}
	function DecTabLevel() {
		$this->tabLevel--;
	}
	function getTabLevel() {
		return $this->tabLevel;
	}

	function addLine($token, $text, $tabLevel) {
		$newLine = '';
		for ($i = 0; $i < $tabLevel; $i++) {
			$newLine .= "\t";
		}
		$newLine .= $text . PHP_EOL;
		$newLine .= '[' . $token . ']';
		$this->html = str_replace('[' . $token . ']', $newLine, $this->html);
	}

	function addLineToHead($text) {
		$this->addLine('BHP_HEADER', $text, 1);
	}

	function addLineToBody($text) {
		$this->addLine('BHP_BODY', $text, $this->tabLevel);
	}

	function removeToken($token) {
		$this->html = str_replace('[' . $token . ']', '', $this->html);
	}

	function printAll() {
		$this->removeToken('BHP_HEADER');
		$this->removeToken('BHP_BODY');
		echo $this->html;
	}
}
?>