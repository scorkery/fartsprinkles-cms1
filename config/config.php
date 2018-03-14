<?php
/*
** Config file.  Edit definitions to fit your server.
*/

// Database 
define("DB_HOST", "");  // database host
define("DB_USER", "");  // username
define("DB_PASS", "");  // password
define("DB_NAME", "");  // name of database

// Site URI and Paths/Filenames
define("BASE_URI", "http://".$_SERVER['SERVER_NAME']);
define("BASE_PATH", "");   // path to the base directory on the local server where the code is stored
define("ADMIN_PATH", BASE_PATH."admin/");
define("ADMIN_URI", BASE_URI."admin/");
define("CONFIG_PATH", BASE_PATH."config/");
define("LIBRARY_PATH", BASE_PATH."libraries/");
define("HELPER_PATH", BASE_PATH."helpers/");
define("CSS_PATH", BASE_URI."css/");
define("EXTENSIONS_FILE", dirname(__FILE__)."/extensions.txt");

// Site Variables - edit to fit your site configuration
define("PUBLIC_USER_ID", 1); // corresponds to a user in the database with no privileges, by default this is 1
define("PAGE_DIRECTOR", "load.php?page=");
define("DEFAULT_PAGE", "home");
define("FILE_SIZE_LIMIT", 10000000);

// Load Required Files
require_once(CONFIG_PATH.'sql.php');
require_once(CONFIG_PATH.'globals.php');
require_once(HELPER_PATH.'system_helper.php');
require_once(HELPER_PATH.'upload_helper.php');
require_once(HELPER_PATH.'format_helper.php');

// Auto Load Classes
function __autoload($className) {
	require_once(LIBRARY_PATH.$className.'.php');
}
?>
