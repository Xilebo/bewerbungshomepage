﻿<?php

require_once('htmlObject.php');

/**
 * Die Klasse HtmlPage verwaltet den HTML-Code der Seite.
 * Sie stellt hilfreiche Funktionen zum bearbeiten des Codes zur Verfügung
 * und gibt ihn am Ende aus.
 */
class HtmlPage {
	private static $htmlPage = 0;

	public $html = '';
	private $body = NULL;

	function __construct() {
		$this->html = file_get_contents('html/template.html');
		$this->body = new htmlObject('body');
	}

	function addLine($token, $text, $tabLevel) {
		$newLine = '';
		$newLine .= htmlObject::generateTabs($tabLevel);
		$newLine .= $text . PHP_EOL;
		$newLine .= '[' . $token . ']';
		$this->html = str_replace('[' . $token . ']', $newLine, $this->html);
	}

	function addLineToHead($text) {
		$this->addLine('BHP_HEADER', $text, 1);
	}

	function addHtmlObjectToBody($object) {
		$this->body->addContent($object);
	}

	function removeToken($token) {
		$this->html = str_replace('[' . $token . ']', '', $this->html);
	}

	function encoding($code) {
		$t = mb_detect_encoding($code, "UTF-8, ISO-8859-1, ISO-8859-15", true);
		return mb_convert_encoding($code, "UTF-8", $t);
	}

	function printAll() {
		$this->removeToken('BHP_HEADER');

		$newLine = $this->body->toString();
		$this->html = str_replace('[BHP_BODY]', $newLine, $this->html);

		echo $this->encoding($this->html);
	}
}
?>