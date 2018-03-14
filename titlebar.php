<div class="titlebar">
	<h1>
		<?php if ($GLOBALS['titlestring'] == 'heading') {
			if (isset($page)) {
				echo $page->heading;
			}
			else {
				echo 'Something has gone terribly wrong.';
			}
		}
		else if ($GLOBALS['titlestring'] == 'title') {
			echo $GLOBALS['siteTitle'];
		}
		else {
			echo $GLOBALS['titlestring']; 
		} ?>
	</h1>
</div>
