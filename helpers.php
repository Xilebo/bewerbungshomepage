<?php

	function generateTrTag($level, $class) {
		if (($level < 0) && ($class == '')) {
			$result = '<tr>';
		} elseif (($level >= 0) && ($class == '')) {
			$result = '<tr class="expandable level' . $level . '">';
		} elseif (($level < 0) && ($class != '')) {
			$result = '<tr class="' . $class . '">';
		} elseif (($level >= 0) && ($class != '')) {
			$result = '<tr class="expandable level' . $level . ' ' . $class . '">';
		}
		return $result;
	}

	function addLineToBody($line) {
		global $html;

		$trTag = generateTrTag($line['level'], $line['class']);
		$html->addLineToBody($trTag);
		$html->IncTabLevel();
		$fieldcount = count($line) - 2;
		for ($i = 0; $i < $fieldcount; $i++) {
			$html->addLineToBody('<td>');
			$html->IncTabLevel();
			$html->addLineToBody($line[$i]);
			$html->DecTabLevel();
			$html->addLineToBody('</td>');
		}
		$html->DecTabLevel();
		$html->addLineToBody('</tr>');
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