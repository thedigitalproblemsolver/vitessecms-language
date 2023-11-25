<?php

declare(strict_types=1);

namespace VitesseCms\Language\Repositories;

use VitesseCms\Database\Models\FindOrderIterator;
use VitesseCms\Database\Models\FindValueIterator;
use VitesseCms\Database\Traits\TraitRepositoryConstructor;
use VitesseCms\Database\Traits\TraitRepositoryParseFindAll;
use VitesseCms\Database\Traits\TraitRepositoryParseGetById;
use VitesseCms\Language\Models\Language;
use VitesseCms\Language\Models\LanguageIterator;

class LanguageRepository
{
    use TraitRepositoryParseGetById;
    use TraitRepositoryParseFindAll;
    use TraitRepositoryConstructor;

    public function findAll(
        ?FindValueIterator $findValues = null,
        bool $hideUnpublished = true,
        ?int $limit = null,
        ?FindOrderIterator $findOrders = null,
    ): LanguageIterator {
        return $this->parseFindAll($findValues, $hideUnpublished, $limit, $findOrders);
    }

    public function getById(string $id, bool $hideUnpublished = true): ?Language
    {
        return $this->parseGetById($id, $hideUnpublished);
    }
}
