<?php
function checkFileFormat($fileType) {
	$contents = file_get_contents(EXTENSIONS_FILE);
	$fileFormats = explode("\n", $contents);
	
	foreach($fileFormats as $fileFormat) {
		if ($fileFormat == $fileType) {
			return true;
		}
	}

	return false;
}

function printAllowedFileTypes() {
	$contents = file_get_contents(EXTENSIONS_FILE);
	$fileFormats = explode("\n", $contents);
	echo 'Allowed file formats: ';	

	foreach($fileFormats as $fileFormat) {
		echo '.'.$fileFormat;
		if (next($fileFormats)) {
			echo ', ';	
		}
	}
}
?>
