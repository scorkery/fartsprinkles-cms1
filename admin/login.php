<?php include('../init.php'); ?>
<?php include(BASE_PATH.'header.php'); ?>
<?php include(BASE_PATH.'navbar.php'); ?>

<?php 

if (isset($_POST['do_login'])) {
	$id = $userManager->userLogin($_POST);
	if ($id) {
		$_SESSION['user_id'] = $id;
		redirect(BASE_URI, 'Login successful!');
	}
	else {
		redirect(BASE_URI, 'Login attempt failed.');
	}
} 

?>
<div class="main">
<h1>Administrator Login</h1>
<form role="form" method="post" action="login.php">
        <label>Username: </label>
        <input type="text" name="username"><br>
        <label>Password: </label>
        <input type="password" name="password">
        <button type="submit" name="do_login">Login</button>
</form>
</div>
<?php include(BASE_PATH.'footer.php'); ?>
