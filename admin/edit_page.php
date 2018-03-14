<?php include('../init.php'); ?>

<?php $requiredPermission = 'Edit Pages'; ?>
<?php include('check_user.php'); ?>

<?php if (isset($_GET['page'])) {
	$page = $pageManager->fetchPageByTitle($_GET['page']);
	$pageTitle = $page->title;
        $pageHeading = $page->heading;
        $pageBody = $page->body;
        $pagePublished = $page->published;
	$pageID = $page->id;
} else {
	$pageTitle = '';
        $pageBody = '';
        $pageHeading = '';
        $pageUserLevel = '0';
        $pagePublished = '0';
} ?>

<?php if (isset($_POST['update_page'])) {
	$pageData = $_POST;
	if (isset($_POST['published'])) $pageData['published'] = 1;
	else $pageData['published'] = 0;
	$pageData['owner'] = $userID;
	$pageData['id'] = $pageID;
	if ($pageManager->editPage($pageData)) {
		redirect(BASE_URI.'load.php?page='.$pageData['title'], 'Page successfully edited.');
	}
	redirect(edit_page.php, 'Error editing page.');
} ?>

<?php include(BASE_PATH.'header.php'); ?>
<?php include(BASE_PATH.'navbar.php'); ?> 

<div class="main">
        <h1>Edit Page</h1>
        
        <form class="form-group" method="post" enctype="multipart/form-data" action="upload_resource.php">
                <label class="form-control">Upload Resources</label>
                <p class="tiny"><?php printAllowedFileTypes(); ?></p>
                <p class="tiny"><b>Resources Path: </b><?php echo BASE_URI.'res/'; ?></p>
                <input class="form-control" type="file" name="uploadFile">
                <input type="submit" class="form-control" value="Upload" name="submit">
        </form>

	<br>
        <form role="form" method="post" action="edit_page.php?page=<?php echo $pageTitle ?>">
                <label class="form-control">Page Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo $pageTitle; ?>">

                <label class="form-control">Page Heading</label>
                <input type="text" class="form-control" name="heading" value="<?php echo $pageHeading; ?>">

                <label class="form-control">Page Body</label>
                <textarea name="body" cols="100" rows="30" class="form-control"><?php echo $pageBody; ?></textarea>

                <div class="form-control">
                        <input type="checkbox" name="published" <?php if ($pagePublished == '1') echo 'checked' ?>> Published
                </div>

                <button type="submit" class="form-control" name="update_page">Confirm Edit</button>
        </form>
</div>

<?php include(BASE_PATH.'footer.php'); ?>
