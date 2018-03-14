<?php include('../init.php'); ?>

<?php $requiredPermission = 'Delete Pages'; ?>
<?php include('check_user.php'); ?>

<?php if (isset($_GET['page'])) {
	$pageToDelete = $pageManager->fetchPageByTitle($_GET['page']);
	if ($isAdmin || ($userID == $pageToDelete->owner)) {
		if ($pageManager->deletePage($_GET['page'])) {
			$message = 'Page deleted.';
		}
		else {
			$message = 'There was an error deleting the page.';
		}
	}
	else {
		$message = 'You do not have permission to delete this page.';
	}
} 
else $message = ''; ?>

<?php redirect(BASE_URI, $message); ?>
