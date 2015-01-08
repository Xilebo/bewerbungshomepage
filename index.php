<?php
	require_once('source.php');
	require_once('htmlPage.php');
	require_once('helpers.php');

	$html = new HtmlPage();

	$source = new source('bewerbung.csv');
	$source->readFile();
	$html->IncTabLevel();
	$html->addLineToBody('<div class="center-div">');

	$html->IncTabLevel();
	foreach ($source->data as $line) {
		if ($line['level'] == 'head') {
			addLineToHead($line);
		} elseif ($line['level'] >= -1){
			addLineToBody($line);
		}
	}
	$html->DecTabLevel();

	$html->addLineToBody('</div>');
	$html->DecTabLevel();
	$html->printAll();
?>
