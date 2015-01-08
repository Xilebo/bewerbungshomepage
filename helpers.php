<?php

	function generateOpenTag($level, $class) {
		if (($level < 0) && ($class == '')) {
			$result = '<div>';
		} elseif (($level >= 0) && ($class == '')) {
			$result = '<div class="expandable level' . $level . '">';
		} elseif (($level < 0) && ($class != '')) {
			$result = '<div class="' . $class . '">';
		} elseif (($level >= 0) && ($class != '')) {
			$result = '<div class="expandable level' . $level . ' ' . $class . '">';
		}
		return $result;
	}

	function generateCloseTag($level, $class) {
		// currently its </div> for all, but that may change in the future
		$result = '</div>';
		return $result;
	}

	function openTag($level, $class) {
		global $html;
		$openTag = generateOpenTag($level, $class);
		$html->addLineToBody($openTag);
		$html->IncTabLevel();
	}

	function closeTag($level, $class) {
		global $html;
		$html->DecTabLevel();
		$closeTag = generateCloseTag($level, $class);
		$html->addLineToBody($closeTag);

	}

	function addLineToBody($line) {
		global $html;
		$fieldcount = count($line) - 2;
		for ($i = 0; $i < $fieldcount; $i++) {
			$html->addLineToBody('<span class="field' . $i . '">');
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

	function parseSource($source, $nextLine = 0, $currentLevel = 0) {
		$lineCount = count($source);
		for (
				$i = $nextLine;
				(
					($i < $lineCount)
					&& (
						($source[$i]['level'] >= $currentLevel)
						|| ($source[$i]['level'] == -1)
						|| ($source[$i]['level'] == 'head')
					)
				);
				$i++
			) {
			$line = $source[$i];
			if ($line['level'] == 'head') {
				addLineToHead($line);
			} elseif ($line['level'] < 0) {
				openTag($line['level'], $line['class']);
				addLineToBody($line);
				closeTag($line['level'], $line['class']);
			} elseif ($line['level'] == $currentLevel) {
				openTag($line['level'], $line['class']);
				addLineToBody($line);
				if ($i + 1 < $lineCount) {
					if ($source[$i + 1]['level'] > $currentLevel) {
						parseSource($source, $i + 1, $currentLevel + 1);
					}
				}
				closeTag($line['level'], $line['class']);
			}
		}

	}

?>