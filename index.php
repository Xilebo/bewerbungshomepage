<?php
	require_once('source.php');
	require_once('html/htmlPage.php');
	require_once('helpers.php');

	$html = new HtmlPage();

	$source = new source('bewerbung.csv');
	$html->IncTabLevel();
	$html->addLineToBody('<div class="center-div">');

	$html->IncTabLevel();
	parseSource($source->getData());
	$html->DecTabLevel();

	$html->addLineToBody('</div>');
	$html->DecTabLevel();
	$html->printAll();
?>
