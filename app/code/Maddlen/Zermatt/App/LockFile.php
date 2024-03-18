<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\App;

use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\Framework\View\Design\Theme\ThemePackageList;

class LockFile
{
    private array $modulesConfig;
    private array $themesConfig;
    private array $mergedThemes = [];
    private $themePaths = [];

    public function __construct(
        protected readonly ModuleList         $moduleList,
        protected readonly ComponentRegistrar $componentRegistrar,
        protected readonly ThemePackageList   $themePackageList,
        protected readonly Config             $appConfig
    )
    {
    }


    public function generate(): void
    {
        $this->loadModules();
        $this->loadThemes();
        $this->addModulesToThemes();
        $this->writeFiles();
    }

    private function loadModules(): void
    {
        $modules = $this->moduleList->getNames();
        $moduleConfig = [];

        foreach ($modules as $module) {
            $modulePath = $this->componentRegistrar->getPath(ComponentRegistrar::MODULE, $module);
            $jsonFilePath = $modulePath . '/view/frontend/web/zermatt/zermatt.json';
            if (file_exists($jsonFilePath)) {
                $content = file_get_contents($jsonFilePath);
                $content = str_replace('"./', '"/' . $module. '/zermatt/', $content);
                $config = json_decode($content, true);
                $moduleConfig[$module] = $config;
            }
        }

        $this->modulesConfig = $moduleConfig;
    }

    private function loadThemes(): void
    {
        $config = [];
        $themes = $this->themePackageList->getThemes();

        foreach ($themes as $theme) {
            $jsonFilePath = $theme->getPath() . '/web/zermatt/zermatt.json';
            if (file_exists($jsonFilePath)) {
                $content = file_get_contents($jsonFilePath);
                $content = str_replace('"./', '"/zermatt/', $content);
                $this->themePaths[$theme->getKey()] = $theme->getPath();
                $config[$theme->getKey()] = json_decode($content, true);
            }
        }

        $this->themesConfig = $config;
    }

    private function addModulesToThemes(): void
    {
        foreach ($this->themesConfig as $theme => $themeConfig) {
            foreach ($this->modulesConfig as $module => $moduleConfig) {
                $themeConfig = array_merge($moduleConfig, $themeConfig);
            }
            $this->mergedThemes[$theme] = $themeConfig;
        }
    }

    private function writeFiles(): void
    {
        array_walk($this->mergedThemes, function ($themeConfig, $theme) {

            $finalConfig = [];
            foreach ($themeConfig as $section => $configs) {
                $newConfigs = [];
                foreach ($configs as $key => $value) {
                    $config = [
                        'name' => $key,
                        'path' => $value
                    ];
                    $newConfigs[] = $config;
                }
                $finalConfig[$section] = $newConfigs;
            }


            $filePath = $this->themePaths[$theme] . '/web/zermatt/zermatt-lock.json';
            file_put_contents($filePath, json_encode($finalConfig, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        });
    }


}
