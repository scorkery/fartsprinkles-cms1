<?php
function formatLink($text, $link) {
        return '<a href="'.$link.'">'.$text.'</a>';
}

function formatSpecialPermissionButton($permission, $pageName) {
        return ' <a class="edit" href="'.ADMIN_URI.$permission->filename.'?page='.$pageName.'">['.$permission->menu_name.']</a>';
}

function formatMenuItem($menuItem, $type) {
        if ($type == 'normal') {
                return formatLink($menuItem->title, BASE_URI.PAGE_DIRECTOR.$menuItem->title);
        }
        else if ($type == 'admin') {
                return formatLink($menuItem->menu_name, ADMIN_URI.$menuItem->filename);
        }
}

function formatMenu($menu, $type) {
        foreach ($menu as $menuItem) {
                // echo menu item formatted as a link
                echo '<li>'.formatMenuItem($menuItem, $type);

                // if user has edit and delete options for pages, add buttons
                // only applies to normal page lists, not admin menu
                if ($type == 'normal') {
                        $edit = $manager->checkUserPermission('Edit Pages');
                        $delete = $manager->checkUserPermission('Delete Pages');
                        if ($edit) echo formatSpecialPermissionButton($edit, $menuItem->title);
                        if ($delete) echo formatSpecialPermissionButton($delete, $menuItem->title);
                }

                echo '</li>';
        }
}
?>
