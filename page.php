<div class="main">
	<?php 
		if (isset($page)) {
			echo $page->body;
		}
		else {
			echo 'Something has gone terribly wrong.';
		}
	?>
</div>
