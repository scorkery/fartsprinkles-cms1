<?php
if (!isset($requiredPermission) || !hasPermission($requiredPermission, $userPermissions)) {
	header('Location: index.php');
}
?>
