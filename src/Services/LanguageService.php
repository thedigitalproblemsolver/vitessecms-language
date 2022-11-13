<?php declare(strict_types=1);

namespace VitesseCms\Language\Services;

use Phalcon\Config\Adapter\Ini;
use VitesseCms\Admin\Utils\AdminUtil;
use VitesseCms\Configuration\Services\ConfigService;

class LanguageService
{
    /**
     * @var Ini[]
     */
    protected $translations;

    /**
     * @var ConfigService
     */
    protected $configuration;

    public function __construct(ConfigService $configService)
    {
        $this->translations = [];
        $this->configuration = $configService;
    }

    public function parsePlaceholders(string $string): string
    {
        $parsed = [];

        preg_match_all("/%([A-Z_]*)%/", $string, $aMatches);
        foreach ($aMatches[1] as $key => $value) :
            if (!in_array($value, $parsed, true)) :
                $string = str_replace('%' . $value . '%', $this->get($value), $string);
                $parsed[] = $value;
            endif;
        endforeach;

        return $string;
    }

    public function get(string $key, array $replace = []): string
    {
        $parts = explode('_', $key);
        $module = $parts[0];

        if (!isset($this->translations[$module])) :
            $iniFile = $this->configuration->getTranslationDir() . strtolower($module) . '.ini';
            $moduleIniFile = $this->configuration->getVendorNameDir() . strtolower($module) . '/src/Translations/' . $this->configuration->getLanguageLocale() . '.ini';
            $accountIniFile = $this->configuration->getAccountTranslationDir() . strtolower($module) . '.ini';
            $moduleNameAdminIniFile = $this->configuration->getVendorNameDir() . strtolower($module) . '/src/Translations/' . $this->configuration->getLanguageLocale() . '/admin.ini';
            $this->translations[$module] = null;

            if (is_file($iniFile)) :
                $this->addFileToTranslation($module, $iniFile);
            endif;
            if (is_file($accountIniFile)) :
                $this->addFileToTranslation($module, $accountIniFile);
            endif;
            if (is_file($moduleIniFile)) :
                $this->addFileToTranslation($module, $moduleIniFile);
            endif;
            if (AdminUtil::isAdminPage() && is_file($moduleNameAdminIniFile)) :
                $this->addFileToTranslation($module, $moduleNameAdminIniFile);
            endif;
        endif;

        if ($this->translations[$module] === null) :
            return $key;
        endif;

        $return = $this->translations[$module]->get(str_replace($module . '_', '', $key), $key);

        if (count($replace) > 0) :
            $search = [];
            foreach ($replace as $part) :
                $search[] = '/%s/';
            endforeach;

            $return = preg_replace($search, $replace, $return, 1);
        endif;

        return $return;
    }

    private function addFileToTranslation(string $module, string $file): void
    {
        if (is_file($file)) :
            if ($this->translations[$module] === null) :
                $this->translations[$module] = new Ini($file);
            else :
                $this->translations[$module]->merge(new Ini($file));
            endif;
        endif;
    }
}
