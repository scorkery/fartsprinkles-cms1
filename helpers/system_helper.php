<?php

// Redirect to page
function redirect($page = FALSE, $message = NULL) {
	if (is_string($page)) {
		$location = $page;
	}
	else {
		$location = $_SERVER['SCRIPT_NAME'];
	}

	if ($message != NULL) {
		$_SESSION['message'] = $message;
	}

	header('Location: '.$location);
	exit;
}

function displayMessage() {
	if (!empty($_SESSION['message'])) {
		$message = $_SESSION['message'];
		
		echo $message;
		unset($_SESSION['message']);
	}
	else {
		echo '';	
	}
}

function checkTitle($title) {
        if ($GLOBALS['titlestring'] == '') {
                if ($title == '') return true;
                return false;
        }
        else if ($GLOBALS['titlestring'] == 'heading') {
                if ($title == 'heading') return true;
                return false;
        }
        else if ($GLOBALS['titlestring'] == 'title') {
                if ($title == 'title') return true;
                return false;
        }
        else {
                if ($title == 'custom') return true;
                return false;
        }
}


function isLoggedIn() {
	if (isset($_SESSION['user_id'])) {
		return true;
	}
	return false;
}

function getUser() {
	$userArray = array();
	$userArray['user_id'] = $_SESSION['user_id'];
	$userArray['username'] = $_SESSION['username'];
	$userArray['name'] = $_SESSION['name'];
	return $userArray;
}

function hasPermission($which, $permissionSet = NULL) {
	if ($permissionSet == NULL) return false;
	foreach ($permissionSet as $permission) {
		if ($permission->name == $which) return $permission;
	}
	return false;
}

?>
