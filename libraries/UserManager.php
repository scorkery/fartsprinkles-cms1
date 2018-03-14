<?php

class UserManager {

	private $connectionManager;

	public function __construct($con) {
		$this->connectionManager = $con;
	}

	// fetches all users from the database
	public function getAllUsers() {
		return $this->connectionManager->getMultipleRows(FETCH_ALL_USERS);
	}

	// creates a new user in the database
	public function addUser($name, $password, $permissions) {
		$permissionsString = $this->createPermissionsString($permissions);
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$bindings = array(
			['var' => ':name', 'value' => $name],
			['var' => ':password', 'value' => $hash],
			['var' => ':permissions', 'value' => $permissionsString]
		);
		return $this->connectionManager->executeNonReturningQuery(INSERT_USER, $bindings);
	}

	// updates a user's information
	public function updateUserPermissions($permissions, $userID) {
		$permissionsString = $this->createPermissionsString($permissions);
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$bindings = array(
			['var' => ':permissions', 'value' => $permissionsString],
			['var' => ':id', 'value' => $userID]
		);
		return $this->connectionManager->executeNonReturningQuery(UPDATE_USER_PERMISSIONS, $bindings);
	}

	// deletes a user from the database
	public function deleteUser($name) {
		$bindings = array(['var' => ':name', 'value' => $name]);
		return $this->connectionManager->executeNonReturningQuery(DELETE_USER, $bindings);
	}

	// returns data object for user
        public function fetchUserData($id) {
                $bindings = array(['var' => ':id', 'value' => $id]);
                return $this->connectionManager->getSingleRow(FETCH_USER_DATA, $bindings);
        }
	
	// returns data object for user
	public function fetchUserDataForName($name) {
		$bindings = array(['var' => ':name', 'value' => $name]);
		return $this->connectionManager->getSingleRow('SELECT * FROM users WHERE name = :name', $bindings);
	}

	// checks supplied login and password against database, returns id if correct combination found
	public function userLogin($data) {
                $bindings = array(['var' => ':name', 'value' => $data['username']]);
                $usr = $this->connectionManager->getSingleRow(USER_LOGIN, $bindings);
                $pass = $data['password'];
                if (password_verify($pass, $usr->password)) {
                        if (password_needs_rehash($usr->password, PASSWORD_DEFAULT)) {
                                $newHash = password_hash($pass, PASSWORD_DEFAULT);
                                $this->updatePassword($usr->id, $newHash);
                        }
                        return $usr->id;
                }
                return false;
        }

	// updates password in the database
	public function updatePassword($userID, $newPass) {
                $bindings = array(['var' => ':password', 'value' => $newPass], ['var' => ':id', 'value' => $userID]);
                return $this->connectionManager->executeNonReturningQuery(UPDATE_USER_PASSWORD, $bindings);
        }

	// returns a string composed of permission ids
	private function createPermissionsString($permissions) {
		$permissionsString = "";
		foreach ($permissions as $permission) {
			$permissionsString = $permissionsString.$permission;
			if (next($permissions)) $permissionsString = $permissionsString.', ';
		}
		return $permissionsString;
	}
	
}

?>
