<?php

class PageManager {

	private $connectionManager;

	public function __construct($con) {
		$this->connectionManager = $con;
	}

	// returns set of all published pages
	public function fetchBasicPages() {
		return $this->connectionManager->getMultipleRows(FETCH_BASIC_PAGES);
	}

	// returns set of unpublished pages owned by the user, or all unpublished pages if user has the Administrator permission
        public function fetchUnpublishedPages($userID, $isAdmin = NULL) {
                if ($isAdmin != NULL && $isAdmin->name == 'Administrator') {
                        return $this->connectionManager->getMultipleRows(FETCH_ALL_UNPUBLISHED_PAGES);
                }
                $bindings = array(['var' => ':id', 'value' => $userID]);
		return $this->connectionManager->getMultipleRows(FETCH_UNPUBLISHED_PAGES_FOR_USER, $bindings);
        }

	// returns a specific page
        public function fetchPageByTitle($title) {
                $bindings = array(['var' => ':title', 'value' => $title]);
                return $this->connectionManager->getSingleRow(FETCH_PAGE, $bindings);
        }

	// inserts a new page into the database
	public function insertPage($data) {
                $bindings = array(
                        ['var' => ':title', 'value' => $data['title']],
                        ['var' => ':heading', 'value' => $data['heading']],
                        ['var' => ':body', 'value' => $data['body']],
                        ['var' => ':published', 'value' => $data['published']],
                        ['var' => ':owner', 'value' => $data['owner']]
                );
                return $this->connectionManager->executeNonReturningQuery(INSERT_PAGE, $bindings);
        }

	// deletes a page from the database
	public function deletePage($title) {
                $bindings = array(['var' => ':title', 'value' => $title]);
                return $this->connectionManager->executeNonReturningQuery(DELETE_PAGE, $bindings);
        }

	// edits a page entry in the database
	public function editPage($pageData) {
                $bindings = array(
                        ['var' => ':title', 'value' => $pageData['title']],
                        ['var' => ':heading', 'value' => $pageData['heading']],
                        ['var' => ':body', 'value' => $pageData['body']],
                        ['var' => ':published', 'value' => $pageData['published']],
                        ['var' => ':owner', 'value' => $pageData['owner']],
                        ['var' => ':id', 'value' => $pageData['id']]
                );
                return $this->connectionManager->executeNonReturningQuery(EDIT_PAGE, $bindings);
        }

	
}

?>
