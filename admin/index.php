<?php include('../init.php'); ?>
<?php if (!$hasAccount) {
	redirect('login.php'); 
} 
else {
	redirect(BASE_URI);
} ?>
