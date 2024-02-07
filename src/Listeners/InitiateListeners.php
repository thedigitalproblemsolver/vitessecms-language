<?php

declare(strict_types=1);

namespace VitesseCms\Language\Listeners;

use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Language\Enums\LanguageEnum;
use VitesseCms\Language\Listeners\Admin\AdminMenuListener;
use VitesseCms\Language\Models\Language;
use VitesseCms\Language\Repositories\LanguageRepository;

class InitiateListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $injectable): void
    {
        if ($injectable->user->hasAdminAccess()) :
            $injectable->eventsManager->attach('adminMenu', new AdminMenuListener());
        endif;
        $injectable->eventsManager->attach(
            LanguageEnum::SERVICE_LISTENER->value,
            new LanguageListener(
                new LanguageRepository(Language::class),
                $injectable->language
            )
        );
    }
}
