<?php
class source {
	const CSV_FIELD_DELIMITER = ';';
	const STATUS_ERROR = 0;
	const STATUS_OK = 1;

	private $file;

	private $data = array();
	public $status = STATUS_OK;

	function __construct($file = 'bewerbung.csv') {
		$this->file = $file;
		$this->readFile ();
	}

	function readFile () {
		$sourcefile = fopen ($this->file,'r');
		if ($sourcefile === FALSE) {
			$status = $this::STATUS_ERROR;
		} else {
			$i = 0;
			while (($line = fgetcsv($sourcefile, 0, $this::CSV_FIELD_DELIMITER)) !== FALSE) {
				$this->data[$i]['level'] = trim(array_shift($line));
				$this->data[$i]['class'] = trim(array_shift($line));
				foreach ($line as $field) {
					$this->data[$i][] = $field;
				}
				$i++;
			}
			fclose($sourcefile);
			$status = $this::STATUS_OK;
		}
	}

	function getData() {
		return $this->data;
	}
}
?>