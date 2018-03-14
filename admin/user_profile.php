<?php include('../init.php'); ?>
<?php $requiredPermission = 'Login' ?>
<?php include('check_user.php'); ?>

<?php include(BASE_PATH.'header.php'); ?>
<?php include(BASE_PATH.'navbar.php'); ?>

<?php $name = $user->name; ?>

<?php if(isset($_POST['edit_profile'])) {
	$pass1 = $_POST['new_password_1'];
	$pass2 = $_POST['new_password_2'];
	$oldPass = $_POST['old_password'];

	if ($pass1 != '' && $pass2 != '' && $oldPass != '') {
		if ($pass1 == $pass2) {
			$data = ['username' => $name, 'password' => $oldPass];
			$id = $userID;
			if ($userManager->userLogin($data) == $id) {
				$hash = password_hash($pass1, PASSWORD_DEFAULT);
				$success = $userManager->updatePassword($id, $hash);
				if ($success) {
					echo 'User info updated.';
				}
				else {
					echo 'Error updating user info.';
				}
			}
			else {
				echo 'Incorrect password.';
			}
		}
		else {
			echo 'Passwords do not match.';
		}
	}
}?>

<div class="main">
	<form class="form-group" role="form" method="post" action="user_profile.php">
		<h1 class="form-control">User Profile: <?php echo $name; ?></h1>
		<label class="form-control">Change Password:</label>
		<input type="password" name="new_password_1" class="form-control">
		<label class="form-control">Enter New Password Again:</label>
		<input type="password" name="new_password_2" class="form-control">
		<label class="form-control">Enter Old Password:</label>
		<input type="password" name="old_password" class="form-control">
		<button type="submit" name="edit_profile">Confirm</button>
	</form>
</div>
