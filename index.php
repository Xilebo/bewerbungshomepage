<?php
	require_once('source.php');
	require_once('html/htmlPage.php');
	require_once('helpers.php');

	$html = new HtmlPage();

	$source = new source('bewerbung.csv');

	$centerDiv = parseSource($source->getData());
	$centerDiv->addClass('center-div');
	$html->addHtmlObjectToBody($centerDiv);

	$html->printAll();
?>
