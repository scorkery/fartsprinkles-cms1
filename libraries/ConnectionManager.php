<?php 

class ConnectionManager {
	
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function getMultipleRows($query, $bindings = NULL) {
		$this->formatQuery($query, $bindings);
		return $this->db->resultSet();
	}

	public function getSingleRow($query, $bindings = NULL) {
		$this->formatQuery($query, $bindings);
		return $this->db->single();
	}

	public function executeNonReturningQuery($query, $bindings = NULL) {
		$this->formatQuery($query, $bindings);
		return $this->db->execute();
	}

	public function dumpParams() {
		return $this->db->dumpParams();
	}

	private function formatQuery($query, $bindings) {
		$this->db->query($query);
		if ($bindings != NULL) {
                	foreach($bindings as $binding) {
                        	$var = $binding['var'];
                        	$value = $binding['value'];
                        	$this->db->bind($var, $value);
                	}
		}
	}
}

?>
