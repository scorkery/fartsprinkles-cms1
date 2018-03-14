<?php include('../init.php'); ?>

<?php $requiredPermission = 'Upload Resources'; ?>
<?php include('check_user.php'); ?>

<?php
if (isset($_POST['submit'])) {
	$targetDirectory = BASE_PATH."res/";
	$targetFile = $targetDirectory.basename($_FILES["uploadFile"]["name"]);
	$uploadOK = 1;
	$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

	$uploadOK = 1;

	// check if file exists
	if (file_exists($targetFile)) {
		echo "File already exists.";
		$uploadOK = 0;
	}

	// Check file size
	if ($_FILES["uploadFile"]["size"] > FILE_SIZE_LIMIT) {
		echo "File too large (limit ".FILE_SIZE_LIMIT." bytes).";
		$uploadOK = 0;
	}

	// Check for file formats
	if (!checkFileFormat($fileType)) {
		echo "File format not allowed.";
		$uploadOK = 0;
	}

	// create directory if it does not exist
	if (!is_dir($targetDirectory)) {
		mkdir($targetDirectory);
	}

	// upload file if OK
	if ($uploadOK == 1) {
		if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $targetFile)) {
			echo "File successfully uploaded.";
		}
		else {
			echo "Error:  File was not uploaded.";
		}
	}
}

?>

