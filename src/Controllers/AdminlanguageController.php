<?php

declare(strict_types=1);

namespace VitesseCms\Language\Controllers;

use ArrayIterator;
use stdClass;
use VitesseCms\Admin\Interfaces\AdminModelAddableInterface;
use VitesseCms\Admin\Interfaces\AdminModelDeletableInterface;
use VitesseCms\Admin\Interfaces\AdminModelEditableInterface;
use VitesseCms\Admin\Interfaces\AdminModelFormInterface;
use VitesseCms\Admin\Interfaces\AdminModelListInterface;
use VitesseCms\Admin\Interfaces\AdminModelPublishableInterface;
use VitesseCms\Admin\Traits\TraitAdminModelAddable;
use VitesseCms\Admin\Traits\TraitAdminModelDeletable;
use VitesseCms\Admin\Traits\TraitAdminModelEditable;
use VitesseCms\Admin\Traits\TraitAdminModelList;
use VitesseCms\Admin\Traits\TraitAdminModelPublishable;
use VitesseCms\Core\AbstractControllerAdmin;
use VitesseCms\Database\AbstractCollection;
use VitesseCms\Database\Models\FindValueIterator;
use VitesseCms\Language\Enums\LanguageEnum;
use VitesseCms\Language\Forms\LanguageForm;
use VitesseCms\Language\Models\Language;
use VitesseCms\Language\Repositories\LanguageRepository;

class AdminlanguageController extends AbstractControllerAdmin implements
    AdminModelListInterface,
    AdminModelDeletableInterface,
    AdminModelPublishableInterface,
    AdminModelEditableInterface,
    AdminModelAddableInterface
{
    use TraitAdminModelList;
    use TraitAdminModelDeletable;
    use TraitAdminModelPublishable;
    use TraitAdminModelEditable;
    use TraitAdminModelAddable;

    private LanguageRepository $languageRepository;

    public function onConstruct()
    {
        parent::onConstruct();

        $this->languageRepository = $this->eventsManager->fire(LanguageEnum::GET_REPOSITORY->value, new stdClass());
    }

    public function getModel(string $id): ?AbstractCollection
    {
        return match ($id) {
            'new' => new Language(),
            default => $this->languageRepository->getById($id, false)
        };
    }

    public function getModelForm(): AdminModelFormInterface
    {
        return new LanguageForm();
    }

    public function getModelList(?FindValueIterator $findValueIterator): ArrayIterator
    {
        return $this->languageRepository->findAll(
            $findValueIterator,
            false
        );
    }
}
