<?php include('../init.php'); ?>

<?php $requiredPermission = 'Manage Users'; ?>
<?php include('check_user.php'); ?>

<?php if (isset($_POST['edit_user']) && isset($_GET['id'])) {
	$id = $_GET['id'];

	$userPermissions = array();
	foreach ($allPermissions as $permission) {
		if (isset($_POST[$permission->id])) {
			array_push($userPermissions, $permission->id);
		}

		// all users automatically get login and logout
		if ($permission->name == 'Login' || $permission->name == 'Logout') {
			array_push($userPermissions, $permission->id);
		}
	}

	if ($userManager->updateUserPermissions($userPermissions, $id)) {
		$message = "User info successfully updated.";
		$page = 'users.php';
	}
	else {
		$message = "ERROR: user data was not updated..";
		$page = 'users.php';
	}

	redirect($page, $message);
}?>

