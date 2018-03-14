<?php

// new sql
define("FETCH_BASIC_PAGES", "SELECT title FROM pages WHERE published = 1");
define("FETCH_ALL_UNPUBLISHED_PAGES", "SELECT title FROM pages WHERE published = 0");
define("FETCH_UNPUBLISHED_PAGES_FOR_USER", "SELECT title FROM pages WHERE published = 0 AND owner = :id");
define("FETCH_PERMISSIONS", "SELECT * FROM permissions");
define("FETCH_PAGE", "SELECT * FROM pages WHERE title = :title");
define("FETCH_USER_DATA", "SELECT * FROM users WHERE id = :id");
define("FETCH_ALL_USERS", "SELECT * FROM users");

define("INSERT_USER", "INSERT INTO users (name, password, permissions) VALUES (:name, :password, :permissions)");
define("UPDATE_USER_PERMISSIONS", "UPDATE users SET permissions = :permissions WHERE id = :id");
define("UPDATE_USER_PASSWORD", "UPDATE users SET password = :password WHERE id = :id");
define("UPDATE_UNIQUE_ID", "UPDATE users SET unique_id = :unique_id WHERE id = :id");
define("USER_LOGIN", "SELECT * FROM users WHERE name = :name");
define("DELETE_USER", "DELETE FROM users WHERE name = :name");

define ("INSERT_PAGE", "INSERT INTO pages (title, heading, body, published, owner) VALUES (:title, :heading, :body, :published, :owner)");
define("DELETE_PAGE", "DELETE FROM pages WHERE title = :title");
define("EDIT_PAGE", "UPDATE pages SET title = :title, heading = :heading, body = :body, published = :published, owner = :owner WHERE id = :id");
?>
