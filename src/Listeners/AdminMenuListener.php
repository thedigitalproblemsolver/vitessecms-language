<?php declare(strict_types=1);

namespace VitesseCms\Language\Listeners;

use VitesseCms\Admin\Models\AdminMenu;
use VitesseCms\Admin\Models\AdminMenuNavBarChildren;
use VitesseCms\Datagroup\Models\Datagroup;
use Phalcon\Events\Event;

class AdminMenuListener
{
    public function AddChildren(Event $event, AdminMenu $adminMenu): void
    {
        if ($adminMenu->getUser()->getPermissionRole() === 'superadmin') :
            $children = new AdminMenuNavBarChildren();
            $children->addChild('Languages', 'admin/language/adminlanguage/adminList');
            $adminMenu->addDropdown('System', $children);
        endif;
    }
}