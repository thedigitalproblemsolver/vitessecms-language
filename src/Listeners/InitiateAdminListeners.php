<?php

declare(strict_types=1);

namespace VitesseCms\Language\Listeners;

use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Language\Controllers\AdminlanguageController;
use VitesseCms\Language\Enums\LanguageEnum;
use VitesseCms\Language\Listeners\Admin\AdminMenuListener;
use VitesseCms\Language\Listeners\Controllers\AdminlanguageControllerListener;
use VitesseCms\Language\Models\Language;
use VitesseCms\Language\Repositories\LanguageRepository;

class InitiateAdminListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $injectable): void
    {
        $injectable->eventsManager->attach('adminMenu', new AdminMenuListener());
        $injectable->eventsManager->attach(AdminlanguageController::class, new AdminlanguageControllerListener());
        $injectable->eventsManager->attach(
            LanguageEnum::SERVICE_LISTENER->value,
            new LanguageListener(
                new LanguageRepository(Language::class),
                $injectable->language
            )
        );
    }
}
