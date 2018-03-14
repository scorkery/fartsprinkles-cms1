<?php include('../init.php'); ?>

<?php $requiredPermission = 'Edit Site Settings'; ?>
<?php include('check_user.php'); ?>

<?php include(BASE_PATH.'header.php'); ?>
<?php include(BASE_PATH.'navbar.php'); ?>

<div class="main">
	<form action="edit_settings.php" method="post">
		<h1>Site Settings</h1>
		<div class="form-control">
			<label>Site Title: </label>
			<input type="text" name="siteTitle" value="<?php echo $GLOBALS['siteTitle']; ?>">
		</div>
		<div class="form-control">
			<label>CSS File: </label>
			<select name="cssfile">
				<?php if ($availableCSS = scandir('../css/')) {
					foreach ($availableCSS as $file) {
						$first = substr($file, 0, 1);
						if ($first != '.') { 
							echo '<option ';
							if ($file == $GLOBALS['cssfile']) {
								echo 'selected ';
							}
							echo 'value='.$file.'>'.$file.'</option>';
						}
					}
				} ?>
			</select>
		</div>
		<hr>
		<div class="form-control">
			<label><h2>Title Bar Format</h2></label>
		</div>
		<div class="form-control">
			<label>Text Display: </label>
			<select name="titlestring" onchange="checkStuff(this)">
				<option value="" <?php if (checkTitle('')) echo ' selected '; ?>>None</option>
				<option value="heading" <?php if (checkTitle('heading'))  echo ' selected '; ?>>Page Heading</option>
				<option value="title" <?php if (checkTitle('title')) echo ' selected '; ?>>Site Title</option>
				<option value="custom" <?php if (checkTitle('custom')) echo ' selected '; ?>>Custom Text</option>
			</select>
			<input type="text" id="ifCustom" style="display:none" name="customText">
			<script>
				function checkStuff(thing) {
					if (thing.value == "custom") {
						document.getElementById("ifCustom").style.display = "block";
					}
					else {
						document.getElementById("ifCustom").style.display = "none";
					}
				}
			</script>	
		</div>
		<div class="form-control">
			<?php include(BASE_PATH.'titlebar.php'); ?>
		</div>
		<div class="form-control">
			<button name="update" type="submit">Update</button>
		</div>
	</form>
</div>
