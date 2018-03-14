<?php include('../init.php'); ?>
<?php

if (isset($_SESSION['user_id'])) {
	unset($_SESSION['user_id']);
	redirect(BASE_URI, 'You have successfully logged out.');
}

redirect(BASE_URI);
?>
