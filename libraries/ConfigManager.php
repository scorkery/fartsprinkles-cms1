<?php

class ConfigManager {

	private $terminateChar;
	private $configFileName;
	private $assignmentChar;

	public function __construct($configFileName, $terminateChar = ';', $assignmentChar = '=') {
		$this->configFileName = $configFileName;
		$this->terminateChar = $terminateChar;
		$this->assignmentChar = $assignmentChar;
	}

	private function generateConfigStringFromArray($arr) {
		$returnVal = "";

		foreach ($arr as $item) {
			$key = array_search($item, $arr);
			$returnVal = $returnVal."\n".$key.$this->assignmentChar.$item.$this->terminateChar;
		}
		
		return $returnVal;
	}

	public function generateArrayFromConfigFile($errorMsg = "unable to open config file") {
		// read file into string, separate based on termination char
		$contents = file_get_contents($this->configFileName) or die($errorMsg);
		$params = explode($this->terminateChar, $contents);
		
		// create array of key/value pairs from config file
		$returnVal = array();
		foreach($params as $param) {
			// separate each assignment statement based on assignment char
			$temp = explode($this->assignmentChar, $param);
			$key = $temp[0];
			
			// remove whitespace in key if it exists
			$key = preg_replace('/\s+/', '', $key);

			// if every statement is a key/val pair, assign to the array
			if (isset($temp[1])) {
				$value = $temp[1];
				$returnVal[$key] = $value;
			}
		}

		return $returnVal;
	}

	public function editConfigFile($changes) {
		// get original config file as array
		$original = $this->generateArrayFromConfigFile();

		// replace old values with new values
		foreach ($changes as $change) {
			$key = array_search($change, $changes);
			if (isset($original[$key])) {
				$original[$key] = $change;
			}
		}
		
		// generate string and write to config file
		$newConfigFile = $this->generateConfigStringFromArray($original);
		return file_put_contents($this->configFileName, $newConfigFile);
	}
}

?>
