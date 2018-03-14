<?php include('../init.php'); ?>

<?php $requiredPermission = 'Manage Users'; ?>
<?php include('check_user.php'); ?>

<?php include(BASE_PATH.'header.php'); ?>
<?php include(BASE_PATH.'navbar.php'); ?>

<?php if (isset($_GET['name'])) {
        $name = $_GET['name'];
}
else {
        $name = 'none';
}?>

<?php 
	$data = $userManager->fetchUserDataForName($name);
	$permissions = $permissionManager->fetchUserPermissionData($data->permissions);
?>
<?php function checkUserPermission($name, $permissionSet) {
	foreach ($permissionSet as $permission) {
		if ($permission->name == $name) return true;
	}
	return false;
}?>

<div class="main">
        <div class="right-col">
                <form role="form" method="post" action="update_user.php?id=<?php echo $data->id; ?>" class="form-group">
                        <div class="form-control"><h2>Edit User: <?php echo $name; ?></h2></div>

                        <?php if ($name != $user->name) : ?>
                                <a class="form-control" href="delete_user.php?name=<?php echo $name; ?>">Delete User</a>
                        <?php endif; ?>

                        <label class="form-control">User Permissions</label>
                        <div class="double-column">
                                <?php foreach ($allPermissions as $permission) : ?>
                                        <?php if ($permission->name != "Login" && $permission->name != "Logout") : ?>
                                                <div class="form-control">
                                                        <input
                                                                type="checkbox"
                                                                name="<?php echo $permission->id; ?>"
                                                                <?php if (checkUserPermission($permission->name, $permissions)) {
                                                                        echo "checked";
                                                                }?>
                                                                <?php if ($permission->name == 'Administrator') {
                                                                         echo "onChange='selectAll(this)'";
                                                                }?>
                                                        >
                                                        <?php echo $permission->name; ?>
                                                </div>
                                        <?php endif; ?>
                                <?php endforeach; ?>
                        </div>
                        <button type="submit" name="edit_user">Confirm</button>
                </form>
        </div>
</div>

<?php include(BASE_PATH.'footer.php'); ?>
