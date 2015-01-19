<?php

	function addClassByLevel($class, $level) {
		if ($class != '') {
			$class .= ' ';
		}
		if ($level >= 0) {
			$class .= 'expandable ';
		}
		if ($level >= -1){
			$class .= 'level' . $level;
		}

		return $class;
	}

	function openTag($level, $class) {
		global $html;
		$class = addClassByLevel($class, $level);
		$openTag = HtmlPage::generateOpenTag($class);
		$html->addLineToBody($openTag);
		$html->IncTabLevel();
	}

	function closeTag($level, $class) {
		global $html;
		$html->DecTabLevel();
		$closeTag = HtmlPage::generateCloseTag();
		$html->addLineToBody($closeTag);

	}

	function addLineToBody($line) {
		global $html;
		$fieldcount = count($line) - 2;
		for ($i = 0; $i < $fieldcount; $i++) {
			$html->addLineToBody('<span class="field field' . $i . '">');
			$html->IncTabLevel();
			$html->addLineToBody($line[$i]);
			$html->DecTabLevel();
			$html->addLineToBody('</span>');
		}
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
		for ($lineNumber = $nextLine;
				continueParseSource($lineNumber, $lineCount, $source[$lineNumber]['level'], $currentLevel);
				$lineNumber++) {
			$result = $lineNumber;
			$line = $source[$lineNumber];
			if ($line['level'] == 'head') {
				addLineToHead($line);
			} elseif ($line['level'] < 0) {
				openTag($line['level'], $line['class']);
				addLineToBody($line);
				closeTag($line['level'], $line['class']);
				if (($lineNumber + 1 < $lineCount)
						&& ($source[$lineNumber + 1]['level'] > $currentLevel)) {
					$tmp = parseSource($source, $lineNumber + 1, $source[$lineNumber + 1]['level']);
				}
			} elseif ($line['level'] == $currentLevel) {
				openTag($line['level'], $line['class']);
				addLineToBody($line);
				if (($lineNumber + 1 < $lineCount)
						&& ($source[$lineNumber + 1]['level'] > $currentLevel)) {
					$tmp = parseSource($source, $lineNumber + 1, $source[$lineNumber + 1]['level']);
				}
				closeTag($line['level'], $line['class']);
			}
		}
		return $result;
	}

?>