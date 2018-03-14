<?php include('../config/config.php'); ?>
<?php
session_unset();
$sql = "DROP TABLE ".DB_NAME.".users, ".DB_NAME.".permissions, ".DB_NAME.".pages";
$con = new ConnectionManager();
$success = $con->executeNonReturningQuery($sql);
if ($success) echo "Database successfully cleared.";
else echo "You dun goofed.";
?>
