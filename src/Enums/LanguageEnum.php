<?php declare(strict_types=1);

namespace VitesseCms\Language\Enums;

enum LanguageEnum: string
{
    case SERVICE_LISTENER = 'LanguageListener';
    case ATTACH_SERVICE_LISTENER = 'LanguageListener:attach';
    case GET_REPOSITORY = 'LanguageListener:getRepository';
}