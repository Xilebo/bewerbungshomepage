<?php

	/**
	 * add level specific classes
	 */
	function addClassByLevel($class, $level) {
		if ($class != '') {
			$class .= ' ';
		}
		if ($level >= 0) {
			$class .= 'expandable closed ';
		}
		if ($level >= -1){
			$class .= 'level' . $level;
		}

		return $class;
	}

	function parseLine($line) {
		$class = addClassByLevel($line['class'], $line['level']);
		$lineHtml = new htmlObject('div');
		$lineHtml->addClass($class);

		$fieldcount = count($line) - 2; //the fields 'level' and 'class' don't get displayed
		for ($i = 0; $i < $fieldcount; $i++) {
			$fieldHtml = new htmlObject('span');
			$fieldHtml->addClass('field');
			$fieldHtml->addClass('field' . $i);
			$fieldHtml->addContent($line[$i]);
			$lineHtml->addContent($fieldHtml);
		}

		return $lineHtml;
	}

	function addLineToHead($line) {
		global $html;

		$newLine = '<' . $line['class'] . ' ' . $line[0] . '>';
		$newLine .= $line[1];
		if ($line['class'] != 'meta') {
			$newLine .= '</' . $line['class'] . '>';
		}
		$html->addLineToHead($newLine);
	}

	function continueParseSource($lineNumber, $lineCount, $lineLevel, $currentLevel) {
		$result = false;

		$lineCountReached = ($lineNumber >= $lineCount);

		$validLevel = (($lineLevel >= $currentLevel)
				|| ($lineLevel == 'head'));

		$result = $validLevel && !$lineCountReached;
		return $result;
	}

	function parseSource($source, $nextLine = 0, $currentLevel = -1) {
		$lineCount = count($source);
		$result = new htmlObject('div');
		for ($i = $nextLine;
				continueParseSource($i, $lineCount, $source[$i]['level'], $currentLevel);
				$i++) {
			$line = $source[$i];
			if ($line['level'] == 'head') {
				addLineToHead($line);
			} elseif ($line['level'] == $currentLevel) {
				$lineDiv = parseLine($line);
				$lineDiv->addClass('line');
				$lineDiv->addClass('line' . $i);

				$result->addContent($lineDiv);

				//check if the next element has a higher level
				//if so - add it at the right place
				if (($i + 1 < $lineCount)
						&& ($source[$i + 1]['level'] > $currentLevel)) {
					$tmp = parseSource($source, $i + 1, $source[$i + 1]['level']);
					if ($line['level'] < 0) {
						$result->addContent($tmp);
					} else {
						$lineDiv->addContent($tmp);
					}
				}
			}
		}
		return $result;
	}

?>