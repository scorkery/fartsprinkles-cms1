<?php include('../config/config.php'); ?>

<?php
$heading = 'shit nigger';
$body = '<p>holy shit nigger u gay as fuk</p>';
$adminLog = 'admin';
$adminPass = 'fishsticks';
$adminHash = password_hash($adminPass, PASSWORD_DEFAULT);
$sql = array();
$con = new ConnectionManager();

// create tables
array_push($sql, ['stmt' => "CREATE TABLE ".DB_NAME.".users (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        permissions TEXT NULL,
        PRIMARY KEY (id)
);", 'bindings' => NULL, 'msg' => 'Create users table']);

array_push($sql, ['stmt' => "CREATE TABLE ".DB_NAME.".pages (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        heading TEXT NULL,
        body TEXT NULL,
        owner TINYINT NOT NULL,
        published TINYINT NOT NULL,
        PRIMARY KEY (id)
);", 'bindings' => NULL, 'msg' => 'Create pages table']);

array_push($sql, ['stmt' => "CREATE TABLE ".DB_NAME.".permissions (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        filename VARCHAR(255) NULL,
        menu_name VARCHAR(255) NULL,
        show_in_menu TINYINT NOT NULL,
        PRIMARY KEY (id)
);", 'bindings' => NULL, 'msg' => 'Create permissions table']);


// insert home page
array_push($sql, ['stmt' => "INSERT INTO pages (title, heading, body, published, owner) VALUES ('home', :heading, :body, 1, 2);", 'bindings' => array(['var' => ':heading', 'value' => $heading], ['var' => ':body', 'value' => $body]), 'msg' => 'Insert home page']);

// insert public and admin users
array_push($sql, ['stmt' => "INSERT INTO users (name, password, permissions) VALUES ('public', '', '');", 'bindings' => NULL, 'msg' => 'Insert public user']);
array_push($sql, ['stmt' => "INSERT INTO users (name, password, permissions) VALUES (:login, :password, '1,2,3,4,5,6,7,8,9,10');", 'bindings' => array(['var' => ':login', 'value' => $adminLog], ['var' => ':password', 'value' => $adminHash]), 'msg' => 'Insert admin user']);

// insert privileges
array_push($sql, ['stmt' => "INSERT INTO permissions (name, filename, menu_name, show_in_menu) VALUES ('Login', 'login.php', 'Login', 0);", 'bindings' => NULL, 'msg' => 'Insert login permission']);
array_push($sql, ['stmt' => "INSERT INTO permissions (name, filename, menu_name, show_in_menu) VALUES ('Logout', 'logout.php', 'Logout', 1);", 'bindings' => NULL, 'msg' => 'Insert logout permission']);
array_push($sql, ['stmt' => "INSERT INTO permissions (name, filename, menu_name, show_in_menu) VALUES ('Edit Profile', 'user_profile.php', 'Edit Profile', 1);", 'bindings' => NULL, 'msg' => 'Insert Edit Profile permission']);
array_push($sql, ['stmt' => "INSERT INTO permissions (name, filename, menu_name, show_in_menu) VALUES ('Administrator', '', '', 0);", 'bindings' => NULL, 'msg' => 'Insert Admin permission']);
array_push($sql, ['stmt' => "INSERT INTO permissions (name, filename, menu_name, show_in_menu) VALUES ('Edit Pages', 'edit_page.php', 'edit', 0);", 'bindings' => NULL, 'msg' => 'Insert Edit Page permission']);
array_push($sql, ['stmt' => "INSERT INTO permissions (name, filename, menu_name, show_in_menu) VALUES ('Add Pages', 'add_page.php', 'Add Page', 1);", 'bindings' => NULL, 'msg' => 'Insert Add Page permission']);
array_push($sql, ['stmt' => "INSERT INTO permissions (name, filename, menu_name, show_in_menu) VALUES ('Delete Pages', 'delete_page.php', 'delete', 0);", 'bindings' => NULL, 'msg' => 'Insert Delete Page permission']);
array_push($sql, ['stmt' => "INSERT INTO permissions (name, filename, menu_name, show_in_menu) VALUES ('Edit Site Settings', 'settings.php', 'Settings', 1);", 'bindings' => NULL, 'msg' => 'Insert Edit Settings permission']);
array_push($sql, ['stmt' => "INSERT INTO permissions (name, filename, menu_name, show_in_menu) VALUES ('Manage Users', 'users.php', 'Manage Users', 1);", 'bindings' => NULL, 'msg' => 'Insert Manage Users permission']);
array_push($sql, ['stmt' => "INSERT INTO permissions (name, filename, menu_name, show_in_menu) VALUES ('Upload Resources', 'upload_resources.php', 'upload', 0);", 'bindings' => NULL, 'msg' => 'Insert upload resources permission']);

foreach ($sql as $query) {
	if ($con->executeNonReturningQuery($query['stmt'], $query['bindings'])) echo "Success - ".$query['msg']."<br>";
	else echo "Error - ".$query['msg']."<br>";
}

?>
