<?php declare(strict_types=1);

namespace VitesseCms\Language\Listeners;

use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Language\Controllers\AdminlanguageController;
use VitesseCms\Language\Listeners\Admin\AdminMenuListener;
use VitesseCms\Language\Listeners\Controllers\AdminlanguageControllerListener;

class InitiateAdminListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $di): void
    {
        $di->eventsManager->attach('adminMenu', new AdminMenuListener());
        $di->eventsManager->attach(AdminlanguageController::class, new AdminlanguageControllerListener());
    }
}
