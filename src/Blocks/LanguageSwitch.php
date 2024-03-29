<?php

declare(strict_types=1);

namespace VitesseCms\Language\Blocks;

use stdClass;
use VitesseCms\Block\AbstractBlockModel;
use VitesseCms\Block\Models\Block;
use VitesseCms\Language\Enums\LanguageEnum;
use VitesseCms\Language\Models\Language;
use VitesseCms\Language\Repositories\LanguageRepository;

class LanguageSwitch extends AbstractBlockModel
{
    private LanguageRepository $languageRepository;

    public function initialize()
    {
        parent::initialize();

        $this->excludeFromCache = true;
        $this->languageRepository = $this->getDi()->get('eventsManager')->fire(
            LanguageEnum::GET_REPOSITORY->value,
            new stdClass()
        );
    }

    public function parse(Block $block): void
    {
        parent::parse($block);
        $languages = $this->languageRepository->findAll();

        if ($this->view->hasCurrentItem()) :
            $currentItem = $this->view->getCurrentItem();
            /** @var Language $language */
            foreach ($languages as $key => $language):
                $language->set('slug', $currentItem->_('slug', $language->_('short')));
                $language->set('showDelimiter', true);
                if ($language->_('slug') === '/') :
                    $language->set('slug', null);
                    $language->set('showDelimiter', false);
                elseif (substr_count($language->_('domain'), '/' . $language->getShortCode() . '/')) :
                    $language->set('showDelimiter', false);
                endif;
            endforeach;
        endif;

        $this->view->set('hrefLanguages', $languages);
        $block->set('languages', $languages);
    }
}
