<?php
session_start();
include('config/config.php');

// fetch data from GET and SESSION
if (isset($_GET['page'])) $pageName = $_GET['page'];
else $pageName = DEFAULT_PAGE;

if (isset($_SESSION['user_id'])) {
	$userID = $_SESSION['user_id'];
}
else $userID = PUBLIC_USER_ID;

// create manager objects
$connectionManager = new ConnectionManager();
$pageManager = new PageManager($connectionManager);
$userManager = new UserManager($connectionManager);
$permissionManager = new PermissionManager($connectionManager);

$user = $userManager->fetchUserData($userID);
$userPermissions = $permissionManager->fetchUserPermissionData($user->permissions);
$allPermissions = $permissionManager->fetchAllPermissions();
$page = $pageManager->fetchPageByTitle($pageName);

$hasAccount = ($userID != PUBLIC_USER_ID);
$isAdmin = hasPermission('Administrator', $userPermissions);

?>
