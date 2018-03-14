<?php include('../init.php'); ?>
<?php $requiredPermission = 'Add Pages'; ?>
<?php include('check_user.php'); ?>
<?php if (isset($_POST['add_page'])) {
	if (isset($_POST['published'])) {
		$_POST['published'] = 1;
	}
	else {
		$_POST['published'] = 0;
	}
	
	$_POST['owner'] = $userID;

	if ($pageManager->insertPage($_POST)) redirect(BASE_URI, 'Page successfully added.');
	else redirect(add_page.php, 'Error uploading page data.');
} ?>

<?php include(BASE_PATH.'header.php'); ?>
<?php include(BASE_PATH.'navbar.php'); ?>


<div class="main">
	<h1>Add Page</h1>
	
	<form class="form-group" method="post" enctype="multipart/form-data" action="upload_resource.php">
	        <label class="form-control">Upload Resources</label>
	        <p class="tiny"><?php printAllowedFileTypes(); ?></p>
	        <p class="tiny"><b>Resources Path: </b><?php echo BASE_URI.'res/'; ?></p>
	        <input class="form-control" type="file" name="uploadFile">
	        <input type="submit" class="form-control" value="Upload" name="submit">
	</form>

	<br>
	<form role="form" method="post" action="add_page.php">
		<label class="form-control">Page Title</label>
		<input type="text" class="form-control" name="title">

		<label class="form-control">Page Heading</label>
                <input type="text" class="form-control" name="heading">

		<label class="form-control">Page Body</label>
		<textarea name="body" cols="100" rows="30" class="form-control"></textarea>

		<div class="form-control"><input type="checkbox" name="published"> Published</div>

		<button type="submit" class="form-control" name="add_page">Add Page</button>
	</form>
</div>

<?php include(BASE_PATH.'footer.php'); ?>
