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
			if ($i == 0) {
				$html->addLineToBody("<h4>");
				$html->IncTabLevel();
				$html->addLineToBody($line[$i]);
				$html->DecTabLevel();
				$html->addLineToBody("</h4>");
			} elseif ($i == 1) {
				$html->addLineToBody("<h5>");
				$html->IncTabLevel();
				$html->addLineToBody($line[$i]);
				$html->DecTabLevel();
				$html->addLineToBody("</h5>");
			} elseif ($i == 2) {
				$html->addLineToBody("<p>");
				$html->IncTabLevel();
				$html->addLineToBody($line[$i]);
				$html->DecTabLevel();
				$html->addLineToBody("</p>");
			} else {
				$html->IncTabLevel();
				$html->addLineToBody($line[$i]);
				$html->DecTabLevel();
			}
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

?>