<?php declare(strict_types=1);

namespace VitesseCms\Language\Listeners;

use Phalcon\Events\Manager;
use VitesseCms\Language\Controllers\AdminlanguageController;

class InitiateAdminListeners
{
    public static function setListeners(Manager $eventsManager): void
    {
        $eventsManager->attach('adminMenu', new AdminMenuListener());
        $eventsManager->attach(AdminlanguageController::class, new AdminlanguageControllerListener());
    }
}
