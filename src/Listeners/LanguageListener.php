<?php declare(strict_types=1);

namespace VitesseCms\Language\Listeners;

use VitesseCms\Language\Repositories\LanguageRepository;

class LanguageListener
{
    public function __construct(private readonly LanguageRepository $languageRepository)
    {
    }

    public function getRepository(): LanguageRepository
    {
        return $this->languageRepository;
    }
}