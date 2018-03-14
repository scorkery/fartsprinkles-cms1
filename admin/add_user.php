<?php include('../init.php'); ?>

<?php $requiredPermission = 'Manage Users'; ?>
<?php include('check_user.php'); ?>

<?php if (isset($_POST['add_user'])) {
	if ($_POST['name'] == '' || $_POST['password'] == '') {
		redirect ('users.php', 'Username and Password fields cannot be blank.');
	}
	$userPermissions = array();
	foreach ($allPermissions as $permission) {
		if (isset($_POST[$permission->id])) {
			array_push($userPermissions, $permission->id);
		}
		
		// all users automatically get the Login and Logout permissions
		if ($permission->name == 'Login' || $permission->name == 'Logout') {
			array_push($userPermissions, $permission->id);
		}
	}
        $userManager->addUser($_POST['name'], $_POST['password'], $userPermissions);
} ?>
<?php redirect('users.php', 'User Added.'); ?>
