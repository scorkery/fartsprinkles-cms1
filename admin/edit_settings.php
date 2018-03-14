<?php include('../init.php'); ?>

<?php $requiredPermission = 'Edit Site Settings'; ?>
<?php include('check_user.php'); ?>

<?php
$filename = dirname(__FILE__).'/../config/configure.txt';

if (isset($_POST['update'])) {
	$configManager = new ConfigManager($filename);

	// custom text is a special case so it requires some adjustment
	if ($_POST['titlestring'] == "custom") {
		$_POST['titlestring'] = $_POST['customText'];
		$_POST['customText'] = "";
	}

	$success = $configManager->editConfigFile($_POST);
	if ($success) {
		$message = 'Settings file edited; '.$success.' bytes written.';
	}
	else {
		$error = error_get_last();
		$message = 'ERROR:  Settings file was not edited. <b> '.$error['message'].'</b>';
	}
}
else {
	$message = 'ERROR: Something has gone terribly, terribly wrong.  All is lost; abandon hope.';
}

redirect('settings.php', $message);
?>
