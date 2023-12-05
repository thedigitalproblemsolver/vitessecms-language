<?php

declare(strict_types=1);

namespace VitesseCms\Language\Forms;

use VitesseCms\Admin\Interfaces\AdminModelFormInterface;
use VitesseCms\Form\AbstractForm;
use VitesseCms\Form\Models\Attributes;

class LanguageForm extends AbstractForm implements AdminModelFormInterface
{
    public function buildForm(): void
    {
        $this->addText('%CORE_NAME%', 'name', (new Attributes())->setRequired())
            ->addText('%ADMIN_LANGUAGE_LOCAL_NAME%', 'nativeName', (new Attributes())->setRequired())
            ->addText('%ADMIN_LANGUAGE_ISO_FOUR_CODE%', 'locale', (new Attributes())->setRequired())
            ->addText('%ADMIN_LANGUAGE_ISO_TWO_CODE%', 'short', (new Attributes())->setRequired())
            ->addText('%ADMIN_LANGUAGE_DOMAIN%', 'domain', (new Attributes())->setRequired())
            ->addText('%ADMIN_LANGUAGE_FLAGICON_CSSCLASS%', 'flagClass', (new Attributes())->setRequired())
            ->addSubmitButton('%CORE_SAVE%');
    }
}
