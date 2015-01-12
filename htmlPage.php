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

	public static function getHtmlPage() {
		// if (HtmlPage::htmlPage == 0) {
			// HtmlPage::htmlPage = new HtmlPage();
		// }
		// return HtmlPage::htmlPage;
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
	// function openTag() {
		// $args = func_get_args();
	// }

	function removeToken($token) {
		$this->html = str_replace('[' . $token . ']', '', $this->html);
	}

	function encoding($code) {
		$t = mb_detect_encoding($code, "UTF-8, ISO-8859-1, ISO-8859-15", true);
		return mb_convert_encoding($code, "UTF-8", $t);
	}

	function printAll() {
		$this->removeToken('BHP_HEADER');
		$this->removeToken('BHP_BODY');
		echo $this->encoding($this->html);
	}
}
?>