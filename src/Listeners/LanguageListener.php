<?php declare(strict_types=1);

namespace VitesseCms\Language\Listeners;

use VitesseCms\Language\Repositories\LanguageRepository;
use VitesseCms\Language\Services\LanguageService;

class LanguageListener
{
    public function __construct(
        private readonly LanguageRepository $languageRepository,
        private readonly LanguageService    $languageService
    )
    {
    }

    public function getRepository(): LanguageRepository
    {
        return $this->languageRepository;
    }

    public function attach(): LanguageService
    {
        return $this->languageService;
    }
}