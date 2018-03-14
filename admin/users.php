<?php include('../init.php'); ?>

<?php $requiredPermission = 'Manage Users'; ?>
<?php include('check_user.php'); ?>

<?php include(BASE_PATH.'header.php'); ?>
<?php include(BASE_PATH.'navbar.php'); ?>

<?php $users = $userManager->getAllUsers() ?>

<script language="JavaScript">
	function selectAll(item) {
		var options = document.getElementsByTagName('input');
		for (var i = 0; i < i < options.length; i++) {
			if (options[i].type == 'checkbox' && item.type == 'checkbox') options[i].checked = item.checked;
		}
	}
</script>

<div class="main">
	<h1>Manage Users</h1>
	<div class="left-col">
		<div class="form-group">
		<div class="form-control"><h2>Current User List</h2></div>
		<table class="table">
			<thead>
				<tr>
					<th class="id-field">ID</th>
					<th>Name</th>
					<th>Permissions</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user) : ?>
					<?php if ($user->id != PUBLIC_USER_ID) : ?>
					<tr>
						<td class="id-field"><?php echo $user->id; ?></td>
						<td><?php echo $user->name; ?></span></td>
						<td>
							<?php $permissions = $permissionManager->fetchUserPermissionData($user->permissions); ?>
							<?php foreach ($permissions as $permission) : ?>
								<?php echo $permission->name; ?>
								<?php if (next($permissions)) echo '|'; ?>
							<?php endforeach; ?>
						</td>
						<td>
							<a class="edit" href="edit_user.php?name=<?php echo $user->name; ?>">[edit]</a>
							<?php if ($_SESSION['user_id'] != $user->id) {
								echo '<a class="edit" href="delete_user.php?name='.$user->name.'"> [delete]</a>';
							} ?>
						</td>
					</tr>
					<?php endif; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
		</div>
	</div>
	<div class="right-col">
		<form role="form" method="post" action="add_user.php" class="form-group">
			<div class="form-control"><h2>Add New User</h2></div>
			<label class="form-control">Name</label>
			<input type="text" name="name" class="form-control">

			<label class="form-control">Password</label>
			<input type="password" name="password" class="form-control">

			<label class="form-control">User Permissions</label>
			<div class="double-column">
				<?php $allPermissions = $permissionManager->fetchAllPermissions(); ?>
				<?php foreach ($allPermissions as $permission) : ?>
					<?php if ($permission->name != "Login" && $permission->name != "Logout") : ?>
						<div class="form-control">
							<input type="checkbox" name="<?php echo $permission->id; ?>" <?php if ($permission->name == 'Administrator') echo "onChange='selectAll(this)'" ?>><?php echo $permission->name; ?>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>	
			<button type="submit" name="add_user">Add</button>
		</form>
	</div>
</div>
<?php include('../footer.php'); ?>
