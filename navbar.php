<?php
$basicMenu = $pageManager->fetchBasicPages();
if ($hasAccount) {
        $adminMenu = array();
        foreach($userPermissions as $permission) {
                if ($permission->show_in_menu == 1) {
                        array_push($adminMenu, $permission);
                }
        }

        $unpublishedMenu = $pageManager->fetchUnpublishedPages($userID, $isAdmin);
}
?>

<div class="navbar">
	<ul class="form-control"><?php if ($hasAccount) echo 'Logged in as '.$user->name; ?></ul>
	<ul>
		<?php if (isset($basicMenu)) {
			foreach ($basicMenu as $menuItem) {
				echo '<li>'.formatMenuItem($menuItem, 'normal');

				$edit = hasPermission('Edit Pages', $userPermissions);
				$delete = hasPermission('Delete Pages', $userPermissions);
				if ($edit) {
					echo formatSpecialPermissionButton($edit, $menuItem->title);
				}
				if ($delete) {
					echo formatSpecialPermissionButton($delete, $menuItem->title);
				}
				echo '</li>';
			}
		} ?>
	</ul>

	<ul class="form-control"><?php if (isset($adminMenu)) echo 'User Menu'; ?></ul>
	<ul>
		<?php if (isset($adminMenu)) {
			foreach ($adminMenu as $menuItem) {
				echo '<li>'.formatMenuItem($menuItem, 'admin').'</li>';
			}
		} ?>
	</ul>

	<ul class="form-control"><?php if (isset($unpublishedMenu)) echo 'Unpublished Pages'; ?></ul>
	<ul>
		<?php if (isset($unpublishedMenu)) {
			foreach ($unpublishedMenu as $menuItem) {
                                echo '<li>'.formatMenuItem($menuItem, 'normal');

                                $edit = hasPermission('Edit Pages', $userPermissions);
                                $delete = hasPermission('Delete Pages', $userPermissions);
                                if ($edit) {
                                        echo formatSpecialPermissionButton($edit, $menuItem->title);
                                }
                                if ($delete) {
                                        echo formatSpecialPermissionButton($delete, $menuItem->title);
                                }
                                echo '</li>';
                        }
		} ?>
	</ul>
</div>
