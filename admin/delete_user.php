<?php include('../init.php'); ?>;

<?php $requiredPermission = 'Manage Users'; ?>
<?php include('check_user.php'); ?>

<?php if (isset($_GET['name'])) {
        $userManager->deleteUser($_GET['name']);
} ?>
<?php redirect('users.php', 'User Deleted.'); ?>
