<?php declare(strict_types=1);

namespace VitesseCms\Language\Listeners;

use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Language\Enums\LanguageEnum;
use VitesseCms\Language\Listeners\Admin\AdminMenuListener;
use VitesseCms\Language\Repositories\LanguageRepository;

class InitiateListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $di): void
    {
        if ($di->user->hasAdminAccess()) :
            $di->eventsManager->attach('adminMenu', new AdminMenuListener());
        endif;
        $di->eventsManager->attach(LanguageEnum::SERVICE_LISTENER->value, new LanguageListener(
            new LanguageRepository(),
            $di->language
        ));
    }
}
