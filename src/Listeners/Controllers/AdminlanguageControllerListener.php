<?php

declare(strict_types=1);

namespace VitesseCms\Language\Listeners\Controllers;

use Phalcon\Events\Event;
use VitesseCms\Admin\Forms\AdminlistFormInterface;
use VitesseCms\Language\Controllers\AdminlanguageController;

class AdminlanguageControllerListener
{
    public function adminListFilter(
        Event $event,
        AdminlanguageController $controller,
        AdminlistFormInterface $form
    ): void {
        $form->addText('%CORE_NAME%', 'filter[name]');
        $form->addPublishedField($form);
    }
}