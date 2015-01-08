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

	function addLineToBody($line) {
		global $html;

		$openTag = generateOpenTag($line['level'], $line['class']);
		$html->addLineToBody($openTag);
		$html->IncTabLevel();
		$fieldcount = count($line) - 2;
		for ($i = 0; $i < $fieldcount; $i++) {
			$html->addLineToBody('<span class="field' . $i . '">');
			$html->IncTabLevel();
			$html->addLineToBody($line[$i]);
			$html->DecTabLevel();
			$html->addLineToBody('</span>');
		}
		$html->DecTabLevel();
		$html->addLineToBody('</div>');
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

	function parseSource($source, $nextLine = 0, $currentLevel = -1) {
		foreach ($source as $line) {
			if ($line['level'] == 'head') {
				addLineToHead($line);
			} elseif ($line['level'] < 0){
				addLineToBody($line);
			} else {
				addLineToBody($line);
			}
		}

	}

?>