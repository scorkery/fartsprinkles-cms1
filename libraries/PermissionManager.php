<?php

class PermissionManager {

	private $connectionManager;

	public function __construct($con) {
		$this->connectionManager = $con;
	}

	// returns all permissions for the site
	public function fetchAllPermissions() {
		return $this->connectionManager->getMultipleRows(FETCH_PERMISSIONS);
	}

	// returns user's permissions
        public function fetchUserPermissionData($userPermissionString) {
                if ($userPermissionString == "" || $userPermissionString == NULL) return;
                $permissionsArray = explode(',', $userPermissionString);
                $queryString = FETCH_PERMISSIONS;
                
                $queryString = $queryString.' WHERE ';
                foreach ($permissionsArray as $permission) {
                        $queryString = $queryString.'id = '.$permission;
                        if (next($permissionsArray)) $queryString = $queryString.' OR ';
                }
                return $this->connectionManager->getMultipleRows($queryString);
        }
}

?>
