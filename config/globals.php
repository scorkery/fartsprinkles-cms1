<?php

include(dirname(__FILE__).'/../libraries/ConfigManager.php');
$filename = dirname(__FILE__)."/configure.txt";
$confManager = new ConfigManager($filename);

$confArray = $confManager->generateArrayFromConfigFile();

foreach ($confArray as $item) {
	$key = array_search($item, $confArray);
	$GLOBALS[$key] = $item;
}

?>
